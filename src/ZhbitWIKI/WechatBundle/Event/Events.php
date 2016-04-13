<?php

/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/13
 * Time: PM6:05
 */
namespace ZhbitWIKI\WechatBundle\Event;

class Events
{
    const AUTHORIZE = 'lilocon.wechat.authorize';
    const MESSAGE_ALL = 'lilocon.wechat.message.all';
    const MESSAGE_TEXT = 'lilocon.wechat.message.text';
    const MESSAGE_IMAGE = 'lilocon.wechat.message.image';
    const MESSAGE_VOICE = 'lilocon.wechat.message.voice';
    const MESSAGE_VIDEO = 'lilocon.wechat.message.video';
    const MESSAGE_LOCATION = 'lilocon.wechat.message.location';
    const MESSAGE_LINK = 'lilocon.wechat.message.link';
    const MESSAGE_EVENT = 'lilocon.wechat.message.event';
    const MESSAGE_EVENT_SUBSCRIBE = 'lilocon.wechat.message.event.subscribe';
    const MESSAGE_EVENT_UNSUBSCRIBE = 'lilocon.wechat.message.event.unsubscribe';
    const MESSAGE_EVENT_SCAN = 'lilocon.wechat.message.event.scan';
    const MESSAGE_EVENT_LOCATION = 'lilocon.wechat.message.event.location';
    const MESSAGE_EVENT_CLICK = 'lilocon.wechat.message.event.click';
    const MESSAGE_EVENT_VIEW = 'lilocon.wechat.message.event.view';
}