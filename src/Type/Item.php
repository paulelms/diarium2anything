<?php
declare(strict_types=1);

namespace Diarium\To\Anything\Type;


abstract class Item
{

    protected function getReadOnlyFields(): array
    {
        return [];
    }

    abstract public function toArray(): array;

    public static function createFromArray(array $row): static
    {
        return new static();
    }

}
