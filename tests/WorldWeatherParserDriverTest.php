<?php

namespace ArtARTs36\WeatherArchive\Tests;

use ArtARTs36\WeatherArchive\Contracts\Place;
use ArtARTs36\WeatherArchive\Contracts\UrlCreator;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\Decoders\Html\CyrillicDomDocument;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\Decoders\Html\DecodeMachine;
use ArtARTs36\WeatherArchive\Drivers\WorldWeather\Decoders\Html\HtmlDecoder;
use ArtARTs36\WeatherArchive\Drivers\WorldWeather\WorldWeatherParserDriver;
use ArtARTs36\WeatherArchive\Drivers\WorldWeather\WorldWeatherUrlCreator;
use ArtARTs36\WeatherArchive\EntityCreator;
use ArtARTs36\WeatherArchive\Support\TypeCaster;
use PHPUnit\Framework\TestCase;

final class WorldWeatherParserDriverTest extends TestCase
{
    public function testGetOnMonth(): void
    {
        $driver = $this->createInstance(file_get_contents(__DIR__ . '/mock/world_weather_response.html'));

        $days = $driver->getOnMonth(new \DateTime(), new \ArtARTs36\WeatherArchive\Entities\Place([
            WorldWeatherParserDriver::class => 'russia/voronezh',
        ]));

        self::assertCount(30, $days);
    }

    protected function createInstance(string $response)
    {
        return new class(
            new HtmlDecoder(new DecodeMachine(new TypeCaster()), new CyrillicDomDocument()),
            new EntityCreator(),
            new WorldWeatherUrlCreator(),
            $response
        ) extends WorldWeatherParserDriver {
            private $response;

            public function __construct(
                HtmlDecoder $decoder,
                EntityCreator $entityCreator,
                UrlCreator $urlCreator,
                string $response
            ) {
                parent::__construct($decoder, $entityCreator, $urlCreator);

                $this->response = $response;
            }

            protected function getContent(\DateTimeInterface $time, Place $place): string
            {
                return $this->response;
            }
        };
    }
}
