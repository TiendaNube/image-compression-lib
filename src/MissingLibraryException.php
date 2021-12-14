<?php

declare(strict_types=1);

namespace ImageCompression;

use Exception;

class MissingLibraryException extends Exception
{
    public function __construct($library = null)
    {
        $message = sprintf('Library %s is not available', $library);

        parent::__construct($message);
    }
}
