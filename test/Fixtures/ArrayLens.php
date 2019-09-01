<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest\Fixtures;

use Adam1658\JsonLens\AbstractLens;

class ArrayLens extends AbstractLens
{
    protected $schema = 'http://example.com/array.json';

    public static function buildNewValue()
    {
        return new \stdClass();
    }

    public function getStringItems(): Array_StringItemsLens
    {
        return $this->jsonLensFactory->getLens(Array_StringItemsLens::class, $this->json->stringItems);
    }

    public function setStringItems(Array_StringItemsLens $lens): void
    {
        $this->json->stringItems = $lens->json;
    }

    public function getObjectItems(): Array_ObjectItemsLens
    {
        return $this->jsonLensFactory->getLens(Array_ObjectItemsLens::class, $this->json->objectItems);
    }

    public function setObjectItems(Array_ObjectItemsLens $lens): void
    {
        $this->json->objectItems = $lens->json;
    }
}
