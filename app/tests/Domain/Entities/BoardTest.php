<?php

namespace Cbatista8a\Tris\Tests\Domain\Entities;

use Cbatista8a\Tris\Domain\Entities\Board;
use Exception;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    protected function setUp(): void
    {
        $this->board = new Board(1);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testUpdateMatrix(): void
    {
        $position = random_int(0, 8);
        $this->board->updateMatrix($position, 'X');
        self::assertEquals('X', $this->board->getMatrix()[$position]);
    }

    public function testUpdateMatrixPositionOutOfRange(): void
    {
        $this->expectExceptionMessage('Position out of range');
        $this->board->updateMatrix(9, 'X');
    }

    public function testUpdateMatrixPositionAlreadyTaken(): void
    {
        $this->expectExceptionMessage('Position already taken');
        $this->board->updateMatrix(0, 'X');
        $this->board->updateMatrix(0, 'O');
    }
}
