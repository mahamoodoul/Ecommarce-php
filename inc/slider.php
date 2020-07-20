<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">


			<?php
			$iphone = $pd->latestFromIphone();
			if ($iphone) {
				while ($result = $iphone->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productId=<?php echo $result['productid']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Iphone</h2>
							<p><?php echo $result['productname']; ?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo $result['productid']; ?>">Add to cart</a></span></div>
						</div>
					</div>

			<?php }
			} ?>

			<?php
			$onePLus = $pd->latestFromOnePlus();
			if ($onePLus) {
				while ($result = $onePLus->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productId=<?php echo $result['productid']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>One Plus</h2>
							<p><?php echo $result['productname']; ?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo $result['productid']; ?>">Add to cart</a></span></div>
						</div>
					</div>

			<?php }
			} ?>
		</div>

		<div class="section group">

			<?php
			$samsung = $pd->latestFromSamsung();
			if ($samsung) {
				while ($result = $samsung->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productId=<?php echo $result['productid']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Samsungs</h2>
							<p><?php echo $result['productname']; ?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo $result['productid']; ?>">Add to cart</a></span></div>
						</div>
					</div>

			<?php }
			} ?>

			<?php
			$lg = $pd->latestFromLg();
			if ($lg) {
				while ($result = $lg->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?productId=<?php echo $result['productid']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Lg</h2>
							<p><?php echo $result['productname']; ?></p>
							<div class="button"><span><a href="details.php?productId=<?php echo $result['productid']; ?>">Add to cart</a></span></div>
						</div>
					</div>

			<?php }
			} ?>
		</div>

		<div class="clear"></div>
	</div>
	<div class="header_bottom_right_images">
		<!-- FlexSlider -->

		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<li><img src="images/1.jpg" alt="" /></li>
					<li><img src="images/2.jpg" alt="" /></li>
					<li><img src="images/3.jpg" alt="" /></li>
					<li><img src="images/4.jpg" alt="" /></li>
				</ul>
			</div>
		</section>
		<!-- FlexSlider -->
	</div>
	<div class="clear"></div>
</div>