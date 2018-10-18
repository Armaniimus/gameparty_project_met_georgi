<?php require_once('header.php') ?>
</
<body>
	<div class="marginner">

	</div>
	<div class="row cinema-container">
		<?php foreach ($sample as $array_key => $value) {
			?>
				<div class="cinema">
					<div class="image-container">
						<img src="../View/images/gpp.svg" alt="">
					</div>

					<div class="information-container">

						 <?php echo $value['bioscoop_naam']; ?>
						 <?php $bioscoop_id = $value['bioscoopID']; ?>
						 <div class="buttons">
						 	<div class="button-container">
						 		<a href="reserveer/<?php echo $bioscoop_id; ?>">Reserveer</a>
						 	</div>
						 	<div class="button-container">
						 		<a href="">Detail</a>
						 	</div>

						 </div>
					</div>
				</div>
		<?php } ?>
			</div>
			<div class="marginner">

			</div>
</body>
</html>
