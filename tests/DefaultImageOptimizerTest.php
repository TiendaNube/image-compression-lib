<?php

declare(strict_types=1);

namespace ImageCompression;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;
use Spatie\ImageOptimizer\OptimizerChain;

class DefaultImageOptimizerTest extends TestCase
{
    use PHPMock;
    use MockeryPHPUnitIntegration;

    /**
     * @dataProvider inputAndOutputImageProvider
     */
    public function testOptimizeImageWithValidData($pathToImage, $pathToOutput, $convertInput, $convertOutput) : void
    {
        $optimizerChainMock = Mockery::mock(OptimizerChain::class);
        $optimizerChainMock->shouldReceive('optimize')
            ->once()
            ->with($pathToImage, $pathToOutput);

        $optimizerChainFactoryMock = Mockery::mock('alias:Spatie\ImageOptimizer\OptimizerChainFactory');
        $optimizerChainFactoryMock
            ->shouldReceive('create')
            ->once()
            ->andReturn($optimizerChainMock);

        $command = sprintf('convert %s -sampling-factor 4:2:0 -strip -quality 65 %s', $convertInput, $convertOutput);

        $exec = $this->getFunctionMock(__NAMESPACE__, 'shell_exec');
        $exec
            ->expects($this->once())
            ->with($command)
            ->willReturn('ok');

        $defaultImageOptimizer = new DefaultImageOptimizer();
        $result = $defaultImageOptimizer->optimizeImage($pathToImage, $pathToOutput);

        $this->assertTrue($result);
    }

    public function inputAndOutputImageProvider() : array
    {
        return [
            ['original/img.jpg', null, 'original/img.jpg', 'original/img.jpg'],
            ['original/img.jpg', 'optimized.jpg', 'original/img.jpg', 'optimized.jpg'],
        ];
    }
}
