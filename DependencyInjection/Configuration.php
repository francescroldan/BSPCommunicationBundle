<?php

namespace BSP\CommunicationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('bsp_communication');

        $rootNode
            ->children()
                ->scalarNode('db_driver')
                ->validate()
                    ->ifNotInArray(array('mongodb'))
                    ->thenInvalid('The %s driver is not supported')
                ->end()
            ->end()
        ->end();

        $this->addFromDataSection( $rootNode );

        return $treeBuilder;
    }

    /**
     * Add Configuration Captcha
     *
     * @param ArrayNodeDefinition $rootNode
     */
    private function addFromDataSection( ArrayNodeDefinition $node )
    {
        $node
            ->children()
                ->arrayNode('from_data')
                    ->children()
                        ->scalarNode('email')
                        ->validate()
                            ->ifTrue(function ($v) { return ! preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $v);})
                            ->thenInvalid('"%s" is an invalid email account')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end()
        ;
    }
}
