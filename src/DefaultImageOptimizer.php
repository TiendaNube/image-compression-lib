<?php

declare(strict_types=1);

namespace ImageCompression;

use ImageCompression\Optimizers\DefaultOptimizerList;
use ImageCompression\Optimizers\OptimizerListService;

class DefaultImageOptimizer implements ImageOptimizerInterface
{
    /**
     * @var OptimizerListService
     */
    private $optimizerListService;

    public function __construct(OptimizerListService $optimizerListService = null)
    {
        if ($optimizerListService===null) {
            $optimizerListService = DefaultOptimizerList::create();
        }

        $this->setOptimizerList($optimizerListService);
    }

    private function setOptimizerList(OptimizerListService $optimizerListService)
    {
        $this->optimizerListService = $optimizerListService;
    }

    private function getOptimizerChain()
    {
        return $this->optimizerListService->getOptimizerChain();
    }

    public function optimizeImage(string $pathToImage, string $pathToOutput = null)
    {
        if (empty($pathToOutput)) {
            $pathToOutput = $pathToImage;
        }

        $this->getOptimizerChain()->optimize($pathToImage, $pathToOutput);

        $this->convert($pathToOutput, $pathToOutput);
    }

    private function convert(string $pathToImage, string $pathToOutput)
    {
        $command = sprintf('convert %s -sampling-factor 4:2:0 -strip -quality 65 %s', $pathToImage, $pathToOutput);

        return shell_exec($command);
    }
}
