<?php
/**
 * Created by PhpStorm.
 * User: artem.tsepkov
 * Date: 2019-04-25
 * Time: 16:44
 */

namespace Dijkstra;

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
     * @throws \Exception
     */
    public function add(NodeInterface $node)
    {
        if (array_key_exists($node->getId(), $this->getNodes())) {
            throw new \Exception('Unable to insert multiple Nodes with the same ID in a Graph');
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
     * @throws \Exception
     */
    public function getNode($id)
    {
        $nodes = $this->getNodes();
        if (!array_key_exists($id, $nodes)) {
            throw new \Exception("Unable to find $id in the Graph");
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