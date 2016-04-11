<?php

/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/11
 * Time: PM6:51
 */
namespace ZhbitWIKI\WechatBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ReplaceLoggerPass
 * @package ZhbitWIKI\WechatBundle\DependencyInjection\Compiler
 */
class ReplaceLoggerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        // TODO: Implement process() method.
    }

}