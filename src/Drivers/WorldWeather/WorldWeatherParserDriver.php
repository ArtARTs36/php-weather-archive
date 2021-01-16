<?php

namespace ArtARTs36\WeatherArchive\Drivers\WorldWeather;

use ArtARTs36\WeatherArchive\Contracts\Driver;
use ArtARTs36\WeatherArchive\Contracts\EntityCreatorInterface;
use ArtARTs36\WeatherArchive\Contracts\Place;
use ArtARTs36\WeatherArchive\Contracts\UrlCreator;
use ArtARTs36\WeatherArchive\Drivers\WorldWeather\Decoders\Html\HtmlDecoder;
use ArtARTs36\WeatherArchive\Entities\Day;
use ArtARTs36\WeatherArchive\EntityCreator;

class WorldWeatherParserDriver implements Driver
{
    protected $decoder;

    protected $entityCreator;

    protected $urlCreator;

    public function __construct(HtmlDecoder $decoder, EntityCreatorInterface $entityCreator, UrlCreator $urlCreator)
    {
        $this->decoder = $decoder;
        $this->entityCreator = $entityCreator;
        $this->urlCreator = $urlCreator;
    }

    public function getOnMonth(\DateTimeInterface $date, Place $place): array
    {
        return array_map(function (array $data) use ($date) {
            /** @var Day $entity */
            $entity = $this->entityCreator->create(Day::class, $data);
            $entity->month = (int) $date->format('m');
            $entity->year = (int) $date->format('Y');

            return $entity;
        }, $this->decoder->decode($this->getContent($date, $place)));
    }

    protected function getContent(\DateTimeInterface $time, Place $place): string
    {
        return file_get_contents($this->urlCreator->create($time, $place));
    }
}
