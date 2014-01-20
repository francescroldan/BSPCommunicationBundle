<?php

namespace BSP\CommunicationBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

use BSP\CommunicationBundle\Model\CommunicationData as BaseCommunicationData;
use BSP\CommunicationBundle\Model\Communicable;

/**
 * @MongoDB\EmbeddedDocument
 */
class CommunicationData extends BaseCommunicationData
{
    /**
     * @MongoDB\Hash
     */
	protected $data;

    public function __construct(Communicable $communicableElement = null)
    {
        $this->data = array();

        if (null !== $communicableElement)
        {
            $this->setCommunicationData($communicableElement);
        }

        return $this;
    }

    public function setCommunicationData(Communicable $communicableElement)
    {
        foreach ($communicableElement->getCommunicationData() as $key => $value) 
        {
            $this->set($key, $value);
        }

        return $this;
    }
}