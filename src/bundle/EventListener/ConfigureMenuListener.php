<?php

namespace Edgar\EzUIProfileBundle\EventListener;

use EzSystems\EzPlatformAdminUi\Menu\Event\ConfigureMenuEvent;
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

        $menu->addChild(
            self::ITEM_PROFILE,
            [
                'route' => 'edgar.ezuiprofile.menu',
            ]
        );

        $children = $menu->getChildren();
        $order = array_keys($children);
        $oldPosition = array_search(self::ITEM_PROFILE, $order);
        unset($order[$oldPosition]);

        $order = array_values($order);

        array_splice($order, count($children) - 2, 0, self::ITEM_PROFILE);
        $menu->reorderChildren($order);
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
