<?php

/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/13
 * Time: PM6:06
 */
namespace ZhbitWIKI\WechatBundle\Event;

/**
 * Class WechatAuthorizeEvent
 * @package ZhbitWIKI\WechatBundle\Event
 */
class WechatAuthorizeEvent extends Events
{
    /**
     * @var array
     */
    private $user;

    /**
     * WechatAuthorizeEvent constructor.
     * @param array $user
     */
    public function __construct(array $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param array $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}