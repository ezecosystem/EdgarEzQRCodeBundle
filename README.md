# EdgarEzQRCodeBundle

> Use Ariel Ferrandini PHPQRCode library (https://github.com/aferrandini/PHPQRCode)


## Installation

### Get the bundle using composer

Add EdgarEzQRCodeBundle by running this command from the terminal at the root of
your eZPlatform project:

```bash
composer require edgarez/qrcodebundle
```


### Enable the bundle

To start using the bundle, register the bundle in your application's kernel class:

```php
// ezpublish/EzPublishKernel.php
public function registerBundles()
{
    $bundles = array(
        // ...
        new EdgarEz\QRCodeBundle\EdgarEzQRCodeBundle(),
        // ...
    );
}
```

Install assets for this new Bundle

```command
php ezpublish/console assets:install
```


### How to use

```html
<img src="{{ asset(eez_qrcode('foo')) }}"" />
```


### This bundle is still in beta version!