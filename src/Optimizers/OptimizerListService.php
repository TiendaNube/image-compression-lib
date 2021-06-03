<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use Spatie\ImageOptimizer\OptimizerChain;
use Spatie\ImageOptimizer\Optimizers\BaseOptimizer;

class OptimizerListService
{
    /**
     * @var BaseOptimizer[]
     */
    private $optimizers = [];

    /**
     * @param BaseOptimizer[] $optimizers
     */
    public function addOptimizers(array $optimizers)
    {
        array_push($this->optimizers, ...$optimizers);
    }

    private function addOptimizersTo(OptimizerChain &$optimizerChain)
    {
        $optimizerChain->setOptimizers($this->optimizers);
    }

    public function getOptimizerChain() : OptimizerChain
    {
        $optimizerChain = new OptimizerChain();

        $this->addOptimizersTo($optimizerChain);

        return $optimizerChain;
    }
}
