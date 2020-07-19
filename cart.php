<?php include("inc/header.php") ?>


<div class="main">
	<div class="content">
		<div class="cartoption">

			<div class="cartpage">
				<h2>Your Cart</h2>
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
					// $data=$getCart->fetch_Assoc();
					// var_dump($data);
					// die();
					if ($getCart) {
						while ($result = $getCart->fetch_assoc()) {

						
					?>
							<tr>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt="" /></td>
								<td><?php echo $result['price']; ?></td>
								<td>
									<form action="" method="post">
										<input type="number" value="<?php echo $result['quantity']; ?>" name="" value="1" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>

								<td>Tk.<?php
										$total = $result['price'] * $result['quantity'];
										echo $total ?>
								</td>
								<?php $grandTotal = $grandTotal + $total ?>
								<td><a href="">X</a></td>
							</tr>
						

					<?php 		}
					}
					?>



				</table>
				<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td>TK.<?php echo $grandTotal; ?></td>
					</tr>
					<tr>
						<th>VAT(10%) : </th>
						<td>TK. <?php echo ($grandTotal*(10/100)); ?></td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td>TK. <?php echo ($grandTotal+($grandTotal*(10/100))); ?> </td>
					</tr>
				</table>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="login.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
<?php include("inc/footer.php") ?>