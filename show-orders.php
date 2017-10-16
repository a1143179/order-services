<?php

$orders = file_get_contents('http://order-services.dev/orders'); // you need to change this to your local
$orders = json_decode($orders, true);

?>


<table border="1">
<thead>
	<th>ID</th>
	<th>User Name</th>
	<th>Email</th>
	<th>Products</th>
</thead>
<tbody>
<?php foreach ($orders as $order) { ?>
	<tr>
		<td><?= $order['id'] ?></td>
		<td><?= $order['user_name'] ?></td>
		<td><?= $order['email'] ?></td>
		<td>
			<table>
			<?php foreach ($order['products'] as $product) { ?>
				<tr>
					<td><?= $product['product_name'] ?></td>
					<td><?= $product['quantity'] ?></td>
				</tr>

			<?php } ?>
			</table>
		</td>
	</tr>
<?php } ?>
</tbody>
</table>