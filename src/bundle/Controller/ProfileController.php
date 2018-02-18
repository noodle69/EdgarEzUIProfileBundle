<?php

namespace Edgar\EzUIProfileBundle\Controller;

use EzSystems\EzPlatformAdminUiBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function menuAction(Request $request): Response
    {
        return $this->render('@EdgarEzUIProfile/profile/view.html.twig', []);
    }

    public function accountAction(Request $request): Response
    {
        return $this->render('@EdgarEzUIProfile/profile/right/account/view.html.twig', []);
    }

    public function securityAction(Request $request): Response
    {
        return $this->render('@EdgarEzUIProfile/profile/right/security/view.html.twig', []);
    }

    public function contentAction(Request $request): Response
    {
        return $this->render('@EdgarEzUIProfile/profile/right/content/view.html.twig', []);
    }
}
