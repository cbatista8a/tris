<?php

namespace Cbatista8a\Tris\Domain\Entities;

class Board
{
    private int $id;
    private array $matrix = [1, 2, 3, 4, 5, 6, 7, 8, 9];

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMatrix(): array
    {
        return $this->matrix;
    }


    /**
     * @param int $position
     * @param string $symbol
     * @return void
     */
    public function updateMatrix(int $position, string $symbol): void
    {
        $this->matrix[$position] = $symbol;
    }
}