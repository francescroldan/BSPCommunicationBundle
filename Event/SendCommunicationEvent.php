<?php
namespace BSP\CommunicationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use BSP\CommunicationBundle\Model\CommunicationInterface;

class SendCommunicationEvent extends Event
{
    protected $communication;
    protected $types;

    public function __construct(CommunicationInterface $communication, $types = null)
    {
        $this->communication = $communication;
        $this->types = $types;
    }

    public function getCommunication()
    {
        return $this->communication;
    }

    public function getTypes()
    {
        return $this->types;
    }
}