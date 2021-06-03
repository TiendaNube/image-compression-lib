<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use PHPUnit\Framework\TestCase;
use Spatie\ImageOptimizer\Optimizers\BaseOptimizer;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;
use Spatie\ImageOptimizer\Optimizers\Optipng;
use Spatie\ImageOptimizer\Optimizers\Pngquant;

class DefaultOptimizerListTest extends TestCase
{
    public function testChainHasDefaultValues()
    {
        $optimizerListService = DefaultOptimizerList::create();

        $optimizerChain = $optimizerListService->getOptimizerChain();
        $optimizers = $optimizerChain->getOptimizers();

        $this->assertCount(3, $optimizers);
        $this->assertContainsOnlyInstancesOf(BaseOptimizer::class, $optimizers);
        $this->assertInstanceOf(Jpegoptim::class, $optimizers[0]);
        $this->assertInstanceOf(Optipng::class, $optimizers[1]);
        $this->assertInstanceOf(Pngquant::class, $optimizers[2]);
    }
}
