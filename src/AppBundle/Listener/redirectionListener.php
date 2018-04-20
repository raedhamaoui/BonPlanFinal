<?php

namespace AppBundle\Listener;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class redirectionListener
{
    public function __construct(ContainerInterface $container)
    {
        $this->router = $container->get('router');
        $this->securityContext = $container->get('security.token_storage');
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $route = $event->getRequest()->attributes->get('_route');

        if ($route == 'publication_index' || $route == 'experiences_page' ) { // || $route == 'homepage'

            if (!is_object($this->securityContext->getToken()->getUser())) {
                $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
            }

        }


    }

}
