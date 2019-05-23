<?php
declare(strict_types=1);

namespace Dijkstra\Model;

use Dijkstra\Exception\UnableInsertMultipleNodesException;
use Dijkstra\Exception\UnableFindInGraphException;

interface GraphInterface
{

    /**
     * Adds a new node to the current graph.
     *
     * @param NodeInterface $node
     *
     * @return Graph
     * @throws UnableInsertMultipleNodesException
     */
    public function addNode(NodeInterface $node);

    /**
     * Get the node identified with the $id associated to this graph.
     *
     * @param int $id
     *
     * @return NodeInterface
     * @throws UnableFindInGraphException
     */
    public function getNode(int $id): NodeInterface;

    /**
     * Get all the nodes that belong to this graph.
     *
     * @return array
     */
    public function getNodes(): array;
}
