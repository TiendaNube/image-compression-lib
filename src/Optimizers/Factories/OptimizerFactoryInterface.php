<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers\Factories;

use Spatie\ImageOptimizer\Optimizers\BaseOptimizer;

interface OptimizerFactoryInterface
{
    public static function create(array $options = []) : BaseOptimizer;
}
