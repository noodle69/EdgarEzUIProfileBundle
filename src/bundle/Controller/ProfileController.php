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
}
