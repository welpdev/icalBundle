<?php

namespace Welp\IcalBundle\Component;

use Jsvrcek\ICS\Model\Calendar as vCalendar;

use Jsvrcek\ICS\Utility\Formatter;
use Jsvrcek\ICS\CalendarStream;
use Jsvrcek\ICS\CalendarExport;

/**
 * Calendar component
 *
 * @package Welp\IcalBundle\Component
 * @author  Titouan BENOIT <titouan@welp.today>
 */
class Calendar extends vCalendar
{
    private string $filename = 'calendar.ics';

    public function getContentType(): string
    {
        return 'text/calendar';
    }

    public function export(bool $doImmediateOutput = false): string
    {
        //setup exporter
        $calendarExport = new CalendarExport(new CalendarStream, new Formatter());
        $calendarExport->addCalendar($this);

        //set exporter to send items directly to output instead of storing in memory
        $calendarExport->getStreamObject()->setDoImmediateOutput($doImmediateOutput);

        //output .ics formatted text
        return $calendarExport->getStream();
    }

    public function setFilename(string $filename): Calendar
    {
        $this->filename = $filename;

        return $this;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }
}
