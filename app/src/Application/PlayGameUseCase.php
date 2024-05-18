<?php

namespace Cbatista8a\Tris\Application;

use Cbatista8a\Tris\Domain\Entities\Game;
use Cbatista8a\Tris\Domain\Entities\Player;
use Cbatista8a\Tris\Domain\Interfaces\RepositoryInterface;

class PlayGameUseCase
{

    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $game_id, Player $player, int $position): array
    {
        /** @var Game $game */
        $game = $this->repository->find(Game::class, $game_id);
        $game->play($player, $position -1); // -1 because the board is 0 indexed
        $this->repository->save($game);

        $checkWinner = $game->checkWinner();
        return [
            'board' => $game->getBoard()->getMatrix(),
            'has_winner' => $checkWinner !== null,
            'winner' => $checkWinner,
            'is_tie' => $game->isTie(),
        ];
    }
}