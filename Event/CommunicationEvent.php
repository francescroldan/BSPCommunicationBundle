<?php
namespace BSP\CommunicationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use BSP\CommunicationBundle\Model\CommunicationInterface;

class CommunicationEvent extends Event
{
    protected $communication;

    public function __construct(CommunicationInterface $communication)
    {
        $this->communication = $communication;
    }

    public function getCommunication()
    {
        return $this->communication;
    }
}