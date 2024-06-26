<?php

declare(strict_types=1);

namespace ImageCompression;

use Mockery;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;

class WebpOptimizerTest extends TestCase
{
    use PHPMock;

    /**
     * @dataProvider inputAndOutputImageProvider
     */
    public function testOptimizeImageWithValidData($pathToImage, $pathToOutput, $expectedPathToOutput): void
    {
        $options = [
            'converters' => [
                'cwebp',
            ],
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
            ['/tmp/my-directory/image.png', null, '/tmp/my-directory/image.webp'],
        ];
    }

    public function testVerifiesLibraryInstallation(): void
    {
        $this->expectException(MissingLibraryException::class);

        $exec = $this->getFunctionMock(__NAMESPACE__, 'shell_exec');
        $exec->expects($this->once())
            ->with('which \'cwebp\'')
            ->willReturn('');

        new WebpOptimizer();

        Mockery::close();
    }
}
