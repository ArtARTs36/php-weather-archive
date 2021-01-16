<?php

namespace ArtARTs36\WeatherArchive\Contracts;

interface GisMeteoContentDecoder
{
    public function decode(string $content): array;
}
