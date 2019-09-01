<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest;

class JsonLensUnionTest extends AbstractJsonLensTest
{
    private $json = <<<'JSON'
    {
        "entities": [
            { "type": "person", "firstName": "John", "lastName": "Doe" },
            { "type": "company", "name": "acme" }
        ]
    }
    JSON;

    public function testCorrectClassReturnedFromGetter()
    {
        $data = json_decode($this->json);
        $lens = $this->jsonLensFactory->getLens(Fixtures\UnionLens::class, $data);
        $lens->validate();

        $this->assertInstanceOf(Fixtures\Union_PersonLens::class, $lens->getEntities()[0]);
        $this->assertInstanceOf(Fixtures\Union_CompanyLens::class, $lens->getEntities()[1]);
    }

    public function testCanOverwriteWithDifferentSubclass()
    {
        $data = json_decode($this->json);
        $lens = $this->jsonLensFactory->getLens(Fixtures\UnionLens::class, $data);
        $lens->validate();

        $this->assertInstanceOf(Fixtures\Union_PersonLens::class, $lens->getEntities()[0]);

        $lens->getEntities()[0] = $this->jsonLensFactory->createLens(
            Fixtures\Union_CompanyLens::class,
            (object)['type' => 'company', 'name' => 'company-name']
        );

        $this->assertInstanceOf(Fixtures\Union_CompanyLens::class, $lens->getEntities()[0]);
        $this->assertEquals('company-name', $lens->getEntities()[0]->getName());
    }
}
