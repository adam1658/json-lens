<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest\Fixtures;

use Adam1658\JsonLens\AbstractLens;

class BasicLens extends AbstractLens
{
    protected $schema = 'http://example.com/basic.json';

    public static function buildNewValue()
    {
        return new \stdClass();
    }

    public function getProp1(): string
    {
        return $this->json->prop1;
    }

    public function setProp1(string $prop1): void
    {
        $this->json->prop1 = $prop1;
    }
}
