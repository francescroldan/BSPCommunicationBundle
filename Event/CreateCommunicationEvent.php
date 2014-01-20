<?php
namespace BSP\CommunicationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use BSP\CommunicationBundle\Model\CommunicationInterface;

class CreateCommunicationEvent extends Event
{
    protected $communication;
    protected $to;
    protected $types;
    protected $title;
    protected $message;
    protected $contentType;
    protected $related;

    public function __construct(CommunicationInterface $communication, $to, $types, $title, $message, $contentType, $related )
    {
        $this->communication = $communication;
        $this->to = $to;
        $this->types = $types;
        $this->title = $title;
        $this->message = $message;
        $this->contentType = $contentType;
        $this->related = $related;
    }

    public function getCommunication()
    {
        return $this->communication;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getTypes()
    {
        return $this->types;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getContentType()
    {
        return $this->contentType;
    }

    public function getRelated()
    {
        return $this->related;
    }
}