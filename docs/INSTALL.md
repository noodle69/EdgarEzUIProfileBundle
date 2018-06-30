# EdgarEzUIProfileBundle

## Installation

### Get the bundle using composer

Add EdgarEzUIProfileBundle by running this command from the terminal at the root of
your symfony project:

```bash
composer require edgar/ez-uiprofile-bundle
```

## Enable the bundle

To start using the bundle, register the bundle in your application's kernel class:

```php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Edgar\EzUIProfileBundle\EdgarEzUIProfileBundle(),
        // ...
    );
}
```

## Add routing

Add to your global configuration app/config/routing.yml

```yaml
edgar.ezuiprofile:
    resource: '@EdgarEzUIProfileBundle/Resources/config/routing.yml'
    prefix: /_profile
    defaults:
        siteaccess_group_whitelist: 'admin_group'    
```
