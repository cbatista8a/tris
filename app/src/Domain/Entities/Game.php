<?php

namespace Cbatista8a\Tris\Domain\Entities;

use RuntimeException;

class Game
{
    private int $id;
    private Board $board;
    private Player $player1;
    private Player $player2;

    private int $last_player_id = 0;
    private array $winning_positions = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6]
    ];

    public function __construct(int $id, Board $board, Player $player1, Player $player2)
    {
        $this->id = $id;
        $this->board = $board;
        $this->assertPlayersHaveDifferentSymbols($player1, $player2);
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    public function getBoard(): Board
    {
        return $this->board;
    }

    public function getPlayer1(): Player
    {
        return $this->player1;
    }

    public function getPlayer2(): Player
    {
        return $this->player2;
    }

    /**
     * @throws RuntimeException
     */
    public function play(Player $player, int $position): void
    {
        $this->assertIsThePlayerTurn($player);
        $this->board->updateMatrix($position, $player->getSymbol());
        $this->last_player_id = $player->getId();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function checkWinner(): ?Player
    {
        $matrix = $this->board->getMatrix();
        foreach ($this->winning_positions as $positions) {
            if ($matrix[$positions[0]] === $matrix[$positions[1]] && $matrix[$positions[1]] === $matrix[$positions[2]]) {
                if ($matrix[$positions[0]] === $this->player1->getSymbol()) {
                    $this->player1->increaseScore();
                    return $this->player1;
                }

                if ($matrix[$positions[0]] === $this->player2->getSymbol()) {
                    $this->player2->increaseScore();
                    return $this->player2;
                }
            }
        }
        return null;
    }

    public function isTie(): bool
    {
        $values = array_values($this->board->getMatrix());
        // return true if all values are not integers
        return !array_filter($values, 'is_int');
    }

    public function getLastPlayerId(): int
    {
        return $this->last_player_id;
    }

    /**
     * @param Player $player1
     * @param Player $player2
     * @return void
     */
    private function assertPlayersHaveDifferentSymbols(Player $player1, Player $player2): void
    {
        if ($player1->getSymbol() === $player2->getSymbol()) {
            throw new RuntimeException('Players cannot have the same symbol');
        }
    }

    /**
     * @param Player $player
     * @return void
     */
    private function assertIsThePlayerTurn(Player $player): void
    {
        if ($this->last_player_id === $player->getId()) {
            throw new RuntimeException("It's not your turn");
        }
    }
}