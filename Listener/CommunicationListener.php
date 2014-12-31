<?php

namespace BSP\CommunicationBundle\Listener;

use BSP\CommunicationBundle\Model\CommunicationManagerInterface;
use BSP\CommunicationBundle\Provider\CommunicationTypeSenderProvider;
use BSP\CommunicationBundle\Event\CreateCommunicationEvent;
use BSP\CommunicationBundle\Event\SendCommunicationEvent;
use BSP\CommunicationBundle\Event\ChangeStatusCommunicationEvent;

use BSP\CommunicationBundle\Document\CommunicationData;

class CommunicationListener
{
    protected $communicationManipulator;
    protected $communicationManager;
    protected $communicationTypeSenderProvider;
        
    public function onCreateCommunication( CreateCommunicationEvent $event )
    {
        $communication = $event->getCommunication();
        $to = $event->getTo();
        $types = $event->getTypes();
        $title = $event->getTitle();
        $message = $event->getMessage();
        $related = $event->getRelated();
        
        $communication->setTo(new CommunicationData($to));
        
        $typeClass   = $this->communicationManager->getCommunicationTypeClass();
        foreach ($types as $type) 
        {
            $communication->addType(new $typeClass($type));
        }

        $communication->setTitle($title);
        $communication->setMessage($message);
        
        if ($related != null) 
        {
            $communication->setRelated($related);
        }

        $this->communicationManager->updateCommunication( $communication );
        
        $this->communicationManipulator->sendCommunication($communication);
    }

    public function onSendCommunication( SendCommunicationEvent $event )
    {
        $communication = $event->getCommunication();
        $types = $event->getTypes();

        foreach ($communication->getTypes() as $type) 
        {
            // if a communication type is not in a final status(less than 900)
            if ($type->getStatus() < 900)
            {
                if ( is_array($types) && ! empty($types) && ! in_array($type->getType(), $types))
                {
                   continue;
                }
                $resultSended = $this->communicationTypeSenderProvider->send($type->getType(), array_merge($type->serialize(), $communication->serialize()));

                $this->communicationManipulator->changeStatusCommunication($communication, $type->getType(), $resultSended);
            }
        }

        $this->communicationManager->updateCommunication($communication);
    }

    public function onChangeStatusCommunication( ChangeStatusCommunicationEvent $event )
    {
        $communication = $event->getCommunication();
        $typeName = $event->getTypeName();
        $options = $event->getOptions();

        foreach ($communication->getTypes() as $type) 
        {
            if ($type->getType() == $typeName)
            {
                $type->setStatus($this->communicationTypeSenderProvider->changeStatus($typeName, $options));
                break;
            }
        }
        
        $this->communicationManager->updateCommunication($communication);        
    }

    /**
     * Getter for communicationManager
     *
     * @return mixed
     */
    public function getCommunicationManager()
    {
        return $this->communicationManager;
    }
    
    /**
     * Setter for communicationManager
     *
     * @param mixed $communicationManager Value to set
     *
     * @return self
     */
    public function setCommunicationManager($communicationManager)
    {
        $this->communicationManager = $communicationManager;
        return $this;
    }
    
    /**
     * Getter for communicationManipulator
     *
     * @return mixed
     */
    public function getCommunicationManipulator()
    {
        return $this->communicationManipulator;
    }
    
    /**
     * Setter for communicationManipulator
     *
     * @param mixed $communicationManipulator Value to set
     *
     * @return self
     */
    public function setCommunicationManipulator($communicationManipulator)
    {
        $this->communicationManipulator = $communicationManipulator;
        return $this;
    }
    
    /**
     * Getter for communicationTypeSenderProvider
     *
     * @return mixed
     */
    public function getCommunicationTypeSenderProvider()
    {
        return $this->communicationTypeSenderProvider;
    }
    
    /**
     * Setter for communicationTypeSenderProvider
     *
     * @param mixed $communicationTypeSenderProvider Value to set
     *
     * @return self
     */
    public function setCommunicationTypeSenderProvider(CommunicationTypeSenderProvider $communicationTypeSenderProvider)
    {
        $this->communicationTypeSenderProvider = $communicationTypeSenderProvider;
        return $this;
    }
}
