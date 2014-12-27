<?php

namespace BSP\CommunicationBundle\Model;

interface CommunicationTypeInterface
{

    /**
    *   Communication types
    */
    /*
    const COMMUNICATION_TYPE_INTERNAL               = 100;
    const COMMUNICATION_TYPE_EMAIL                  = 200;
        const COMMUNICATION_TYPE_EMAIL_IMMEDIATE    = 201;
        const COMMUNICATION_TYPE_EMAIL_QUEUED       = 210;
    const COMMUNICATION_TYPE_PHONE                  = 300;
        const COMMUNICATION_TYPE_PHONE_SMS          = 301;
        const COMMUNICATION_TYPE_PHONE_CALL         = 310;
        const COMMUNICATION_TYPE_PHONE_WASSAP       = 320;
    const COMMUNICATION_TYPE_TWITTER                = 400;
    const COMMUNICATION_TYPE_FACEBOOK               = 500;
    */
    /**
    *   Communication statuses
    */
    /*
    const COMMUNICATION_STATUS_CREATED              = 000;

    const COMMUNICATION_STATUS_INTERNAL_PENDING     = 100;
    const COMMUNICATION_STATUS_INTERNAL_SEND        = 230;

    const COMMUNICATION_STATUS_EMAIL_PENDING        = 200;
    const COMMUNICATION_STATUS_EMAIL_QUEUED         = 210;
    const COMMUNICATION_STATUS_EMAIL_SEND           = 230;
    const COMMUNICATION_STATUS_EMAIL_REFUSED        = 240;

    const COMMUNICATION_STATUS_FINISHED             = 900;
    */
    public function getFrom();
    public function setFrom($from);
    public function getType();
    public function setType($type);
    public function getStatus();
    public function setStatus($status);
    public function getUpdatedAt();
    public function setUpdatedAt($updatedAt);
}
