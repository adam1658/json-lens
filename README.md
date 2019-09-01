# JsonLens

This library allows you to write 'JSON lens' classes that represent a `json_decode`d value and allow typesafe access to it (assuming the value conforms to a JSON Schema). Usually you retain control of the json value, and the lens can read and mutate it.

## Usage
1. extend `AbstractLens`:
    ```php
    class YourLens extends AbstractLens
    {
        // What JSON-schema does this correspond with?
        protected $schema = 'http://example.com/your-json-schema.json';

        // When building a new json object, what should the empty value be?
        public static function buildNewValue()
        {
            return new \stdClass();
        }

        // Add typed getters and setters which access the underlying json value
        public function getProp1(): string
        {
            return $this->json->prop1;
        }

        public function setProp1(string $prop1): void
        {
            $this->json->prop1 = $prop1;
        }
    }
    ```

2. Get an instance, using the `JsonLensFactory`:
    ```php
    $jsonLensFactory = new JsonLensFactory($yourValidator);

    $json = json_decode('{"prop1": "a string"}');
    $yourLens = $jsonLensFactory->getLens();

    echo $yourLens->getProp1();
    // 'a string'

    $yourLens->setProp1('the original value is mutated')
    echo $json->prop1;
    // 'the original value is mutated'

    $result = $yourLens->validate();
    // Returns ValidationResult
    ```

## Unions (JSON Schema 'anyof')

A union of JSON schema types can often be mapped to one of a set of Lens classes. A discriminator property is often useful for this. See [JsonLensUnionTest](./test/JsonLensUnionTest.php) and the associated lenses that extend from [UnionLens](./test/Fixtures/UnionLens.php)

## Docker development environment
This project uses docker for it's development environment. Build the docker image as follows:
```bash
docker build -t json-lens:dev .
```

Then start a container for development as follows:
```bash
docker run -it --rm -v $(pwd):/json-lens json-lens:dev bash
```

## QA Tools
squizlabs/php_codesniffer is used to check source code formatting.

Codesniffer check:
```bash
$ composer cs-check
```

Codesniffer fix:
```bash
$ composer cs-fix
```
