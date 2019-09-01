<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest\Fixtures;

use Adam1658\JsonLens\AbstractLens;

class Union_CompanyLens extends AbstractLens
{
    protected $schema = 'http://example.com/nested.json#/definitions/company';

    public static function buildNewValue()
    {
        return new \stdClass();
    }

    public function getName(): string
    {
        return $this->json->name;
    }

    public function setName(string $name): void
    {
        $this->json->name = $name;
    }
}
