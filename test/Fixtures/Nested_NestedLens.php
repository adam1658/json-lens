<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest\Fixtures;

use Adam1658\JsonLens\AbstractLens;

class Nested_NestedLens extends AbstractLens
{
    protected $schema = 'http://example.com/nested.json#/definitions/nested';

    public static function buildNewValue()
    {
        return new \stdClass();
    }

    public function getProp3(): string
    {
        return $this->json->prop3;
    }

    public function setProp3(string $prop3): void
    {
        $this->json->prop3 = $prop3;
    }
}
