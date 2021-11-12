<?php

declare(strict_types=1);

namespace ImageCompression;

use Mockery;
use PHPUnit\Framework\TestCase;

class WebpOptimizerTest extends TestCase
{
    /**
     * @dataProvider inputAndOutputImageProvider
     */
    public function testOptimizeImageWithValidData($pathToImage, $pathToOutput, $expectedPathToOutput)
    {
        $options = [
            'png' => [
                'encoding' => 'lossy',
                'near-lossless' => 100,
                'quality' => 95,
                'sharp-yuv' => true,
            ],
            'jpeg' => [
                'encoding' => 'lossy',
                'quality' => 95,
                'auto-limit' => true,
                'sharp-yuv' => true,
            ],
        ];

        $webpOptimizerMock = Mockery::mock('alias:WebPConvert\WebPConvert');
        $webpOptimizerMock
            ->shouldReceive('convert')
            ->with($pathToImage, $expectedPathToOutput, $options)
            ->once();

        $defaultImageOptimizer = new WebpOptimizer();
        $result = $defaultImageOptimizer->optimizeImage($pathToImage, $pathToOutput);

        $this->assertTrue($result);

        Mockery::close();
    }

    public function inputAndOutputImageProvider() : array
    {
        return [
            ['/tmp/my-directory/image.png', '/tmp/my-directory/image.webp', '/tmp/my-directory/image.webp'],
            ['/tmp/my-directory/image.png', '/tmp/my-directory/image.png', '/tmp/my-directory/image.webp'],
        ];
    }
}
