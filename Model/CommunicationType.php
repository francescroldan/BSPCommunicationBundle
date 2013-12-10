<?php

namespace BSP\CommunicationBundle\Model;

use BSP\CommunicationBundle\Model\CommunicationTypeInterface;

class CommunicationType implements CommunicationTypeInterface
{
    const COMMUNICATION_STATUS_CREATED = 100;

    protected $type;
    protected $status;

    public function __construct($type, $status = self::COMMUNICATION_STATUS_CREATED)
    {
        $this->type = $type;
        $this->status = $status;
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
}
