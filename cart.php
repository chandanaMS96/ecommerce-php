<!DOCTYPE html>
<?php 
session_start();
include("functions/functions.php");
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Front page</title>
	<!-- goggle fonts -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" rel="stylesheet">
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- fontawesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="styles/front-page2.css" media="all" />
	<script src="script/font-page.js"></script> 

</head>




<body>
	<!-- start of navigation bar -->
	<ul id ="navbar">
		<li  class="nav-color  opaCor" id="logo"><a href="index.php"><img src="images/logo.png" ></a></li>
		<li class="nav-color opaCor"><a href="index.php">Home</a></li>
		<li class="nav-color opaCor"><a href="all_products.php">Products</a></li>
		<li class="nav-color opaCor"><a  href="cart.php"><span>Cart</span><span class="badge"> <?php total_items();?></span></a></li>


		<?php if(!isset($_SESSION['customer_email'])){
				echo "<li class='nav-color opaCor'><a href='customer_register.php'>Sign up</a></li>";
			}
			else
				{
				echo "<li class='nav-color opaCor'><a href='logout.php'>Log out</a></li>";

				}?>

		<?php if(isset($_SESSION['customer_email'])){
				echo "<li class='nav-color opaCor'><a href='customer/my_account.php'>My Account</a></li>";
			}?>

		

	</ul>
	<div id="subnav" style="text-align: center;">
		<h1 style ="font-size: 25px">Welcome <?php if(!isset($_SESSION['customer_email'])){
				echo "Guest !!!";
			}
			else
				{
					$email =$_SESSION['customer_email'];
					$query = "select * from customers where customer_email ='$email'";
					$ran = mysqli_query($con,$query);
					while($cus = mysqli_fetch_array($ran)){
						$name = $cus['customer_name'];
					}
				echo $name. " !!";

				}?></h1>
	</div>


	<!-- end of navigation bar -->

	<!-- container -->
	<div  id ="img-container" >
<?php cart(); ?>		




<!-- image start -->
<?php addWishList(); ?>
<?php getCartPro(); ?>
<!-- image end -->

	</div>

</body>
</html>