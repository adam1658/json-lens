<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest\Fixtures;

use Adam1658\JsonLens\AbstractLens;

class UnionLens extends AbstractLens
{
    protected $schema = 'http://example.com/union.json';

    public static function buildNewValue()
    {
        return new \stdClass();
    }

    public function getEntities(): Union_EntitiesLens
    {
        return $this->jsonLensFactory->getLens(Union_EntitiesLens::class, $this->json->entities);
    }

    public function setEntities(Union_EntitiesLens $lens): void
    {
        $this->json->entities = $lens->json;
    }
}
