<?php include("inc/header.php") ?>

<?php
if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
	echo " <script> window.location ='details.php'; </script>";
} else {
	$id = $_GET['catId'];
	$getCategoryProducts = $cat->getCategoryProductsById($id);
}
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Latest from Category</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php

			if ($getCategoryProducts) {
				while ($result = $getCategoryProducts->fetch_assoc()) {
			?>
						<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php?productId=<?php echo $result['productid']; ?>"><img height="200px" width="150px" src="admin/<?php echo $result['image']; ?>" alt="" /></a>
						<h2><?php echo $result['productname']; ?> </h2>
						<p><?php echo $fm->textShorten($result['body'], 100); ?></p>
						<p><span class="price">$<?php echo $result['price']; ?></span></p>
						<div class="gradient-button gradient-button-3"><span><a href="details.php?productId=<?php echo $result['productid']; ?>" class="details">Details</a></span></div>
					</div>
			<?php 	}
			} else{				
				echo "Product Out of Stock.Comming soon..";	
			}?>
		</div>



	</div>
</div>
</div>
<?php include("inc/footer.php") ?>