<?php

namespace ArtARTs36\WeatherArchive\Tests;

use ArtARTs36\WeatherArchive\Contracts\Driver;
use ArtARTs36\WeatherArchive\Contracts\GisMeteoContentDecoder;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\GisMeteoParserDriver;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\GisMeteoUrlCreator;
use ArtARTs36\WeatherArchive\Entities\Place;
use ArtARTs36\WeatherArchive\EntityCreator;
use ArtARTs36\WeatherArchive\Exceptions\PlaceNotSpecifiedForDriver;
use PHPUnit\Framework\TestCase;
use ArtARTs36\WeatherArchive\Contracts\Place as PlaceContract;

final class PlaceTest extends TestCase
{
    /**
     * @covers \ArtARTs36\WeatherArchive\Entities\Place::getIdentity
     */
    public function testIdentity(): void
    {
        $place = new Place([
            GisMeteoParserDriver::class => $identity = '123',
        ]);

        //

        self::assertEquals($identity, $place->getIdentity(new GisMeteoParserDriver(
            new GisMeteoUrlCreator(),
            new class implements GisMeteoContentDecoder {
                public function decode(string $content): array
                {
                    return [];
                }
            },
            new EntityCreator()
        )));

        //

        self::expectException(PlaceNotSpecifiedForDriver::class);

        $place->getIdentity(new class implements Driver {
            public function getOnMonth(\DateTimeInterface $date, PlaceContract $place): array
            {
                return [];
            }
        });
    }
}
