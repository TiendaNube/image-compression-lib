<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use Spatie\ImageOptimizer\Optimizers\Optipng;
use Spatie\ImageOptimizer\Optimizers\Pngquant;

class PngOptimizer implements OptimizerHandlerInterface
{
    public static function create() : array
    {
        return [
            new Optipng(),
            new Pngquant(),
        ];
    }
}
