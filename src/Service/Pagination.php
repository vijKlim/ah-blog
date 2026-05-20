<?php

namespace App\Service;

class Pagination
{
     public function __construct(
         private int $totalCount,
         private int $page,
         private int $perPage,
     ) {
     }

     public function getTotalCount(): int
     {
         return $this->totalCount;
     }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPagesCount(): int
    {
        return (int) ceil($this->totalCount / $this->perPage);
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getLimit(): int
    {
        return $this->perPage;
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->perPage;
    }

    public function hasPreviousPage(): bool
    {
        return $this->page > 1;
    }

    public function hasNextPage(): bool
    {
        return $this->page < $this->getPagesCount();
    }

    public function getPreviousPage(): int
    {
        return max(1, $this->page - 1);
    }

    public function getNextPage(): int
    {
        return min($this->getPagesCount(), $this->page + 1);
    }
}