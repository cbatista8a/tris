<?php

namespace Cbatista8a\Tris\Infrastructure;

use Cbatista8a\Tris\Domain\Interfaces\EntityInterface;
use Cbatista8a\Tris\Domain\Interfaces\RepositoryInterface;

class InMemoryRepository implements RepositoryInterface
{

    public function save(EntityInterface $entity): void
    {
        $_SESSION[get_class($entity)][$entity->getId()] = $entity;
    }

    public function find(string $class_name,int $id): ?EntityInterface
    {
        return $_SESSION[$class_name][$id] ?? null;
    }

    public function findAll(string $class_name): array
    {
        return $_SESSION[$class_name];
    }

    public function remove(EntityInterface $entity): void
    {
        unset($_SESSION[get_class($entity)][$entity->getId()]);
    }
}