<?php

namespace Welp\IcalBundle\Response;

use Welp\IcalBundle\Component\Calendar;
use Symfony\Component\HttpFoundation\Response;

use Jsvrcek\ICS\Utility\Formatter;
use Jsvrcek\ICS\CalendarStream;
use Jsvrcek\ICS\CalendarExport;

/**
 * Represents a HTTP response for a calendar file download
 *
 * @package Welp\IcalBundle\Response
 * @author  Titouan BENOIT <titouan@welp.today>
 */
class CalendarResponse extends Response
{
    /**
     * Calendar
     *
     * @var Calendar
     */
    protected $calendar;


    /**
     * Construct calendar response
     *
     * @param Calendar $calendar Calendar
     * @param int      $status   Response status
     * @param array    $headers  Response headers
     */
    public function __construct(Calendar $calendar, $status = 200, $headers = array())
    {
        $this->calendar = $calendar;

        $content = $this->calendar->export();

        $headers = array_merge($this->getDefaultHeaders(), $headers);
        parent::__construct($content, $status, $headers);
    }


    /**
     * Get default response headers for a calendar
     *
     * @return array
     */
    protected function getDefaultHeaders()
    {
        $headers = array();

        $mimeType = $this->calendar->getContentType();
        $headers['Content-Type'] = sprintf('%s; charset=utf-8', $mimeType);

        $filename = $this->calendar->getFilename();
        $headers['Content-Disposition'] = sprintf('attachment; filename="%s', $filename);

        return $headers;
    }
}
