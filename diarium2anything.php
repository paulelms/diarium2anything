#!/usr/bin/env php
<?php declare(strict_types=1);

use Diarium\To\Anything\Converter;
use Diarium\To\Anything\Exception;
use Diarium\To\Anything\ExporterFactory;
use Diarium\To\Anything\LoaderFactory;
use Diarium\To\Anything\Logger;
use Diarium\To\Anything\Util;

require __DIR__ . '/vendor/autoload.php';

// useful var dump
if (class_exists('Kint')) {
    Kint::$aliases[] = 'dd';
    function dd(...$vars)
    {
        Kint::dump(...$vars);
        exit;
    }
}

/** @var \Psr\Log\LoggerInterface $logger */
$logger = new Logger\Cli();

if ($argc !== 4) {
    Util\CommandLine::printUsage();
    exit(Util\ExitCodes::EX_USAGE);
}

[, $outputType, $inputPath, $outputPath] = $argv;

// TODO more human cli
if (file_exists($outputPath) || ! mkdir($outputPath)) {
    $logger->error('can\'t create directory: ' . $outputPath);
    exit(Util\ExitCodes::EX_CANTCREAT);
}

if (! file_exists($inputPath)) {
    $logger->error('input file doesn\'t exist: ' . $inputPath);
    exit(Util\ExitCodes::EX_USAGE);
}

try {
    $ext = pathinfo($inputPath, PATHINFO_EXTENSION);
    $mimeType = mime_content_type($inputPath);
    if ($loaderType = LoaderFactory::detectLoaderType($ext, $mimeType)) {
        $loader = LoaderFactory::getLoader($loaderType);
    } else {
        $logger->error('unknown diary format');
        exit(Util\ExitCodes::EX_USAGE);
    }

    $exporter = ExporterFactory::getExporter($outputType);

    $converter = new Converter($loader, $exporter, $logger);
    $converter->process();
} catch (Exception\NotImplemented $e) {
    $logger->error('feature not implemented: ' . $e->getMessage());
    exit(Util\ExitCodes::EX_USAGE);
} catch (\Exception $e) {
    $logger->error('unhandled error: ' . $e->getMessage());
    exit(Util\ExitCodes::EX_SOFTWARE);
}

$logger->info('done');
exit(Util\ExitCodes::EX_OK);
