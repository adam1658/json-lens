<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest\Fixtures;

use Adam1658\JsonLens\AbstractLens;

class Union_PersonLens extends AbstractLens
{
    protected $schema = 'http://example.com/nested.json#/definitions/person';

    public static function buildNewValue()
    {
        return new \stdClass();
    }

    public function getFirstName(): string
    {
        return $this->json->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->json->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->json->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->json->lastName = $lastName;
    }
}
