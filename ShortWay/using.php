<?php
declare(strict_types=1);

require __DIR__ . "/../autoload.php";

use \ShortWay\Graph;
use \ShortWay\Node;
use \ShortWay\Dijkstra;

function printShortestPath($from_name, $to_name, $routes)
{
    $graph = new Graph();
    foreach ($routes as $route) {
        $from  = $route['from'];
        $to    = $route['to'];
        $price = $route['price'];
        if (!array_key_exists($from, $graph->getNodes())) {
            $from_node = new Node($from);
            $graph->add($from_node);
        } else {
            $from_node = $graph->getNode($from);
        }
        if (!array_key_exists($to, $graph->getNodes())) {
            $to_node = new Node($to);
            $graph->add($to_node);
        } else {
            $to_node = $graph->getNode($to);
        }
        $from_node->connect($to_node, $price);
    }

    $g          = new Dijkstra($graph);
    $start_node = $graph->getNode($from_name);
    $end_node   = $graph->getNode($to_name);
    $g->setStartingNode($start_node);
    $g->setEndingNode($end_node);
    echo "From: " . $start_node->getId() . "\n";
    echo "To: " . $end_node->getId() . "\n";
    echo "Route: " . $g->getLiteralShortestPath() . "\n";
    echo "Total: " . $g->getDistance() . "\n";
}

function createGraph(int $countNodes, array $nodes = [], array $prevNodeKeys = [])
{
    if ($countNodes > 1) {
        $curNodeKeys = [];
        if (count($nodes) == 0) {
            $current = 1;
            $next = 2;
            for ($i = 1; $i <= $countNodes; $i++) {
                $nodes[] = ['from' => $current, 'to' => $next, 'price' => rand(10,100)];
                $curNodeKeys[] = $current;
                $current = $next;
                if($current == $countNodes){
                    $next = 1;
                }else{
                    $next++;
                }
            }
        }else{
            $current = 1;
            $next = $nodes[count($nodes)-1]['from'] + 1;
            for ($i = 1; $i <= $countNodes; $i++) {
                $nodes[] = ['from' => $current, 'to' => $next, 'price' => rand(10,100)];
                $nodes[] = ['from' => $next, 'to' => array_shift($prevNodeKeys), 'price' => rand(10,100)];
                $nodes[] = ['from' => $next, 'to' => array_shift($prevNodeKeys), 'price' => rand(10,100)];
                $curNodeKeys[] = $current;
                $current = $next;
                if($current == $countNodes){
                    $next = 1;
                }else{
                    $next++;
                }
            }
        }

        $countNodes = $countNodes / 2;

        return createGraph($countNodes, $nodes, $curNodeKeys);
    } else {
        return $nodes;
    }
}

function showRoutes(array $routes){
    foreach ($routes as $index => $route) {
//        echo "From: " . $route['from'];
//        echo "; To: " . $route['to'];
//        echo "; Value: " . $route['price'] . PHP_EOL;

        echo $route['from']." " . $route['to']. PHP_EOL;
    }
}

$routes = createGraph(32);
//showRoutes($routes);

//$routes[] = ['from' => 'a', 'to' => 'b', 'price' => 200];
//$routes[] = ['from' => 'b', 'to' => 'g', 'price' => 100];
//$routes[] = ['from' => 'g', 'to' => 'e', 'price' => 600];
//$routes[] = ['from' => 'b', 'to' => 'd', 'price' => 300];
//$routes[] = ['from' => 'd', 'to' => 'e', 'price' => 50];
//$routes[] = ['from' => 'a', 'to' => 'c', 'price' => 300];
//$routes[] = ['from' => 'c', 'to' => 'e', 'price' => 400];
//$routes[] = ['from' => 'a', 'to' => 'h', 'price' => 100];
//$routes[] = ['from' => 'h', 'to' => 'f', 'price' => 200];
//$routes[] = ['from' => 'f', 'to' => 'e', 'price' => 100];

printShortestPath(1, 23, $routes);












