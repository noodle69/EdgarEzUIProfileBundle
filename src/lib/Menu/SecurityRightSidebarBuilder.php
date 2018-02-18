<?php

namespace Edgar\EzUIProfile\Menu;

use Edgar\EzUIProfile\Menu\Event\ConfigureMenuEvent;
use eZ\Publish\API\Repository\Exceptions as ApiExceptions;
use InvalidArgumentException;
use JMS\TranslationBundle\Model\Message;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;
use Knp\Menu\ItemInterface;

class SecurityRightSidebarBuilder extends AbstractBuilder implements TranslationContainerInterface
{
    /**
     * @return string
     */
    protected function getConfigureEventName(): string
    {
        return ConfigureMenuEvent::PROFILE_SECURITY_SIDEBAR_RIGHT;
    }

    /**
     * @param array $options
     *
     * @return ItemInterface
     *
     * @throws ApiExceptions\InvalidArgumentException
     * @throws ApiExceptions\BadStateException
     * @throws InvalidArgumentException
     */
    public function createStructure(array $options): ItemInterface
    {
        /** @var ItemInterface|ItemInterface[] $menu */
        $menu = $this->factory->createItem('root');

        return $menu;
    }

    /**
     * @return Message[]
     */
    public static function getTranslationMessages(): array
    {
        return [];
    }
}
