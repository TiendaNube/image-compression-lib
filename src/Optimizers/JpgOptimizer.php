<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use ImageCompression\Optimizers\Factories\Jpegoptim;
use Spatie\ImageOptimizer\OptimizerChain;

class JpgOptimizer implements OptimizerHandlerInterface
{
    public static $quality = 95;

    const JPEGOPTIM_PROGRESSIVE = '--all-progressive';
    const JPEGOPTIM_STRIP = '--strip-all';
    const JPEGOPTIM_QUALITY = '--max=%s';

    public static function addOptimizerTo(OptimizerChain &$optimizerChain)
    {
        $options = self::getConfig();

        $jpegOptim = Jpegoptim::create($options);

        $optimizerChain->addOptimizer($jpegOptim);
    }

    private static function getConfig() : array
    {
        return [
            self::getBinaryQuality(self::$quality),
            self::JPEGOPTIM_STRIP,
            self::JPEGOPTIM_PROGRESSIVE,
        ];
    }

    private static function getBinaryQuality(int $quality)
    {
        return sprintf(self::JPEGOPTIM_QUALITY, $quality);
    }
}
