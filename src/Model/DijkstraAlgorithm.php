<?php
declare(strict_types=1);

namespace Dijkstra\Model;

use Dijkstra\ConstantMessage;
use Dijkstra\Exception\CannotCalculateDistanceException;
use Dijkstra\Exception\CannotSolveWithoutBeginOrEndException;

class DijkstraAlgorithm
{
    private $startingNode;

    private $endingNode;

    private $graph;

    private $paths    = [];

    private $solution = false;

    /**
     * Instantiates a new algorithm, requiring a graph to work with.
     *
     * @param Graph $graph
     */
    public function __construct(Graph $graph)
    {
        $this->graph = $graph;
    }

    /**
     * Returns the distance between the starting and the ending point.
     *
     * @return integer
     */
    public function getDistance()
    {
        if (!$this->isSolved()) {
            throw new CannotCalculateDistanceException(ConstantMessage::CAN_NOT_CALCULATE_DISTANCE_ERROR);
        }

        return $this->getEndingNode()->getPotential();
    }

    /**
     * Gets the node which we are pointing to.
     *
     * @return Node
     */
    public function getEndingNode()
    {
        return $this->endingNode;
    }

    /**
     * Returns the solution in a human-readable style.
     *
     * @return string
     */
    public function getLiteralShortestPath()
    {
        $path    = $this->solve();
        $literal = '';
        foreach ($path as $p) {
            $literal .= "{$p->getId()} - ";
        }

        return substr($literal, 0, count($literal) - 4);
    }

    /**
     * Reverse-calculates the shortest path of the graph thanks the potentials
     * stored in the nodes.
     *
     * @return array
     */
    public function getShortestPath()
    {
        $path = [];
        $node = $this->getEndingNode();
        while ($node->getId() != $this->getStartingNode()->getId()) {
            $path[] = $node;
            $node   = $node->getPotentialFrom();
        }
        $path[] = $this->getStartingNode();

        return array_reverse($path);
    }

    /**
     * Retrieves the node which we are starting from to calculate the shortest path.
     *
     * @return Node
     */
    public function getStartingNode()
    {
        return $this->startingNode;
    }

    /**
     * Sets the node which we are pointing to.
     *
     * @param Node $node
     */
    public function setEndingNode(Node $node)
    {
        $this->endingNode = $node;
    }

    /**
     * Sets the node which we are starting from to calculate the shortest path.
     *
     * @param Node $node
     */
    public function setStartingNode(Node $node)
    {
        $this->paths[]      = [$node];
        $this->startingNode = $node;
    }

    /**
     * Solves the algorithm and returns the shortest path as an array.
     *
     * @return array
     */
    public function solve()
    {
        if (!$this->getStartingNode() || !$this->getEndingNode()) {
            throw new CannotSolveWithoutBeginOrEndException(ConstantMessage::CAN_NOT_SOLVE_WITHOUT_BEGIN_OR_END_ERROR);
        }
        $this->calculatePotentials($this->getStartingNode());
        $this->solution = $this->getShortestPath();

        return $this->solution;
    }

    /**
     * Recursively calculates the potentials of the graph, from the
     * starting point you specify with ->setStartingNode(), traversing
     * the graph due to Node's $connections attribute.
     *
     * @param Node $node
     */
    protected function calculatePotentials(Node $node)
    {
        $connections = $node->getConnections();
        $sorted      = array_flip($connections);
        krsort($sorted);
        foreach ($connections as $id => $distance) {
            $v = $this->getGraph()->getNode($id);
            $v->setPotential($node->getPotential() + $distance, $node);
            foreach ($this->getPaths() as $path) {
                $count = count($path);
                if ($path[$count - 1]->getId() === $node->getId()) {
                    $this->paths[] = array_merge($path, [$v]);
                }
            }
        }
        $node->markPassed();
        // Get loop through the current node's nearest connections
        // to calculate their potentials.
        foreach ($sorted as $id) {
            $node = $this->getGraph()->getNode($id);
            if (!$node->isPassed()) {
                $this->calculatePotentials($node);
            }
        }
    }

    /**
     * Returns the graph associated with this algorithm instance.
     *
     * @return Graph
     */
    protected function getGraph()
    {
        return $this->graph;
    }

    /**
     * Returns the possible paths registered in the graph.
     *
     * @return array
     */
    protected function getPaths()
    {
        return $this->paths;
    }

    /**
     * Checks wheter the current algorithm has been solved or not.
     *
     * @return bool
     */
    protected function isSolved()
    {
        return (bool) $this->solution;
    }
}
