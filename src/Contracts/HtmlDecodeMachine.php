<?php

namespace ArtARTs36\WeatherArchive\Contracts;

use ArtARTs36\WeatherArchive\Support\Html\DomNodeField;

interface HtmlDecodeMachine
{
    public function prepareField(DomNodeField $field, \DOMNode $value);
}
