<?php
declare(strict_types=1);

namespace Diarium\To\Anything;

class LoaderFactory
{

    private const EXT_DIARIUM_DB    = 'diary';
    private const MIME_DIARIUM_DB   = 'application/x-sqlite3';

    /**
     * @throws Exception\Loader\UnknownFormat
     */
    public static function getLoader(string $fileExtension, ?string $fileMimeType): ILoader
    {
        // TODO plain text / html / docx
        switch (true) {
            case $fileExtension === self::EXT_DIARIUM_DB && $fileMimeType === self::MIME_DIARIUM_DB:
                return new Loader\SQLite(); // FIXME not implemented
        }
        throw new Exception\Loader\UnknownFormat($fileExtension, $fileMimeType, 'Loader: unsupported file format');
    }

}
