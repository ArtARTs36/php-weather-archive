<?php

namespace ArtARTs36\WeatherArchive\Contracts;

use ArtARTs36\WeatherArchive\Entities\Entity;

interface EntityCreatorInterface
{
    public function create(string $class, array $fields): Entity;
}
