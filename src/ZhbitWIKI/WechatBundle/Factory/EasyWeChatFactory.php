<?php

/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/11
 * Time: PM6:33
 */
namespace ZhbitWIKI\WechatBundle\Factory;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Support\Log;

/**
 * Class EasyWeChatFactory
 * @package ZhbitWIKI\WechatBundle\Factory
 */
class EasyWeChatFactory
{
    /**
     * @param $config
     * @param $cache
     * @param $logger
     * @return Application
     */
    public static function createNewInstance($config, $cache, $logger)
    {
        Log::setLogger($logger);
        $application = new Application($config);
        $application->offsetSet('cache', $cache);
        return $application;
    }
}