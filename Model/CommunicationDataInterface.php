<?php

namespace BSP\CommunicationBundle\Model;

interface CommunicationDataInterface
{
    public function get($key);
    public function set($key, $value);
    public function toArray();
}
