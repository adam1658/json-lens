<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest\Fixtures;

use Adam1658\JsonLens\AbstractLens;
use Adam1658\JsonLens\JsonLensFactory;
use Opis\JsonSchema\IValidator;

abstract class Union_EntityLens extends AbstractLens
{
    protected $schema = 'http://example.com/nested.json#/definitions/entity';

    public static function build(JsonLensFactory $jsonLensFactory, IValidator $validator, &$json): AbstractLens
    {
        if ($json === null) {
            throw new \Exception('Cannot build abstract Union_EntityLens');
        }

        switch ($json->type) {
            case 'person':
                return $jsonLensFactory->getLens(Union_PersonLens::class, $json);
            case 'company':
                return $jsonLensFactory->getLens(Union_CompanyLens::class, $json);
        }
    }
}
