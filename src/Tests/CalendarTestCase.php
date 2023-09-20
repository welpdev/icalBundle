<?php

namespace Welp\IcalBundle\Tests;

use PHPUnit\Framework\TestCase;
use Welp\IcalBundle\Component\Calendar;

/**
 * Abstract calendar test case
 *
 * @package Welp\IcalBundle\Tests
 * @author  Titouan BENOIT <titouan@welp.today>
 */
abstract class CalendarTestCase extends TestCase
{

    /**
     * Assert calendar configs
     *
     * @param Calendar $calendar Actual calendar
     */
    protected function assertCalendar($calendar)
    {
        $this->assertInstanceOf('Welp\IcalBundle\Component\Calendar', $calendar);
        $this->assertInstanceOf('Jsvrcek\ICS\Model\Calendar', $calendar);
    }
}
