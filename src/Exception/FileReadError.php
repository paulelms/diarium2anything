<?php
declare(strict_types=1);

namespace Diarium\To\Anything\Exception;

use Diarium\To\Anything\Exception;
use Throwable;

class FileReadError extends Exception
{

    private \SplFileInfo $fileInfo;

    public function __construct(\SplFileInfo $fileInfo, $code = 0, Throwable $previous = null)
    {
        $this->fileInfo = $fileInfo;
        parent::__construct('file unreadable: ' . $fileInfo->getRealPath(), $code, $previous);
    }

    /**
     * @return \SplFileInfo
     */
    public function getFileInfo(): \SplFileInfo
    {
        return $this->fileInfo;
    }

}
