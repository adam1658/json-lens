<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest;

class JsonLensNestedTest extends AbstractJsonLensTest
{
    public function testNestedGetter()
    {
        $data = json_decode('{ "prop1": 5, "prop2": { "prop3": "test" } }');
        $lens = $this->jsonLensFactory->getLens(Fixtures\NestedLens::class, $data);
        $lens->validate();

        $this->assertEquals('test', $lens->getProp2()->getProp3());
    }

    public function testNestedSetter()
    {
        $data = json_decode('{ "prop1": 5, "prop2": { "prop3": "test" } }');
        $lens = $this->jsonLensFactory->getLens(Fixtures\NestedLens::class, $data);
        $lens->validate();

        $lens->getProp2()->setProp3('new-value');
        $lens->validate();

        $this->assertEquals('new-value', $data->prop2->prop3);
    }

    public function testNestedOverwrite()
    {
        $data = json_decode('{ "prop1": 5, "prop2": { "prop3": "test" } }');
        $lens = $this->jsonLensFactory->getLens(Fixtures\NestedLens::class, $data);
        $lens->validate();

        $newNestedLens = $this->jsonLensFactory->createLens(
            Fixtures\Nested_NestedLens::class,
            (object)['prop3' => 'new-value']
        );
        $newNestedLens->validate();

        $lens->setProp2($newNestedLens);
        $lens->validate();

        $this->assertEquals('new-value', $data->prop2->prop3);
    }
}
