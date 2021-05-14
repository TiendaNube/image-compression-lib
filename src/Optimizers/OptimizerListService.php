<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use Spatie\ImageOptimizer\OptimizerChain;

class OptimizerListService
{
    /**
     * @var OptimizerHandlerInterface[]
     */
    private $optimizers = [
        JpgOptimizer::class,
        PngOptimizer::class,
    ];

    private function addOptimizersTo(OptimizerChain &$optimizerChain)
    {
        foreach ($this->optimizers as $optimizer) {
            $optimizer::addOptimizerTo($optimizerChain);
        }
    }

    public function getOptimizerChain()
    {
        $optimizerChain = new OptimizerChain();

        $this->addOptimizersTo($optimizerChain);

        return $optimizerChain;
    }
}
