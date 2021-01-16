<?php

namespace ArtARTs36\WeatherArchive\Contracts;

interface UrlCreator
{
    public function create(\DateTimeInterface $date, Place $place): string;
}
