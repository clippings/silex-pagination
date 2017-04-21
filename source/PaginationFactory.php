<?php

namespace Kilte\Silex\Pagination;

use Kilte\Pagination\Pagination;

class PaginationFactory
{
    /**
     * @var int
     */
    private $perPage;

    /**
     * @var int
     */
    private $neighbours;

    function __construct(int $perPage, int $neighbours)
    {
        $this->perPage = $perPage;
        $this->neighbours = $neighbours;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function setPerPage(int $perPage): self
    {
        $this->perPage = $perPage;

        return $this;
    }

    public function getNeighbours(): int
    {
        return $this->neighbours;
    }

    public function setNeighbours(int $neighbours): self
    {
        $this->neighbours = $neighbours;

        return $this;
    }

    public function create(int $total, int $current, int $perPage = null, int $neighbours = null): Pagination
    {
        if ($perPage === null) {
            $perPage = $this->perPage;
        }
        if ($neighbours === null) {
            $neighbours = $this->neighbours;
        }

        return new Pagination($total, $current, $perPage, $neighbours);
    }
}
