<?php
declare(strict_types=1);

namespace Dijkstra\Service;

use Dijkstra\Model\DijkstraAlgorithm;

class OutputResult implements OutputResultInterface
{
    /**
     * @var DijkstraAlgorithm
     */
    private $dijkstraAlgorithm;

    /**
     * OutputResult constructor.
     *
     * @param DijkstraAlgorithm $dijkstraAlgorithm
     */
    public function __construct(DijkstraAlgorithm $dijkstraAlgorithm)
    {
        $this->dijkstraAlgorithm = $dijkstraAlgorithm;
    }

    public function getLiteralShortestPath(): ?string
    {
        return implode(' - ', $this->dijkstraAlgorithm->solve());
    }
}
