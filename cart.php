<?php include("inc/header.php") ?>



<?php
if (isset($_GET['removeProduct'])) {
	$id = preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['removeProduct']);
	// var_dump($id);
	// die();
	$delCartProduct = $ct->delCartProduct($id);
}
?>




<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity'];
	$updateCart = $ct->updateCartQuantity($cartId, $quantity);
}

?>


<?php

if (!isset($_GET['id'])) {
	echo "<meta http-equiv='refresh' content='0?id=cart' />";
}

?>
<div class="main">
	<div class="content">
		<div class="cartoption">

			<div class="cartpage">
				<table>
					<tr>
						<td>
							<h2>Your Cart</h2>
						</td>
						<td><?php

							if (isset($delCartProduct)) {
								echo $delCartProduct;
							}
							?></td>
					</tr>
				</table>

				<?php
				if (isset($updateCart)) {
					echo $updateCart;
				}
				?>



				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>

					<?php
					$getCart = $ct->getCartProducts();
					$grandTotal = 0;
					if ($getCart) {
						while ($result = $getCart->fetch_assoc()) {


					?>
							<tr>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt="" /></td>
								<td><?php echo $result['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="number" value="<?php echo $result['quantity']; ?>" name="quantity" value="1" />
										<input type="hidden" value="<?php echo $result['cartId']; ?>" name="cartId" value="1" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>

								<td>Tk.<?php
										$total = $result['price'] * $result['quantity'];
										echo $total ?>
								</td>
								<?php $grandTotal = $grandTotal + $total ?>
								<td><a onclick="return confirm('Are you Sure to Remove!!')" href="?removeProduct=<?php echo $result['cartId']; ?>">X</a></td>
							</tr>


					<?php 		}
					}
					?>





					<?php
					$sId = session_id();
					$cartInHeader = $ct->cartHintinHeadder($sId);
					if (isset($cartInHeader)) {
					?>
				</table>
				<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td>TK.<?php echo $grandTotal; ?></td>
					</tr>
					<tr>
						<th>VAT(10%) : </th>
						<td>TK. <?php echo ($grandTotal * (10 / 100)); ?></td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td>TK. <?php echo ($grandTotal + ($grandTotal * (10 / 100))); ?> </td>
					</tr>
				</table>
			<?php } else { ?>

				<span style="margin-left: 350px; font-size:18px; color:royalblue;">Your Cart is Empty ...Go Do some Shopping.</span>
			<?php } ?>


			</div>
			<div class="shopping">
				<?php if (isset($cartInHeader)) {
				?>
					<div class="shopleft">
						<a href="index.php"> <img src="images/shop.png" alt="" /></a>
					</div>
					<div class="shopright">
						<a href="payment.php"> <img src="images/check.png" alt="" /></a>
					</div>
				<?php } else { ?>

					<div class="shopleft">
						<a style="margin-left: 400px;" href="index.php"> <img src="images/shop.png" alt="" /></a>
					</div>


				<?php } ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
<?php include("inc/footer.php") ?>