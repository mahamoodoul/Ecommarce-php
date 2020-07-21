<?php include("inc/header.php") ?>

<?php

$login = Session::get("customerLogin");
if ($login == true) {
	header('Location:order.php');
}

?>

<style>
	.inupt-shape {
		font-size: 12px;
		color: #b3b1b1;
		padding: 8px;
		outline: none;
		margin: 5px 0;
		width: 340px;
	}

	.number-size {
		width: 344px !important;
		border: 1px solid #767676 !important;
		height: 17px !important;
	}
</style>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$loginCustomer = $customer->customerLoigin($_POST);
}

?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
	$registrationSuccess = $customer->customerREgistration($_POST);
}

?>


<div class="main">
	<div class="content">
		<div class="login_panel">
			<?php
			if (isset($loginCustomer)) {
				echo $loginCustomer;
			}

			?>
			<h3>Existing Customers</h3>
			<p>Sign in with the form below.</p>
			<form action="" method="post">
				<input style="width: 92% !important;" class="inupt-shape" name="email" type="email" placeholder="Email">
				<input name="password" type="password" placeholder="Password">
				<div class="buttons">
					<div><button class="grey" name="login">Sign In</button></div>
				</div>
			</form>
			<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>

		</div>
		<div class="register_account">


			<?php

			if (isset($registrationSuccess)) {
				echo $registrationSuccess;
			}

			?>
			<h3>Register New Account</h3>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Name">
								</div>

								<div>
									<input type="text" name="city" placeholder="City">
								</div>

								<div>
									<input type="text" name="code" placeholder="Zip-Code">
								</div>
								<div>
									<input class="inupt-shape" type="email" name="email" placeholder="Email">
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Addresee">
								</div>
								<div>
									<select id="country" name="country">
										<option value="null">Select a Country</option>
										<option value="Afghanistan">Afghanistan</option>
										<option value="Albania">Albania</option>
										<option value="Algeria">Algeria</option>
										<option value="Argentina">Argentina</option>
										<option value="Armenia">Armenia</option>
										<option value="Aruba">Aruba</option>
										<option value="Australia">Australia</option>
										<option value="Austria">Austria</option>
										<option value="Azerbaijan">Azerbaijan</option>
										<option value="Bahamas">Bahamas</option>
										<option value="Bahrain">Bahrain</option>
										<option value="Bangladesh">Bangladesh</option>

									</select>
								</div>

								<div>
									<input class="inupt-shape number-size" type="number" name="phone" placeholder="Phone Number">
								</div>

								<div>
									<input style="margin-top:6px;" class="inupt-shape " type="password" name="password" placeholder="Password">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><button name="register" class="grey">Create Account</button></div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
<?php include("inc/footer.php") ?>