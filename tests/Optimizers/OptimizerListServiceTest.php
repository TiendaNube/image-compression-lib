<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

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
        $pngOptimizer->shouldReceive('addOptimizerTo')->once();

        $jpgOptimizer = Mockery::mock('alias:'.JpgOptimizer::class);
        $jpgOptimizer->shouldReceive('addOptimizerTo')->once();

        $optimizerListService = new OptimizerListService();

        $this->assertInstanceOf(OptimizerChain::class, $optimizerListService->getOptimizerChain());
        Mockery::close();
    }
}
