<?php

declare(strict_types=1);

namespace ImageCompression;

use Spatie\ImageOptimizer\OptimizerChainFactory;

class DefaultImageOptimizer implements ImageOptimizerInterface
{
    public function optimizeImage(string $pathToImage, $pathToOutput = null)
    {
        if (null === $pathToOutput) {
            $pathToOutput = $pathToImage;
        }

        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($pathToImage, $pathToOutput);
        $this->convert($pathToImage, $pathToOutput);
    }

    private function convert(string $pathToImage, string $pathToOutput)
    {
        $command = sprintf('%s -sampling-factor 4:2:0 -strip -quality 65 %s', $pathToImage, $pathToOutput);

        return shell_exec($command);
    }
}
