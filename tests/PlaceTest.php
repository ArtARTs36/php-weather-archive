<?php

namespace ArtARTs36\WeatherArchive\Tests;

use ArtARTs36\WeatherArchive\Entities\Place;
use PHPUnit\Framework\TestCase;

final class PlaceTest extends TestCase
{
    /**
     * @covers \ArtARTs36\WeatherArchive\Entities\Place::getIdentity
     */
    public function testIdentity(): void
    {
        $place = new Place($identity = '123');

        self::assertEquals($identity, $place->getIdentity());
    }
}
