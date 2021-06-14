<?php

namespace Diarium\To\Anything;

use Psr\Log\LoggerInterface;

class Converter
{

    /** @var ILoader */
    private $loader;

    /** @var IExporter */
    private $exporter;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(ILoader $loader, IExporter $exporter, LoggerInterface $logger)
    {
        $this->loader = $loader;
        $this->exporter = $exporter;
        $this->logger = $logger;
    }

    public function process(): void
    {
        // TODO WIP
    }

    private function getLoader(): ILoader
    {
        return $this->loader;
    }

    private function getExporter(): IExporter
    {
        return $this->exporter;
    }

    private function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}
