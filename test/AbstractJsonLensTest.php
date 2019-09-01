<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest;

use Adam1658\JsonLens\JsonLensFactory;
use Opis\JsonSchema;
use PHPUnit\Framework\TestCase;

abstract class AbstractJsonLensTest extends TestCase
{
    /** @var JsonLensFactory $jsonLensFactory */
    protected $jsonLensFactory;

    public function setUp(): void
    {
        $loader = new JsonSchema\Loaders\File(
            'http://example.com/',
            [__DIR__ . '/Fixtures/']
        );

        $validator = new JsonSchema\Validator(null, $loader);

        $this->jsonLensFactory = new JsonLensFactory($validator);
    }
}
