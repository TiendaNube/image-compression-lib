<?php

declare(strict_types=1);

namespace ImageCompression;

trait VerifiesCommand
{
    private function commandExists(string $command) : bool
    {
        $return = shell_exec(sprintf('which %s', escapeshellarg($command)));

        return !empty($return);
    }
}
