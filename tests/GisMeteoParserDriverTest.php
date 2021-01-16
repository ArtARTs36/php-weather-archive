<?php

namespace ArtARTs36\WeatherArchive\Tests;

use ArtARTs36\WeatherArchive\Contracts\GisMeteoContentDecoder;
use ArtARTs36\WeatherArchive\Contracts\Place;
use ArtARTs36\WeatherArchive\Contracts\UrlCreator;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\Decoders\Html\CyrillicDomDocument;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\Decoders\Html\DecodeMachine;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\Decoders\Html\HtmlDecoder;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\GisMeteoParserDriver;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\GisMeteoUrlCreator;
use ArtARTs36\WeatherArchive\EntityCreator;
use ArtARTs36\WeatherArchive\Support\TypeCaster;
use PHPUnit\Framework\TestCase;

final class GisMeteoParserDriverTest extends TestCase
{
    /**
     * @covers \ArtARTs36\WeatherArchive\Drivers\GisMeteo\GisMeteoParserDriver::getOnMonth
     */
    public function testDecode(): void
    {
        $instance = $this->createInstance(file_get_contents(__DIR__ . '/mock/gismeteo_response.html'));

        $expected = [
            [
                'day' => 1,
                'month' => 1,
                'year' => 2021,
                'temperature' => 27,
                'pressure' => 746,
                'wind' => 'ЮВ 1м/с',
                'cloudy' => 25.0,
            ],
            [
                'day' => 2,
                'month' => 1,
                'year' => 2021,
                'temperature' => 31,
                'pressure' => 748,
                'wind' => 'С 2м/с',
                'cloudy' => 50.0,
            ],
        ];

        $result = $instance->getOnMonth(
            new \DateTime('2021-01-15'),
            new \ArtARTs36\WeatherArchive\Entities\Place('')
        );

        foreach ($expected as $i => $part) {
            self::assertEquals($part, $result[$i]->toArray());
        }
    }

    private function createInstance(string $response): GisMeteoParserDriver
    {
        return new class(
            $response,
            new GisMeteoUrlCreator(),
            new HtmlDecoder(new DecodeMachine(new TypeCaster()), new CyrillicDomDocument()),
            new EntityCreator()
        ) extends GisMeteoParserDriver {
            private $response;

            public function __construct(string $response, UrlCreator $urlCreator, GisMeteoContentDecoder $decoder, EntityCreator $entityCreator)
            {
                parent::__construct($urlCreator, $decoder, $entityCreator);

                $this->response = $response;
            }

            public function getContent(\DateTimeInterface $date, Place $place): string
            {
                return $this->response;
            }
        };
    }
}
