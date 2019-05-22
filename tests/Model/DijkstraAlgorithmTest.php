<?php

namespace Tests\Model;

use Dijkstra\Model\DijkstraAlgorithm;
use PHPUnit\Framework\TestCase;

class DijkstraAlgorithmTest extends TestCase
{

    public function testEmpty()
    {
        $stack = [];
        $this->assertEmpty($stack);

        return $stack;
    }
}
