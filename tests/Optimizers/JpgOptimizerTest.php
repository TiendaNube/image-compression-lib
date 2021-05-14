<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use ImageCompression\Optimizers\Factories\Jpegoptim;
use Mockery;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;
use Spatie\ImageOptimizer\OptimizerChain;

class JpgOptimizerTest extends TestCase
{
    use PHPMock;

    /**
     * @dataProvider providerQuality
     * @runInSeparateProcess
     */
    public function testSetOptimizer($quality)
    {
        if ($quality !== null) {
            JpgOptimizer::$quality = $quality;
        }

        $options = [
            '--max='.JpgOptimizer::$quality,
            '--strip-all',
            '--all-progressive',
        ];

        $jpegOptim = new \Spatie\ImageOptimizer\Optimizers\Jpegoptim($options);

        $jpegOptimFactory = Mockery::mock('alias:'.Jpegoptim::class);
        $jpegOptimFactory->shouldReceive('create')
            ->with($options)
            ->once()
            ->andReturn($jpegOptim);

        $optimizerChainMock = Mockery::mock(OptimizerChain::class);
        $optimizerChainMock->shouldReceive('addOptimizer')
            ->with($jpegOptim)
            ->once();

        JpgOptimizer::addOptimizerTo($optimizerChainMock);

        $this->assertTrue(true);
        Mockery::close();
    }

    public function providerQuality()
    {
        return [
            [5],
            [null],
            [80],
        ];
    }

    /**
     * @runInSeparateProcess
     */
    public function testQualityHasDefault()
    {
        $this->assertNotNull(JpgOptimizer::$quality);
        $this->assertEquals(95, JpgOptimizer::$quality);
        Mockery::close();
    }
}
