<?php

namespace Cbatista8a\Tris\Domain\Interfaces;

interface RepositoryInterface
{
    public function save(EntityInterface $entity);

    public function find($id): ?EntityInterface;

    public function findAll(): array;

    public function remove(EntityInterface $entity);
}