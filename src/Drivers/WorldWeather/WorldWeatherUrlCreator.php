<?php

namespace ArtARTs36\WeatherArchive\Drivers\WorldWeather;

use ArtARTs36\WeatherArchive\Contracts\Place;
use ArtARTs36\WeatherArchive\Contracts\UrlCreator;

class WorldWeatherUrlCreator implements UrlCreator
{
    public function create(\DateTimeInterface $date, string $placeIdentity): string
    {
        return "https://world-weather.ru/pogoda/{$placeIdentity}/{$this->dateToString($date)}/";
    }

    protected function dateToString(\DateTimeInterface $date): string
    {
        return mb_strtolower($date->format('F')) . '-' . $date->format('Y');
    }
}
