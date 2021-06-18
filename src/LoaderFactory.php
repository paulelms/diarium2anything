<?php

namespace Diarium\To\Anything;

class LoaderFactory
{

    public const TYPE_DIARIUM_DB = 'diarium';

    /**
     * @throws Exception\NotImplemented
     */
    public static function getLoader(\SplFileInfo $fileInfo): ILoader
    {
        if (! $fileInfo->isReadable()) {
            throw new Exception\FileReadError($fileInfo);
        }

        $loaderType = self::detectLoaderType($fileInfo);

        // TODO plain text / html / docx export
        switch ($loaderType) {
            case self::TYPE_DIARIUM_DB:
                return new Loader\SQLite();
        }
        throw new Exception\NotImplemented('diary type: ' . $loaderType);
    }

    private static function detectLoaderType(\SplFileInfo $fileInfo): ?string
    {
        $mimeType = mime_content_type($fileInfo->getRealPath());
        return match (true) {
            $fileInfo->getExtension() === 'diary' && $mimeType === 'application/x-sqlite3' => self::TYPE_DIARIUM_DB,
            default => null,
        };
    }

}
