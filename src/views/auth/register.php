<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div class="container-center">
	<div class="vertical-center">
		<?php if (isset($error)) : ?>
		<h1 class="error">Error: <?= $error ?></h1>
		<?php endif; ?>
		<div class="box login">
			<h1>Instcription</h1>
			<form action="/auth/register" method="post">
				<p><input type="text" placeholder="login" name="login" required></p>
				<p><input type="password" placeholder="passwd" name="passwd" required></p>
				<p><input type="password" placeholder="confirm" name="confirm" required></p>
				<p><input type="submit" name="submit" value="Inscription"></p>
			</form>
		</div>
	</div>
</div>

<?php include "components/footer.php"; ?>
