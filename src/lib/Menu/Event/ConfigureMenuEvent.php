<?php

namespace Edgar\EzUIProfile\Menu\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\Event;

class ConfigureMenuEvent extends Event
{
    const PROFILE_SIDEBAR_LEFT = 'edgar_ezuiprofile.menu_configure.profile_sidebar_left';
    const PROFILE_ACCOUNT_SIDEBAR_RIGHT = 'edgar_ezuiprofile.menu_configure.profile_account_sidebar_right';
    const PROFILE_SECURITY_SIDEBAR_RIGHT = 'edgar_ezuiprofile.menu_configure.profile_security_sidebar_right';
    const PROFILE_CONTENT_SIDEBAR_RIGHT = 'edgar_ezuiprofile.menu_configure.profile_content_sidebar_right';

    /** @var FactoryInterface */
    private $factory;

    /** @var ItemInterface */
    private $menu;

    /** @var array|null */
    private $options;

    /**
     * @param FactoryInterface $factory
     * @param ItemInterface $menu
     */
    public function __construct(FactoryInterface $factory, ItemInterface $menu, array $options = [])
    {
        $this->factory = $factory;
        $this->menu = $menu;
        $this->options = $options;
    }

    /**
     * @return FactoryInterface
     */
    public function getFactory(): FactoryInterface
    {
        return $this->factory;
    }

    /**
     * @return ItemInterface
     */
    public function getMenu(): ItemInterface
    {
        return $this->menu;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options ?? [];
    }
}
