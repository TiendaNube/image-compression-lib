<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use ImageCompression\Optimizers\Factories\Optipng;
use ImageCompression\Optimizers\Factories\Pngquant;
use Spatie\ImageOptimizer\OptimizerChain;

class PngOptimizer implements OptimizerHandlerInterface
{
    public static function addOptimizerTo(OptimizerChain &$optimizerChain)
    {
        $optimizerChain->addOptimizer(Optipng::create());

        $optimizerChain->addOptimizer(Pngquant::create());
    }
}
