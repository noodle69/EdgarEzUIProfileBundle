<?php

namespace Edgar\EzUIProfileBundle\EventListener;

use EzSystems\EzPlatformAdminUi\Menu\Event\ConfigureMenuEvent;
use EzSystems\EzPlatformAdminUi\Menu\UserMenuBuilder;
use JMS\TranslationBundle\Model\Message;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;

class ConfigureMenuListener implements TranslationContainerInterface
{
    const ITEM_PROFILE = 'user__content__profile';

    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $cronsMenu = $menu->getChild(UserMenuBuilder::ITEM_LOGOUT);
        $cronsMenu->getParent()->addChild(
            self::ITEM_PROFILE,
            [
                'route' => 'edgar.ezuiprofile.menu',
            ]
        );
    }

    /**
     * @return array
     */
    public static function getTranslationMessages(): array
    {
        return [
            (new Message(self::ITEM_PROFILE, 'messages'))->setDesc('Profile'),
        ];
    }
}
