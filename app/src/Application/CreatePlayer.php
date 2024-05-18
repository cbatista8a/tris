<?php

namespace Cbatista8a\Tris\Application;

use Cbatista8a\Tris\Domain\Entities\Player;
use Cbatista8a\Tris\Domain\Interfaces\RepositoryInterface;

class CreatePlayer
{

    private RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id, string $name): Player
    {
        $player = new Player($id, $name);
        $this->repository->save($player);
        return $player;
    }
}