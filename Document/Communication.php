<?php

namespace BSP\CommunicationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;

use BSP\CommunicationBundle\Model\Communication as BaseCommunication;

/**
 * @MongoDB\Document(collection="communications")
 */
class Communication extends BaseCommunication
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument="BSP\CommunicationBundle\Document\Communication")
     */
    protected $related;

    /**
     * @MongoDB\EmbedMany(targetDocument="BSP\CommunicationBundle\Document\CommunicationType")
     */
    protected $types;

    /**
     * @MongoDB\Date
     */
    protected $createdAt;

    /**
     * @MongoDB\Date
     */
    protected $updatedAt;

    /**
     * @MongoDB\EmbedOne(targetDocument="BSP\CommunicationBundle\Document\CommunicationData")
     */
    protected $to;

    /**
     * @MongoDB\String
     */
    protected $title;

    /**
     * @MongoDB\String
     */
    protected $message;

    /**
     * @MongoDB\String
     */
    protected $contentType;


    /** @MongoDB\PrePersist */
    public function prePersistCart()
    {
        $this->incrementCreatedAt();
    }

    /** @MongoDB\PreUpdate */
    public function preUpdateCart()
    {
        $this->incrementUpdatedAt();
    }
    
    /**
     * Getter for id
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Is this communication related to another one?
     *
     * @return boolean
     */
    public function hasRelated()
    {
        return $this->related == null;
    }
    
    /**
     * Getter for related
     *
     * @return mixed
     */
    public function getRelated()
    {
        return $this->related;
    }
    
    /**
     * Setter for related
     *
     * @param QDDS\CommunicationBundle\Document\Communication $related Communication related
     *
     * @return self
     */
    public function setRelated($related)
    {
        $this->related = $related;
        return $this;
    }
    
    /**
     * Getter for types
     *
     * @return collection
     */
    public function getTypes()
    {
        return $this->types;
    }
    
    /**
     * Add type
     *
     * @param mixed $type Value to add
     *
     * @return self
     */
    public function addType($type)
    {
        $this->types[] = $type;
        return $this;
    }

    /**
     * Setter for types
     *
     * @param mixed $types Value to set
     *
     * @return self
     */
    public function setTypes($types)
    {
        $this->types = $types;
        return $this;
    }

    /**
     * Getter for createdAt
     *
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * Setter for createdAt
     *
     * @param mixed $createdAt Value to set
     *
     * @return self
     */
    public function setCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        $this->updatedAt = new \DateTime();
        return $this;
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
    
    /**
     * Getter for title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Setter for title
     *
     * @param mixed $title Value to set
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Getter for message
     *
     * @return String
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Setter for message
     *
     * @param mixed $message Value to set
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
    
    /**
     * Getter for contentType
     *
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }
    
    /**
     * Setter for contentType
     *
     * @param mixed $contentType Value to set
     *
     * @return self
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }
    
}
