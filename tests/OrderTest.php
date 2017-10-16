<?php

require_once(__DIR__ . '/../models/OrderModel.php');

use Model\OrderModel;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
	public function testValidateOrder()
	{
		$orderModel = new OrderModel();
		
		
		$this->assertFalse($orderModel->validateOrderStoreUser(['email' => '']));
		$this->assertTrue($orderModel->validateOrderStoreUser(['user' =>
			['email' => 'weiwangfly@hotmail.com', 
			'name' => 'test name', 
			'address' => 'test address',
			'phone' => 'test phone',]
		]));
		
	}

}