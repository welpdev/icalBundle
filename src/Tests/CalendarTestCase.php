<?php

namespace Welp\IcalBundle\Tests;

use Welp\IcalBundle\Component\Calendar;

/**
 * Abstract calendar test case
 *
 * @package Welp\IcalBundle\Tests
 * @author  Titouan BENOIT <titouan@welp.today>
 */
abstract class CalendarTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Get config test data
     *
     * @return array
     */
    public function getCalendarTestData()
    {
        return array(
            array(new Calendar(array('format' => 'ical')), array('foo' => 'bar')),
            array(new Calendar(array('format' => 'xcal'))),
        );
    }


    /**
     * Get calendar test config
     *
     * @return array
     */
    public function getCalendarConfigTestData()
    {
        return array(
            array(array('format' => 'iCal', 'filename' => 'file.ics')),
            array(array('format' => 'xCal', 'filename' => 'file.xml')),
        );
    }


    /**
     * Assert calendar configs
     *
     * @param array    $expected Expected configs
     * @param Calendar $calendar Actual calendar
     */
    protected function assertCalendarConfigs($expected, $calendar)
    {
        $this->assertInstanceOf('Welp\IcalBundle\Component\Calendar', $calendar);
        foreach ($expected as $key => $value) {
            $this->assertEquals($value, $calendar->getConfig($key));
        }
    }
}
