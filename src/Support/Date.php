<?php

namespace ArtARTs36\WeatherArchive\Support;

class Date
{
    public static function oneDateGreaterTwoDateByMonthAndYear(\DateTimeInterface $one, \DateTimeInterface $two): bool
    {
        [$oneMonth, $twoMonth] = [(int) $one->format('m'), (int) $two->format('m')];
        [$oneYear, $twoYear] = [(int) $one->format('Y'), (int) $two->format('Y')];

        return $oneMonth > $twoMonth && $oneYear > $twoYear;
    }
}
