<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container">
	<?php if (isset($error)) : ?>
	<h1 class="error">Error: <?= $error ?></h1>
	<?php endif; ?>
	<h1>CART</h1>
	<div class="box">
		<h2>PRODUCTS ADDED TO CART</h2>
		<div id="table">
			<div id="print-display" style="display:none">
				<h1 align="center">FT_MINISHOP BILL</h1>
				<p>Account id <?= $_SESSION['user']['id'] ?></p>
				<p>Name <?= $_SESSION['user']['login'] ?></p>
			</div>
		<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		td, th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		tr {
			background-color: #e2e2e2;
		}

		tr:nth-child(even){
			background-color: #f2f2f2;
		}

		th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: left;
			background-color: #1867c0;
			color: white;
		}
		</style>
		<table style="width: 100%" >
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Price</th>
					<th>Amount</th>
					<th>Total price</th>
					<th id="action-col">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $product) : ?>
				<tr>
					<td><?= $product['id'] ?></td>
					<td><?= $product['name'] ?></td>
					<td><?= $product['price'] ?>€</td>
					<td><?= $product['amount'] ?></td>
					<td><?= $product['totalprice'] ?>€</td>
					<td align="right" class="action">
						<form action="/home/cart" method="post">
							<input type="hidden" name="id" value="<?= $product['id'] ?>">
							<input type="submit" name="delproduct" value="delete">
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<p>TOTAL : <?= $total ?>€</p>
		</div>
		<form action="/home/cart" method="post">
			<input type="submit" name="submitorder" value="comfirm my order" style="width: 48%">
			<input type="submit" name="cancelcart" value="clear my cart" style="width: 48%; float right; right: 0; display: inline">	
		</form>
		<?php if (isset($_SESSION['user'])) : ?>
		<button id="print">Print</button>
		<?php endif; ?>
	</div>
</div>

<script>

const btn = document.getElementById('print');

btn.addEventListener('click', () => {
	console.log('click');
	const elems =  Array.from(document.getElementsByClassName('action'));
	const col = document.getElementById('action-col');
	const title = document.getElementById('print-display');
	title.style.display = 'block';
	col.style.display = 'none';
	console.log(elems);
	elems.forEach((e) => e.style.display = 'none');
	printJS({ printable: 'table', type: 'html'});
	elems.forEach((e) => e.style.display = 'block');
	col.style.display = 'block';
	title.style.display = 'none';
});
console.log(btn);

</script>

<?php include "components/footer.php"; ?>
