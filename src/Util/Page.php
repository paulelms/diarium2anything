<?php
namespace Diarium\To\Anything\Util;

class Page
{
    private $page;
    private $size;

    private $count;
    private $total;

    protected function __construct($onPage, $startPage = 1, $total = null)
    {
        $this->page = $startPage;
        $this->size = $onPage;
        if ($total !== null ) {
            $this->count = (int)($total / (int)$onPage) + (int)($total % $onPage > 0);
        }
        $this->total = $total;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getOnPage()
    {
        return $this->size;
    }

    public function getCount()
    {
        return $this->count;
    }

    public static function createFirst($onPage, $total = null)
    {
        return new self($onPage, 1, $total);
    }

    /**
     * @param int $onPage
     * @param int $startPage >= 1
     * @param int|null $total
     * @return Page
     */
    public static function createAny($onPage, $startPage, $total = null)
    {
        if ($startPage < 1) {
            $startPage = 1;
        }
        return new self($onPage, $startPage, $total);
    }

    public function getNext()
    {
        $cnt = $this->getCount();
        if ( $cnt === null || $this->getPage() < $cnt) {
            $new = new self($this->getOnPage(), $this->getPage()+1, $this->total);
            $new->count = $this->count;
            return $new;
        }
        return null;
    }

    public function getCurrentPage($reduceCount)
    {
        if ($this->total === null) {
            return  new self($this->getOnPage(), $this->getPage());
        }
        if (($total = $this->total - $reduceCount) > 0) {
            $page = new self($this->getOnPage(), $this->getPage(), $total);
            if ($page->getPage() <= $page->getCount()) {
                return $page;
            }
        }
        return null;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->getOnPage();
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return ($this->getPage() - 1) * $this->getOnPage();
    }
}