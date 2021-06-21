<?php
declare(strict_types=1);

namespace Diarium\To\Anything;

final class LoaderFactory
{

    private const EXT_DIARIUM_DB    = 'diary';
    private const MIME_DIARIUM_DB   = 'application/x-sqlite3';

    /**
     * @throws Exception\Loader\UnknownFormat
     */
    public static function getLoader(\SplFileInfo $fileInfo): ILoader
    {
        if (! $fileInfo->isReadable()) {
            throw new Exception\FileReadError($fileInfo);
        }

        $fileExtension = $fileInfo->getExtension();
        $fileMimeType = mime_content_type($fileInfo->getRealPath()) ?: null;
        switch (true) {
            case $fileExtension === self::EXT_DIARIUM_DB && $fileMimeType === self::MIME_DIARIUM_DB:
                $sqlite = new \SQLite3($fileInfo->getRealPath());
                return new Loader\DiariumDb($sqlite);
            // TODO plain text / html / docx
        }
        throw new Exception\Loader\UnknownFormat($fileExtension, $fileMimeType, 'Loader: unsupported file format');
    }

}
