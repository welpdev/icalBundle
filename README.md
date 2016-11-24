# icalBundle

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
