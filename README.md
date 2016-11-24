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

## Configuration

In your `config.yml`:

```yaml
welp_ical:
    default_timezone: "Europe/Paris"
    default_prodid: "-//WelpIcalBundle//Calendar App//FR"
```

## Usage

``` php
<?php

    ...

    /**
     * Generate calendar event ICAL for welpAction
     * @Config\Route("/ical", name="app_ical")
     */
    public function icalAction()
    {
        $icalFactory = $this->get('welp_ical.factory');

        //Create a calendar
        $calendar = $icalFactory->createCalendar();

        //Create an event
        $eventOne = $icalFactory->createCalendarEvent();
        $eventOne->setStart(new \DateTime())
            ->setSummary('Family reunion')
            ->setUid('event-uid');

        //add an Attendee
        $attendee = $icalFactory->createAttendee();
        $attendee->setValue('moe@example.com')
            ->setName('Moe Smith');
        $eventOne->addAttendee($attendee);

        //set the Organizer
        $organizer = $icalFactory->createOrganizer();
        $organizer->setValue('titouan@welp.fr')
            ->setName('Titouan BENOIT')
            ->setLanguage('fr');
        $eventOne->setOrganizer($organizer);

        //new event
        $eventTwo = $icalFactory->createCalendarEvent();
        $eventTwo->setStart(new \DateTime())
            ->setSummary('Dentist Appointment')
            ->setUid('event-uid');

        $calendar
            ->addEvent($eventOne)
            ->addEvent($eventTwo);

        $headers = array();
        $calendarResponse = new Welp\IcalBundle\Response\CalendarResponse($calendar, 200, $headers);

        return $calendarResponse;

    }


```
