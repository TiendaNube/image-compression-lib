<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use Spatie\ImageOptimizer\Optimizers\BaseOptimizer;
use Spatie\ImageOptimizer\Optimizers\Optipng;

class PngOptimizer implements OptimizerHandlerInterface
{
    public static function getOptimizer() : BaseOptimizer
    {
        $options = static::getConfig();

        return new Optipng($options);
    }

    private static function getConfig()
    {
        return [
        ];
    }
}
