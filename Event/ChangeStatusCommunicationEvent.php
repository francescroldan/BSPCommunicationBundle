<?php
namespace BSP\CommunicationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use BSP\CommunicationBundle\Model\CommunicationInterface;

class ChangeStatusCommunicationEvent extends Event
{
    protected $communication;
    protected $typeName;
    protected $options;

    public function __construct(CommunicationInterface $communication, $typeName, $options)
    {
        $this->communication = $communication;
        $this->typeName = $typeName;
        $this->options = $options;
    }

    public function getCommunication()
    {
        return $this->communication;
    }

    public function getTypeName()
    {
        return $this->typeName;
    }

    public function getOptions()
    {
        return $this->options;
    }
}