<?php

/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/8
 * Time: PM5:05
 */
namespace zhbitwiki\WechatBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Class Configuration
 * @package zhbitwiki\WechatBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('wechat');

        $rootNode
            ->children()
                ->scalarNode('app_id')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('app_secret')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('token')->isRequired()->end()
                ->scalarNode('cache_provider_id')->isRequired()->end()
                ->scalarNode('user_class')->isRequired()->end()
                ->scalarNode('alias')->end()
                ->arrayNode('payment')
                    ->children()
                        ->scalarNode('merchant_id')->isRequired()->end()
                        ->scalarNode('key')->isRequired()->end()
                        ->scalarNode('cert_path')->isRequired()->end()
                        ->scalarNode('key_path')->isRequired()->end()
                        ->scalarNode('notify_url')->defaultNull()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }

}