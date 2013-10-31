<?php

namespace BSP\CommunicationBundle\Manipulator;

use BSP\CommunicationBundle\Event\CommunicationEvents;
use BSP\CommunicationBundle\Model\Communicable;
use BSP\CommunicationBundle\Event\CommunicationEvent;

class CommunicationManipulator
{
    protected $communicationManager;
    protected $dispatcher;

    public function __construct( $cm, $dispatcher )
    {
        $this->communicationManager = $cm;
        $this->dispatcher = $dispatcher;
    }

    public function createCommunication( $from, Communicable $to, Array $types, $message, $related = null )
    {
        $communication = $this->communicationManager->createCommunication();
        $communication->setFrom($from);
        $communication->setTo($to);
        
        $typeClass   = $this->communicationManager->getCommUnicationTypeClass();
        foreach ($types as $type) 
        {
            $communication->addType(new $typeClass($type));
        }

        $communication->setMessage($message);
        
        if ($related != null) 
        {
            $communication->setRelated($related);
        }
        
        $this->communicationManager->updateCommunication( $communication );
        
        if (null != $this->dispatcher) 
        {
            $this->dispatcher->dispatch( CommunicationEvents::COMMUNICATION_CREATED,  new CommunicationEvent($communication) );
        }

        return $communication;
    }

    public function sendCommunication( $communication, $date = null )
    {
        $communication = $this->_getCommunication($communication);
        $date = ( $date == null)? new \DateTime() : $date;
        $communication->setDate( $date );
        $this->communicationManager->updateCommunication( $communication );
        
        return $communication;
    }
    
    protected function _getCommunication( $communication )
    {
        if ( is_string($communication) ) {
            $ncommunication = $this->communicationManager->findCommunicationtById( $communication );
            if (! $ncommunication) {
                throw new \Exception( 'Communication ' . $communication . ' not found' );
            }

            return $ncommunication;
        }

        return $communication;
    }
}
