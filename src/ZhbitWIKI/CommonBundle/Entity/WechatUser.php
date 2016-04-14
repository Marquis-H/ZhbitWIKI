<?php

namespace ZhbitWIKI\CommonBundle\Entity;

/**
 * WechatUser
 */
/**
 * Class WechatUser
 * @package ZhbitWIKI\CommonBundle\Entity
 */
class WechatUser
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $openId;

    /**
     * @var string
     */
    private $nickName;

    /**
     * @var string
     */
    private $sex;

    /**
     * @var string
     */
    private $province;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var array
     */
    static $sexChoices = array(
        0 => "未知",
        1 => "男",
        2 => "女"
    );

    /**
     * WechatUser constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setOpenId($data['openid']);
        $this->setNickname($data['nickname']);
        $this->setSex($data['sex']);
        $this->setProvince($data['province']);
        $this->setCity($data['city']);
        $this->setCountry($data['country']);
        $this->setAvatar($data['headimgurl']);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getNickname();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set openId
     *
     * @param string $openId
     *
     * @return WechatUser
     */
    public function setOpenId($openId)
    {
        $this->openId = $openId;

        return $this;
    }

    /**
     * Get openId
     *
     * @return string
     */
    public function getOpenId()
    {
        return $this->openId;
    }

    /**
     * Set nickName
     *
     * @param string $nickName
     *
     * @return WechatUser
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * Get nickName
     *
     * @return string
     */
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * Set sex
     *
     * @param string $sex
     *
     * @return WechatUser
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return WechatUser
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return WechatUser
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return WechatUser
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return WechatUser
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}

