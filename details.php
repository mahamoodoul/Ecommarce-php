<?php include("inc/header.php") ?>

<?php
// echo session_id();
if (!isset($_GET['productId']) || $_GET['productId'] == NULL) {
	echo " <script> window.location ='404.php'; </script>";
} else {
	// $id = $_GET['brandid'];
	$id = preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['productId']);

	// $getProductDetails
}
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$quantity = $_POST['quantity'];
	$addCart = $ct->addToCart($quantity, $id);
	if ($addCart) {
		echo $addCart;
	}
}

?>

<div class="main">
	<div class="content">
		<div class="section group">
			<div class="cont-desc span_1_of_2">


				<?php
				$getProductDetails = $pd->getSingleProducts($id);
				if ($getProductDetails) {
					while ($result = $getProductDetails->fetch_assoc()) {
				?>

						<div class="grid images_3_of_2">
							<!-- imageZoom -->
							<img id="imageZoom2" src="admin/<?php echo $result['image']; ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result['productname']; ?> </h2>
							<p><?php echo $result['body']; ?></p>
							<div class="price">
								<p>Price: <span>$<?php echo $result['price']; ?></span></p>
								<p>Category: <span><?php echo $result['catname']; ?></span></p>
								<p>Brand:<span><?php echo $result['name']; ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>
							</div>
						</div>


						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?php echo $result['body']; ?></p>
						</div>
				<?php 		}
				} ?>
			</div>

			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<?php
				$getCat = $cat->getallcat();
				if ($getCat) {
					while ($category = $getCat->fetch_assoc()) {


				?>
						<ul>
							<li><a href="productbycat.php?catId=<?php echo $category['catid']; ?>"><?php echo $category['catname']; ?></a></li>
						</ul>
				<?php
					}
				}
				?>

			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="dist/js/image-zoom.min.js"></script>



		<script>
			$(document).ready(function() {
				$('#imageZoom').imageZoom();
				$('#imageZoom2').imageZoom({
					zoom: 200
				});
			});
		</script>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-36251023-1']);
			_gaq.push(['_setDomainName', 'jqueryscript.net']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();
		</script>
		<script>
			try {
				fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", {
					method: 'HEAD',
					mode: 'no-cors'
				})).then(function(response) {
					return true;
				}).catch(function(e) {
					var carbonScript = document.createElement("script");
					carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
					carbonScript.id = "_carbonads_js";
					document.getElementById("carbon-block").appendChild(carbonScript);
				});
			} catch (error) {
				console.log(error);
			}
		</script>
	</div>

</div>
<?php include("inc/footer.php") ?>