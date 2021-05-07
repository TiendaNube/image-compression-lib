<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use Spatie\ImageOptimizer\OptimizerChain;

interface OptimizerHandlerInterface
{
    public static function setOptimizer(OptimizerChain &$optimizerChain);
}
