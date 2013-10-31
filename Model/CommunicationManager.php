<?php

namespace BSP\CommunicationBundle\Model;

use BSP\CommunicationBundle\Model\CommunicationManagerInterface;

abstract class CommunicationManager implements CommunicationManagerInterface
{
    protected $dispatcher;

    public function setEventDispatcher($dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function createCommunication( )
    {
        $class = $this->getClass();
        $communication = new $class();

        return $communication;
    }

    public function findCommunicationById( $id )
    {
        return $this->findCommunicationBy( array( 'id' => $id ) );
    }
}
