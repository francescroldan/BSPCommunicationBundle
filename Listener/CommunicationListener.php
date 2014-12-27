<?php

namespace BSP\CommunicationBundle\Listener;

use BSP\CommunicationBundle\Model\CommunicationManagerInterface;
use BSP\CommunicationBundle\Provider\CommunicationTypeSenderProvider;
use BSP\CommunicationBundle\Event\CommunicationEvent;
use BSP\CommunicationBundle\Model\CommunicationInterface;

class CommunicationListener
{
    protected $communicationManager;
    protected $communicationTypeSenderProvider;

    public function __construct( CommunicationManagerInterface $communicationManager)
    {
        $this->communicationManager = $communicationManager;
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
        
    public function onSendCommunication( CommunicationEvent $event )
    {
        $communication = $event->getCommunication();

        foreach ($communication->getTypes() as $type) 
        {
            $resultSended = $this->communicationTypeSenderProvider->send($type->getType(), $communication->serialize());
            $type->setStatus($this->communicationTypeSenderProvider->changeStatus($type->getType(), array('result' => $resultSended)));
        }

        $this->communicationManager->updateCommunication($communication);
    }
}
