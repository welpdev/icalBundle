<?php

namespace Welp\IcalBundle\Tests\Factory;

use Welp\IcalBundle\Component\Calendar;
use Welp\IcalBundle\Factory\Factory;
use Welp\IcalBundle\Tests\CalendarTestCase;

/**
 * Tests for calendar factory
 *
 * @package Welp\IcalBundle\Tests
 * @author  Titouan BENOIT <titouan@welp.today>
 */
class FactoryTest extends CalendarTestCase
{

    /**
     * @var Factory
     */
    protected $factory;


    /**
     * Set up tests
     */
    public function setUp()
    {
        $this->factory = new Factory();
    }


    /**
     * Test initiating factory
     */
    public function testInit()
    {
        $this->assertInstanceOf('Welp\IcalBundle\Factory\Factory', $this->factory);
    }


    /**
     * Test creating new calendar
     *
     */
    public function testCreateCalendar()
    {
        $calendar = $this->factory->createCalendar();
        $this->assertCalendar($calendar);
    }

    /**
     * Test creating new calendarEvent
     *
     */
    public function testCreateCalendarEvent()
    {
        $calendarEvent = $this->factory->createCalendarEvent();
        $this->assertInstanceOf('Jsvrcek\ICS\Model\CalendarEvent', $calendarEvent);
    }

    /**
     * Test creating new calendarAlarm
     *
     */
    public function testCreateCalendarAlarm()
    {
        $calendarAlarm = $this->factory->createCalendarAlarm();
        $this->assertInstanceOf('Jsvrcek\ICS\Model\CalendarAlarm', $calendarAlarm);
    }

    /**
     * Test creating new calendarFreeBusy
     *
     */
    public function testCreateCalendarFreeBusy()
    {
        $calendarFreeBusy = $this->factory->createCalendarFreeBusy();
        $this->assertInstanceOf('Jsvrcek\ICS\Model\CalendarFreeBusy', $calendarFreeBusy);
    }

    /**
     * Test creating new calendarTodo
     *
     */
    public function testCreateCalendarTodo()
    {
        $calendarTodo = $this->factory->createCalendarTodo();
        $this->assertInstanceOf('Jsvrcek\ICS\Model\CalendarTodo', $calendarTodo);
    }

    /**
     * Test creating new Attendee
     *
     */
    public function testCreateAttendee()
    {
        $attendee = $this->factory->createAttendee();
        $this->assertInstanceOf('Jsvrcek\ICS\Model\Relationship\Attendee', $attendee);
    }

    /**
     * Test creating new Organizer
     *
     */
    public function testCreateOrganizer()
    {
        $organizer = $this->factory->createOrganizer();
        $this->assertInstanceOf('Jsvrcek\ICS\Model\Relationship\Organizer', $organizer);
    }

    /**
     * Test creating new Geo
     *
     */
    public function testCreateGeo()
    {
        $geo = $this->factory->createGeo();
        $this->assertInstanceOf('Jsvrcek\ICS\Model\Description\Geo', $geo);
    }

    /**
     * Test creating new Location
     *
     */
    public function testCreateLocation()
    {
        $location = $this->factory->createLocation();
        $this->assertInstanceOf('Jsvrcek\ICS\Model\Description\Location', $location);
    }

    /**
     * Test creating new RecurrenceRule
     *
     */
    public function testCreateRecurrenceRule()
    {
        $recurrenceRule = $this->factory->createRecurrenceRule();
        $this->assertInstanceOf('Jsvrcek\ICS\Model\Recurrence\RecurrenceRule', $recurrenceRule);
    }

    /**
     * Test timezone
     *
     */
    public function testTimezone()
    {
        $this->factory->setTimezone('Europe/Paris');
        $calendar = $this->factory->createCalendar();
        $this->assertCalendar($calendar);
        $this->assertInstanceOf('\DateTimeZone', $calendar->getTimezone());
        $this->assertEquals('Europe/Paris', $calendar->getTimezone()->getName());

    }

}
