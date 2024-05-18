<?php

namespace Cbatista8a\Tris\Domain\Interfaces;

interface RepositoryInterface
{
    public function save(EntityInterface $entity);

    public function find(string $class_name,int $id): ?EntityInterface;

    public function findAll(string $class_name): array;

    public function remove(EntityInterface $entity);
}