<?php

namespace ArtARTs36\WeatherArchive;

use ArtARTs36\WeatherArchive\Contracts\EntityCreatorInterface;
use ArtARTs36\WeatherArchive\Entities\Entity;

class EntityCreator implements EntityCreatorInterface
{
    public function create(string $class, array $fields): Entity
    {
        $entity = new $class();

        $setter = function (string $field, $value) {
            $this->$field = $value;
        };

        foreach ($fields as $field => $value) {
            $setter->call($entity, $field, $value);
        }

        return $entity;
    }
}
