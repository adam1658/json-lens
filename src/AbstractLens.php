<?php
declare(strict_types=1);

namespace Adam1658\JsonLens;

use Opis\JsonSchema\IValidator;

abstract class AbstractLens
{
    /** @var string $schema */
    protected $schema;

    /** @var JsonLensFactory $jsonLensFactory */
    protected $jsonLensFactory;

    /** @var IValidator $validator */
    protected $validator;

    public $json;

    public function __construct(JsonLensFactory $jsonLensFactory, IValidator $validator, &$json)
    {
        $this->jsonLensFactory = $jsonLensFactory;
        $this->validator = $validator;
        $this->json =& $json;
    }

    public static function build(JsonLensFactory $jsonLensFactory, IValidator $validator, &$json): AbstractLens
    {
        return new static($jsonLensFactory, $validator, $json);
    }

    abstract public static function buildNewValue();

    public function validate()
    {
        return $this->validator->uriValidation($this->json, $this->schema);
    }
}
