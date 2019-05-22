<?php
declare(strict_types=1);

namespace Dijkstra\Model;

use Dijkstra\ConstantMessage;
use Dijkstra\Exception\UnableInsertMultipleNodesException;
use Dijkstra\Exception\UnableFindInGraphException;

class Graph implements GraphInterface
{
    /**
     * All the nodes in the graph
     *
     * @var array
     */
    protected $nodes = [];

    /**
     * Adds a new node to the current graph.
     *
     * @param NodeInterface $node
     *
     * @return Graph
     * @throws UnableInsertMultipleNodesException
     */
    public function add(NodeInterface $node)
    {
        if (array_key_exists($node->getId(), $this->getNodes())) {
            throw new UnableInsertMultipleNodesException(ConstantMessage::UNABLE_INSERT_MULTIPLE_NODES_ERROR);
        }
        $this->nodes[$node->getId()] = $node;

        return $this;
    }

    /**
     * Returns the node identified with the $id associated to this graph.
     *
     * @param mixed $id
     *
     * @return Node
     * @throws UnableFindInGraphException
     */
    public function getNode(int $id)
    {
        $nodes = $this->getNodes();
        if (!array_key_exists($id, $nodes)) {
            throw new UnableFindInGraphException(sprintf(ConstantMessage::UNABLE_FIND_IN_GRAPH_ERROR, $id));
        }

        return $nodes[$id];
    }

    /**
     * Returns all the nodes that belong to this graph.
     *
     * @return array
     */
    public function getNodes()
    {
        return $this->nodes;
    }
}