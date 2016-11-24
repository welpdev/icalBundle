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
     */
    public function testCalendarResponse()
    {
        $calendar = new Calendar();
        $response = new CalendarResponse($calendar, 200);

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
        $this->assertInstanceOf('Welp\IcalBundle\Response\CalendarResponse', $response);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals($calendar->export(), $response->getContent());

        $this->assertContains($calendar->getContentType()."; charset=utf-8", $response->headers->get('Content-Type'));
        $this->assertContains($calendar->getFilename(), $response->headers->get('Content-Disposition'));
    }
}
