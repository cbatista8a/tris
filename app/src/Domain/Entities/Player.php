<?php

/**
 * Player Entity
 */
class Player
{
    private int $id;

    private string $name;
    private string $symbol;
    private int $score;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->symbol = strtoupper($name[0]);
        $this->score = 0;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function increaseScore(): int
    {
        return $this->score++;
    }

    public function getName(): string
    {
        return $this->name;
    }
}