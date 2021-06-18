<?php
declare(strict_types=1);

namespace Diarium\To\Anything\Exception\Loader;

use Diarium\To\Anything\Exception;
use Throwable;

class UnknownFormat extends Exception
{

    private string $fileExtension;

    private ?string $fileMimeType;

    public function __construct(string $fileExtension, ?string $fileMimeType, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->fileExtension = $fileExtension;
        $this->fileMimeType = $fileMimeType;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getFileExtension(): string
    {
        return $this->fileExtension;
    }

    /**
     * @return string|null
     */
    public function getFileMimeType(): ?string
    {
        return $this->fileMimeType;
    }

}
