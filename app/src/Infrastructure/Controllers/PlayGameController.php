<?php

namespace Cbatista8a\Tris\Infrastructure\Controllers;

use Cbatista8a\Tris\Application\GetPlayer;
use Cbatista8a\Tris\Application\PlayGameUseCase;
use Cbatista8a\Tris\Domain\Interfaces\RepositoryInterface;
use Exception;

class PlayGameController
{

    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        if (!isset($_GET['player_id'], $_GET['game_id'], $_GET['position'])) {
            return ['error' => 'Invalid request, missing parameters.'];
        }
        $player = (new GetPlayer($this->repository))($_GET['player_id']);
        $game_id = $_GET['game_id'];
        $position = $_GET['position'];
        try {
            return (new PlayGameUseCase($this->repository))($game_id, $player, $position);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}