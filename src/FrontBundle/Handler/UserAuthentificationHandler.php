<?php
/**
 * Created by PhpStorm.
 * User: Sofien
 * Date: 28/03/2018
 * Time: 03:24
 */

namespace FrontBundle\Handler;


use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserAuthentificationHandler implements AuthenticationSuccessHandlerInterface,AuthenticationFailureHandlerInterface
{
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var Session
     */
    private $session;
    public function __construct(RouterInterface $router, Session $session)
    {
        $this->router = $router;
        $this->session = $session;
    }
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $request = $event->getRequest();
        $this->onAuthenticationSuccess($request, $token);
    }

    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @return JsonResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {

        if ($request->isXmlHttpRequest()) {
            $roles = $token->getRoles();
            $rolesTab = array_map(function($role){
                return $role->getRole();
            }, $roles);
            $url = null;
            if(in_array('ROLE_PARENT',$rolesTab))
                $url = $this->router->generate('homepage');
            else $url = $this->router->generate('garderie_homepage');
            return new JsonResponse(array('success' => true,'targetUrl' => $url));
        }
        else {
            $url = $this->router->generate('homepage');
            return new RedirectResponse($url);
        }

    }

    /**
     * This is called when an interactive authentication attempt fails. This is
     * called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @return Response The response to return, never null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(array('success' => false,'message' => $exception->getMessage()));
        }
        else {
            $url = $this->router->generate('homepage');
            return new RedirectResponse($url);
        }
    }
}