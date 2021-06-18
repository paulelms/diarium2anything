<?php
declare(strict_types=1);

namespace Diarium\To\Anything\Type;

abstract class Collection implements \Iterator, \Countable
{
    protected $position = 0;

    /** @var Item[] */
    protected $items = array();

    protected function appendItem(Item $item)
    {
        $this->items[] = $item;
    }

    abstract public function createItem(array $array);

    public function __construct(array $data = [])
    {
        foreach ($data as $item) {
            $this->appendItem($item);
        }
    }

    /**
     * @param array $array
     * @return static
     */
    public static function fromArray(array $array)
    {
        $collection = new static();
        foreach ($array as $row) {
            if ($item = $collection->createItem($row)) {
                $collection->appendItem($item);
            }
        }
        return $collection;
    }

    public function getFirst(&$position)
    {
        $position = 0;
        return $this->getNext($position);
    }

    public function getNext(&$position)
    {
        return $position < count($this->items) ? $this->items[$position++] : null;
    }

    /**
     * @return Item
     * @see \Iterator
     */
    public function current()
    {
        return $this->items[$this->position];
    }

    /**
     * @return void
     * @see \Iterator
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * @return int
     * @see \Iterator
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @return bool
     * @see \Iterator
     */
    public function valid()
    {
        return array_key_exists($this->position, $this->items);
    }

    /**
     * @see \Iterator
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return int
     * @see \Countable
     */
    public function count()
    {
        return count($this->items);
    }
}
