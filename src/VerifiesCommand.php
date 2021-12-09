<?php

namespace ImageCompression;

trait VerifiesCommand
{
    private function commandExists($command){
        $return = shell_exec(sprintf("which %s", escapeshellarg($command)));

        return !empty($return);
    }
}