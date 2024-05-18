<?php

namespace Cbatista8a\Tris\Infrastructure\Controllers;

use Cbatista8a\Tris\Application\CreatePlayer;
use Cbatista8a\Tris\Application\NewGameUseCase;
use Cbatista8a\Tris\Domain\Interfaces\RepositoryInterface;
use Exception;

class NewGameController
{
    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $player1 = (new CreatePlayer($this->repository))(1, 'Carlos');
        $player2 = (new CreatePlayer($this->repository))(2, 'Dayanet');
        try {
            $game = (new NewGameUseCase($this->repository))($player1, $player2);
            return ['game_id' => $game->getId()];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}