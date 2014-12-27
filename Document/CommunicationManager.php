<?php

namespace BSP\CommunicationBundle\Document;

use BSP\CommunicationBundle\Model\CommunicationManager as BaseCommunicationManager;
use BSP\CommunicationBundle\Model\CommunicationInterface;
use BSP\CommunicationBundle\Event\CommunicationEvents;
use BSP\CommunicationBundle\Event\CommunicationEvent;

class CommunicationManager extends BaseCommunicationManager
{
    protected $dm;
    protected $repository;
    protected $class;
    protected $commUnicationTypeClass;

    public function __construct($dm, $communicationClass, $commUnicationTypeClass)
    {
        $this->dm = $dm;
        $this->repository = $dm->getRepository($communicationClass);
        $metadata = $dm->getClassMetadata($communicationClass);
        $this->class = $metadata->name;
        $this->commUnicationTypeClass = $commUnicationTypeClass;
    }

    public function findCommunicationBy( array $criteria  )
    {
        return $this->repository->findOneBy($criteria);
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getCommUnicationTypeClass()
    {
        return $this->commUnicationTypeClass;
    }

    public function findCommunications()
    {
        return $this->repository->findAll();
    }

    public function updateCommunication( CommunicationInterface $communication, $andFlush = true )
    {
        $this->dm->persist($communication);
        if ($andFlush) {
            $this->dm->flush();
        }
    }

}
