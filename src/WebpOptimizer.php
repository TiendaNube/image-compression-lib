<?php

declare(strict_types=1);

namespace ImageCompression;

use Exception;
use WebPConvert\WebPConvert;

class WebpOptimizer implements ImageOptimizerInterface
{
    const WEBP_EXT = 'webp';
    use VerifiesCommand;

    public function optimizeImage(string $pathToImage, string $pathToOutput = null) : bool
    {
        try {
            if($this->commandExists('cwebp')){
                throw new Exception('Command doen');
            }
            $pathToOutput = $pathToOutput ?? $this->getWebpPath($pathToImage);

            /**
             * @see https://github.com/rosell-dk/webp-convert/blob/master/docs/v2.0/converting/introduction-for-converting.md#configuring-the-options
             */
            $options = [
                'png' => [
                    'encoding' => 'lossy',
                    'near-lossless' => 100,
                    'quality' => 95,
                    'sharp-yuv' => true,
                    'converters' => [
                        'cwebp',
                    ],
                ],
                'jpeg' => [
                    'encoding' => 'lossy',
                    'quality' => 95,
                    'auto-limit' => true,
                    'sharp-yuv' => true,
                    'converters' => [
                        'cwebp',
                    ],
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
