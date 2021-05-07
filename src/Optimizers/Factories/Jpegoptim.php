<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers\Factories;

use Spatie\ImageOptimizer\Optimizers\BaseOptimizer;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim as SpazieJpegoptim;

class Jpegoptim implements OptimizerFactoryInterface
{
    public static function create(array $options = []) : BaseOptimizer
    {
        return new SpazieJpegoptim($options);
    }
}
