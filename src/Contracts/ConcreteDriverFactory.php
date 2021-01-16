<?php

namespace ArtARTs36\WeatherArchive\Contracts;

interface ConcreteDriverFactory
{
    public static function create(): Driver;
}
