<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use Spatie\ImageOptimizer\Optimizers\BaseOptimizer;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;

class JpgOptimizer implements OptimizerHandlerInterface
{
    public static $quality = 95;

    public static function getOptimizer() : BaseOptimizer
    {
        $options = static::getConfig();

        return new Jpegoptim($options);
    }

    private static function getConfig()
    {
        return [
            'quality' => static::$quality,
            '--strip-all',
            '--all-progressive',
        ];
    }
}
