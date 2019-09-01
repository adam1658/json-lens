<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest\Fixtures;

use Adam1658\JsonLens\AbstractLens;

class NestedLens extends AbstractLens
{
    protected $schema = 'http://example.com/nested.json';

    public static function buildNewValue()
    {
        return new \stdClass();
    }

    public function getProp2(): Nested_NestedLens
    {
        return $this->jsonLensFactory->getLens(Nested_NestedLens::class, $this->json->prop2);
    }

    public function setProp2(Nested_NestedLens $prop2Lens): void
    {
        $this->json->prop2 = $prop2Lens->json;
    }
}
