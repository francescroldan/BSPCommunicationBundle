<?php

namespace BSP\CommunicationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class CommunicationHandlerFactoryPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $factory = $container->getDefinition('bsp.communication.communication_type_sender_provider');
        foreach ($container->findTaggedServiceIds('bsp.communication.communication_type_handler') as $id => $attr) 
        {
            $factory->addMethodCall('addCommunicationTypeHandler', array(new Reference($id)));
        }
    }
}
