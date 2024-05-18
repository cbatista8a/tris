<?php

namespace Cbatista8a\Tris\Domain\Entities;

use RuntimeException;

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
     * @throws RuntimeException
     */
    public function updateMatrix(int $position, string $symbol): void
    {
        $this->assertIsValidPosition($position);
        $this->assertIsFreePosition($position);
        $this->matrix[$position] = $symbol;
    }

    /**
     * @param int $position
     * @return void
     */
    private function assertIsValidPosition(int $position): void
    {
        if ($position < 0 || $position > 8) {
            throw new RuntimeException('Position out of range');
        }
    }

    /**
     * @param int $position
     * @return void
     */
    private function assertIsFreePosition(int $position): void
    {
        if (!is_int($this->matrix[$position])) {
            throw new RuntimeException('Position already taken');
        }
    }
}