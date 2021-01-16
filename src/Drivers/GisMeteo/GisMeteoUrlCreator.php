<?php

namespace ArtARTs36\WeatherArchive\Drivers\GisMeteo;

use ArtARTs36\WeatherArchive\Contracts\UrlCreator;

class GisMeteoUrlCreator implements UrlCreator
{
    public function create(\DateTimeInterface $date, string $placeIdentity): string
    {
        return "https://www.gismeteo.ru/diary/{$placeIdentity}/{$this->dateToString($date)}";
    }

    protected function dateToString(\DateTimeInterface $date): string
    {
        return implode('/', [
            $date->format('Y'),
            $date->format('m'),
        ]);
    }
}
