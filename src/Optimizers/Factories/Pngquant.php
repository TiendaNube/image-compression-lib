<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers\Factories;

use Spatie\ImageOptimizer\Optimizers\BaseOptimizer;
use Spatie\ImageOptimizer\Optimizers\Pngquant as SpatiePngquant;

class Pngquant implements OptimizerFactoryInterface
{
    public static function create(array $options = []) : BaseOptimizer
    {
        return new SpatiePngquant($options);
    }
}
