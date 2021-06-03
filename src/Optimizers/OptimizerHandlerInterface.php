<?php

declare(strict_types=1);

namespace ImageCompression\Optimizers;

interface OptimizerHandlerInterface
{
    public static function create() : array;
}
