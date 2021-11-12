<?php

declare(strict_types=1);

namespace ImageCompression;

use Exception;
use WebPConvert\WebPConvert;

class WebpOptimizer implements ImageOptimizerInterface
{
    const WEBP_EXT = 'webp';

    public function optimizeImage(string $pathToImage, string $pathToOutput = null) : bool
    {
        try {
            $pathToOutput = $this->getWebpPath($pathToOutput);

            /**
             * @see https://github.com/rosell-dk/webp-convert/blob/master/docs/v2.0/converting/introduction-for-converting.md#configuring-the-options
             */
            $options = [
                'png' => [
                    'encoding' => 'lossy',
                    'near-lossless' => 100,
                    'quality' => 95,
                    'sharp-yuv' => true,
                ],
                'jpeg' => [
                    'encoding' => 'lossy',
                    'quality' => 95,
                    'auto-limit' => true,
                    'sharp-yuv' => true,
                ],
            ];

            WebPConvert::convert($pathToImage, $pathToOutput, $options);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    private function getWebpPath(string $file) : string
    {
        $fileParts = pathinfo($file);

        return $fileParts['dirname'].'/'.$fileParts['filename'].'.'.self::WEBP_EXT;
    }
}
