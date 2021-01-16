<?php

namespace ArtARTs36\WeatherArchive\Drivers\GisMeteo\Decoders\Html;

class DomNodeField
{
    public $name;

    public $type;

    public function __construct(string $name, string $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    public function prepareValue(\DOMNode $value): string
    {
        return $value->nodeValue;
    }
}
