<?php

namespace BSP\CommunicationBundle\Model;

use BSP\CommunicationBundle\Model\CommunicationInterface;

interface CommunicationManagerInterface
{
    public function getClass();
    public function createCommunication();
    public function findCommunicationBy(array $criteria);
    public function findCommunicationById( $id );
    public function findCommunications();
    public function updateCommunication( CommunicationInterface $communication, $andFlush = true );
}
