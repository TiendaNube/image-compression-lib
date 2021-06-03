<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use Mockery;
use PHPUnit\Framework\TestCase;
use Spatie\ImageOptimizer\Optimizers\BaseOptimizer;

class OptimizerListServiceTest extends TestCase
{
    public function testDefaultHasEmptyOptimizers()
    {
        $optimizerListService = new OptimizerListService();

        $optimizerChain = $optimizerListService->getOptimizerChain();

        $this->assertEmpty($optimizerChain->getOptimizers());
    }

    public function testSetsOptimizersToChain()
    {
        $optimizerMock = Mockery::mock(BaseOptimizer::class);

        $optimizerListService = new OptimizerListService();
        $optimizerListService->addOptimizers([$optimizerMock]);

        $optimizerChain = $optimizerListService->getOptimizerChain();

        $this->assertNotEmpty($optimizerChain->getOptimizers());
        $this->assertSame([$optimizerMock], $optimizerChain->getOptimizers());
    }

    public function testAddsAllOptimizers()
    {
        $optimizerMockOne = Mockery::mock(BaseOptimizer::class);
        $optimizerMockOne->options = ['--some-flag'];

        $optimizerMockTwo = Mockery::mock(BaseOptimizer::class);
        $optimizerMockTwo->options = ['--another-flag'];

        $optimizerListService = new OptimizerListService();
        $optimizerListService->addOptimizers([$optimizerMockOne]);
        $optimizerListService->addOptimizers([$optimizerMockTwo]);

        $optimizerChain = $optimizerListService->getOptimizerChain();

        $optimizers = $optimizerChain->getOptimizers();

        $this->assertNotEmpty($optimizers);
        $this->assertEquals([$optimizerMockOne, $optimizerMockTwo], $optimizers);
        $this->assertContains('--some-flag', $optimizers[0]->options);
        $this->assertContains('--another-flag', $optimizers[1]->options);
    }
}
