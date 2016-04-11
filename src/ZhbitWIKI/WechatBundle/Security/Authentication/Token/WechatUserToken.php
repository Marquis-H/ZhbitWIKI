<?php
/**
 * Created by PhpStorm.
 * User: Marquis
 * Date: 16/4/12
 * Time: 上午12:36
 */
namespace ZhbitWIKI\WechatBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * Class WechatUserToken
 * @package ZhbitWIKI\WechatBundle\Security\Authentication\Token
 */
class WechatUserToken extends AbstractToken
{
    /**
     * @param array|\string[]|\Symfony\Component\Security\Core\Role\RoleInterface[] $openId
     * @param array $roles
     */
    public function __construct($openId, array $roles = array())
    {
        parent::__construct($roles);

        $this->setAttribute('openId', $openId);
        $this->setAuthenticated(count($roles) > 0);
    }

    /**
     * @return mixed
     */
    public function getOpenId()
    {
        return $this->getAttribute('openId');
    }

    /**
     * Returns the user credentials.
     *
     * @return mixed The user credentials
     */
    public function getCredentials()
    {
        return '';
    }

}