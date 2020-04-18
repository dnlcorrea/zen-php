<?php

use PHPUnit\Framework\TestCase;

use Zen\Zen;

class ZenTest extends TestCase {

    // -, + Public, Private
    // ; function
    public $input = "zen-name-email+;add";

    public $output = <<<'EOF'
class Zen {

private $name;
private $email;

public function add() { }
}
EOF;

    /** @test */
    public function parses_and_outputs_string()
    {
        $this->expectOutputString($this->output);

        $zen = new Zen($this->input);

        $zen->print();
    }

    /** @test */
    public function parses_properties()
    {
        $zen = new Zen('zen+name-email');

        $this->assertEquals(
            ['name' => 'public $name;', 'email' => 'private $email;'],
            $zen->getProperties()
        );
    }

    /** @test */
    public function parses_methods()
    {
        $zen = new Zen('zen+;setName-;parse');

        $this->assertEquals(
            ['setName' => "public function setName() { }", 'parse' => "private function parse() { }"
],
            $zen->getMethods()
        );
    }


    /** @test */
    public function parse_class_name()
    {
        $zen = new Zen('zen+;setName-;parse');

        $this->assertEquals("Zen", $zen->getClassName());
    }


}
