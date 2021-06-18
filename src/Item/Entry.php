<?php
declare(strict_types=1);

namespace Diarium\To\Anything\Item;

use DateTimeImmutable;

class Entry
{

    /** @var string */
    private string $title;

    /** @var string */
    private string $text;

    /** @var DateTimeImmutable */
    private DateTimeImmutable $dateTime;

}
