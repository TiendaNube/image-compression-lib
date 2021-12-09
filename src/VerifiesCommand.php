<?php

declare(strict_types=1);

namespace ImageCompression;

use Exception;

trait VerifiesCommand
{
    private function commandExists($command)
    {
        $return = shell_exec(sprintf('which %s', escapeshellarg($command)));

        return !empty($return);
    }

    private function ensureInstalledCommand()
    {
        if (!$this->commandExists(self::CONVERTER_CMD)) {
            throw new Exception(sprintf('Command %s is not installed', self::CONVERTER_CMD));
        }
    }
}
