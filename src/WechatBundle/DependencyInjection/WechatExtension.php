<?php
/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/8
 * Time: PM5:33
 */

namespace zhbitwiki\WechatBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class WechatExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('wechat.user_class', $config['user_class']);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('service.yml');

        $definition = $container->getDefinition('wechat.sdk');
    }

}