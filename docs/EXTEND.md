# EdgarEzUIProfileBundle

## Extend

Profile interface view has a sidebar left menu.
Your can add new menu entry

### Add Menu listener

```php
use Edgar\EzUIProfile\Menu\Event\ConfigureMenuEvent;
use Edgar\EzUIProfile\Menu\LeftSidebarBuilder;
use JMS\TranslationBundle\Model\Message;
use JMS\TranslationBundle\Translation\TranslationContainerInterface;

class ConfigureMenuListener implements TranslationContainerInterface
{
    const ITEM_PROFILE_<menu_identifier> = 'user__content__<menu_identifier>';

    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $cronsMenu = $menu->getChild(LeftSidebarBuilder::ITEM__PASSWORD);
        $cronsMenu->getParent()->addChild(
            self::ITEM_PROFILE_<menu_identifier>,
            [
                'route' => '<menu_route>',
                'extras' => ['icon' => '<menu_icon>'],
            ]
        );
    }

    /**
     * @return array
     */
    public static function getTranslationMessages(): array
    {
        return [
            (new Message(self::ITEM_PROFILE_<menu_identifier>, 'messages'))->setDesc('<menu_label>'),
        ];
    }
}
```

replace all entries <...>

### Define menu service

```yaml
    Acme\AcmeBundle\EventListener\ConfigureMenuListener:
        public: true
        tags:
          - { name: kernel.event_listener, event: edgar_ezuiprofile.menu_configure.profile_sidebar_left, method: onMenuConfigure }
```
