<?php

namespace ArtARTs36\WeatherArchive\Factories;

use ArtARTs36\WeatherArchive\Contracts\ConcreteDriverFactory;
use ArtARTs36\WeatherArchive\Contracts\Driver;
use ArtARTs36\WeatherArchive\Support\Html\CyrillicDomDocument;
use ArtARTs36\WeatherArchive\Support\Html\DecodeMachine;
use ArtARTs36\WeatherArchive\Drivers\WorldWeather\Decoders\Html\HtmlDecoder;
use ArtARTs36\WeatherArchive\Drivers\WorldWeather\WorldWeatherParserDriver;
use ArtARTs36\WeatherArchive\Drivers\WorldWeather\WorldWeatherUrlCreator;
use ArtARTs36\WeatherArchive\EntityCreator;
use ArtARTs36\WeatherArchive\Support\TypeCaster;

class WorldWeatherParserDriverFactory implements ConcreteDriverFactory
{
    public static function create(): Driver
    {
        return new WorldWeatherParserDriver(
            new HtmlDecoder(
                new DecodeMachine(new TypeCaster()),
                new CyrillicDomDocument(),
            ),
            new EntityCreator(),
            new WorldWeatherUrlCreator()
        );
    }
}
