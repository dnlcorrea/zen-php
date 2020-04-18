<?php

namespace Zen;

class Zen
{

    private const PROPERTY = "%s $%s;";
    private const METHOD = "%s function %s() { }";

    private $input;

    private $properties;

    private $methods;

    private $className;

    public function __construct(string $input) {
        $this->input = $input;

        $this->fire();
    }

    private function parse($regex, $num, $format, $field) {

        preg_match_all($regex, $this->input, $matches);

        foreach ($matches[0] as $match) {
            $visibility = substr($match, 0, 1) === '-' ? 'private' : 'public';

            $name = substr($match,$num);

            $this->$field[$name] = sprintf(
                $format,
                $visibility,
                $name
            );
        }
    }


    public function getClassName():string {
        return $this->className;
    }

    public function setClassName():void {
        preg_match("/^\w+/", $this->input, $matches);

        $this->className = ucfirst($matches[0]);
    }


    public function getProperties() {
        return $this->properties;
    }

    public function setProperties() {
        $this->parse("/[-+]\w+/", 1, self::PROPERTY, 'properties');
    }


    public function getMethods ()
    {
        return $this->methods;
    }

    public function setMethods()
    {
        $this->parse("/[-+];\w+/", 2, self::METHOD, "methods");
    }

    public function fire() {
        $this->setClassName();
        $this->setMethods();
        $this->setProperties();
    }

    public function print()
    {
        echo "class {$this->getClassName()} {\n\n";

        echo implode("\n", $this->getProperties()) . "\n";

        echo "\n";

        echo implode("\n", $this->getMethods()) . "\n";

        echo "}";
    }
}
