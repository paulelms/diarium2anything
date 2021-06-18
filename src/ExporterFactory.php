<?php

namespace Diarium\To\Anything;

class ExporterFactory
{

    public const TYPE_ORG_ROAM    = 'org-roam';
    public const TYPE_ORG_JOURNAL = 'org-journal';
    public const TYPE_MARKDOWN    = 'markdown';

    /**
     * @throws Exception\NotImplemented
     */
    public static function getExporter(string $outputType): IExporter
    {
        switch ($outputType) {
            case self::TYPE_ORG_ROAM:
                return new Exporter\Org\Roam();
            // TODO WIP
            // case self::TYPE_ORG_JOURNAL:
            //     return new Exporter\Org\Journal();
            // case self::TYPE_MARKDOWN:
            //     return new Exporter\Markdown();
        }
        throw new Exception\NotImplemented('unsupported output format: ' . $outputType);
    }
}
