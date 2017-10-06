<?php

namespace ED\FlagBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Ed Report configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ed_flag');

        $rootNode
            ->children()
                ->arrayNode('model')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->children()
                        ->scalarNode('report_class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('reason_class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('action_class')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
