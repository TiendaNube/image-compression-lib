<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use ImageCompression\Optimizers\Factories\Jpegoptim;
use ImageCompression\Optimizers\Factories\Optipng;
use ImageCompression\Optimizers\Factories\Pngquant;
use Mockery;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;
use Spatie\ImageOptimizer\OptimizerChain;

class OptimizerListServiceTest extends TestCase
{
    use PHPMock;

    /**
     * @runInSeparateProcess
     */
    public function testGetOptimizer()
    {

        $pngOptimizer = Mockery::mock('alias:'.PngOptimizer::class);
        $pngOptimizer->shouldReceive('setOptimizer')->once();

        $jpgOptimizer = Mockery::mock('alias:'.JpgOptimizer::class);
        $jpgOptimizer->shouldReceive('setOptimizer')->once();

        $this->assertInstanceOf(OptimizerChain::class, OptimizerListService::getOptimizerChain());
        Mockery::close();
    }
}
