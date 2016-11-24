# icalBundle

[![Build Status](https://travis-ci.org/welpdev/icalBundle.svg?branch=master)](https://travis-ci.org/welpdev/icalBundle)
[![Packagist](https://img.shields.io/packagist/v/welp/ical-bundle.svg)](https://packagist.org/packages/welp/ical-bundle)
[![Packagist](https://img.shields.io/packagist/dt/welp/ical-bundle.svg)](https://packagist.org/packages/welp/ical-bundle)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/welpdev/icalBundle/blob/master/LICENSE)

Symfony Bundle to manage .ics iCal file (creating and eventually reading)

use of the library: <https://github.com/jasvrcek/ICS>

## Setup

Add bundle to your project:

```bash
composer require welp/ical-bundle
```

Add `Welp\IcalBundle\WelpIcalBundle` to your `AppKernel.php`:

```php
$bundles = [
    // ...
    new Welp\IcalBundle\WelpIcalBundle(),
];
```

## Minimal Configuration

In your `config.yml`:

```yaml
welp_ical:
    default_timezone: "Europe\\Paris"
    default_prodid: "-//WelpIcalBundle//Calendar App//FR"
```
