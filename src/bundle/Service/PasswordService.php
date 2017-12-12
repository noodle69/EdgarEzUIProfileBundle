<?php

namespace Edgar\EzUIProfileBundle\Service;

use Edgar\EzUIProfile\Exception\PasswordUpdateException;
use eZ\Publish\API\Repository\Values\User\User as APIUser;
use eZ\Publish\API\Repository\UserService;
use eZ\Publish\API\Repository\Exceptions\InvalidArgumentException;
use eZ\Publish\API\Repository\Exceptions\NotFoundException;
use eZ\Publish\API\Repository\Exceptions\UnauthorizedException;
use eZ\Publish\API\Repository\Exceptions\ContentFieldValidationException;
use eZ\Publish\API\Repository\Exceptions\ContentValidationException;
use eZ\Publish\API\Repository\Repository;

class PasswordService
{
    /** @var UserService  */
    protected $userService;

    /** @var Repository */
    private $repository;

    public function __construct(UserService $userService, Repository $repository)
    {
        $this->userService = $userService;
        $this->repository = $repository;
    }

    /**
     * @param APIUser $apiUser
     * @param string $oldPassword
     * @param string $newPassword
     * @throws PasswordUpdateException
     */
    public function updatePassword(APIUser $apiUser, string $oldPassword, string $newPassword)
    {
        try {
            $user = $this->userService->loadUserByCredentials($apiUser->login, $oldPassword);
        } catch (InvalidArgumentException | NotFoundException $e) {
            throw new PasswordUpdateException($e->getMessage());
        }

        $userUpdateStruct = $this->userService->newUserUpdateStruct();
        $userUpdateStruct->password = $newPassword;

        $this->repository->sudo(
            function () use ($user, $userUpdateStruct) {
                try {
                    $this->userService->updateUser($user, $userUpdateStruct);
                } catch (InvalidArgumentException | UnauthorizedException | ContentFieldValidationException | ContentValidationException $e) {
                    throw new PasswordUpdateException($e->getMessage());
                }
            }
        );
    }
}
