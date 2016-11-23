<?php

namespace Welp\IcalBundle\Component;

use Jsvrcek\ICS\Model\Calendar;
use Jsvrcek\ICS\Model\CalendarEvent;
use Jsvrcek\ICS\Model\Relationship\Attendee;
use Jsvrcek\ICS\Model\Relationship\Organizer;

use Jsvrcek\ICS\Utility\Formatter;
use Jsvrcek\ICS\CalendarStream;
use Jsvrcek\ICS\CalendarExport;

/**
 * Calendar component
 * @TODO
 *
 * @package Welp\IcalBundle\Component
 * @author  Titouan BENOIT <titouan@welp.today>
 */
class Calendar extends \vcalendar
{

    /**
     * Default date format for converting DateTime objects
     */
    const DATE_FORMAT = 'Y/m/d H:i:s';

    /**
     * Event status types
     */
    const EVENT_STATUS_TENTATIVE = 'TENTATIVE';
    const EVENT_STATUS_CONFIRMED = 'CONFIRMED';
    const EVENT_STATUS_CANCELLED = 'CANCELLED';

    /**
     * @var string
     */
    protected $timezone;


    /**
     * Get content type
     *
     * @return string
     */
    public function getContentType()
    {
        if ($this->format == 'xcal') {
            return 'application/calendar+xml';
        } else {
            return 'text/calendar';
        }
    }


    /**
     * Create new event for calendar
     *
     * @return \vevent
     */
    public function newEvent()
    {
        return $this->newComponent('VEVENT');
    }


    /**
     * Get event from calendar
     *
     * @param int $index
     *
     * @return \vevent|false
     */
    public function getEvent($index = 1)
    {
        return $this->getComponent('VEVENT', $index);
    }


    /**
     * Set timezone, when Non-UTC
     *
     * @see http://kigkonsult.se/iCalcreator/docs/using.html#createTimezone
     *
     * @param string $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
        $this->setConfig('TZID', $timezone);
        $this->setProperty('X-WR-TIMEZONE', $timezone);
    }


    /**
     * Create calendar
     * Adds timezone component, when not already done
     *
     * @see http://kigkonsult.se/iCalcreator/docs/using.html#createTimezone
     *
     * @return string
     */
    public function createCalendar()
    {
        // add timezone component
        if ($this->timezone && $this->getComponent('VTIMEZONE') === false) {
            $xprops = array('X-LIC-LOCATION' => $this->timezone);
            \iCalUtilityFunctions::createTimezone($this, $this->timezone, $xprops);
        }

        return parent::createCalendar();
    }
}
