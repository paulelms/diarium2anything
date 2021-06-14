#!/usr/bin/env php
<?php declare(strict_types=1);

use Diarium\To\Anything\Converter;
use Diarium\To\Anything\Loader;
use Diarium\To\Anything\Exporter;
use Diarium\To\Anything\Logger;
use Diarium\To\Anything\Util;

require __DIR__ . '/vendor/autoload.php';

// useful debugger
if (class_exists('Kint')) {
    Kint::$aliases[] = 'dd';
    function dd(...$vars)
    {
        Kint::dump(...$vars);
        exit;
    }
}

// psr/log implementation
$logger = new Logger\Cli();

if ($argc !== 4) {
    Util\CommandLine::printUsage();
    exit(Util\ExitCodes::EX_USAGE);
}
$outputType = $argv[1];
$inputPath = $argv[2];
$outputPath = $argv[3];

if (file_exists($outputPath) || ! mkdir($outputPath)) {
    $logger->error('can\'t create directory: ' . $outputPath);
    exit(Util\ExitCodes::EX_CANTCREAT);
}

if (! file_exists($inputPath)) {
    $logger->error('input file doesn\'t exist: ' . $inputPath);
    exit(Util\ExitCodes::EX_USAGE);
}

$ext = pathinfo($inputPath, PATHINFO_EXTENSION);
$mimeType = mime_content_type($inputPath);

// TODO plain text / html / docx export
switch (true) {
    case $ext === 'diary' && $mimeType === 'application/x-sqlite3':
        $loader = new Loader\SQLite();
        break;
    default:
        $logger->error('unsupported input file type');
        exit(Util\ExitCodes::EX_USAGE);
}

switch ($outputType) {
    case 'org-roam':
        die('not implemented'); // FIXME WIP
        $exporter = new Exporter\Org\Roam();
        break;
    case 'org-journal':
        die('not implemented'); // FIXME WIP
        $exporter = new Exporter\Org\Journal();
        break;
    case 'markdown':
        die('not implemented'); // FIXME WIP
        $exporter = new Exporter\Markdown();
        break;
    default:
        $logger->error('unsupported input file type' );
        exit(Util\ExitCodes::EX_USAGE);
}

try {
    $converter = new Converter($loader, $exporter, $logger);
    $converter->process();
} catch (\Exception $e) {
    $logger->error('process error');
    exit(Util\ExitCodes::EX_SOFTWARE);
}

$logger->info('done');
exit(Util\ExitCodes::EX_OK);
