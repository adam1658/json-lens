<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest\Fixtures;

use Adam1658\JsonLens\AbstractLens;

class Array_StringItemsLens extends AbstractLens implements \ArrayAccess
{
    protected $schema = 'http://example.com/array.json#/properties/stringItems';

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
        return $this->json[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->json[] = $value;
        } else {
            $this->json[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->json[$offset]);
    }
}
