<?php include '../classes/AdminLogin.php'; ?>

<?php

$al = new AdminLogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$logincheck = $al->adminlogin($username, $password);
}


?>

<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
	<div class="container">
		<section id="content">


			<form action="login.php" method="post">
				<h1>Admin Login</h1>
				<span style="color: red; font-size:18px">
					<?php
					if (isset($logincheck)) {
						echo $logincheck;
					}
					?>
				</span>
				<div>
					<input type="text" placeholder="Username" required="" name="username" />
				</div>
				<div>
					<input type="password" placeholder="Password" required="" name="password" />
				</div>
				<div>
					<input type="submit" value="Log in" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="forgetpass.php">Forgot Password?</a>
			</div><!-- button -->
			<div class="button">
				<a href="#">Training with live project</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>

</html>