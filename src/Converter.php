<?php
declare(strict_types=1);

namespace Diarium\To\Anything;

use Psr\Log\LoggerInterface;

class Converter
{

    /** @var ILoader */
    private ILoader $loader;

    /** @var IExporter */
    private IExporter $exporter;

    /** @var LoggerInterface */
    private LoggerInterface $logger;

    public function __construct(ILoader $loader, IExporter $exporter, LoggerInterface $logger)
    {
        $this->loader = $loader;
        $this->exporter = $exporter;
        $this->logger = $logger;
    }

    /**
     * @throws Exception\NotImplemented
     * @return void
     */
    public function process(): void
    {
        d($this->getLoader()->getCount());
        throw new \Exception('WIP');
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
