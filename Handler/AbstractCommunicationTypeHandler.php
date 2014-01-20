<?php

namespace BSP\CommunicationBundle\Handler;

use BSP\CommunicationBundle\Handler\CommunicationTypeHandlerInterface;

abstract class AbstractCommunicationTypeHandler implements CommunicationTypeHandlerInterface
{
    /**
    *	Pending statuses
    */
    const COMMUNICATION_STATUS_CREATED        = 100;

    /**
    *	Final statuses, always over than 900
    */
    const COMMUNICATION_STATUS_SEND           = 900;

    public function send( array $options = null )
    {
        throw new \Exception("Sorry send() doesn't have default functionality in place");
    }
    
    public function changeStatus( array $options = null )
    {
        throw new \Exception("Sorry changeStatus() doesn't have default functionality in place");
    }
    
    public function getType()
    {
        throw new \Exception("Sorry getType() doesn't have default functionality in place");
    }
}
