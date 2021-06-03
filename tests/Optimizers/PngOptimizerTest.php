<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use PHPUnit\Framework\TestCase;
use Spatie\ImageOptimizer\Optimizers\Optipng;
use Spatie\ImageOptimizer\Optimizers\Pngquant;

class PngOptimizerTest extends TestCase
{
    public function testCreateReturnsOptimizer()
    {
        $optimizers = PngOptimizer::create();

        $this->assertNotEmpty($optimizers);
        $this->assertCount(2, $optimizers);
        $this->assertInstanceOf(Optipng::class, $optimizers[0]);
        $this->assertInstanceOf(Pngquant::class, $optimizers[1]);
    }
}
