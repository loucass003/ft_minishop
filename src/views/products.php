<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container"  style="display: flex; flex-direction: row; flex-wrap: wrap">
	<?php foreach ($products as $product) : ?>
	<div class="product">
		<form method="post">
			<div class="title"><?= $product['name'] ?></div>
			<div class="img-container">
				<img src="/<?= PRODUCTS_FOLDER.'/'.$product['id'] ?>" width="100%">
			</div>
			<p><?= $product['price'] ?> €</p>
			<input type="hidden" name="id" value="<?= $product['id'] ?>">
			<input type="number" name="amount" value="1">
			<button type="submit" name="addcart" value="Add">Add to chart</button>
		</form>
	</div>
	<?php endforeach; ?>
</div>

<?php include "components/footer.php"; ?>
