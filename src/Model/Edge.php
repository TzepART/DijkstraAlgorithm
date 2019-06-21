<?php
declare(strict_types=1);

namespace Dijkstra\Model;

class Edge implements EdgeInterface
{
    /**
     * @var NodeInterface
     */
    private $beginNode;

    /**
     * @var NodeInterface
     */
    private $endNode;

    /**
     * @var int
     */
    private $value;

    /**
     * @var boolean
     */
    private $passed;

    public function setBeginNode(NodeInterface $node): Edge
    {
        $this->beginNode = $node;

        return $this;
    }

    public function setFinishNode(NodeInterface $node): Edge
    {
        $this->endNode = $node;

        return $this;
    }

    public function getBeginNode(): NodeInterface
    {
        return $this->beginNode;
    }

    public function getEndNode(): NodeInterface
    {
        return $this->endNode;
    }

    public function setValue(int $value): Edge
    {
        $this->value = $value;

        return $this;
    }

    public function markPassed(): Edge
    {
        $this->passed = true;

        return $this;
    }

    public function isPassed()
    {
        return $this->passed;
    }
}