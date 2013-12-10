# BSPCommunicationBundle


This bundle allows to centralize the communications with your users.

## Installation


## Basic Usage

This bundle abstracts you from mailer's services, calling simply to his manipulator:

``` php
$manipulator = $this->get('bsp.communication.manipulator');

$email_from = "from@email.com";
$user = $this->getUser();

$message = $this->templating->render('AcmeTestBundle:Email:testEmail.html.twig');

$this->communicationManipulator->createCommunication($email_from, $user(), array('email_immediately'), $message, 'text/html' );

```
Note that `email_from` is an email address and `$user` is an instance of `BSP\CommunicationBundle\Model\Communicable` interface.


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

    public function __construct(CommunicationManipulator $communicationManipulator, UrlGeneratorInterface $router, EngineInterface $templating, array $parameters)
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

        $message = $this->templating->render($template, array(
            'user' => $user,
            'confirmationUrl' =>  $url
        ));

        $this->communicationManipulator->createCommunication($this->parameters['from_email']['confirmation'], $user, array('email_immediately'), $message, 'text/html' );
    }

    public function sendResettingEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['template']['resetting'];
        $url = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);

        $message = $this->templating->render($template, array(
            'user' => $user,
            'confirmationUrl' =>  $url
        ));

        $this->communicationManipulator->createCommunication($this->parameters['from_email']['resetting'], $user, array('email_immediately'), $message, 'text/html' );
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
          - @templating
          - { template: { confirmation: %fos_user.registration.confirmation.template%, resetting: %fos_user.resetting.email.template% }, from_email: { confirmation: %fos_user.registration.confirmation.from_email%, resetting: %fos_user.resetting.email.from_email% } }
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
