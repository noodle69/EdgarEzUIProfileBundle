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
    const ITEM__ACCOUNT = 'sidebar_left__account';
    const ITEM__SECURITY = 'sidebar_left__security';
    const ITEM__CONTENT = 'sidebar_left__content';


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

        $menu->setChildren([
            self::ITEM__ACCOUNT => $this->createMenuItem(
                self::ITEM__ACCOUNT,
                [
                    'route' => 'edgar.ezuiprofile.account',
                    'extras' => ['icon' => 'author'],
                ]
            ),
            self::ITEM__SECURITY => $this->createMenuItem(
                self::ITEM__SECURITY,
                [
                    'route' => 'edgar.ezuiprofile.security',
                    'extras' => ['icon' => 'lock'],
                ]
            ),
            self::ITEM__CONTENT => $this->createMenuItem(
                self::ITEM__CONTENT,
                [
                    'route' => 'edgar.ezuiprofile.content',
                    'extras' => ['icon' => 'personalize-content'],
                ]
            ),
        ]);

        return $menu;
    }

    /**
     * @return Message[]
     */
    public static function getTranslationMessages(): array
    {
        return [
            (new Message(self::ITEM__ACCOUNT, 'menu'))->setDesc('Account managment'),
            (new Message(self::ITEM__SECURITY, 'menu'))->setDesc('Security configuration'),
            (new Message(self::ITEM__CONTENT, 'menu'))->setDesc('Personal content'),
        ];
    }

    /**
     * Build menu.
     *
     * @param array $options
     * @return ItemInterface
     */
    public function build(array $options): ItemInterface
    {
        $menu = $this->createStructure($options);

        $menuBuilder = new ConfigureMenuEvent($this->factory, $menu);
        $this->dispatchMenuEvent(ConfigureMenuEvent::PROFILE_SIDEBAR_LEFT, $menuBuilder);

        return $menu;
    }
}
