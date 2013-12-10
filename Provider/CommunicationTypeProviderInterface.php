<?php

namespace BSP\CommunicationBundle\Provider;

use BSP\CommunicationBundle\Handler\CommunicationTypeHandlerInterface;

interface CommunicationTypeProviderInterface
{
    public function addCommunicationTypeHandler(CommunicationTypeHandlerInterface $handler);
    public function listCommunicationTypeHandlers();
}
