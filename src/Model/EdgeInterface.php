<?php
declare(strict_types=1);

namespace Dijkstra\Model;

/**
 * Interface EdgeInterface
 * @package Dijkstra\Model
 */
interface EdgeInterface
{
    /**
     * @param NodeInterface $node
     *
     * @return mixed
     */
    public function setBeginNode(NodeInterface $node);

    /**
     * @param NodeInterface $node
     *
     * @return mixed
     */
    public function setFinishNode(NodeInterface $node);

    /**
     * @return NodeInterface
     */
    public function getBeginNode(): NodeInterface;

    /**
     * @return NodeInterface
     */
    public function getEndNode(): NodeInterface;

    /**
     * @param int $value
     *
     * @return mixed
     */
    public function setValue(int $value);

    /**
     * @return mixed
     */
    public function markPassed();

    /**
     * @return mixed
     */
    public function isPassed();
}