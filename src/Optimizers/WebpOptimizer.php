<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

use Exception;
use ImageCompression\ImageOptimizerInterface;
use WebPConvert\WebPConvert;

class WebpOptimizer implements ImageOptimizerInterface
{
    const WEBP_EXT = 'webp';

    public function optimizeImage(string $pathToImage, string $pathToOutput = null)
    {
        try {
            $pathToImageLevel = $this->getWebpPath($pathToOutput);

            $options = [
                'png' => [
                    'encoding' => 'lossy',    // Try both lossy and lossless and pick smallest
                    'near-lossless' => 100,   // The level of near-lossless image preprocessing (when trying lossless)
                    'quality' => 95,         // Quality when trying lossy. It is set high because pngs is often selected to ensure high quality
                    'sharp-yuv' => true,
                ],
                'jpeg' => [
                    'encoding' => 'lossy',     // If you are worried about the longer conversion time, you could set it to "lossy" instead (lossy will often be smaller than lossless for jpegs)
                    'quality' => 95,          // Quality when trying lossy. It is set a bit lower for jpeg than png
                    'auto-limit' => true,     // Prevents using a higher quality than that of the source (requires imagick or gmagick extension, not necessarily compiled with webp)
                    'sharp-yuv' => true,
                ],
            ];

            WebPConvert::convert($pathToImage, $pathToImageLevel, $options);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function getWebpPath(string $file) : string
    {
        $fileParts = pathinfo($file);

        return $fileParts['dirname'].'/'.$fileParts['filename'].'.'.self::WEBP_EXT;
    }
}
