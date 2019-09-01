<?php
declare(strict_types=1);

namespace Adam1658\JsonLens;

use Opis\JsonSchema\IValidator;

class JsonLensFactory
{
    /** @var IValidator $validator */
    private $validator;

    public function __construct(IValidator $validator)
    {
        $this->validator = $validator;
    }

    // Get lens for given data
    public function getLens(string $lensClass, &$json)
    {
        return $lensClass::build($this, $this->validator, $json);
    }

    // Create empty lens for new data
    public function createLens(string $lensClass, $json = null)
    {
        $data = $json ?? $lensClass::buildNewValue();
        return $lensClass::build($this, $this->validator, $data);
    }
}
