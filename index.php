<?php

require 'vendor/autoload.php';
require_once('models/DB.php');
require_once('models/OrderModel.php');

use Model\OrderModel;
use Model\DB;


function orders_index()
{
    $orderModel = new OrderModel();
    echo json_encode($orderModel->find());
}

function orders_show($vars)
{
    $orderModel = new OrderModel();
    echo json_encode($orderModel->find($vars['id']));
}

function orders_store()
{
    $orderModel = new OrderModel();
    $postArray = json_decode(file_get_contents('php://input'), true);
    if (!$orderModel->validateOrderStoreProduct($postArray)) {
        echo json_encode(['status' => 'error', 'message' => 'Error: invalid products']);
        exit;
    }
    if (!$orderModel->validateOrderStoreUser($postArray)) {
        echo json_encode(['status' => 'error', 'message' => 'Error: invalid user information']);
        exit;
    }
    $orderModel->save($postArray);
    echo json_encode(['status' => 'ok']);
}


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/orders', 'orders_index');
    // {id} must be a number (\d+)
    $r->addRoute('GET', '/orders/{id:\d+}', 'orders_show');
    
    $r->addRoute('POST', '/orders', 'orders_store');

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        throw new Exception('error: not found.');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        throw new Exception('error: method not allowed.');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $handler($vars);
        break;
}