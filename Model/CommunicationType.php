<?php

namespace BSP\CommunicationBundle\Model;

use BSP\CommunicationBundle\Model\CommunicationTypeInterface;
use BSP\CommunicationBundle\Handler\AbstractCommunicationTypeHandler;

class CommunicationType implements CommunicationTypeInterface
{
    protected $parameters;
    protected $type;
    protected $status;
    protected $updatedAt;


    public function __construct(array $type, $status = AbstractCommunicationTypeHandler::COMMUNICATION_STATUS_CREATED)
    {
        $this->type = $type[0];
        $this->parameters = $type[1];
        $this->status = $status;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
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
            'parameters' => $this->parameters,
            'status' => $this->status,
            );
    }
}
