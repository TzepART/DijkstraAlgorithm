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
    protected $potential;

    /**
     * @var NodeInterface
     */
    protected $potentialFrom;

    /**
     * @var array
     */
    protected $connections = [];

    /**
     * @var bool
     */
    protected $passed = false;

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
     * A $distance, to balance the connection, can be specified.
     *
     * @param NodeInterface $node
     * @param integer       $distance
     */
    public function addConnection(NodeInterface $node, $distance = 1): void
    {
        $this->connections[$node->getId()] = $distance;
    }

    /**
     * Get the connections of the current node.
     *
     * @return array
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * Get the distance to the node.
     *
     * @param NodeInterface $node
     *
     * @return array
     * TODO add exception if connection does not exist
     */
    public function getDistanceByNode(NodeInterface $node)
    {
        return $this->connections[$node->getId()];
    }

    /**
     * Sets the potential for the node, if the node has no potential or the
     * one it has is higher than the new one.
     *
     * @param integer       $potential
     * @param NodeInterface $from
     *
     * @return bool
     */
    public function setPotential(int $potential, NodeInterface $from): bool
    {
        if (!$this->getPotential() || $potential < $this->getPotential()) {
            $this->potential     = $potential;
            $this->potentialFrom = $from;

            return true;
        }

        return false;
    }

    /**
     * Get node's potential.
     *
     * @return integer
     */
    public function getPotential(): ?int
    {
        return $this->potential;
    }

    /**
     * Get the node which gave to the current node its potential.
     *
     * @return NodeInterface
     */
    public function getPotentialFrom(): NodeInterface
    {
        return $this->potentialFrom;
    }

    /**
     * Get whether the node has passed or not.
     *
     * @return bool
     */
    public function isPassed(): bool
    {
        return $this->passed;
    }

    /**
     * Marks this node as passed, meaning that, in the scope of a graph, he
     * has already been processed in order to calculate its potential.
     */
    public function markPassed(): void
    {
        $this->passed = true;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->id;
    }
}