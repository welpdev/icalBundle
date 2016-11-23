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
     * @param array $config Calendar configs
     *
     * @dataProvider getCalendarConfigTestData
     */
    public function testCreate(array $config)
    {
        $calendar = $this->factory->create($config);
        $this->assertCalendarConfigs($config, $calendar);
    }


    /**
     * Test setting timezone for calendar via factory
     *
     * @param array $config Calendar configs
     *
     * @dataProvider getCalendarConfigTestData
     */
    public function testSetTimezone(array $config)
    {
        $timezone = 'Europe/Berlin';
        $this->factory->setTimezone($timezone);

        $calendar = $this->factory->create($config);
        $this->assertCalendarConfigs($config, $calendar);

        $reflection = new \ReflectionObject($calendar);
        $attribute = $reflection->getProperty('timezone');
        $attribute->setAccessible(true);
        $this->assertEquals($timezone, $attribute->getValue($calendar));
    }


    /**
     * Test add default configs and generating calendars with it
     */
    public function testAddDefaultConfig()
    {
        $reflection = new \ReflectionObject($this->factory);
        $attribute = $reflection->getProperty('defaultConfig');
        $attribute->setAccessible(true);

        $config = array('unique_id' => 'MyUniqueCalendarId', 'format' => 'xCal');
        foreach ($config as $name => $value) {
            $this->factory->addDefaultConfig($name, $value);
        }

        $this->assertEquals($config, $attribute->getValue($this->factory));

        $calendar = $this->factory->create();
        $this->assertCalendarConfigs($config, $calendar);
    }
}
