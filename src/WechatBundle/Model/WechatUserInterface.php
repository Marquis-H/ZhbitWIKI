<?php

/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/8
 * Time: PM4:49
 */
namespace zhbitwiki\WechatBundle\Model;

interface WechatUserInterface
{
    public function getOpenId();

    public function load(array $data);

    public function __toString();
}