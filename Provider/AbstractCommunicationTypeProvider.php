<?php

namespace BSP\CommunicationBundle\Provider;

use BSP\CommunicationBundle\Provider\CommunicationTypeProviderInterface;
use BSP\CommunicationBundle\Handler\CommunicationTypeHandlerInterface;

abstract class AbstractCommunicationTypeProvider implements CommunicationTypeProviderInterface
{
    protected $handlers;

    public function addCommunicationTypeHandler(CommunicationTypeHandlerInterface $handler)
    {
        $type = $handler->getType();

        if (isset($this->handlers[$type])) 
        {
            throw new \Exception("CommunicationType Handler '$type' duplicated");
        }
        
        $this->handlers[$type] = $handler;
    }

    protected function getCommunicationTypeHandler($type)
    {
        if ( ! isset($this->handlers[$type])) 
        {
            throw new \Exception("CommunicationType Handler '$type' does not exists");
        }

        return $this->handlers[$type];
    }

    public function listCommunicationTypeHandlers()
    {
        if (isset($this->handlers)) 
        {
            return array_keys($this->handlers);
        }

        return array();
    }
}
