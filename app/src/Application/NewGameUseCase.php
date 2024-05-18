<?php

namespace Cbatista8a\Tris\Application;

use Cbatista8a\Tris\Domain\Entities\Board;
use Cbatista8a\Tris\Domain\Entities\Game;
use Cbatista8a\Tris\Domain\Entities\Player;
use Cbatista8a\Tris\Domain\Interfaces\RepositoryInterface;

class NewGameUseCase
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Player $player1, Player $player2): Game
    {
        $id = (int)date('U'); // This is a simple way to generate a unique id but you can use a UUID library or get it from a database
        $board = new Board($id);
        $game = new Game($id, $board, $player1, $player2);
        $this->repository->save($game);
        return $game;
    }
}