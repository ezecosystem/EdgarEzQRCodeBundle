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
// Text to QRCodize
<img src="{{ asset(eez_qrcode('foo')) }}"" />

// Level of error correction (3 by default, should be at least 0, maximum 3)
<img src="{{ asset(eez_qrcode('foo', 3)) }}"" />

// Size of QRCode image
<img src="{{ asset(eez_qrcode('foo', 3, 4)) }}"" />

// Margin of QRCode image
<img src="{{ asset(eez_qrcode('foo', 3, 4, 5)) }}"" />
```

