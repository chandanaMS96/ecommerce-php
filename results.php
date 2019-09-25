<!DOCTYPE html>
<?php 
session_start();
include("functions/functions.php");
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Shopping</title>
	<!-- goggle fonts -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" rel="stylesheet">
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- fontawesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="styles/front-page1.css" media="all" />
	<script src="script/font-page.js"></script> 

</head>




<body>
	<div class="full-width-search">
		<div class="search-form">
			<form method="get" action="results.php" enctype="multipart/form-data" method="get">
			<input type="text" name="user_query" placeholder="search..."> 
					<input style ="display:none"type="submit" name="search" value="Search" />
			<div class="close"><i class="fa fa-close"></i></div>
		</form>
		</div>
		
	</div>
	<!-- start of navigation bar -->
	<ul id ="navbar">
		<li  class="nav-color  opaCor" id="logo"><a href="index.php"><img src="images/logo.jpg" ></a></li>
		<li class="nav-color opaCor"><a href="index.php">Home</a></li>
		<li class="nav-color opaCor"><a href="all_products.php">Products</a></li>
		<li class="nav-color opaCor"><a  href="cart.php"><span>Cart</span><span class="badge"> <?php total_items();?></span></a></li>
		<li class="nav-color" id ="cat-icon"><a  href="#">Categories</a></li>


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

		<li class="opaCor"><a id ="search"><i class="fa fa-search"></i></a></li>

	</ul>


	<!-- end of navigation bar -->
	<div id="subnav" style="text-align: center;">
		<h1 style ="font-size: 25px">Welcome  <?php if(!isset($_SESSION['customer_email'])){
				echo "Guest !!!";
			}
			else
				{
						$user = $_SESSION['customer_email'];
				
				$get_customer = "select * from customers where customer_email='$user'";
				
				$run_customer = mysqli_query($con, $get_customer); 
				
				$row_customer = mysqli_fetch_array($run_customer); 
				$name = $row_customer['customer_name'];
					
				echo $name. "  !!";

				}?></h1>
	</div>
	<!-- side bar start  -->
<div class="sidebar-container" style="display: none">

		<ul id="sidebar">
			<li class="side-items" id="cat-desc"><a href="">Select catrgory</a></li>
			<?php getCats(); ?>
		</ul>
		
	
</div>
	<!-- end of side bar -->
	<!-- container -->
	<div  id ="img-container" >
<?php cart(); ?>		




<!-- image start -->
<?php addWishList(); ?>
<?php getSearchPro();
 getCatPro();?>
<!-- image end -->

	</div>

</body>
</html>