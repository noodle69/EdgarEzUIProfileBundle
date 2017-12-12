<?php

namespace Edgar\EzUIProfileBundle\Controller;

use Edgar\EzUIProfile\Exception\PasswordUpdateException;
use Edgar\EzUIProfile\Form\Data\PasswordData;
use EzSystems\EzPlatformAdminUiBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Edgar\EzUIProfile\Form\Factory\FormFactory;
use Edgar\EzUIProfile\Form\SubmitHandler;
use Edgar\EzUIProfileBundle\Service\PasswordService;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use EzSystems\EzPlatformAdminUi\Notification\NotificationHandlerInterface;
use Symfony\Component\Translation\TranslatorInterface;

class PasswordController extends Controller
{
    /** @var NotificationHandlerInterface */
    private $notificationHandler;

    /** @var TranslatorInterface */
    private $translator;

    /** @var FormFactory $formFactory */
    protected $formFactory;

    /** @var SubmitHandler $submitHandler */
    protected $submitHandler;

    protected $passwordService;

    protected $tokenStorage;

    public function __construct(
        FormFactory $formFactory,
        SubmitHandler $submitHandler,
        TokenStorage $tokenStorage,
        PasswordService $passwordService,
        NotificationHandlerInterface $notificationHandler,
        TranslatorInterface $translator
    ) {
        $this->notificationHandler = $notificationHandler;
        $this->translator = $translator;
        $this->formFactory = $formFactory;
        $this->submitHandler = $submitHandler;
        $this->tokenStorage = $tokenStorage;
        $this->passwordService = $passwordService;
    }

    public function passwordAction(Request $request): Response
    {
        $passwordType = $this->formFactory->filterContent(
            new PasswordData(null, null)
        );
        $passwordType->handleRequest($request);

        if ($passwordType->isSubmitted() && $passwordType->isValid()) {
            $result = $this->submitHandler->handle($passwordType, function (PasswordData $data) use ($passwordType) {
                $user = $this->tokenStorage->getToken()->getUser();
                $apiUser = $user->getAPIUser();

                $oldPassword = $data->getOldPassword();
                $newPassword  = $data->getNewPassword();

                try {
                    $this->passwordService->updatePassword($apiUser, $oldPassword, $newPassword);

                    $this->notificationHandler->success(
                        $this->translator->trans(
                            'edgarezprofile.password.message.updated',
                            [],
                            'messages'
                        )
                    );
                } catch (PasswordUpdateException $e) {
                    $this->notificationHandler->error(
                        $e->getMessage()
                    );
                }

                return new RedirectResponse($this->generateUrl('edgar.ezuiprofile.password', [
                ]));
            });

            if ($result instanceof Response) {
                return $result;
            }
        }

        return $this->render('@EdgarEzUIProfile/profile/password/view.html.twig', [
            'form_password' => $passwordType->createView(),
        ]);
    }
}
