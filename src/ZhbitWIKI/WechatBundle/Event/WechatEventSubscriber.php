<?php
/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/14
 * Time: PM3:29
 */

namespace ZhbitWIKI\WechatBundle\Event;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use ZhbitWIKI\CommonBundle\Entity\WechatUser;

/**
 * Class WechatEventSubscriber
 * @package ZhbitWIKI\WechatBundle\Event
 */
class WechatEventSubscriber
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * WechatEventSubscriber constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param WechatAuthorizeEvent $event
     */
    public function onWechatAuthorize(WechatAuthorizeEvent $event)
    {
        $repoWechatUser = $this->em->getRepository('ZhbitWIKICommonBundle:WechatUser');
        $wxUser = $event->getUser();
        $openId = $wxUser['openid'];

        $user = $repoWechatUser->findOneBy(array('openId' => $openId));

        if (!$user) {
            $user = new WechatUser($wxUser);
            $this->em->persist($user);
            $this->em->flush();
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            Events::AUTHORIZE => "onWechatAuthorize"
        );
    }

}