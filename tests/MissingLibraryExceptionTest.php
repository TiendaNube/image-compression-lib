<?php

declare(strict_types=1);

namespace ImageCompression;

use Exception;
use PHPUnit\Framework\TestCase;

class MissingLibraryExceptionTest extends TestCase
{
    public function testGeneratesMessage()
    {
        $library = 'cwebp';

        $missingLibraryException = new MissingLibraryException($library);

        $expectedMessage = 'Library cwebp is not available';

        $this->assertEquals($expectedMessage, $missingLibraryException->getMessage());
        $this->assertInstanceOf(Exception::class, $missingLibraryException);
    }
}
