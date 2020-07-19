<?php include("inc/header.php") ?>
<?php include("inc/slider.php") ?>


<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">

			<?php
			$getProduct = $pd->getFeatureProduct();
			if ($getProduct) {
				while ($result = $getProduct->fetch_assoc()) {


			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php?productId=<?php echo $result['productid']; ?>"><img height="200px" width="150px" src="admin/<?php echo $result['image']; ?>" alt="" /></a>
						<h2><?php echo $result['productname']; ?> </h2>
						<p><?php echo $fm->textShorten($result['body'], 100); ?></p>
						<p><span class="price">$<?php echo $result['price']; ?></span></p>
						<div class="gradient-button gradient-button-3"><span><a href="details.php?productId=<?php echo $result['productid']; ?>" class="details">Details</a></span></div>
					</div>

			<?php 	}
			} ?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">

			<?php

			$NewProduct = $pd->getNewProduct();
			if ($NewProduct) {
				while ($result = $NewProduct->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?productId=<?php echo $result['productid']; ?>"><img height="200px" width="150px" src="admin/<?php echo $result['image']; ?>" alt="" /></a>
						<h2><?php echo $result['productname']; ?> </h2>
						<p><?php echo $fm->textShorten($result['body'], 100); ?></p>
						<p><span class="price">$<?php echo $result['price']; ?></span></p>
						<div class="gradient-button gradient-button-3"><span><a href="details.php?productId=<?php echo $result['productid']; ?>" class="details">Details</a></span></div>
					</div>
			<?php }
			} ?>
		</div>
	</div>
</div>
</div>
<?php include("inc/footer.php") ?>