<?php

namespace Edgar\EzUIProfile\Form\Factory;

use Edgar\EzUIProfile\Form\Data\PasswordData;
use Edgar\EzUIProfile\Form\Type\PasswordType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class FormFactory
{
    /** @var FormFactoryInterface $formFactory */
    protected $formFactory;

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function filterContent(
        PasswordData $data,
        ?string $name = null
    ): ?FormInterface {
        return $this->formFactory->createNamed(
            $name,
            PasswordType::class,
            $data,
            [
                'method' => Request::METHOD_POST,
                'csrf_protection' => true,
            ]
        );
    }
}
