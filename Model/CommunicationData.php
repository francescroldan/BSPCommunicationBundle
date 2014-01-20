<?php

namespace BSP\CommunicationBundle\Model;

use BSP\CommunicationBundle\Model\CommunicationDataInterface;

class CommunicationData implements CommunicationDataInterface
{
	protected $data;

    /**
     * Get a data's value by their key 
     *
     * @param string $key Key for the hash
     *
     * @return mixed
     */
    public function get($key)
    {
    	if ( ! array_key_exists($key, $this->data))
    	{
            throw new \InvalidArgumentException(sprintf('There is no data with key "%s".', $key));
    	}
    	return $this->data[$key];
    }

    /**
     * Set a value into data 
     *
     * @param string $key Key for hash
     * @param mixed $value Value to set
     *
     * @return self
     */
    public function set($key, $value)
    {
    	$this->data[$key] = $value;

    	return $this;
    }

    /**
     * Getter for data
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * Setter for data
     *
     * @param mixed $data Value to set
     *
     * @return self
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    
    public function toArray()
    {
        return $this->data;
    }
}
