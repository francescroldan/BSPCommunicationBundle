<?php

namespace BSP\CommunicationBundle\Manipulator;

use BSP\CommunicationBundle\Event\CommunicationEvents;
use BSP\CommunicationBundle\Model\Communicable;
use BSP\CommunicationBundle\Event\CreateCommunicationEvent;
use BSP\CommunicationBundle\Event\SendCommunicationEvent;
use BSP\CommunicationBundle\Event\ChangeStatusCommunicationEvent;

class CommunicationManipulator
{
    protected $communicationManager;
    protected $dispatcher;

    public function __construct( $cm, $dispatcher )
    {
        $this->communicationManager = $cm;
        $this->dispatcher = $dispatcher;
    }

    public function createCommunication(Communicable $to, Array $types, $title, $message, $contentType = 'text/plain', $related = null )
    {
        $communication = $this->communicationManager->createCommunication();
               
        if (null != $this->dispatcher) 
        {
            $this->dispatcher->dispatch( CommunicationEvents::COMMUNICATION_CREATED,  new CreateCommunicationEvent($communication, $to, $types, $title, $message, $contentType, $related) );
        }

        return $communication;
    }

    public function sendCommunication( $communication, $types = null )
    {
        $communication = $this->_getCommunication($communication);

        if (null != $this->dispatcher) 
        {
            $this->dispatcher->dispatch( CommunicationEvents::COMMUNICATION_SENDED,  new SendCommunicationEvent($communication, $types) );
        }
        else
        {
            throw new \Exception( 'The event dispatcher is not enabled.' );
        }
        
        return $communication;
    }
    
    public function changeStatusCommunication( $communication, $typeName, $options )
    {
        $communication = $this->_getCommunication($communication);

        if (null != $this->dispatcher) 
        {
            $this->dispatcher->dispatch( CommunicationEvents::COMMUNICATION_STATUS_CHANGED,  new ChangeStatusCommunicationEvent($communication, $typeName, $options ) );
        }
        
        return $communication;
    }
    
    protected function _getCommunication( $communication )
    {
        if ( is_string($communication) ) 
        {
            $ncommunication = $this->communicationManager->findCommunicationById( $communication );
            
            if (! $ncommunication) 
            {
                throw new \Exception( 'Communication ' . $communication . ' not found' );
            }

            return $ncommunication;
        }

        return $communication;
    }
}
