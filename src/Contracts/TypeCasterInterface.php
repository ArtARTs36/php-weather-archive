<?php

namespace ArtARTs36\WeatherArchive\Contracts;

use ArtARTs36\WeatherArchive\Exceptions\TypeNotAvailableForCasting;

interface TypeCasterInterface
{
    public const TYPE_INT = 'int';
    public const TYPE_STRING = 'string';
    public const TYPE_FLOAT = 'float';

    /**
     * @throws TypeNotAvailableForCasting
     */
    public function cast($value, string $type);
}
