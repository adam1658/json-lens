<?php
declare(strict_types=1);

namespace Adam1658\JsonLensTest;

class JsonLensArrayTest extends AbstractJsonLensTest
{
    private $json = <<<'JSON'
    {
        "stringItems": ["5", "hello"],
        "objectItems": [
            { "prop3": "test0" }
        ]
    }
    JSON;

    // Array of strings ************************************************************************************************
    public function testArrayStringGetter()
    {
        $data = json_decode($this->json);
        $lens = $this->jsonLensFactory->getLens(Fixtures\ArrayLens::class, $data);
        $lens->validate();

        $this->assertEquals('5', $lens->getStringItems()[0]);
    }

    public function testArrayStringSetter()
    {
        $data = json_decode($this->json);
        $lens = $this->jsonLensFactory->getLens(Fixtures\ArrayLens::class, $data);
        $lens->validate();

        $lens->getStringItems()[] = 'new value';
        $lens->validate();

        $this->assertEquals('new value', $data->stringItems[2]);
    }

    public function testArrayStringOverwrite()
    {
        $data = json_decode($this->json);
        $lens = $this->jsonLensFactory->getLens(Fixtures\ArrayLens::class, $data);
        $lens->validate();

        $newItems = $this->jsonLensFactory->createLens(Fixtures\Array_StringItemsLens::class);
        $newItems[] = 'test1';
        $newItems[] = 'test2';

        $lens->setStringItems($newItems);
        $lens->validate();

        $this->assertEquals('test2', $data->stringItems[1]);
    }

    // Array of objects ************************************************************************************************
    public function testArrayObjectGetter()
    {
        $data = json_decode($this->json);
        $lens = $this->jsonLensFactory->getLens(Fixtures\ArrayLens::class, $data);
        $lens->validate();

        $this->assertEquals('test0', $lens->getObjectItems()[0]->getProp3());
    }

    public function testArrayObjectSetter()
    {
        $data = json_decode($this->json);
        $lens = $this->jsonLensFactory->getLens(Fixtures\ArrayLens::class, $data);
        $lens->validate();

        $newObject = $this->jsonLensFactory->createLens(
            Fixtures\Nested_NestedLens::class,
            (object)['prop3' => 'new value']
        );

        $lens->getObjectItems()[] = $newObject;
        $lens->validate();

        $this->assertEquals('new value', $data->objectItems[1]->prop3);
    }

    public function testArrayObjectOverwrite()
    {
        $data = json_decode($this->json);
        $lens = $this->jsonLensFactory->getLens(Fixtures\ArrayLens::class, $data);
        $lens->validate();

        
        $newItems = $this->jsonLensFactory->createLens(Fixtures\Array_ObjectItemsLens::class);
        $newItems[0] = $this->jsonLensFactory->createLens(
            Fixtures\Nested_NestedLens::class,
            (object)['prop3' => 'newItem']
        );

        $lens->setObjectItems($newItems);
        $lens->validate();

        $this->assertEquals('newItem', $data->objectItems[0]->prop3);
    }
}
