<?php

declare(strict_types=1);

namespace ImageCompression;

interface ImageOptimizerInterface
{
    public function optimizeImage(string $pathToImage, $pathToOutput = null);
}
