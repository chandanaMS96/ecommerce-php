<!DOCTYPE html>
<?php 
session_start();
include("functions/functions.php");
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Customer Login</title>
	<!-- goggle fonts -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" rel="stylesheet">
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- fontawesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="styles/customer-login1.css" media="all" />

	<!-- <script src="script/font-page.js"></script>  -->			
<body>

<div class="login-box">
	<h2>Login</h2>
	<form  method="post" action="">
		<div >
			<input class="input-item" type="text" name="email" required>
			<label>Email</label>
		</div>
		<div >
			<input class="input-item" type="password" name="pass" required>
			<label>Password</label>
		</div>
	<input type="submit" name="customer-login" value="Login">
	<?php customer_login(); ?>
	</form>
</div>

</body>
</html>