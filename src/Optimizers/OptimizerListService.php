<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use Spatie\ImageOptimizer\OptimizerChain;

class OptimizerListService
{
    /**
     * @var OptimizerHandlerInterface[]
     */
    private static $optimizers = [
        JpgOptimizer::class,
        PngOptimizer::class,
    ];

    public static function setOptimizers(OptimizerChain &$optimizerChain)
    {
        foreach (self::$optimizers as $optimizer) {
            $optimizerChain->addOptimizer($optimizer::getOptimizer());
        }
    }
}
