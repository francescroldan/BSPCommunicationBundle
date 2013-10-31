<?php

namespace BSP\CommunicationBundle\Handler;

use BSP\CommunicationBundle\Handler\CommunicationTypeHandlerInterface;

abstract class AbstractCommunicationTypeHandler implements CommunicationTypeHandlerInterface
{
    public function send( array $options = null )
    {
        throw new \Exception("Sorry send() doesn't have default functionality in place");
    }
    
    public function changeStatus( array $options = null )
    {
        throw new \Exception("Sorry changeStatus() doesn't have default functionality in place");
    }
}
