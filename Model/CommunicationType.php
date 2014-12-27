<?php

namespace BSP\CommunicationBundle\Model;

use BSP\CommunicationBundle\Model\CommunicationTypeInterface;
use BSP\CommunicationBundle\Handler\AbstractCommunicationTypeHandler;

class CommunicationType implements CommunicationTypeInterface
{
    protected $from;
    protected $type;
    protected $status;
    protected $updatedAt;


    public function __construct(array $type, $status = AbstractCommunicationTypeHandler::COMMUNICATION_STATUS_CREATED)
    {
        $this->type = $type[0];
        $this->from = $type[1];
        $this->status = $status;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Getter for updatedAt
     *
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * Setter for updatedAt
     *
     * @param mixed $updatedAt Value to set
     *
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    
    public function serialize()
    {
        return array(
            'type' => $this->type,
            'from' => $this->from,
            'status' => $this->status,
            );
    }
}
