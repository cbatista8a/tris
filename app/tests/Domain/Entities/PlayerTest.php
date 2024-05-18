<?php

namespace Cbatista8a\Tris\Tests\Domain\Entities;

use Cbatista8a\Tris\Domain\Entities\Player;
use Exception;
use PHPUnit\Framework\TestCase;


class PlayerTest extends TestCase
{
    private Player $player;

    public function setUp(): void
    {
        $this->player = new Player(1, 'Carlos');
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testIncreaseScore(): void
    {
        $number = random_int(1, 5);
        for ($i = 0; $i < $number; $i++){
            $this->player->increaseScore();
        }
        $this->assertEquals($number, $this->player->getScore());
    }

    public function testGetSymbol(): void
    {
        $this->assertEquals('C', $this->player->getSymbol());
    }
}
