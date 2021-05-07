<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use ImageCompression\Optimizers\Factories\Optipng;
use ImageCompression\Optimizers\Factories\Pngquant;
use Mockery;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;
use Spatie\ImageOptimizer\OptimizerChain;

class PngOptimizerTest extends TestCase
{
    use PHPMock;
    /**
     * @runInSeparateProcess
     */
    public function testSetOptimizer()
    {
        $pngQuant = new \Spatie\ImageOptimizer\Optimizers\Pngquant();

        $pngQuantFactory = Mockery::mock('alias:'.Pngquant::class);
        $pngQuantFactory->shouldReceive('create')
            ->once()
            ->andReturn($pngQuant);

        $optiPng = new \Spatie\ImageOptimizer\Optimizers\Optipng();

        $optipngFactory = Mockery::mock('alias:'.Optipng::class);
        $optipngFactory->shouldReceive('create')
            ->once()
            ->andReturn($optiPng);

        $optimizerChainMock = Mockery::mock(OptimizerChain::class);

        $optimizerChainMock->shouldReceive('addOptimizer')
            ->with($pngQuant)
            ->once();

        $optimizerChainMock->shouldReceive('addOptimizer')
            ->with($optiPng)
            ->once();

        PngOptimizer::setOptimizer($optimizerChainMock);

        $this->assertTrue(true);
        Mockery::close();
    }
}
