<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use Spatie\ImageOptimizer\Optimizers\Jpegoptim;

class JpgOptimizer implements OptimizerHandlerInterface
{
    private $quality = 95;

    const JPEGOPTIM_PROGRESSIVE = '--all-progressive';
    const JPEGOPTIM_STRIP = '--strip-all';
    const JPEGOPTIM_QUALITY = '--max=%s';

    private function getConfig() : array
    {
        return [
            $this->getBinaryQuality($this->quality),
            self::JPEGOPTIM_STRIP,
            self::JPEGOPTIM_PROGRESSIVE,
        ];
    }

    private function getBinaryQuality(int $quality)
    {
        return sprintf(self::JPEGOPTIM_QUALITY, $quality);
    }

    public static function create() : array
    {
        $options = (new JpgOptimizer())->getConfig();

        return [new Jpegoptim($options)];
    }
}
