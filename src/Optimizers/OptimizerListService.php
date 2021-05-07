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
            $optimizer::setOptimizer($optimizerChain);
        }
    }

    public static function getOptimizerChain(){

        $optimizerChain = new OptimizerChain();

        self::setOptimizers($optimizerChain);

        return $optimizerChain;
    }
}
