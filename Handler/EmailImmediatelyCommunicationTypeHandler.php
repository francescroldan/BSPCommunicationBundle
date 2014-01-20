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
    *   Send an email immediately
    *
    *   @param array $options The options array shall contain the keys 'message', 'to' and 'from'.
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

        if ($options['from'] === null || $options['from'] == '' ) {
            throw new \Exception( 'You need to specify the email from field' );
        }

        if ($options['to'] === null || $options['to'] == '' ) 
        {
            throw new \Exception( 'You need to specify the email to field' );
        }

		$message = \Swift_Message::newInstance()
		    ->setSubject($options['title'])
            ->setFrom($options['from'])
		    ->setTo($options['to']->get('email'))
		    ->setBody($options['message'])
            ->setContentType($options['contentType'])
		;
        die(var_export($options['to']->get('email'), 1));
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
