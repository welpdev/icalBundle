<?php

namespace Welp\IcalBundle\Mailer;

use Symfony\Component\Mime\Part\DataPart;
use Welp\IcalBundle\Component\Calendar;

/**
 * Calendar attachment for Swift mailer messages
 *
 * @package Welp\IcalBundle\Mailer
 * @author  Titouan BENOIT <titouan@welp.today>
 */
class CalendarAttachment extends DataPart
{
    public function __construct(Calendar $calendar)
    {
        $data = $calendar->export();

        $filename = $calendar->getFilename();
        $contentType = sprintf('%s; charset=utf-8', $calendar->getContentType());

        parent::__construct($data, $filename, $contentType);
    }
}
