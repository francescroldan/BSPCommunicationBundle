<?php

namespace BSP\CommunicationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use BSP\CommunicationBundle\DependencyInjection\Compiler\CommunicationHandlerFactoryPass;

class BSPCommunicationBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CommunicationHandlerFactoryPass());
    }
}
