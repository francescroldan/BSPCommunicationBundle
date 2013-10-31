<?php

namespace BSP\CommunicationBundle\Handler;

interface CommunicationTypeHandlerInterface
{
    public function getType();
    public function send( array $options = null );
    public function changeStatus( array $options = null );
}
