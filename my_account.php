
<!DOCTYPE html>
<?php 
session_start();
include("../functions/functions.php");

?>

<html>
<head>
	<title></title>
	
		<script src="../script/customer-register-validation.js"></script> 

<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<!-- goggle fonts -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" rel="stylesheet">
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<!-- fontawesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"><title>customer account</title>
	<link rel="stylesheet" href="../styles/customer_edit2.css" media="all" />
	<link rel="stylesheet" href="../styles/change_pass.css" media="all" />
	<link rel="stylesheet" href="../styles/delete_account2.css" media="all" />
    <script src="../script/customer-register-validation.js"></script> 
    <link rel="stylesheet" href="styles/customer_account1.css" media="all" /> 
	<link rel="stylesheet" href="../styles/front-page2.css" media="all" /> 

</head>
<style>
	
</style>
<script>
	$(document).ready(function(){
		$(".menu-icon").click(function(){
			$(".menu-icon").toggleClass("active")
		})

		$(".menu-icon").click(function(){
			$(".side-bar").toggleClass("active")
		})
	})
</script>
<body>
	<!-- start of navigation bar -->
	<ul id ="navbar">
		<li  class="nav-color  opaCor" id="logo"><a href="../index.php"><img src="../images/logo.png" ></a></li>
		<li class="nav-color opaCor"><a href="../index.php">Home</a></li>
		<li class="nav-color opaCor"><a href="../all_products.php">Products</a></li>
		<li class="nav-color opaCor"><a  href="../cart.php"><span>Cart</span><span class="badge"> <?php total_items();?></span></a></li>


		<?php if(!isset($_SESSION['customer_email'])){
				echo "<li class='nav-color opaCor'><a href='../customer_register.php'>Sign up</a></li>";
			}
			else
				{
				echo "<li class='nav-color opaCor'><a href='../logout.php'>Log out</a></li>";

				}?>

		<?php if(isset($_SESSION['customer_email'])){
				echo "<li class='nav-color opaCor'><a href='my_account.php'>My Account</a></li>";
			}?>
			<li></li>

	

	</ul>

	<div id="subnav" style="text-align: center;">
		<h1 style= "font-size: 30px; font-weight: 700;">Welcome   <?php if(!isset($_SESSION['customer_email'])){
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
<div class="menu-icon">
	<span></span>
	<span></span>
	<span></span>
</div>

	<!-- end of navigation bar -->


<div class="side-bar">
	       <?php 
				$user = $_SESSION['customer_email'];
				
				$get_img = "select * from customers where customer_email='$user'";
				
				$run_img = mysqli_query($con, $get_img); 
				
				$row_img = mysqli_fetch_array($run_img); 
				
				$c_image = $row_img['customer_image'];
				
				$c_name = $row_img['customer_name'];
				
				
				?>
	<ul class="menu">
		<li><a href="my_account.php?my_orders">My   Orders</a></li>
				<li><a href="my_account.php?edit_account">Edit   Account</a></li>
				<li><a href="my_account.php?change_pass">Change   Password</a></li>
				<li><a href="my_account.php?delete_account">Delete   Account</a></li>
				<li><a href="../logout.php">Logout</a></li>
	</ul>
</div>


<div  id="cus-content" style="text-align: center;">
	<?php 
				if(!isset($_GET['my_orders'])){
					if(!isset($_GET['edit_account'])){
						if(!isset($_GET['change_pass'])){
							if(!isset($_GET['delete_account'])){
						echo "<div id='cus-img'><img  src='customer_images/$c_image'/></div>";	
				echo "
				<b class='msg'>You can see your order progress by clicking this <a href='my_account.php?my_orders' style='color:#fa7082;'>link</a></b>";

				}
				}
				}
				}
				?>

				<?php 
				if(isset($_GET['edit_account'])){
				include("edit_account.php");
				}
				if(isset($_GET['change_pass'])){
				include("change_pass.php");
				}
				if(isset($_GET['delete_account'])){
				include("delete_account.php");
				}
				
				
				?>
</div>
		

</body>
</html>
