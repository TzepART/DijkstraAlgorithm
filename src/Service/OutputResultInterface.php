<?php
declare(strict_types=1);

namespace Dijkstra\Service;

interface OutputResultInterface
{
    public function getLiteralShortestPath():? string;
}