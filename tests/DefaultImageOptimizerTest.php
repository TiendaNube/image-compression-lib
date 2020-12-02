<?php

declare(strict_types=1);

namespace ImageCompression;

use Mockery;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;
use Spatie\ImageOptimizer\OptimizerChain;

class DefaultImageOptimizerTest extends TestCase
{
    use PHPMock;

    private $defaultImageOptimizer;

    public function setUp()
    {
        $this->defaultImageOptimizer = new DefaultImageOptimizer();
    }

    /**
     * @dataProvider inputAndOutputImageProvider
     */
    public function testOptimizeImageWithInputAndOutput($pathToImage, $pathToOutput, $expectedPathToOutput)
    {
        $optimizerChainMock = Mockery::mock(OptimizerChain::class);
        $optimizerChainMock->shouldReceive('optimize')
            ->once()
            ->with(
                $pathToImage,
                $pathToOutput
            );

        $optimizerChainFactoryMock = Mockery::mock('alias:Spatie\ImageOptimizer\OptimizerChainFactory');
        $optimizerChainFactoryMock
            ->shouldReceive('create')
            ->once()
            ->andReturn($optimizerChainMock);

        $command = sprintf('%s -sampling-factor 4:2:0 -strip -quality 65 %s', $pathToImage, $expectedPathToOutput);

        $exec = $this->getFunctionMock(__NAMESPACE__, 'shell_exec');
        $exec
            ->expects($this->once())
            ->with($command)
            ->willReturn('ok');

        $this->defaultImageOptimizer->optimizeImage($pathToImage, $pathToOutput);
    }

    public function inputAndOutputImageProvider() : array
    {
        return [
            ['original/img.jpg', 'optimized.jpg', 'optimized.jpg'],
            //     ['original/img.jpg', null, 'optimized.jpg'],
        ];
    }
}
