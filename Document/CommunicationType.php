<?php

namespace BSP\CommunicationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;

use BSP\CommunicationBundle\Model\CommunicationType as BaseCommunicationType;

/**
 * @MongoDB\EmbeddedDocument
 */
class CommunicationType extends BaseCommunicationType
{
    /**
     * @MongoDB\Collection
     */
    protected $parameters;

    /**
     * @MongoDB\String
     */
    protected $type;

    /**
     * @MongoDB\Int
     */
    protected $status;

    /**
     * @MongoDB\Date
     */
    protected $updatedAt;

    /** @MongoDB\PrePersist */
    public function prePersistCart()
    {
        $this->updatedAt = new \DateTime();
    }

    /** @MongoDB\PreUpdate */
    public function preUpdateCart()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Getter for parameters
     *
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }
    
    /**
     * Setter for parameters
     *
     * @param mixed $parameters Value to set
     *
     * @return self
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }
    
    /**
     * Getter for type
     *
     * @return collection
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Setter for type
     *
     * @param mixed $type Value to set
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Getter for status
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * Setter for status
     *
     * @param mixed $status Value to set
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
    

}
