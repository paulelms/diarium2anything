<?php
declare(strict_types=1);

namespace Diarium\To\Anything\Loader;

use Diarium\To\Anything\ILoader;
use Diarium\To\Anything\Item\Entry;
use Diarium\To\Anything\Util\Page;

class DiariumDb implements ILoader
{

    private \SQLite3 $db;

    private const TABLE_ENTRIES     = 'Entries';
    private const TABLE_TAGS        = 'Tags';
    private const TABLE_ENTRY_TAGS  = 'EntryTags';
    private const TABLE_EVENTS      = 'Events';
    private const TABLE_MEDIA       = 'Media';
//    private const TABLE_TEMPLATES   = 'Templates';

    public function __construct(\SQLite3 $sqlite)
    {
        $this->db = $sqlite;
    }

    /**
     * @return \SQLite3
     */
    public function getDb(): \SQLite3
    {
        return $this->db;
    }

    public function getEntries(Page $page): Entry
    {
        // TODO: Implement getEntries() method.
    }

    public function getCount(): int
    {
        return $this->getDb()->querySingle('select count(*) from '.self::TABLE_ENTRIES);
    }

}
