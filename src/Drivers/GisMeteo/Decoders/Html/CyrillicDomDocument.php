<?php

namespace ArtARTs36\WeatherArchive\Drivers\GisMeteo\Decoders\Html;

class CyrillicDomDocument extends \DOMDocument
{
    public function loadHTML($source, $options = 0)
    {
        return @parent::loadHTML("\xEF\xBB\xBF". $source);
    }
}
