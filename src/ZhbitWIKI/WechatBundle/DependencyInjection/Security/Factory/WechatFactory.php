<?php

/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/11
 * Time: PM6:54
 */
namespace ZhbitWIKI\WechatBundle\DependencyInjection\Security\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

class WechatFactory implements SecurityFactoryInterface
{
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'security.authentication.provider.wechat.' . $id;
        $container->setDefinition($providerId, new DefinitionDecorator('zhbitwiki_wechat.security.wechat_provider'));

        $listenerId = 'security.authentication.listener.wechat.' . $id;
        $container->setDefinition($listenerId, new DefinitionDecorator('zhbitwiki_wechat.security.wechat_listener'));

        return array($providerId, $listenerId, $defaultEntryPoint);
    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'wechat_login';
    }

    public function addConfiguration(NodeDefinition $builder)
    {
        $builder
            ->children()
            ->scalarNode('authorize_path')->isRequired()->end()
            ->scalarNode('default_redirect')->end()
            ->end();
    }

}