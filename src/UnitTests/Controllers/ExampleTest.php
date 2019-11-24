<?php
namespace Ap\UnitTests\Controllers;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test()
    {
        $stack = [];
        $this->assertEquals(0, count($stack));
    }
}