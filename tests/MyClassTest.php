<?php

declare(strict_types=1);

namespace ImageCompression;

use PHPUnit\Framework\TestCase;

class MyClassTest extends TestCase
{
    public function testReturnAnStringWhenTheObjectIsUsedAsFunction()
    {
        $testInstance = new MyClass();
        $this->assertEquals('MyClass', $testInstance());
    }
}
