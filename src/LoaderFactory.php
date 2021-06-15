<?php

namespace Diarium\To\Anything;

use Diarium\To\Anything\Exception;

class LoaderFactory
{

    public const TYPE_DIARIUM_DB = 'diarium';

    /**
     * @throws Exception\NotImplemented
     */
    public static function getLoader(string $loaderType): ILoader
    {
        // TODO plain text / html / docx export
        switch ($loaderType) {
            case self::TYPE_DIARIUM_DB:
                return new Loader\SQLite();
        }
        throw new Exception\NotImplemented('diary type: ' . $loaderType);
    }

    public static function detectLoaderType(string $fileExt, string $mimeType): ?string
    {
        switch (true) {
            case $fileExt === 'diary' && $mimeType === 'application/x-sqlite3':
                return self::TYPE_DIARIUM_DB;
        }
        return null;
    }

}
