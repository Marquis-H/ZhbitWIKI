<?php
/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/11
 * Time: PM6:30
 */

namespace ZhbitWIKI\WechatBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class WechatExtension
 * @package ZhbitWIKI\CommonBundle\DependencyInjection
 */
class WechatExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('wechat.user_class', $config['user_class']);
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
        $definition = $container->getDefinition('wechat.sdk');
        $argument = array(
            'debug' => false,
            'app_id' => $config['app_id'],
            'secret' => $config['app_secret'],
            'token' => $config['token'],
        );
        if (array_key_exists('payment', $config)) {
            $argument['payment'] = $config['payment'];
        }
        $definition->replaceArgument(0, $argument);
        $definition->replaceArgument(1, new Reference($config['cache_provider_id']));

        // alias
        if (array_key_exists('alias', $config)) {
            $container->setAlias($config['alias'], 'wechat.sdk');
        }
    }

}