<?php

namespace ArtARTs36\WeatherArchive\Entities;

abstract class Entity
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
