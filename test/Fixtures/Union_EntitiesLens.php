<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest\Fixtures;

use Adam1658\JsonLens\AbstractLens;

class Union_EntitiesLens extends AbstractLens implements \ArrayAccess
{
    protected $schema = 'http://example.com/array.json#/properties/entities';

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
        return $this->jsonLensFactory->getLens(Union_EntityLens::class, $this->json[$offset]);
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
