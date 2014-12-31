# BSPCommunicationBundle


This bundle allows to centralize the communications with your users.

## Installation

Installation is a 3 step process:

1. Download BSPCommunicationBundle using composer
2. Enable the Bundle
3. Configure the bundle

### Step 1: Download BSPCommunicationBundle using composer

``` js
{
	"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/francescroldan/BSPCommunicationBundle"
        }
    ],
    "require": {
        "francescroldan/bsp-communication-bundle": "0.1.*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update francescroldan/bsp-communication-bundle
```

Composer will install the bundle to your project's `vendor/francescroldan/bsp-communication-bundle` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new BSP\CommunicationBundle\BSPCommunicationBundle(),
    );
}
```
### Step 3: Configure the bundle

Add the following lines to your config.yml

``` yaml
# app/config/config.yml

bsp_communication:
    db_driver: mongodb # Currently only works with mongodb, we are working on orm
```

And you are done!

## Basic Usage

This bundle abstracts you from any kind of communicaion services, calling simply to his manipulator:

``` php
$communicationManipulator = $this->get('bsp.communication.manipulator');

$email_from = "from@email.com";
$user = $this->getUser();

$subject = "Some subject text";
$message = $this->templating->render('AcmeTestBundle:Email:testEmail.html.twig');

$this->communicationManipulator->createCommunication(	$user, 
							array(array('email_immediately', 
							array('from' => $email_from, 'text/plain' => $message))), 
							$subject, 
							$message);

```

Note that `$user` is an instance of `BSP\CommunicationBundle\Model\Communicable` interface, and manipulator's second parameter is an array of all sending's types you would to use like this:

``` php
array(
	array('email_immediately', array('from' => $email_from, 'text/plain' => $text_body, 'text/html' => $html_body)),
	array('sms', $telephone_sms_from), // not implemented yet
	array('wassap', $telephone_wassap_from), // not implemented yet
)

```

When communication is created, a new register is added on "communications" table/collection. You can use that to implement a delayed email sender service cron or a simply as a log.

## Custom communication type sender


The bundle includes, currently, only the sending type "email immediately", to add your own communicaion type sender just make a handler that extends `BSP\CommunicationBundle\Handler\AbstractCommunicationTypeHandler`, like `BSP\CommunicationBundle\Handler\EmailImmediatelyCommunicationTypeHandler`.

Don't forget to register it as a service:

``` yml
# src/ACME/YourCommunicationBundle/Resources/config/services.yml
    acme.your_communication.communication_type_handler.custom_communication_type:
        class: %acme.your_communication.custom_communication_type_handler.class%
        calls:
            - [ setRequiredService, [@required_service] ]
        tags:
            - { name: bsp.communication.communication_type_handler }

```

## Integrating with FOSUserBundle

It's very easy to integrate with [FOSUserBundle][FriendsOfSymfony/FOSUserBundle], just make a [custom mailer][mailer] like this:

``` php
// src/ACME/UserBundle/Mailer/AcmeMailer
<?php
namespace ACME\UserBundle\Mailer;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\MailerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Templating\EngineInterface;
use BSP\CommunicationBundle\Manipulator\CommunicationManipulator;

class AcmeMailer implements MailerInterface
{
    protected $communicationManipulator;
    protected $router;
    protected $templating;
    protected $parameters;

    public function __construct(CommunicationManipulator $communicationManipulator, UrlGeneratorInterface $router, \Twig_Environment $templating, array $parameters)
    {
        $this->communicationManipulator = $communicationManipulator;
        $this->router = $router;
        $this->templating = $templating;
        $this->parameters = $parameters;
    }

    public function sendConfirmationEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['template']['confirmation'];
        $url = $this->router->generate('fos_user_registration_confirm', array('token' => $user->getConfirmationToken()), true);
        $context = array(
            'user' => $user,
            'confirmationUrl' => $url
        );

        $this->sendMessage($template, $context, $this->parameters['from_email']['confirmation'], $user);
    }

    public function sendResettingEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['template']['resetting'];
        $url = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);
        $context = array(
            'user' => $user,
            'confirmationUrl' => $url
        );
        $this->sendMessage($template, $context, $this->parameters['from_email']['resetting'], $user);
    }

    /**
     * @param string $templateName
     * @param array  $context
     * @param string $fromEmail
     * @param string $toEmail
     */
    protected function sendMessage($templateName, $context, $fromEmail, $to)
    {
        $template = $this->templating->loadTemplate($templateName);
        $subject = $template->renderBlock('subject', $context);
        $textBody = $template->renderBlock('body_text', $context);
        $htmlBody = $template->renderBlock('body_html', $context);

        if ( ! empty($htmlBody)) 
        {
            $message = $htmlBody;
        } 
        else 
        {
            $message = $textBody;
        }

        $this->communicationManipulator->createCommunication(   $to, 
                                                                array(array('email_immediately', array('from' => key($fromEmail), 'text/plain' => $textBody, 'text/html' => $htmlBody))), 
                                                                $subject,
                                                                $message);
 
    }
}

```

define it as a service:

``` yml
# src/ACME/UserBundle/Resources/config/services.yml
parameters:
    acme.user.mailer.class: ACME\UserBundle\Mailer\AcmeMailer
services:
    acme.user.mailer:
      class: %acme.user.mailer.class%
      arguments:
          - @bsp.communication.manipulator
          - @router
          - @twig
          - { template: { confirmation: %fos_user.registration.confirmation.template%, resetting: %fos_user.resetting.email.template% }, from_email: { confirmation: %fos_user.registration.confirmation.from_email%, resetting: %fos_user.resetting.email.from_email% } }
```

add to your User class:

``` php

use BSP\CommunicationBundle\Model\Communicable;

class User extends BaseUser implements Communicable

```

and add to your FOSUserBundle configuration:

``` yml
# app/config/config.yml

fos_user:
    service:
        mailer: acme.user.mailer

```

[FriendsOfSymfony/FOSUserBundle]: https://github.com/FriendsOfSymfony/FOSUserBundle
[mailer]:https://github.com/FriendsOfSymfony/FOSUserBundle/blob/master/Resources/doc/emails.md#using-a-custom-mailer
