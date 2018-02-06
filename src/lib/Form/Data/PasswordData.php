<?php

namespace Edgar\EzUIProfile\Form\Data;

class PasswordData
{
    /**
     * @var string
     */
    private $oldPassword;

    /** @var string */
    private $newPassword;

    public function __construct(?string $oldPassword, ?string $newPassword)
    {
        $this->oldPassword = $oldPassword;
        $this->newPassword = $newPassword;
    }

    public function setOldPassword(?string $oldPassword): self
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    public function setNewPassword(?string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }
}
