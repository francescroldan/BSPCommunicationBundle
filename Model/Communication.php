<?php

namespace BSP\CommunicationBundle\Model;

use BSP\CommunicationBundle\Model\CommunicationInterface;

use Doctrine\Common\Collections\ArrayCollection;

class Communication implements CommunicationInterface
{
    protected $id;
    protected $related;
    protected $types;
    protected $createdAt;
    protected $updatedAt;
    protected $to;
    protected $title;
    protected $message;
    protected $contentType;

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

    public function incrementCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        $this->updatedAt = new \DateTime();
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

    public function incrementUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
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

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
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
    
    public function getMessage()
    {
        return $this->message;
    }

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
    

    public function serialize()
    {
        return array(
                'id' => $this->id,
                'related' => $this->related,
                'types' => $this->types,
                'createdAt' => $this->createdAt,
                'updatedAt' => $this->updatedAt,
                'to' => $this->to,
                'title' => $this->title,
                'message' => $this->message,
                'contentType' => $this->contentType,
            );
    }
}
