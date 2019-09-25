
<!DOCTYPE html>
<?php 
session_start();
include("functions/functions.php"); 


?>
<html lang="en">
<head><meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>FCustomer register</title>
	<!-- goggle fonts -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" rel="stylesheet">
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- fontawesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"><title>customer register</title>
	<link rel="stylesheet" href="styles/customer-register1.css" media="all" />

	<script src="script/customer-register-validation.js"></script> 

</head>
	

<body>
<div id ="error">
    <ul id = "single_error">
    </ul>
  </div>
<div id="wrapper">
	<div class="form-container">
		<span class="form-heading">Register</span>
		<form action="" method="post" enctype="multipart/form-data" onsubmit="return validation();">
			<div class="input-group">
				<i class="fa fa-user"></i>
			<input type="text"  name="c_name" placeholder="Username..." required>
			<span class="bar"></span>
		    </div>

		    <div class="input-group">
				<i class="fa fa-envelope"></i>
			<input type="text" name="c_email" placeholder="Email..." required>
			<span class="bar"></span>
		    </div>

		    <div class="input-group">
				<i class="fa fa-lock"></i>
			<input type="password" name="c_pass" placeholder="Password..."  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
			<span class="bar"></span>
		    </div>

		    <div class="input-group">
				<i class="fa fa-picture-o"></i>
			<input type="file" name="c_image" placeholder="photo...">
			<span class="bar"></span>
		    </div>

		     <div class="input-group">
				<i class="fa fa-phone"></i>
			<input type="text" name="c_contact" placeholder="Contact...">
			<span class="bar"></span>
		    </div>

		     <div class="input-group">
				<i class="fa fa-flag"></i>
			<input type="text"  name="c_country" placeholder="Country...">
			<span class="bar"></span>
		    </div>
              
               <div class="input-group">
				<i class="fa  fa-flag-checkered"></i>
			<input type="text" name="c_state" placeholder="State...">
			<span class="bar"></span>
		    </div> 


		    <div class="input-group">
				<i class="fas fa-city"></i>
			<input type="text" name="c_city" placeholder="City...">
			<span class="bar"></span>
		    </div>

		   

            <div class="input-group">
				<i class="fa fa-address-card-o"></i>
			<input type="text-area" name="c_address" placeholder="Address...">
			<span class="bar"></span>
		    </div>



		    <div class="input-group">
				<button name="customer_register" type="submit">
					<i class="fab fa-telegram-plane"></i>
				</button>
		    </div>

		    <div class="switch-login">
		    	<a href="login.php">Already have an account?<span>Login</span></a>
		    </div>


<?php customerRegister();?>

		</form>
	</div>
</div>


</body>
</html>


