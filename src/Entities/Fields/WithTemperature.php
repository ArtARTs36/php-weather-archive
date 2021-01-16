<?php

namespace ArtARTs36\WeatherArchive\Entities\Fields;

trait WithTemperature
{
    public $temperature;

    public function isWarm(): bool
    {
        return $this->temperature > 0;
    }

    public function getTemperatureWithSign(): string
    {
        return $this->isWarm() ? '+' . $this->temperature : $this->temperature;
    }
}
