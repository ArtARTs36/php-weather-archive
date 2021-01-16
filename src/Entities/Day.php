<?php

namespace ArtARTs36\WeatherArchive\Entities;

use ArtARTs36\WeatherArchive\Entities\Fields\WithTemperature;

class Day extends Entity
{
    use WithTemperature;

    public $day;

    public $month;

    public $year;

    public $pressure;

    public $wind;

    public $cloudy;
}
