<?php require_once('header.php') ?>
<body>
	<div class="row cinema-container">

		<?php foreach ($sample as $array_key => $value) {
			?>
				<div class="cinema">
					<div class="image-container">

						<img src="../View/images/960x280_kinepolisbreda_9.jpg" alt="">

					</div>
					
					<div class="information-container">
						
						 <?php echo $value['bioscoop_naam']; ?>

						 <div class="buttons">
						 	<div class="button-container">
						 		<a href="">Reserveer</a>
						 	</div>
						 	<div class="button-container">
						 		<a href="">Detail</a>
						 	</div>
						 
						 </div>

					</div>

				</div>

		<?php } ?>
			</div>
</body>
</html>