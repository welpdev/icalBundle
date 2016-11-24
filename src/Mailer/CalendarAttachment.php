<?php

namespace Welp\IcalBundle\Mailer;

use Welp\IcalBundle\Component\Calendar;

use Jsvrcek\ICS\Utility\Formatter;
use Jsvrcek\ICS\CalendarStream;
use Jsvrcek\ICS\CalendarExport;

/**
 * Calendar attachment for Swift mailer messages
 *
 * @package Welp\IcalBundle\Mailer
 * @author  Titouan BENOIT <titouan@welp.today>
 */
class CalendarAttachment extends \Swift_Attachment
{
    /**
     * Calendar attachment constructor
     *
     * @param Calendar $calendar
     */
    public function __construct(Calendar $calendar)
    {
        $data = $calendar->export();

        $filename = $calendar->getFilename();
        $contentType = sprintf('%s; charset=utf-8', $calendar->getContentType());

        parent::__construct($data, $filename, $contentType);
    }
}
