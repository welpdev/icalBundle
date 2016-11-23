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
     * @param array $config Calendar config
     *
     * @dataProvider getCalendarConfigTestData
     */
    public function testInit(array $config)
    {
        $calendar = new Calendar($config);
        $this->assertCalendarConfigs($config, $calendar);
    }


    /**
     * Testing getter for content type
     *
     * @param array  $config      Calendar config
     * @param string $contentType Expected content type
     *
     * @dataProvider getCalendarContentTypeTestData
     */
    public function testGetContentType(array $config, $contentType)
    {
        $calendar = new Calendar($config);
        $this->assertEquals($contentType, $calendar->getContentType());
    }


    /**
     * Test creating new event for calendar
     */
    public function testNewEvent()
    {
        $calendar = new Calendar();
        $this->assertEmpty($calendar->getComponent('vevent'));

        $event = $calendar->newEvent();
        $this->assertInstanceOf('vevent', $event);
        $this->assertEquals($event, $calendar->getComponent('vevent'));
    }


    /**
     * Test setter for timezone
     */
    public function testSetTimezone()
    {
        $timezone = 'Europe/Berlin';
        $calendar = new Calendar();
        $reflection = new \ReflectionObject($calendar);
        $attribute = $reflection->getProperty('timezone');
        $attribute->setAccessible(true);

        // check timezone values before setting
        $this->assertEmpty($attribute->getValue($calendar));
        $this->assertEmpty($calendar->getConfig('TZID'));
        $this->assertFalse($calendar->getProperty('X-WR-TIMEZONE'));
        $this->assertFalse($calendar->getComponent('vtimezone'));

        // check timezone values after setting
        $calendar->setTimezone($timezone);
        $this->assertEquals($timezone, $attribute->getValue($calendar));
        $this->assertEquals($timezone, $calendar->getConfig('TZID'));
        $this->assertContains($timezone, $calendar->getProperty('X-WR-TIMEZONE'));

        // check timezone component
        $calendar->createCalendar();
        $this->assertInstanceOf('vtimezone', $calendar->getComponent('vtimezone'));
    }


    /**
     * Get calendar test config
     *
     * @return array
     */
    public function getCalendarContentTypeTestData()
    {
        return array(
            array(array('format' => 'iCal'), 'text/calendar'),
            array(array('format' => 'xCal'), 'application/calendar+xml'),
        );
    }
}
