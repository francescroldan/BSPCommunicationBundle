<?php

namespace BSP\CommunicationBundle\Handler;

use BSP\CommunicationBundle\Handler\AbstractCommunicationTypeHandler;

class EmailImmediatelyCommunicationTypeHandler extends AbstractCommunicationTypeHandler
{
    /**
    *	Pending statuses
    */
    const COMMUNICATION_STATUS_EMAIL_CREATED        = 101;

    /**
    *	Final statuses
    */
    const COMMUNICATION_STATUS_EMAIL_SEND           = 901;
    const COMMUNICATION_STATUS_EMAIL_REFUSED        = 902;
	
	protected $mailer;
	protected $templating;

    /**
    *   Send an email immediately with swiftmailer
    *
    *   @param array $options The options array shall contain the keys 'message', 'to' and 'parameters', 
    *                         this is, also, an array with the key 'from' and probably 'text/plain' and/or 'text/html'.
    *
    */
    public function send( array $options = null )
    {
        if ($options === null) 
        {
            throw new \Exception( 'You must specify the data required for sending email' );
        }

        if ($options['message'] === null || $options['message'] == '' ) 
        {
            throw new \Exception( 'You need to specify the email message' );
        }

        if ($options['parameters']['from'] === null || $options['parameters']['from'] == '' ) {
            throw new \Exception( 'You need to specify the email from field' );
        }

        if ($options['to'] === null || $options['to'] == '' ) 
        {
            throw new \Exception( 'You need to specify the email to field' );
        }

		$message = \Swift_Message::newInstance()
		    ->setSubject($options['title'])
            ->setFrom($options['parameters']['from'])
		    ->setTo($options['to']->get('email'))
        ;

        if ( ! empty($options['parameters']['text/plain'])) 
        {
            //If the key 'text/plain' is defined, create the body with this content type
            $message->setBody($options['parameters']['text/plain'], 'text/plain');

            if ( ! empty($options['parameters']['text/html'])) 
            {
                //If the key 'text/html' is defined, also, create a body part with this content type
                $message->addPart($options['parameters']['text/html'], 'text/html');
            }
        }
        elseif ( ! empty($options['parameters']['text/html'])) 
        {
            //If the key 'text/html' is defined, create the body with this content type
            $message->setBody($options['parameters']['text/html'], 'text/html');
        }
        else
        {
            //If the content type is undefined, create the body with the message option and the 'text/plain' content type 
            $message->setBody($options['message'], 'text/plain');
        }

    	return array('result' => $this->mailer->send($message));    	
    }

    public function changeStatus( array $options = null )
    {
        if ($options === null) 
        {
            throw new \Exception( 'You need to specify an email delivery' );
        }

        if ($options['result'] === null || $options['result'] == '' ) 
        {
            throw new \Exception( 'You need to specify an email delivery result' );
        }

        return $options['result']? self::COMMUNICATION_STATUS_EMAIL_SEND : self::COMMUNICATION_STATUS_EMAIL_REFUSED;

	}
    
    /**
     * Getter for mailer
     *
     * @return mixed
     */
    public function getMailer()
    {
        return $this->mailer;
    }
    
    /**
     * Setter for mailer
     *
     * @param mixed $mailer Value to set
     *
     * @return self
     */
    public function setMailer($mailer)
    {
        $this->mailer = $mailer;
        return $this;
    }
    
    /**
     * Getter for templating
     *
     * @return mixed
     */
    public function getTemplating()
    {
        return $this->templating;
    }
    
    /**
     * Setter for templating
     *
     * @param mixed $templating Value to set
     *
     * @return self
     */
    public function setTemplating($templating)
    {
        $this->templating = $templating;
        return $this;
    }
    
    public function getType()
    {
        return 'email_immediately';
    }
}
