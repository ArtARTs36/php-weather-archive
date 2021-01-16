<?php

namespace ArtARTs36\WeatherArchive\Tests;

use ArtARTs36\WeatherArchive\Entities\Day;
use PHPUnit\Framework\TestCase;

final class DayTest extends TestCase
{
    /**
     * @covers \ArtARTs36\WeatherArchive\Entities\Day::isWarm
     */
    public function testIsWarm(): void
    {
        $day = new Day();

        //

        $day->temperature = 20;
        self::assertTrue($day->isWarm());

        //

        $day->temperature = -20;
        self::assertFalse($day->isWarm());
    }

    /**
     * @covers \ArtARTs36\WeatherArchive\Entities\Day::getTemperatureWithSign
     */
    public function testGetTemperatureWithSign(): void
    {
        $day = new Day();

        //

        $day->temperature = 20;
        self::assertEquals('+20', $day->getTemperatureWithSign());

        //

        $day->temperature = -20;
        self::assertEquals('-20', $day->getTemperatureWithSign());
    }

    /**
     * @covers \ArtARTs36\WeatherArchive\Entities\Day::getDateTime
     */
    public function testGetDateTime(): void
    {
        $day = new Day();

        $day->day = 1;
        $day->month = 1;
        $day->year = 2020;

        self::assertEquals("2020-01-01", $day->getDateTime()->format('Y-m-d'));
    }
}
