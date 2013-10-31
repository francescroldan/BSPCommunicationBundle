<?php

namespace BSP\CommunicationBundle\Provider;

use BSP\CommunicationBundle\Provider\AbstractCommunicationTypeProvider;

class CommunicationTypeSenderProvider extends AbstractCommunicationTypeProvider
{
    /**
     * Send message to a user
     *
     * @param string 	$type 		message type, email_immediately by default
     * @param array 	$options 	array of communication type's options
     *
     * @return mixed
     */
    public function send( $type = 'email_immediately', array $options = null )
    {
        $handler =  $this->getCommunicationTypeHandler( $type );

        return $handler->send( $options );
    }

    /**
     * Changes the status of a message
     *
     * @param string 	$type 		message type, email_immediately by default
     * @param array 	$options 	array of communication type's options
     *
     * @return mixed
     */
    public function changeStatus( $type = 'email_immediately', array $options = null )
    {
        $handler =  $this->getCommunicationTypeHandler( $type );

        return $handler->changeStatus( $options );
    }
}
