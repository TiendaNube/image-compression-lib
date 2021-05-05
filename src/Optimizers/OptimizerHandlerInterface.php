<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use Spatie\ImageOptimizer\Optimizers\BaseOptimizer;

interface OptimizerHandlerInterface
{
    public static function getOptimizer() : BaseOptimizer;
}
