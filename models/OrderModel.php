<?php

namespace Model;

use \PDO;
use \DateTime;

class OrderModel
{
    public function find($id = null)
    {
        
        $db = DB::getInstance();
        $orderRows = [];
        $columns = 'orders.id, orders.created_at, users.name AS user_name, users.email, users.phone, users.address';
        $orderSql = 'SELECT ' . $columns . ' FROM orders JOIN users ON users.id  = orders.user_id';
        if (empty($id)) {
            $orderStmt = $db->prepare($orderSql);
            $orderStmt->execute();
        } else {
            $orderSql .= ' WHERE orders.id = ?';
            $orderStmt = $db->prepare($orderSql);
            $orderStmt->execute([$id]);            
        }
        $orderRows = $orderStmt->fetchAll(PDO::FETCH_ASSOC);

        $selectUserSql = 'SELECT * FROM users WHERE email = ?';
        $selectUserStmt = $db->prepare($selectUserSql);
        $selectUserStmt->execute([$postArray['user']['email']]);


        foreach ($orderRows as $orderKey => $orderRow) {

            $stmt = $db->prepare('SELECT product_name, quantity, product_id FROM order_product JOIN products ON order_product.product_id = products.id WHERE order_id = ?');
            $stmt->execute([$orderRow['id']]);
            $orderRows[$orderKey]['products'][] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $orderRows;
    }


    public function validateOrderStoreProduct($postArray)
    {
        $ids = [];
        foreach ($postArray['products'] as $product) {
            $ids[] = $product['product_id'];
        }
        $db = DB::getInstance();
        $idSql = implode(',', array_fill(0, count($ids), '?'));
        $validateStmt = $db->prepare('SELECT COUNT(DISTINCT id) AS total FROM products WHERE id IN (' . $idSql . ') ');
        $validateStmt->execute($ids);
        $count = $validateStmt->fetch(PDO::FETCH_ASSOC)['total'];
        return (int)$count === count($ids);   
    }

    public function validateOrderStoreUser($postArray)
    {
        return !empty($postArray['user']['email']) && !empty($postArray['user']['name']) && !empty($postArray['user']['address'])
            && !empty($postArray['user']['phone']);
    }

    public function save($postArray)
    {
        $db = DB::getInstance();
        $selectUserSql = 'SELECT * FROM users WHERE email = ?';
        $selectUserStmt = $db->prepare($selectUserSql);
        $selectUserStmt->execute([$postArray['user']['email']]);
        $creator = $selectUserStmt->fetchAll(PDO::FETCH_ASSOC);
        $userId = null;
        if (empty($creator)) {
            $insertUserStmt = $db->prepare('INSERT INTO users(email, address, phone, name) VALUES (?,?,?,?)');
            $insertUserStmt->execute([
                $postArray['user']['email'],
                $postArray['user']['address'],
                $postArray['user']['phone'],
                $postArray['user']['name'],
            ]);
            $userId = $db->lastInsertId();
        } else {
            $userId = $creator[0]['id'];
        }


        $insertOrderSql = 'INSERT INTO orders(created_at, user_id) VALUES (?, ?)';
        $insertOrderStmt = $db->prepare($insertOrderSql);
        $insertOrderStmt->execute([(new DateTime())->format('Y-m-d H:i:s'), $userId]);
        $insertedOrderId = $db->lastInsertId();
        
        foreach ($postArray['products'] as $product) {
            $insertOrderProductSql = 'INSERT INTO order_product(order_id, product_id, quantity) VALUES (?,?,?)';
            $insertOrderProductStmt = $db->prepare($insertOrderProductSql);
            $insertOrderProductStmt->execute([$insertedOrderId, $product['product_id'], $product['quantity']]);
        }

        return true;
    }


}