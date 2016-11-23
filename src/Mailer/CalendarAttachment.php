<?php

namespace Welp\IcalBundle\Mailer;

use Welp\IcalBundle\Component\Calendar;

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
        $data = $calendar->createCalendar();
        $filename = $calendar->getConfig('filename');
        $contentType = $calendar->getContentType();
        
        parent::__construct($data, $filename, $contentType);
    }
}
