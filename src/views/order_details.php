<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container">
	<h1>MY ORDER HISTORY</h1>
	<div class="box">
		<table style="width: 100%">
			<thead>
				<h2>ORDER # <?=$id?></h2>
				<tr>
					<th>PRODUCT</th>
					<th>PRICE</th>
					<th>AMOUNT</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $product) : ?>
				<tr>
					<td><?= $product['name'] ?></td>
					<td><?= $product['price'] ?></td>
					<td><?= $product['amount']?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
            <p style="text-align:right;"><b>TOTAL AMOUNT: €<?= $order_sum[$id]?></b></p>
            <div class="btn"><a href="/users/orders">RETURN</a></div>
	</div>
</div>

<?php include "components/footer.php"; ?>
