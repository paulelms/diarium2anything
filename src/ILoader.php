<?php
declare(strict_types=1);

namespace Diarium\To\Anything;

use Diarium\To\Anything\Util\Page;
use Diarium\To\Anything\Item\Entry;

interface ILoader
{

    public function getEntries(Page $page): Entry;

    /**
     * Get count of all records / entry files / sections etc.
     * @return int
     */
    public function getCount(): int;

}
