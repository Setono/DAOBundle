<?php

declare(strict_types=1);

namespace Setono\DAOBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        if (method_exists(TreeBuilder::class, 'getRootNode')) {
            $treeBuilder = new TreeBuilder('setono_dao');
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $treeBuilder = new TreeBuilder();
            $rootNode = $treeBuilder->root('setono_dao');
        }

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('customer_id')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->info('Your DAO customer id')
                ->end()
                ->scalarNode('password')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->info('Your DAO password')
                ->end()
                ->scalarNode('base_url')
                    ->cannotBeEmpty()
                    ->defaultValue('https://api.dao.as')
                    ->info('The base URL of the DAO API')
                ->end()
                ->scalarNode('http_client')
                    ->cannotBeEmpty()
                    ->info('PSR18 HTTP client that is injected into the client service')
                ->end()
                ->scalarNode('request_factory')
                    ->cannotBeEmpty()
                    ->info('Is injected into the client service')
                ->end()
                ->scalarNode('stream_factory')
                    ->cannotBeEmpty()
                    ->info('Is injected into the client service')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
