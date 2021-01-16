<?php

namespace ArtARTs36\WeatherArchive\Drivers\GisMeteo\Decoders\Html;

use ArtARTs36\WeatherArchive\Contracts\GisMeteoContentDecoder;
use ArtARTs36\WeatherArchive\Contracts\TypeCasterInterface;
use ArtARTs36\WeatherArchive\Support\Html\DomNodeField;

class HtmlDecoder implements GisMeteoContentDecoder
{
    protected $columnsMap = [];

    protected $machine;

    protected $domDocument;

    public function __construct(DecodeMachine $machine, CyrillicDomDocument $domDocument)
    {
        $this->columnsMap = $this->createColumnsMap();
        $this->machine = $machine;
        $this->domDocument = $domDocument;
    }

    public function decode(string $content): array
    {
        $this->domDocument->loadHTML($content);

        $data = $this->domDocument->getElementById('data_block');
        $values = [];

        /** @var \DOMElement $row */
        foreach ($data->getElementsByTagName('tr') as $weatherId => $row) {
            /** @var \DOMDocument[]|null|\DOMNodeList $fields */
            $fields = $row->getElementsByTagName('td');

            if ($fields->length === 0) {
                continue;
            }

            foreach ($fields as $pos => $column) {
                if (isset($this->columnsMap[$pos])) {
                    $values[$weatherId][$this->columnsMap[$pos]->name] = $this->machine->prepareField(
                        $this->columnsMap[$pos],
                        $column
                    );
                }
            }
        }

        return $values;
    }

    protected function createColumnsMap(): array
    {
        return [
            0 => new DomNodeField('day', TypeCasterInterface::TYPE_INT),
            1 => new DomNodeField('temperature', TypeCasterInterface::TYPE_INT),
            2 => new DomNodeField('pressure', TypeCasterInterface::TYPE_INT),
            3 => new CloudyDomNodeField('cloudy', TypeCasterInterface::TYPE_FLOAT),
            4 => null,
            5 => new DomNodeField('wind', TypeCasterInterface::TYPE_STRING),
        ];
    }
}
