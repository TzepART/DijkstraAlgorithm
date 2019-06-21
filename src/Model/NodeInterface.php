<?php
declare(strict_types=1);

namespace Dijkstra\Model;

interface NodeInterface
{
    /**
     * Returns the identifier of this node.
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Connects the node to another $node.
     * A $distance, to balance the edge, can be specified.
     *
     * @param EdgeInterface $edge
     */
    public function addEdge(EdgeInterface $edge);

    /**
     * Returns the edges of the current node.
     *
     * @return array
     */
    public function getEdges();

    /**
     * Sets the potential path distance for the node, if the node has no potential or the
     * one it has is higher than the new one.
     *
     * @param integer       $potential
     * @param NodeInterface $from
     */
    public function setPotentialPathDistance(int $potential, NodeInterface $from): void;

    /**
     * Get node's potential path distance.
     *
     * @return integer|null
     */
    public function getPotentialPathDistance(): ?int;

    /**
     * Returns the node which gave to the current node its potential.
     *
     * @return NodeInterface
     */
    public function getPotentialNodeFrom(): NodeInterface;

    /**
     * @return string
     */
    public function __toString(): string;
}