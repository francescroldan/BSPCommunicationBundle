<?php

namespace BSP\CommunicationBundle\Model;

use BSP\CommunicationBundle\Model\CommunicationInterface;

use Doctrine\Common\Collections\ArrayCollection;

class Communication implements CommunicationInterface
{
    protected $id;
    protected $related;
    protected $types;
    protected $status;
    protected $createdAt;
    protected $updatedAt;
    protected $from;
    protected $to;
    protected $message;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->setCreatedAt();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId( $id )
    {
        $this->id = $id;
        return $this;
    }

    public function getRelated()
    {
        return $this->related;
    }

    public function setRelated( $related )
    {
        $this->related = $related;
        return $this;
    }

    public function getTypes()
    {
        return $this->types;
    }

    public function addType($type)
    {
        $this->types[] = $type;
        return $this;
    }

    public function setTypes($types)
    {
        $this->types = $types;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        $this->updatedAt = new \DateTime();
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function getArrayData()
    {
        return array(
                'id' => $this->id,
                'related' => $this->related,
                'types' => $this->types,
                'status' => $this->status,
                'createdAt' => $this->createdAt,
                'updatedAt' => $this->updatedAt,
                'from' => $this->from,
                'to' => $this->to,
                'message' => $this->message,
            );
    }
}
