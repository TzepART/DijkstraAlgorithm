<?php
declare(strict_types=1);

namespace Dijkstra\Model;

interface NodeInterface
{
    /**
     * Connects the node to another $node.
     * A $distance, to balance the connection, can be specified.
     *
     * @param NodeInterface $node
     * @param integer       $distance
     */
    public function connect(NodeInterface $node, $distance = 1);

    /**
     * Returns the connections of the current node.
     *
     * @return array
     */
    public function getConnections();

    /**
     * Returns the identifier of this node.
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Returns node's potential.
     *
     * @return integer|null
     */
    public function getPotential():? int;

    /**
     * Returns the node which gave to the current node its potential.
     *
     * @return NodeInterface
     */
    public function getPotentialFrom(): NodeInterface;

    /**
     * Returns whether the node has passed or not.
     *
     * @return bool
     */
    public function isPassed(): bool;

    /**
     * Marks this node as passed, meaning that, in the scope of a graph, he
     * has already been processed in order to calculate its potential.
     * @return void
     */
    public function markPassed(): void;

    /**
     * Sets the potential for the node, if the node has no potential or the
     * one it has is higher than the new one.
     *
     * @param integer       $potential
     * @param NodeInterface $from
     *
     * @return bool
     */
    public function setPotential($potential, NodeInterface $from): bool;
}