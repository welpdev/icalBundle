<?php
namespace Welp\IcalBundle\Tests\Component;

use Welp\IcalBundle\Component\Calendar;
use Welp\IcalBundle\Tests\CalendarTestCase;

/**
 * Tests for calendar component
 *
 * @package Welp\IcalBundle\Tests
 * @author  Titouan BENOIT <titouan@welp.today>
 */
class CalendarTest extends CalendarTestCase
{

    /**
     * Testing initiating calendar
     *
     */
    public function testInit()
    {
        $calendar = new Calendar();
        $this->assertCalendar($calendar);
    }

    /**
     * Testing filename calendar
     *
     */
    public function testSetGetFilename()
    {
        $calendar = new Calendar();
        $this->assertEquals('calendar.ics', $calendar->getFilename());

        $calendar->setFilename('test.ics');
        $this->assertEquals('test.ics', $calendar->getFilename());
    }

    /**
     * Testing contentType calendar
     *
     */
    public function testGetContentType()
    {
        $calendar = new Calendar();
        $this->assertEquals('text/calendar', $calendar->getContentType());
    }

    /**
     * Testing export calendar
     *
     */
    public function testExport()
    {
        $calendar = new Calendar();
        $this->assertStringStartsWith('BEGIN:VCALENDAR', $calendar->export());
    }

}
