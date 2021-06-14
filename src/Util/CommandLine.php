<?php

namespace Diarium\To\Anything\Util;

abstract class CommandLine
{

    public static function printUsage(): void
    {
        echo 'Usage: php diarium2anything.php <outputType> <inputPath> <outputPath>' . PHP_EOL;
        echo 'Output types:' . PHP_EOL;
        echo '  - markdown' . PHP_EOL;
        echo '  - org-roam — org-roam daily pages' . PHP_EOL;
        echo '  - org-journal —  simple personal diary / journal in Emacs' . PHP_EOL;
    }

    public static function pressReturnToContinue($message = 'Press return to continue'): void
    {
        echo $message;
        $stdin = fopen('php://stdin', 'r');
        $response = fgetc($stdin);
    }

    public static function questionYesNo($message = 'Continue?'): bool
    {
        echo $message . ' (y/N) - ';
        $stdin = fopen('php://stdin', 'r');
        $response = fgetc($stdin);
        return $response === 'y';
    }

    protected function readInput($message): string
    {
        return readline($message.': ');
    }

}
