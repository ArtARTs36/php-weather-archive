<?php

namespace ArtARTs36\WeatherArchive\Drivers\GisMeteo\Decoders\Html;

class CloudyDomNodeField extends DomNodeField
{
    protected $imgValueMap = [
        'sunc' => '25',
        'suncl' => '50',
        'dull' => '100',
        'sun' => '0',
    ];

    public function prepareValue(\DOMNode $value): string
    {
        $img = $value->firstChild->attributes->item(0)->textContent;

        return $this->imgValueMap[pathinfo($img, PATHINFO_FILENAME)];
    }
}
