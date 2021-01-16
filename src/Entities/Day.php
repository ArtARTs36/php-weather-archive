<?php

namespace ArtARTs36\WeatherArchive\Entities;

class Day extends Entity
{
    public $day;

    public $month;

    public $year;

    public $temperature;

    public $pressure;

    public $wind;

    public $cloudy;

    public function isWarm(): bool
    {
        return $this->temperature > 0;
    }

    public function getTemperatureWithSign(): string
    {
        return $this->isWarm() ? '+' . $this->temperature : $this->temperature;
    }
}
