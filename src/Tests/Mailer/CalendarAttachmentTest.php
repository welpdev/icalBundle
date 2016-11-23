<?php

namespace Welp\IcalBundle\Tests\Mailer;

use Welp\IcalBundle\Component\Calendar;
use Welp\IcalBundle\Mailer\CalendarAttachment;
use Welp\IcalBundle\Tests\CalendarTestCase;

/**
 * Tests for the calendar response
 *
 * @package Welp\IcalBundle\Tests\Mailer
 * @author  Titouan BENOIT <titouan@welp.today>
 */
class CalendarAttachmentTest extends CalendarTestCase
{
    /**
     * Testing calendar attachment
     *
     * @param Calendar $calendar
     *
     * @dataProvider getCalendarTestData
     */
    public function testCalendarAttachment(Calendar $calendar)
    {
        $attachment = new CalendarAttachment($calendar);

        $this->assertInstanceOf('Swift_Attachment', $attachment);
        $this->assertInstanceOf('Welp\IcalBundle\Mailer\CalendarAttachment', $attachment);

        $this->assertEquals($calendar->createCalendar(), $attachment->getBody());
        $this->assertEquals($calendar->getConfig('filename'), $attachment->getFilename());
        $this->assertEquals($calendar->getContentType(), $attachment->getContentType());
    }
}
