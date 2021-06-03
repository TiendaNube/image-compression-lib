<?php

declare(strict_types=1);

namespace ImageCompression;

use ImageCompression\Optimizers\OptimizerListService;
use Mockery;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;
use Spatie\ImageOptimizer\OptimizerChain;

class DefaultImageOptimizerTest extends TestCase
{
    use PHPMock;

    /**
     * @dataProvider inputAndOutputImageProvider
     */
    public function testOptimizeImageWithValidData($pathToImage, $pathToOutput, $expectedPathToOutput)
    {
        $optimizerChainMock = Mockery::mock(OptimizerChain::class);
        $optimizerChainMock->shouldReceive('optimize')
            ->once()
            ->with(
                $pathToImage,
                $expectedPathToOutput
            );

        $optimizerListService = Mockery::mock(OptimizerListService::class);
        $optimizerListService->shouldReceive('getOptimizerChain')
            ->once()
            ->andReturn($optimizerChainMock);

        $command = sprintf('convert %s -sampling-factor 4:2:0 -strip -quality 65 %s', $expectedPathToOutput, $expectedPathToOutput);

        $exec = $this->getFunctionMock(__NAMESPACE__, 'shell_exec');
        $exec->expects($this->once())
            ->with($command)
            ->willReturn('ok');

        $defaultImageOptimizer = new DefaultImageOptimizer($optimizerListService);
        $defaultImageOptimizer->optimizeImage($pathToImage, $pathToOutput);
        Mockery::close();
    }

    public function inputAndOutputImageProvider() : array
    {
        return [
            ['original/img.jpg', null, 'original/img.jpg'],
            ['original/img.jpg', 'optimized.jpg', 'optimized.jpg'],
        ];
    }
}
