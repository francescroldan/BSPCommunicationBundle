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
    const COMMUNICATION_STATUS_EMAIL_SEND           = 900;
    const COMMUNICATION_STATUS_EMAIL_REFUSED        = 950;
	
	protected $mailer;
	protected $templating;

    public function send( array $options = null )
    {
        if ($options === null) 
        {
            throw new \Exception( 'You must specify the data required for sending email' );
        }

        //die(var_export(array_keys($options), 1));
        if ($options['message'] === null || $options['message'] == '' ) 
        {
            throw new \Exception( 'You need to specify the email message' );
        }

        /*if ($options['from'] === null || $options['from'] == '' ) {
            throw new \Exception( 'You need to specify the email from field' );
        }*/

        if ($options['to'] === null || $options['to'] == '' ) 
        {
            throw new \Exception( 'You need to specify the email to field' );
        }

		$message = \Swift_Message::newInstance()
		    ->setSubject('Hello Email')
            ->setFrom($options['from'])
		    ->setTo($options['to']->getEmail())
		    ->setBody(
                $options['message']
		    )
		;

    	return $this->mailer->send($message);    	
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
