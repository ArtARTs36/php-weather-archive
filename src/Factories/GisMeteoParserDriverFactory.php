<?php

namespace ArtARTs36\WeatherArchive\Factories;

use ArtARTs36\WeatherArchive\Contracts\ConcreteDriverFactory;
use ArtARTs36\WeatherArchive\Contracts\Driver;
use ArtARTs36\WeatherArchive\Support\Html\CyrillicDomDocument;
use ArtARTs36\WeatherArchive\Support\Html\DecodeMachine;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\Decoders\Html\HtmlDecoder;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\GisMeteoParserDriver;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\GisMeteoUrlCreator;
use ArtARTs36\WeatherArchive\EntityCreator;
use ArtARTs36\WeatherArchive\Support\TypeCaster;

class GisMeteoParserDriverFactory implements ConcreteDriverFactory
{
    public static function create(): Driver
    {
        return new GisMeteoParserDriver(
            new GisMeteoUrlCreator(),
            new HtmlDecoder(new DecodeMachine(new TypeCaster()), new CyrillicDomDocument()),
            new EntityCreator(),
        );
    }
}
