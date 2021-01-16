<?php

namespace ArtARTs36\WeatherArchive\Support\Html;

use ArtARTs36\WeatherArchive\Contracts\TypeCasterInterface;

class DecodeMachine
{
    protected $typeCaster;

    public function __construct(TypeCasterInterface $typeCaster)
    {
        $this->typeCaster = $typeCaster;
    }

    public function prepareField(DomNodeField $field, \DOMNode $value)
    {
        return $this->typeCaster->cast($field->prepareValue($value), $field->type);
    }
}
