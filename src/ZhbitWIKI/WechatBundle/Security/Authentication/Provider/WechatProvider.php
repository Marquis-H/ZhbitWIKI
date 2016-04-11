<?php
/**
 * Created by PhpStorm.
 * User: Marquis
 * Date: 16/4/12
 * Time: 上午12:10
 */
namespace ZhbitWIKI\WechatBundle\Security\Authentication\Provider;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Doctrine\ORM\EntityRepository;
use ZhbitWIKI\WechatBundle\Exception\UserNotFoundException;
use ZhbitWIKI\WechatBundle\Security\Authentication\Token\WechatUserToken;

/**
 * Class WechatProvider
 * @package ZhbitWIKI\WechatBundle\Security\Authentication\Provider
 */
class WechatProvider implements AuthenticationProviderInterface
{

    /**
     * @var string
     */
    private $userClass;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @param $userClass
     * @param ObjectManager $objectManager
     */
    function __construct($userClass, ObjectManager $objectManager)
    {
        $this->userClass = $userClass;
        $this->objectManager = $objectManager;
        $this->repository = $objectManager->getRepository($userClass);
    }

    /**
     * @param TokenInterface $token
     * @return WechatUserToken
     * @throws UserNotFoundException
     */
    public function authenticate(TokenInterface $token)
    {
        /** @var WechatUserToken $token */
        $user = $this->repository->findOneBy(array('openid' => $token->getOpenId()));
        if(!$user){
            throw new UserNotFoundException();
        }
        $token->setUser($user);
        return $token;
    }

    /**
     * Checks whether this provider supports the given token.
     *
     * @param TokenInterface $token A TokenInterface instance
     *
     * @return bool true if the implementation supports the Token, false otherwise
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof WechatUserToken;
    }

}