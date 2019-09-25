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
	<link rel="stylesheet" href="styles/detail_pro.css" media="all" />

	<script src="script/font-page.js"></script> 

</head>
<body>
	<div class="full-width-search">
		<div class="search-form">
			<form method="get" action="results.php" enctype="multipart/form-data">
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
				echo "<li class='nav-color opaCor'><a href='customer_register2.php'>Sign up</a></li>";
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
					$email =$_SESSION['customer_email'];
					$query = "select * from customers where customer_email ='$email'";
					$ran = mysqli_query($con,$query);
					while($cus = mysqli_fetch_array($ran)){
						$name = $cus['customer_name'];
					}
				echo $name. " !!";

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
		<?php addDetailWishList();
		cart();?>

<?php 
	if(isset($_GET['pro_id'])){
	
	$product_id = $_GET['pro_id'];
	
	$get_pro = "select * from products where product_id='$product_id'";

	$run_pro = mysqli_query($con, $get_pro); 
	
	while($row_pro=mysqli_fetch_array($run_pro)){
	
		$pro_id = $row_pro['product_id'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
		$pro_desc = $row_pro['product_desc'];
	
$wish_query = "SELECT * FROM `wish-lists` WHERE  pro_id = '$pro_id'";
		$run_wish_query = mysqli_query($con,$wish_query);
		$wish_num =mysqli_num_rows($run_wish_query);
		

		echo "<div class='detail-card'>
			<div class='detail-img'>
				<img src='admin_area/product_images/$pro_image'>
			</div>
			<div class='pro-details'>
			<h1>$pro_title</h1>
				<h2><b>Price: </b> $ $pro_price</h2>
				<p><b>Description: </b>$pro_desc</p>
				<div id='wish-detail'>
                <a href='index.php?add_cart=$pro_id'><i class='fa fa-shopping-basket'></i></a>";
				if( $wish_num > 0){
					echo "<a style='color:red !important;' href='detail.php?pro_id=$pro_id'><i class='fa fa-heart'></i></a>";
					echo "<script>console.log($wish_num,'wish number');</script>";

				}
					else {
						echo "<a  href='index.php?wish_list_detail=$pro_id'><i  class='fa fa-heart'></i></a>";

						}


				echo " </div>
				 </div>
			
		</div>";
	
	
	}
	}
?>


	</div>
<!-- end of image container -->



</body>
</html>