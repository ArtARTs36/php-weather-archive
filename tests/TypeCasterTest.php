<?php

namespace ArtARTs36\WeatherArchive\Tests;

use ArtARTs36\WeatherArchive\Drivers\GisMeteo\Decoders\Html\TypeCaster;
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
    }
}
