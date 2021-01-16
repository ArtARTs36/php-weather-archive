<?php

namespace ArtARTs36\WeatherArchive\Contracts;

interface TypeCasterInterface
{
    public const TYPE_INT = 'int';
    public const TYPE_STRING = 'string';
    public const TYPE_FLOAT = 'float';

    public function cast($value, string $type);
}
