<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use PHPUnit\Framework\TestCase;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;

class JpgOptimizerTest extends TestCase
{
    public function testCreateReturnsOptimizer()
    {
        $optimizers = JpgOptimizer::create();

        $this->assertNotEmpty($optimizers);
        $this->assertInstanceOf(Jpegoptim::class, $optimizers[0]);

        $options = [
            '--max=95',
            '--strip-all',
            '--all-progressive',
        ];
        $this->assertSame($options, $optimizers[0]->options);
    }
}
