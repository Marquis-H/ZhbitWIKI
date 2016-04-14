<?php
/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/14
 * Time: PM5:53
 */

namespace ZhbitWIKI\WechatBundle\Event;


use Symfony\Component\EventDispatcher\Event;

/**
 * Class WechatMessageEvent
 * @package ZhbitWIKI\WechatBundle\Event
 */
class WechatMessageEvent extends Event
{
    /**
     * @var
     */
    private $message;

    /**
     * WechatMessageEvent constructor.
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

}