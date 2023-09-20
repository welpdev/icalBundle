<?php

namespace Welp\IcalBundle\Response;

use Welp\IcalBundle\Component\Calendar;
use Symfony\Component\HttpFoundation\Response;

/**
 * Represents a HTTP response for a calendar file download
 *
 * @package Welp\IcalBundle\Response
 * @author  Titouan BENOIT <titouan@welp.today>
 */
class CalendarResponse extends Response
{
    protected Calendar $calendar;

    public function __construct(Calendar $calendar, int $status = 200, array $headers = array())
    {
        $this->calendar = $calendar;

        $content = $this->calendar->export();

        $headers = array_merge($this->getDefaultHeaders(), $headers);
        parent::__construct($content, $status, $headers);
    }

    protected function getDefaultHeaders(): array
    {
        $headers = array();

        $mimeType = $this->calendar->getContentType();
        $headers['Content-Type'] = sprintf('%s; charset=utf-8', $mimeType);

        $filename = $this->calendar->getFilename();
        $headers['Content-Disposition'] = sprintf('attachment; filename="%s', $filename);

        return $headers;
    }
}
