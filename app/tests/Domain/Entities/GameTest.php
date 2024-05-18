<?php

namespace Cbatista8a\Tris\Tests\Domain\Entities;

use Cbatista8a\Tris\Domain\Entities\Board;
use Cbatista8a\Tris\Domain\Entities\Game;
use Cbatista8a\Tris\Domain\Entities\Player;
use Exception;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    private Game $game;

    public function testCheckWinner(): void
    {
        foreach ([0, 1, 2] as $position) {
            $this->game->getBoard()->updateMatrix($position, $this->game->getPlayer1()->getSymbol());
        }
        self::assertEquals($this->game->checkWinner(), $this->game->getPlayer1());
    }

    public function testIsTie(): void
    {
        foreach ([0, 2, 4, 6, 8] as $position) {
            $this->game->getBoard()->updateMatrix($position, $this->game->getPlayer1()->getSymbol());
            if ($position < 8) {
                $this->game->getBoard()->updateMatrix($position + 1, $this->game->getPlayer2()->getSymbol());
            }
        }
        self::assertIsBool($this->game->isTie());
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testPlay(): void
    {
        // test the entire game
        while (!$this->game->checkWinner() && !$this->game->isTie()) {
            try {
                $this->game->play($this->game->getPlayer1(), random_int(0, 8));
            } catch (Exception $e) {
                $this->expectExceptionMessage($e->getMessage());
                $this->game->play($this->game->getPlayer1(), random_int(0, 8));
            }
            try {
                $this->game->play($this->game->getPlayer2(), random_int(0, 8));
            } catch (Exception $e) {
                $this->expectExceptionMessage($e->getMessage());
                $this->game->play($this->game->getPlayer2(), random_int(0, 8));
            }
        }
        self::assertIsBool($this->game->checkWinner() !== null || $this->game->isTie());
    }

    public function testPlayException(): void
    {
        $this->expectExceptionMessage("It's not your turn");
        $this->game->play($this->game->getPlayer1(), 0);
        $this->game->play($this->game->getPlayer1(), 1);
    }

    public function testLastPlayerUpdate(): void
    {
        $this->game->play($this->game->getPlayer2(), 3);
        self::assertEquals($this->game->getPlayer2()->getId(), $this->game->getLastPlayerId());
    }

    public function testPlayersHaveDifferentSymbols(): void
    {
        $this->expectExceptionMessage('Players cannot have the same symbol');
        $this->game = new Game(1, new Board(1), new Player(1, 'Carlos'), new Player(2, 'Carlos'));
    }

    protected function setUp(): void
    {
        $this->game = new Game(1, new Board(1), new Player(1, 'Carlos'), new Player(2, 'Alberto'));
    }
}
