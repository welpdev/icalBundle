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


}
