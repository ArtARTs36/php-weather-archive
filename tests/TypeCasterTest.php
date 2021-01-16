<?php

namespace ArtARTs36\WeatherArchive\Tests;

use ArtARTs36\WeatherArchive\Exceptions\TypeNotAvailableForCasting;
use ArtARTs36\WeatherArchive\Support\TypeCaster;
use PHPUnit\Framework\TestCase;

final class TypeCasterTest extends TestCase
{
    public function testCast(): void
    {
        $caster = new TypeCaster();

        // 1. String -> int

        $res = $caster->cast('123', TypeCaster::TYPE_INT);

        self::assertIsInt($res);
        self::assertEquals(123, $res);

        // 2. Int -> string

        $res = $caster->cast(123, TypeCaster::TYPE_STRING);

        self::assertIsString($res);
        self::assertEquals('123', $res);

        // 3. String -> float

        $res = $caster->cast('123', TypeCaster::TYPE_FLOAT);

        self::assertIsFloat($res);
        self::assertEquals(123.0, $res);

        // Not Available Type

        self::expectException(TypeNotAvailableForCasting::class);

        $res = $caster->cast('123', 'random_type');
    }
}
