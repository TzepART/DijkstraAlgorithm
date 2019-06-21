<?php
declare(strict_types=1);

namespace Dijkstra\Model;

class Node implements NodeInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $potentialPathDistance;

    /**
     * @var NodeInterface
     */
    protected $potentialNodeFrom;

    /**
     * @var array
     */
    protected $edges = [];


    /**
     * Instantiates a new node, requiring a ID to avoid collisions.
     *
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Returns the identifier of this node.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Connects the node to another $node.
     * A $distance, to balance the edge, can be specified.
     *
     * @param EdgeInterface $edge
     *
     * @return Node
     */
    public function addEdge(EdgeInterface $edge): Node
    {
        $this->edges[] = $edge;
        return $this;
    }

    /**
     * Get the edges of the current node.
     *
     * @return array
     */
    public function getEdges()
    {
        return $this->edges;
    }

    /**
     * Sets the potential for the node, if the node has no potential or the
     * one it has is higher than the new one.
     *
     * @param integer       $potential
     * @param NodeInterface $from
     *
     */
    public function setPotentialPathDistance(int $potential, NodeInterface $from): void
    {
        if (!$this->getPotentialPathDistance() || $potential < $this->getPotentialPathDistance()) {
            $this->potentialPathDistance = $potential;
            $this->potentialNodeFrom     = $from;
        }
    }

    /**
     * Get node's potential.
     *
     * @return integer
     */
    public function getPotentialPathDistance(): ?int
    {
        return $this->potentialPathDistance;
    }

    /**
     * Get the node which gave to the current node its potential.
     *
     * @return NodeInterface
     */
    public function getPotentialNodeFrom(): NodeInterface
    {
        return $this->potentialNodeFrom;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->id;
    }
}