<?php

/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/14
 * Time: PM3:25
 */
namespace ZhbitWIKI\WechatBundle\Message;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use ZhbitWIKI\WechatBundle\Event\Events;
use ZhbitWIKI\WechatBundle\Event\WechatMessageEvent;

/**
 * Class MessageHandler
 * @package ZhbitWIKI\WechatBundle\Message
 */
class MessageHandler
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * MessageHandler constructor.
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param $message
     */
    public function handle($message)
    {
        $event = new WechatMessageEvent($message);

        $this->eventDispatcher->dispatch(Events::MESSAGE_ALL, $event);
        switch ($message->MsgType) {
            case "text":
                $this->eventDispatcher->dispatch(Events::MESSAGE_TEXT, $event);
                break;
            case "image":
                $this->eventDispatcher->dispatch(Events::MESSAGE_IMAGE, $event);
                break;
            case "voice":
                $this->eventDispatcher->dispatch(Events::MESSAGE_VOICE, $event);
                break;
            case "video":
                $this->eventDispatcher->dispatch(Events::MESSAGE_VIDEO, $event);
                break;
            case "location":
                $this->eventDispatcher->dispatch(Events::MESSAGE_LOCATION, $event);
                break;
            case "link":
                $this->eventDispatcher->dispatch(Events::MESSAGE_LINK, $event);
                break;
            case "event":
                $this->eventDispatcher->dispatch(Events::MESSAGE_EVENT, $event);
                $this->handleEventMessage($message, $event);
                break;
        }

    }

    /**
     * @param $message
     * @param $event
     */
    public function handleEventMessage($message, $event)
    {
        switch (strtolower($message->Event)) {
            case "subscribe":
                $this->eventDispatcher->dispatch(Events::MESSAGE_EVENT_SUBSCRIBE, $event);
                if (!empty($message->Ticket)) {
                    $this->eventDispatcher->dispatch(Events::MESSAGE_EVENT_SCAN, $event);
                }
                break;
            case "unsubscribe":
                $this->eventDispatcher->dispatch(Events::MESSAGE_EVENT_UNSUBSCRIBE, $event);
                break;
            case "scan":
                $this->eventDispatcher->dispatch(Events::MESSAGE_EVENT_SCAN, $event);
                break;
            case "location":
                $this->eventDispatcher->dispatch(Events::MESSAGE_EVENT_LOCATION, $event);
                break;
            case "click":
                $this->eventDispatcher->dispatch(Events::MESSAGE_EVENT_CLICK, $event);
                break;
            case "view":
                $this->eventDispatcher->dispatch(Events::MESSAGE_EVENT_VIEW, $event);
                break;
        }
    }


}