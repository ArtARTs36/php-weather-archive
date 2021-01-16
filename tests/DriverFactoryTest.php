<?php

namespace ArtARTs36\WeatherArchive\Tests;

use ArtARTs36\WeatherArchive\DriverFactory;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\GisMeteoParserDriver;
use PHPUnit\Framework\TestCase;

final class DriverFactoryTest extends TestCase
{
    public function testByDate(): void
    {
        $factory = new DriverFactory();

        $oldDate = new \DateTime('2021-01-01');

        self::assertInstanceOf(GisMeteoParserDriver::class, $factory->byDate($oldDate));

        // @todo add cases after create new drivers
    }
}
