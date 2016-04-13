<?php

/**
 * Created by PhpStorm.
 * User: marquis
 * Date: 16/4/13
 * Time: PM4:23
 */
namespace ZhbitWIKI\WechatBundle\Security\Firewall;

use EasyWeChat\Foundation\Application;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\HttpUtils;
use Overtrue\Socialite\Providers\WeChatProvider;
use ZhbitWIKI\WechatBundle\Event\WechatAuthorizeEvent;
use ZhbitWIKI\WechatBundle\Exception\UserNotFoundException;
use ZhbitWIKI\WechatBundle\Security\Authentication\Token\WechatUserToken;

/**
 * Class WechatListener
 * @package ZhbitWIKI\WechatBundle\Security\Firewall
 */
class WechatListener implements ListenerInterface
{
    /**
     *
     */
    const REDIRECT_URL_KEY = '_wechat.redirect_url';

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;
    /**
     * @var AuthenticationManagerInterface
     */
    protected $authenticationManager;

    /**
     * @var array
     */
    protected $options = array(
        'authorize_path' => '/wechat/authorize',
        'default_redirect' => '/wechat'
    );

    /**
     * @var HttpUtils
     */
    protected $httpUtils;

    /**
     * @var Application
     */
    private $sdk;

    /**
     * @var EventDispatcherInterface
     */
    private $event_dispatcher;

    /**
     * WechatListener constructor.
     * @param TokenStorageInterface $tokenStorage
     * @param AuthenticationManagerInterface $authenticationManager
     * @param HttpUtils $httpUtils
     * @param Application $sdk
     * @param EventDispatcherInterface $event_dispatcher
     * @param array $options
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthenticationManagerInterface $authenticationManager,
        HttpUtils $httpUtils,
        Application $sdk,
        EventDispatcherInterface $event_dispatcher,
        array $options
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->authenticationManager = $authenticationManager;
        $this->options = $options;
        $this->httpUtils = $httpUtils;
        $this->sdk = $sdk;
        $this->event_dispatcher = $event_dispatcher;
    }


    /**
     * @param GetResponseEvent $event
     */
    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $session = $request->getSession();

        /** @var WeChatProvider $oauth */
        $oauth = $this->sdk->oauth;

        if ($this->httpUtils->checkRequestPath($request, $this->options['authorize_path'])) {
            $user = $oauth->user()->getOriginal();

            $wechatAuthorizeEvent = new WechatAuthorizeEvent($user);
            $this->event_dispatcher->dispatch('wechat.authorize', $wechatAuthorizeEvent);

            $token = new WechatUserToken($user['openId'], array('ROLE_USER', 'ROLE_WECHAT_USER'));

            $this->tokenStorage->setToken($token);
            $this->event_dispatcher->dispatch(
                AuthenticationEvents::AUTHENTICATION_SUCCESS,
                new AuthenticationEvent($token)
            );

            $redirect_url = $session->get(self::REDIRECT_URL_KEY) ?: $request->getUriForPath($this->options['default_redirect']);
            $session->remove(self::REDIRECT_URL_KEY);
            $event->setResponse(new RedirectResponse($redirect_url));
            return;
        }
        do {
            $token = $this->tokenStorage->getToken();
            if ($token === null) break;
            try {
                $token = $this->authenticationManager->authenticate($token);
            } catch (UserNotFoundException $e) {
                break;
            }
            $this->tokenStorage->setToken($token);
            return;
        } while (false);

        $session->set(self::REDIRECT_URL_KEY, $request->getUri());
        $targetUrl = $request->getUriForPath($this->options['authorize_path']);
        $response = $oauth->scopes(['snsapi_userinfo'])->redirect($targetUrl);
        $event->setResponse($response);
    }

}