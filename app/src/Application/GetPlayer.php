<?php

namespace Cbatista8a\Tris\Application;

use Cbatista8a\Tris\Domain\Entities\Player;
use Cbatista8a\Tris\Domain\Interfaces\RepositoryInterface;

class GetPlayer
{

    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $player_id): ?Player
    {
        /** @var Player $player */
        $player = $this->repository->find(Player::class, $player_id);
        return $player;
    }
}