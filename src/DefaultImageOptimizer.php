<?php

declare(strict_types=1);

namespace ImageCompression;

use ImageCompression\Optimizers\OptimizerListService;
use Spatie\ImageOptimizer\OptimizerChain;

class DefaultImageOptimizer implements ImageOptimizerInterface
{
    private $optimizerChain;

    public function __construct(OptimizerChain $optimizerChain = null)
    {
        $this->optimizerChain = $optimizerChain;

        if ($optimizerChain === null) {
            $optimizerListService = new OptimizerListService();
            $this->optimizerChain = $optimizerListService->getOptimizerChain();
        }
    }

    public function optimizeImage(string $pathToImage, string $pathToOutput = null)
    {
        if (empty($pathToOutput)) {
            $pathToOutput = $pathToImage;
        }

        $this->optimizerChain->optimize($pathToImage, $pathToOutput);

        $this->convert($pathToOutput, $pathToOutput);
    }

    private function convert(string $pathToImage, string $pathToOutput)
    {
        $command = sprintf('convert %s -sampling-factor 4:2:0 -strip -quality 65 %s', $pathToImage, $pathToOutput);

        return shell_exec($command);
    }
}
