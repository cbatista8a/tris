<?php

namespace Cbatista8a\Tris\Infrastructure;

use Cbatista8a\Tris\Domain\Interfaces\EntityInterface;
use Cbatista8a\Tris\Domain\Interfaces\RepositoryInterface;

class InMemoryRepository implements RepositoryInterface
{

    public function save(EntityInterface $entity): void
    {
        $_SESSION['games'][$entity->getId()] = $entity;
    }

    public function find($id): ?EntityInterface
    {
        return $_SESSION['games'][$id] ?? null;
    }

    public function findAll(): array
    {
        return $_SESSION['games'];
    }

    public function remove(EntityInterface $entity): void
    {
        unset($_SESSION['games'][$entity->getId()]);
    }
}