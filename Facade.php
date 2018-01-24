<?php
include_once ('YWeather.php');
include_once ('Newton.php');

class Facade{
    function __construct()
    {
        $this->yweather = new YWeather();
        $this->newton = new Newton();
    }

    function getYWeather()
    {
        return $this->yweather->getInfo();
    }

    function getNewton()
    {
        return $this->newton->getdata();
    }
}