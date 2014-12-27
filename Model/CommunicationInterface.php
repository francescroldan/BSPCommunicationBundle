<?php

namespace BSP\CommunicationBundle\Model;

interface CommunicationInterface
{

    public function getId();
    public function setId($id);
    public function getRelated();
    public function setRelated($related);
    public function getTypes();
    public function addType($type);
    public function setTypes($types);
    public function getCreatedAt();
    public function setCreatedAt();
    public function getUpdatedAt();
    public function setUpdatedAt($updatedAt);
    public function getTo();
    public function setTo($to);
    public function getTitle();
    public function setTitle($title);
    public function getMessage();
    public function setMessage($message);
    public function getContentType();
    public function setContentType($contentType);
    public function serialize();
}
