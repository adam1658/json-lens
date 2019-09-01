<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest\Fixtures;

use Adam1658\JsonLens\AbstractLens;

class Array_ObjectItemsLens extends AbstractLens implements \ArrayAccess
{
    protected $schema = 'http://example.com/array.json#/properties/objectItems';

    public static function buildNewValue()
    {
        return [];
    }

    public function offsetExists($offset)
    {
        return isset($this->json[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->jsonLensFactory->getLens(Nested_NestedLens::class, $this->json[$offset]);
    }

    public function offsetSet($offset, $lens)
    {
        if ($offset === null) {
            $this->json[] = $lens->json;
        } else {
            $this->json[$offset] = $lens->json;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->json[$offset]);
    }
}
