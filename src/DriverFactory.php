<?php

namespace ArtARTs36\WeatherArchive;

use ArtARTs36\WeatherArchive\Contracts\ConcreteDriverFactory;
use ArtARTs36\WeatherArchive\Contracts\Driver;
use ArtARTs36\WeatherArchive\Drivers\GisMeteo\GisMeteoParserDriver;
use ArtARTs36\WeatherArchive\Factories\GisMeteoParserDriverFactory;
use ArtARTs36\WeatherArchive\Support\Date;

class DriverFactory
{
    public const TYPE_OLD_DATE = 'old_date';
    public const TYPE_NEW_DATE = 'new_date';

    protected $factories = [
        GisMeteoParserDriver::class => GisMeteoParserDriverFactory::class,
    ];

    protected $map = [
        self::TYPE_OLD_DATE => GisMeteoParserDriver::class,
        self::TYPE_NEW_DATE => '',
    ];

    public function byDate(\DateTimeInterface $date): Driver
    {
        $currentDate = new \DateTime();

        if (Date::oneDateGreaterTwoDateByMonthAndYear($date, $currentDate)) {
            $type = static::TYPE_NEW_DATE;
        } else {
            $type = static::TYPE_OLD_DATE;
        }

        /** @var ConcreteDriverFactory $factory */
        $factory = $this->factories[$this->map[$type]];

        return $factory::create();
    }
}
