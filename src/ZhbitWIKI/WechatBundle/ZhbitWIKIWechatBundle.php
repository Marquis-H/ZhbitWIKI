<?php

namespace ZhbitWIKI\WechatBundle;

use ZhbitWIKI\WechatBundle\DependencyInjection\Compiler\ReplaceLoggerPass;
use ZhbitWIKI\WechatBundle\DependencyInjection\Security\Factory\WechatFactory;
use Symfony\Bundle\SecurityBundle\DependencyInjection\SecurityExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ZhbitWIKIWechatBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container); // TODO: Change the autogenerated stub

        /** @var SecurityExtension $extension */
        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new WechatFactory());
        $container->addCompilerPass(new ReplaceLoggerPass());
    }

}
