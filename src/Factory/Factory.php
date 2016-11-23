<?php

namespace Welp\IcalBundle\Factory;

use Welp\IcalBundle\Component\Calendar;

/**
 * Calendar Factory
 *
 * @package Welp\IcalBundle\Factory
 * @author  Titouan BENOIT <titouan@welp.today>
 */
class Factory
{
    /**
     * @var string
     */
    protected $timezone;

    /**
     * @var array
     */
    protected $defaultConfig = array();


    /**
     * Create new calendar
     *
     * @param array $config
     *
     * @return Calendar
     */
    public function create($config = array())
    {
        // merge with default configs
        $config = array_merge($this->defaultConfig, $config);

        $calendar = new Calendar($config);

        if (!is_null($this->timezone)) {
            $calendar->setTimezone($this->timezone);
        }

        return $calendar;
    }


    /**
     * Add default config
     *
     * @param string $name  Name
     * @param mixed  $value Value
     */
    public function addDefaultConfig($name, $value)
    {
        $this->defaultConfig[$name] = $value;
    }


    /**
     * Set default timezone for calendars
     *
     * @param string $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }
}
