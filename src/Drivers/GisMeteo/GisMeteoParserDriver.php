<?php

namespace ArtARTs36\WeatherArchive\Drivers\GisMeteo;

use ArtARTs36\WeatherArchive\Contracts\Driver;
use ArtARTs36\WeatherArchive\Contracts\EntityCreatorInterface;
use ArtARTs36\WeatherArchive\Contracts\GisMeteoContentDecoder;
use ArtARTs36\WeatherArchive\Contracts\Place;
use ArtARTs36\WeatherArchive\Contracts\UrlCreator;
use ArtARTs36\WeatherArchive\Entities\Day;

class GisMeteoParserDriver implements Driver
{
    protected $urlCreator;

    protected $decoder;

    protected $entityCreator;

    public function __construct(
        UrlCreator $urlCreator,
        GisMeteoContentDecoder $decoder,
        EntityCreatorInterface $entityCreator
    ) {
        $this->urlCreator = $urlCreator;
        $this->decoder = $decoder;
        $this->entityCreator = $entityCreator;
    }

    /**
     * @inheritDoc
     */
    public function getOnMonth(\DateTimeInterface $date, Place $place): array
    {
        $days = [];

        foreach ($this->decoder->decode($this->getContent($date, $place)) as $dayData) {
            $days[] = $this->createDay($dayData, $date);
        }

        return $days;
    }

    protected function createDay(array $data, \DateTimeInterface $date): Day
    {
        return $this->entityCreator->create(Day::class, $data)->setMonthAndYear($date);
    }

    protected function getContent(\DateTimeInterface $date, Place $place): string
    {
        $content = file_get_contents($this->urlCreator->create($date, $place->getIdentity($this)));

        if (! $content) {
            throw new \RuntimeException();
        }

        return $content;
    }
}
