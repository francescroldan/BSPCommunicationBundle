<?php

namespace BSP\CommunicationBundle\Event;

final class CommunicationEvents
{
    /**
     * The bsp.communication.communication_created event is thrown each time a communication is created
     * in the system.
     *
     * The event listener receives an
     * Acme\StoreBundle\Event\FilterOrderEvent instance.
     *
     * @var string
     */
    const COMMUNICATION_CREATED = 'bsp.communication.communication_created';
    const COMMUNICATION_SENDED = 'bsp.communication.communication_sended';

}
