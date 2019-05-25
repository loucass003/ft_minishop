<?php include "components/head.php";?>
<?php include "components/navbar.php";?>

<div id="container_slides">
	<div class="slides">
		<div style="background: url('/public/slides/art42.jpg') no-repeat center center; width: 100%; height:500px"></div>
	</div>
	<div class="slides">
		<div style="background: url('/public/slides/streetartcat.jpg') no-repeat center center; width: 100%; height:500px"></div>
	</div>
	<div id="slide-left" class="slide-btn"></div>
	<div id="slide-right" class="slide-btn"></div>
</div>

<script>
	const container = document.getElementById('container_slides');
	const slides = Array.from(container.getElementsByClassName('slides'));
	let selected = 0;

	document.getElementById('slide-left').addEventListener('click', (e) => {
		selected--;
		if (selected < 0)
			selected = slides.length - 1;
		redraw();
	});

	document.getElementById('slide-right').addEventListener('click', (e) => {
		selected++;
		if (selected >= slides.length)
			selected = 0;
		redraw();
	});

	function redraw()
	{
		slides.forEach((elem, i) => {
			if (i == selected)
				elem.style.display = 'block';
			else
				elem.style.display = 'none';
		});
	}
	redraw();
</script>

<?php include "components/footer.php"; ?>