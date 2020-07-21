<?php
include "lib/Session.php";
Session::init();
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/FormatData.php');



?>
<?php

spl_autoload_register(function ($class) {
	include_once "classes/" . $class . ".php";
});

$db = new Database();
$fm = new FormatData();
$pd = new Product();
$ct = new Cart();
$cat = new Category();
$customer = new Customer();



?>
<?php
$sId = session_id();
$cartInHeader = $ct->cartHintinHeadder($sId);

?>

<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>

<head>
	<title>Store Website</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<!-- imagezoom -->


	<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" href="dist/css/image-zoom.css" />


	<!-- end image zoom -->


	<script type="text/javascript">
		$(document).ready(function($) {
			$('#dc_mega-menu-orange').dcMegaMenu({
				rowItems: '4',
				speed: 'fast',
				effect: 'fade'
			});
		});
	</script>
</head>

<body>
	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo/logo4.png" style="height: 100px; width:280px;" alt="" /></a>
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form>
						<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
							<?php
							$login = Session::get("customerLogin");
							if ($login == true) {
							?>
								<?php if (isset($cartInHeader)) {
									// var_dump($cartInHeader);
									// die();
									$count = $cartInHeader['count'];
									$total = $cartInHeader['grandTotal'];
									$totalQuantity = $cartInHeader['totalQuantity'];
									$grandTotal = ($total + ($total * (10 / 100)));
								?>

									<!-- <span class="cart_title">Cart</span> -->
									<span class="has_product"> P:<?php echo $count; ?>|Q:<?php echo $totalQuantity; ?>($<?php echo $grandTotal; ?>)</span>
								<?php
								} else { ?>
									<span class="cart_title">Cart</span>
									<span class="no_product">(Empty)</span>
								<?php }
							} else { ?>

								<span class="cart_title">Cart</span>
								<span class="no_product">(Null)</span>

							<?php } ?>
						</a>
					</div>
				</div>

				<?php
				if (isset($_GET['cId'])) {

					$delData = $ct->delCustomer();
					Session::destroy();
				}
				?>




				<?php
				$login = Session::get("customerLogin");
				if ($login == true) { ?>
					<div class="login"><a class="login-btn" href="?cId=<?php Session::get("customerID") ?>">Logout</a></div>
				<?php } else {
				?>
					<div class="login"><a class="login-btn" href="login.php">Login</a></div>
				<?php } ?>


				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="menu">
			<ul id="dc_mega-menu-orange" class="dc_mm-orange">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a> </li>
				<li><a href="topbrands.php">Top Brands</a></li>

				<?php
				$cartCheck = $ct->checkCart();
				if ($cartCheck) {
				?>
					<li><a href="cart.php">Cart</a></li>
				<?php	}
				?>

				<?php
				$loggedIn = Session::get("customerLogin");
				if ($loggedIn == true) { ?>
					<li><a href="profile.php">Profile</a> </li>
				<?php	}
				?>
				<li><a href="contact.php">Contact</a> </li>
				<div class="clear"></div>
			</ul>
		</div>