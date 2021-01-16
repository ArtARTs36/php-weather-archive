<?php

namespace ArtARTs36\WeatherArchive\Drivers\WorldWeather\Decoders\Html;

use ArtARTs36\WeatherArchive\Contracts\HtmlDecodeMachine;
use ArtARTs36\WeatherArchive\Contracts\TypeCasterInterface;
use ArtARTs36\WeatherArchive\Support\Html\CyrillicDomDocument;
use ArtARTs36\WeatherArchive\Support\Html\DomNodeField;

class HtmlDecoder
{
    protected $domDocument;

    protected $columnsMap;

    protected $decodeMachine;

    public function __construct(HtmlDecodeMachine $machine, CyrillicDomDocument $domDocument)
    {
        $this->decodeMachine = $machine;
        $this->domDocument = $domDocument;
        $this->columnsMap = $this->createColumnsMap();
    }

    public function decode(string $response)
    {
        $this->domDocument->loadHTML($response);

        /** @var \DOMNodeList|\DOMDocument[] $rows */
        $rows = $this
            ->domDocument
            ->getElementsByTagName('ul')
            ->item(3)
            ->getElementsByTagName('li');

        $values = [];

        foreach ($rows as $rowId => $row) {
            if (empty($row->nodeValue)) {
                continue;
            }

            /**
             * @var \DOMElement $child
             */
            foreach ($row->childNodes as $childId => $child) {
                if (! isset($this->columnsMap[$childId])) {
                    continue;
                }

                $values[$rowId][$this->columnsMap[$childId]->name] = $this->decodeMachine->prepareField(
                    $this->columnsMap[$childId],
                    $child
                );
            }
        }

        return $values;
    }

    protected function createColumnsMap(): array
    {
        return [
            0 => new DomNodeField('day', TypeCasterInterface::TYPE_INT),
            1 => null,
            2 => new DomNodeField('temperature', TypeCasterInterface::TYPE_INT),
        ];
    }
}
