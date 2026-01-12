<?php

declare(strict_types=1);

namespace ImageCompression;

interface ImageOptimizerInterface
{
    public function optimizeImage(string $pathToImage, ?string $pathToOutput = null): bool;
}
