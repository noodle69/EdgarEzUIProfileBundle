<?php

namespace Edgar\EzUIProfile\Menu;

use Edgar\EzUIProfile\Menu\Event\ConfigureMenuEvent;
use EzSystems\EzPlatformAdminUi\Menu\AbstractBuilder;
use InvalidArgumentException;
use JMS\TranslationBundle\Model\Message;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;
use Knp\Menu\ItemInterface;

class LeftSidebarBuilder extends AbstractBuilder implements TranslationContainerInterface
{
    /* Menu items */
    const ITEM__PROFILE = 'sidebar_left__profile';

    /**
     * @return string
     */
    protected function getConfigureEventName(): string
    {
        return ConfigureMenuEvent::PROFILE_SIDEBAR_LEFT;
    }

    /**
     * @param array $options
     *
     * @return ItemInterface
     *
     * @throws InvalidArgumentException
     */
    public function createStructure(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild(
            $this->createMenuItem(
                self::ITEM__PROFILE,
                [
                    'route' => 'edgar.ezuiprofile.profile',
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
            (new Message(self::ITEM__PROFILE, 'menu'))->setDesc('Profile'),
        ];
    }

    public function build(array $options): ItemInterface
    {
        $menu = $this->createStructure($options);

        $menuBuilder = new ConfigureMenuEvent($this->factory, $menu);
        $this->dispatchMenuEvent(ConfigureMenuEvent::PROFILE_SIDEBAR_LEFT, $menuBuilder);

        return $menu;
    }
}
