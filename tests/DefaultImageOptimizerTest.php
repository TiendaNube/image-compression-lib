<?php

declare(strict_types=1);

namespace ImageCompression;

use Mockery;
use phpmock\mockery\PHPMockery;
use PHPUnit\Framework\TestCase;
use Spatie\ImageOptimizer\OptimizerChain;

class DefaultImageOptimizerTest extends TestCase
{
    private $defaultImageOptimizer;

    public function setUp()
    {
        $this->defaultImageOptimizer = new DefaultImageOptimizer();
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @doesNotPerformAssertions
     * @dataProvider optimizeImageProvider
     */
    public function testOptimizeImage($pathToImage, $pathToOutput, $expectedPathToOutput)
    {
        $optimizerChainMock = Mockery::mock(OptimizerChain::class);
        $optimizerChainFactoryMock = Mockery::mock('alias:Spatie\ImageOptimizer\OptimizerChainFactory');
        $optimizerChainFactoryMock->shouldReceive('create')->once()->andReturn($optimizerChainMock);

        $optimizerChainMock->shouldReceive('optimize')->once()->with($pathToImage, $expectedPathToOutput);

        $command = sprintf('%s -sampling-factor 4:2:0 -strip -quality 65 %s', $pathToImage, $expectedPathToOutput);

        PHPMockery::mock(__NAMESPACE__, "shell_exec")->once()->with($command)->andReturn('ok');

        $this->defaultImageOptimizer->optimizeImage($pathToImage, $pathToOutput);
    }

    public function optimizeImageProvider()
    {
        return [
            ['original/img.jpg', 'optimized.jpg', 'optimized.jpg'],
            ['original/img.jpg', null, 'original/img.jpg'],
        ];
    }
}
