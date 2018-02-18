<?php

namespace Edgar\EzUIProfile\Menu;

use Edgar\EzUIProfile\Menu\Event\ConfigureMenuEvent;
use eZ\Publish\API\Repository\Exceptions as ApiExceptions;
use InvalidArgumentException;
use JMS\TranslationBundle\Model\Message;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;
use Knp\Menu\ItemInterface;

class AccountRightSidebarBuilder extends AbstractBuilder implements TranslationContainerInterface
{
    /** Menu items */
    const ITEM__PASSWORD = 'sidebar_left__password';

    /**
     * @return string
     */
    protected function getConfigureEventName(): string
    {
        return ConfigureMenuEvent::PROFILE_ACCOUNT_SIDEBAR_RIGHT;
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

        $menu->addChild(
            $this->createMenuItem(
                self::ITEM__PASSWORD,
                [
                    'route' => 'edgar.ezuiprofile.password',
                    'extras' => ['icon' => 'lock'],
                ]
            )
        );

        return $menu;
    }

    /**
     * @return Message[]
     */
    public static function getTranslationMessages(): array
    {
        return [
            (new Message(self::ITEM__PASSWORD, 'menu'))->setDesc('Manage your password'),
        ];
    }
}
