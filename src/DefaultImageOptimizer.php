<?php

declare(strict_types=1);

namespace ImageCompression;

use ImageCompression\Optimizers\OptimizerListService;
use Spatie\ImageOptimizer\OptimizerChain;

class DefaultImageOptimizer implements ImageOptimizerInterface
{
    public function optimizeImage(string $pathToImage, string $pathToOutput = null)
    {
        if (empty($pathToOutput)) {
            $pathToOutput = $pathToImage;
        }

        $optimizerChain = OptimizerListService::getOptimizerChain();

        $optimizerChain->optimize($pathToImage, $pathToOutput);
        $this->convert($pathToOutput, $pathToOutput);
    }

    private function convert(string $pathToImage, string $pathToOutput)
    {
        $command = sprintf('convert %s -sampling-factor 4:2:0 -strip -quality 65 %s', $pathToImage, $pathToOutput);

        return shell_exec($command);
    }

}
