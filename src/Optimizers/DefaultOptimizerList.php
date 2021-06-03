<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

class DefaultOptimizerList
{
    public static function create() : OptimizerListService
    {
        $optimizerListService = new OptimizerListService();

        $optimizerListService->addOptimizers(JpgOptimizer::create());
        $optimizerListService->addOptimizers(PngOptimizer::create());

        return $optimizerListService;
    }
}
