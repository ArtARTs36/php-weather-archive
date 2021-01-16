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

    public function getDateTime(): \DateTimeInterface
    {
        return new \DateTime("{$this->year}-{$this->month}-{$this->day}");
    }

    public function setMonthAndYear(\DateTimeInterface $date): self
    {
        $this->month = (int) $date->format('m');
        $this->year = (int) $date->format('Y');

        return $this;
    }
}
