<?php

namespace Welp\IcalBundle\Tests\Response;

use Welp\IcalBundle\Component\Calendar;
use Welp\IcalBundle\Response\CalendarResponse;
use Welp\IcalBundle\Tests\CalendarTestCase;

/**
 * Tests for CalendarResponse
 *
 * @package Welp\IcalBundle\Tests\Response
 * @author  Titouan BENOIT <titouan@welp.today>
 */
class CalendarResponseTest extends CalendarTestCase
{
    /**
     * Testing calendar response
     *
     * @param Calendar $calendar Calendar
     * @param array    $headers  Additional response headers
     *
     * @dataProvider getCalendarTestData
     */
    public function testCalendarResponse(Calendar $calendar, $headers = array())
    {
        $response = new CalendarResponse($calendar, 200, $headers);

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
        $this->assertInstanceOf('Welp\IcalBundle\Response\CalendarResponse', $response);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals($calendar->createCalendar(), $response->getContent());

        foreach ($headers as $key => $value) {
            $this->assertEquals($value, $response->headers->get($key));
        }

        $this->assertContains($calendar->getContentType(), $response->headers->get('Content-Type'));
        $this->assertContains($calendar->getConfig('filename'), $response->headers->get('Content-Disposition'));
    }
}
