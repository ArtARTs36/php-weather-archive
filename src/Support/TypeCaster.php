<?php

namespace ArtARTs36\WeatherArchive\Support;

use ArtARTs36\WeatherArchive\Contracts\TypeCasterInterface;
use ArtARTs36\WeatherArchive\Exceptions\TypeNotAvailableForCasting;

class TypeCaster implements TypeCasterInterface
{
    protected $map = [
        self::TYPE_INT => 'intval',
        self::TYPE_STRING => 'strval',
        self::TYPE_FLOAT => 'floatval',
    ];

    public function cast($value, string $type)
    {
        if (! array_key_exists($type, $this->map)) {
            throw new TypeNotAvailableForCasting($type);
        }

        $func = $this->map[$type];

        return $func($value);
    }
}
