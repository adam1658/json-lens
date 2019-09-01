<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest;

class JsonLensBasicTest extends AbstractJsonLensTest
{
    public function testBasicGetter()
    {
        $data = json_decode('{ "prop1": "test" }');
        $lens = $this->jsonLensFactory->getLens(Fixtures\BasicLens::class, $data);
        $lens->validate();

        $this->assertEquals('test', $lens->getProp1());
    }

    public function testBasicSetter()
    {
        $data = json_decode('{ "prop1": "test" }');
        $lens = $this->jsonLensFactory->getLens(Fixtures\BasicLens::class, $data);
        $lens->validate();

        $lens->setProp1('new-value');
        $lens->validate();

        $this->assertEquals('new-value', $data->prop1);
    }
}
