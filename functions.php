		<?php 
// After uploading to online server, change this connection accordingly
$con = mysqli_connect("localhost","root","","shopping");

if (mysqli_connect_errno())
  {
  echo "The Connection was not established: " . mysqli_connect_error();
  }
 // getting the user IP address
  function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
  
  
  
//creating the shopping cart
function cart(){

if(isset($_GET['add_cart'])){

	global $con; 
	
	$ip = getIp();
	
	$pro_id = $_GET['add_cart'];

	$check_pro = "select * from cart where ip_id='$ip' AND p_id='$pro_id'";
	
	$run_check = mysqli_query($con, $check_pro); 
	
	if(mysqli_num_rows($run_check)>0){

	echo " ";
	
	}
	else {
	
	$insert_pro = "insert into cart (p_id,ip_id,qty) values ('$pro_id','$ip',1)";
	
	$run_pro = mysqli_query($con, $insert_pro); 
	
	echo "<script>window.open('index.php','_self')</script>";
	}
	
}

}
 // getting the total added items
 
 function total_items(){
 
	if(isset($_GET['add_cart'])){
	
		global $con; 
		
		$ip = getIp(); 
		
		$get_items = "select * from cart where ip_id='$ip'";
		
		$run_items = mysqli_query($con, $get_items); 
		
		$count_items = mysqli_num_rows($run_items);
		
		}
		
		else {
		
		global $con; 
		
		$ip = getIp(); 
		
		$get_items = "select * from cart where ip_id='$ip'";
		
		$run_items = mysqli_query($con, $get_items); 
		
		$count_items = mysqli_num_rows($run_items);
		
		}
	
	echo $count_items;
	}
  
// Getting the total price of the items in the cart 
	
	function total_price(){
	
		$total = 0;
		
		global $con; 
		
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_id='$ip'";
		
		$run_price = mysqli_query($con, $sel_price); 
		
		while($p_price=mysqli_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id'];
			$qty = $p_price['qty'];
			
			$pro_price = "select * from products where product_id='$pro_id'";
			
			$run_pro_price = mysqli_query($con,$pro_price); 
			
			while ($pp_price = mysqli_fetch_array($run_pro_price)){
			
			 // $product_price = array($pp_price['product_price']);
			
			// $values = array_sum($product_price);
			
			$total +=$qty * $pp_price['product_price'] ;
			echo "<script>window.open('','_self')</script>";
			
			}
		
		
		}
		
		echo  $total;
		
	
	}

//getting the categories

function getCats(){
	
	global $con; 
	
	$get_cats = "select * from categories";
	
	$run_cats = mysqli_query($con, $get_cats);
	
	while ($row_cats=mysqli_fetch_array($run_cats)){
	
		$cat_id = $row_cats['cat_id']; 
		$cat_title = $row_cats['cat_title'];
	
	echo "<li class='side-items'><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	
	
	}


}

//getting the brands

function getBrands(){
	
	global $con; 
	
	$get_brands = "select * from brands";
	
	$run_brands = mysqli_query($con, $get_brands);
	
	while ($row_brands=mysqli_fetch_array($run_brands)){
	
		$brand_id = $row_brands['brand_id']; 
		$brand_title = $row_brands['brand_title'];
	
	echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	
	
	}
}

function getPro(){

	if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){

	global $con; 
	
	$get_pro = "select * from products   order by RAND() LIMIT 0,6";

	$run_pro = mysqli_query($con, $get_pro); 
	
	while($row_pro=mysqli_fetch_array($run_pro)){
	
		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
		$wish_query = "SELECT * FROM `wish-lists` WHERE  pro_id = '$pro_id'";
		$run_wish_query = mysqli_query($con,$wish_query);
		$wish_num =mysqli_num_rows($run_wish_query);
		
	    
		echo "
				<div class='box'>
			<div class='imgBox'>
				<img src='admin_area/product_images/$pro_image'>
			</div>
			<ul class='icons'>
				<li><a href='index.php?add_cart=$pro_id'><i class='fa fa-shopping-basket'></i></a></li>
				<li><a href='detail.php?pro_id=$pro_id'><i class='fa fa-eye'></i></a></li>";
				if( $wish_num > 0){
					echo "<li id='wish'><a href='index.php'><i class='fa fa-heart'></i></a></li>";
						echo "<script>console.log($wish_num,'chandana')</script>";

				}
					else {
						echo "<li ><a href='index.php?wish_list=$pro_id'><i class='fa fa-heart'></i></a></li>";
					}
			echo "</ul>
			<div  class='details'>
				<h5>Price </h5><h4>$ $pro_price</h4>
			</div>
		</div>";
	
	
	}
	}
}

}


function getAllPro(){
		if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){

	global $con; 
	
	$get_pro = "select * from products ";

	$run_pro = mysqli_query($con, $get_pro); 
	
	while($row_pro=mysqli_fetch_array($run_pro)){
	
		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
		$wish_query = "SELECT * FROM `wish-lists` WHERE  pro_id = '$pro_id'";
		$run_wish_query = mysqli_query($con,$wish_query);
		$wish_num =mysqli_num_rows($run_wish_query);
	    
		echo "
				<div class='box'>
			<div class='imgBox'>
				<img src='admin_area/product_images/$pro_image'>
			</div>
			<ul class='icons'>
				<li><a href='index.php?add_cart=$pro_id'><i class='fa fa-shopping-basket'></i></a></li>
				<li><a href='detail.php?pro_id=$pro_id'><i class='fa fa-eye'></i></a></li>";
				if( $wish_num > 0){
					echo "<li id='wish'><a href='all_products2.php'><i class='fa fa-heart'></i></a></li>";}
					else {
						echo "<li ><a href='all_products2.php?all_wish_list=$pro_id'><i class='fa fa-heart'></i></a></li>";
					}
			echo "</ul>
			<div  class='details'>
				<h5>Price </h5><h4>$ $pro_price</h4>
			</div>
		</div>";
	
	
	}
	}
}
}

function  addWishList(){

	global $con;
	if(isset($_GET['wish_list'])){
		if(!isset($_SESSION['customer_email'])){
		echo "<script>window.open('customer_register2.php','_self')</script>";
	}
	$wish_ip_id = getPro();
	$pro_id = $_GET['wish_list'];

	$query_wish = "SELECT * FROM `customers` WHERE customer_ip = '$wish_ip_id'";
	$wish_customer = mysqli_query($con, $query_wish);
	while ($wish_ary = mysqli_fetch_array($wish_customer)) {
		$cus_id = $wish_ary['customer_id'];
	}
	$pro_query = "select * from  wish-lists where pro_id = '$pro_id '";
	$run_pro_query = mysqli_query($con, $pro_query);
	$pro_num = mysqli_num_rows($run_pro_query);
	if($pro_num>0){

	echo "";
	
	}
	else {
		$insert_wish = "INSERT INTO `wish-lists`( `customer_id`, `pro_id`) VALUES ('$cus_id','$pro_id')";
	$run_pro = mysqli_query($con, $insert_wish);
		echo "<script>window.open('index.php','_self')</script>";

	}
	
	
}
	
}


function  addDetailWishList(){

	global $con;
	if(isset($_GET['wish_list_detail'])){
		if(!isset($_SESSION['customer_email'])){
		echo "<script>window.open('customer_register2.php','_self')</script>";
	}
	$wish_ip_id = getPro();
	$pro_id = $_GET['wish_list_detail'];

	$query_wish = "SELECT * FROM `customers` WHERE customer_ip = '$wish_ip_id'";
	$wish_customer = mysqli_query($con, $query_wish);
	while ($wish_ary = mysqli_fetch_array($wish_customer)) {
		$cus_id = $wish_ary['customer_id'];
	}
	$pro_query = "select * from  wish-lists where pro_id = '$pro_id '";
	$run_pro_query = mysqli_query($con, $pro_query);
	$pro_num = mysqli_num_rows($run_pro_query);
	if($pro_num>0){

	echo "";
	
	}
	else {
		$insert_wish = "INSERT INTO `wish-lists`( `customer_id`, `pro_id`) VALUES ('$cus_id','$pro_id')";
	$run_pro = mysqli_query($con, $insert_wish);
		echo "<script>window.open('deatil.php','_self')</script>";

	}
	
	
}
	
}




function addProWishList(){
	global $con;
	if(isset($_GET['all_wish_list'])){
	$wish_ip_id = getPro();
	$pro_id = $_GET['all_wish_list'];

	$query_wish = "SELECT * FROM `customers` WHERE customer_ip = '$wish_ip_id'";
	$wish_customer = mysqli_query($con, $query_wish);
	while ($wish_ary = mysqli_fetch_array($wish_customer)) {
		$cus_id = $wish_ary['customer_id'];
	}
	$pro_query = "select * from  wish-lists where pro_id = '$pro_id '";
	$run_pro_query = mysqli_query($con, $pro_query);
	$pro_num = mysqli_num_rows($run_pro_query);
	if($pro_num>0){

	echo "";
	
	}
	else {
		$insert_wish = "INSERT INTO `wish-lists`( `customer_id`, `pro_id`) VALUES ('$cus_id','$pro_id')";
	$run_pro = mysqli_query($con, $insert_wish);
		echo "<script>window.open('all_products.php','_self')</script>";

	}
	
	
}

}

function getCatPro(){

	if(isset($_GET['cat'])){
		
		$cat_id = $_GET['cat'];

	global $con; 
	
	$get_cat_pro = "select * from products where product_cat='$cat_id'";

	$run_cat_pro = mysqli_query($con, $get_cat_pro); 
	
	$count_cats = mysqli_num_rows($run_cat_pro);
	
	if($count_cats==0){
	
	echo "<h2 class ='not-found'>No products were found in this category..sorry!!</h2>";
	
	}
	
	while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
	
		$pro_id = $row_cat_pro['product_id'];
		$pro_cat = $row_cat_pro['product_cat'];
		$pro_brand = $row_cat_pro['product_brand'];
		$pro_title = $row_cat_pro['product_title'];
		$pro_price = $row_cat_pro['product_price'];
		$pro_image = $row_cat_pro['product_image'];
		$wish_query = "SELECT * FROM `wish-lists` WHERE  pro_id = '$pro_id'";
		echo "<script>console.log($pro_id);</script>";
		$run_wish_query = mysqli_query($con,$wish_query);
		$wish_num =mysqli_num_rows($run_wish_query);
	
		echo "
				
				<div class='box'>
			<div class='imgBox'>
				<img src='admin_area/product_images/$pro_image'>
			</div>
			<ul class='icons'>
				<li><a href='index.php?add_cart=$pro_id'><i class='fa fa-shopping-basket'></i></a></li>
				<li><a href='detail.php?pro_id=$pro_id'><i class='fa fa-eye'></i></a></li>";
				if( $wish_num > 0){
					echo "<li id='wish'><a href='index.php'><i class='fa fa-heart'></i></a></li>";}
					else {
						echo "<li ><a href='index.php?wish_list=$pro_id'><i class='fa fa-heart'></i></a></li>";
					}
			echo "</ul>
			<div  class='details'>
				<h5>Price </h5><h4>$ $pro_price</h4>
			</div>
		</div>
		
		";
		
	
	}
	
}

}


function getBrandPro(){

	if(isset($_GET['brand'])){
		
		$brand_id = $_GET['brand'];

	global $con; 
	
	$get_brand_pro = "select * from products where product_brand='$brand_id'";

	$run_brand_pro = mysqli_query($con, $get_brand_pro); 
	
	$count_brands = mysqli_num_rows($run_brand_pro);
	
	if($count_brands==0){
	
	echo "<h2 style='padding:20px;'>No products where found associated with this brand!!</h2>";
	
	}
	
	while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){
	
		$pro_id = $row_brand_pro['product_id'];
		$pro_cat = $row_brand_pro['product_cat'];
		$pro_brand = $row_brand_pro['product_brand'];
		$pro_title = $row_brand_pro['product_title'];
		$pro_price = $row_brand_pro['product_price'];
		$pro_image = $row_brand_pro['product_image'];
	
		echo "
				<div id='single_product'>
				
					<h3>$pro_title</h3>
					
					<img src='admin_area/product_images/$pro_image' width='180' height='180' />
					
					<p><b> $ $pro_price </b></p>
					
					<a href='detail.php?pro_id=$pro_id' style='float:left;'>Details</a>
					
					<a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
				
				</div>
		
		";
		
	
	}
	
}
}


function customerRegister(){
	global $con;
	if(isset($_POST['customer_register'])){
	
		
		$ip = getIp();
		
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		$c_country = $_POST['c_country'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
	
		
		move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
		
		 $insert_c = "insert into customers (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
	
		$run_c = mysqli_query($con, $insert_c); 
		
		$sel_cart = "select * from cart where ip_id='$ip'";
		
		$run_cart = mysqli_query($con, $sel_cart); 
		
		$check_cart = mysqli_num_rows($run_cart); 
		
		if($check_cart==0){
		
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('Account has been created successfully, Thanks!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
		
		}
		else {
		
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('Account has been created successfully, Thanks!')</script>";
		
		echo "<script>window.open('checkout.php','_self')</script>";
		
		
		}
	}

}


function customer_login(){
	global  $con;
	if(isset($_POST['customer-login'])){
	
		$c_email = $_POST['email'];
		$c_pass = $_POST['pass'];
		
		$sel_c = "select * from customers where customer_pass='$c_pass' AND customer_email='$c_email'";
		
		$run_c = mysqli_query($con, $sel_c);
		
		$check_customer = mysqli_num_rows($run_c); 
		
		if($check_customer==0){
		
		echo "<script>alert('Password or email is incorrect, plz try again!')</script>";
		exit();
		}
		$ip = getIp(); 
		
		$sel_cart = "select * from cart where ip_add='$ip'";
		
		$run_cart = mysqli_query($con, $sel_cart); 
		
		$check_cart = mysqli_num_rows($run_cart); 
		
		if($check_customer>0 AND $check_cart==0){
		
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('You logged in successfully, Thanks!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
		
		}
		else {
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('You logged in successfully, Thanks!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
		
		
		}
	}
	
}

function  getCartPro(){
	global $con; 
		
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_id='$ip'";
		
		$run_price = mysqli_query($con, $sel_price); 
		$cart_num = mysqli_num_rows($run_price);
		if($cart_num > 0){
		while($p_price=mysqli_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id']; 
			
			$pro_price = "select * from products where product_id='$pro_id'";
			
			$run_pro_price = mysqli_query($con,$pro_price); 
			
			while ($pp_price = mysqli_fetch_array($run_pro_price)){
			
			$product_price = array($pp_price['product_price']);
			
			$product_title = $pp_price['product_title'];
			$product_id = $pp_price['product_id'];

			
			$product_image = $pp_price['product_image']; 
			
			$single_price = $pp_price['product_price'];
			echo "
				<div class='box'>
			<div class='imgBox'>
				<img src='admin_area/product_images/$product_image'>
				<form method='post' action='' enctype='multipart/form-data'><input id='quantity' type='number' placeholder='quantity' min='1' step='1'  name='p_qty'><input type='text'  value='$pro_id' style='display:none'><input id='sub-quantity' type='submit' name='change-qty'value ='submit'></form>
			</div>
			<ul class='icons'>
		
				<li><a href='cart.php?remove_pro=$pro_id'><i class='fa fa-trash'></i></a></li>
				

				<li><a href='detail.php?pro_id=$product_id'><i class='fa fa-eye'></i></a></li>
		
			</ul>
			<div  class='details'>
				<h5>Price </h5><h4>$ $single_price</h4>

			</div>
		</div>";

			
			}
		}

	}
	else
	{
		echo "<a href='index.php' class='not-found'><h2 >Your cart is empty  go back to shopping</h2></a>";
	}
}

if(isset($_POST['change-qty'])){
	global $con;
	$qty = $_POST['p_qty'];
	$ip = getIp();
	$pro_id = $_POST['pro_id'];
	$query  ="update cart set qty='$qty' where ip_id ='$ip' and p_id = '$pro_id'";
	$ran = mysqli_query($con,$query );
	if($ran){
		echo "<script>window.open('cart.php');</script>";
	}

}


if(isset($_GET['remove_pro'])){
	$pro_id = $_GET['remove_pro'];
	$ip = getIp();
	$query = "delete from cart where p_id='$pro_id ' AND ip_id='$ip'";
	$ran = mysqli_query($con,$query);
	if($ran){
		echo "<script>window.open(cart2.php);</script>";
	}

}






function getSearchPro(){

	if(isset($_GET['search'])){
	global $con;
	$search_query = $_GET['user_query'];
	
	$get_pro = "select * from products where product_keywords like '%$search_query%'";

	$run_pro = mysqli_query($con, $get_pro); 
	
	while($row_pro=mysqli_fetch_array($run_pro)){
	
		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_cat'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
		$wish_query = "SELECT * FROM `wish-lists` WHERE  pro_id = '$pro_id'";
		$run_wish_query = mysqli_query($con,$wish_query);
		$wish_num =mysqli_num_rows($run_wish_query);
		
	
	    
		echo "
				<div class='box'>
			<div class='imgBox'>
				<img src='admin_area/product_images/$pro_image'>
			</div>
			<ul class='icons'>
				<li><a href='index.php?add_cart=$pro_id'><i class='fa fa-shopping-basket'></i></a></li>
				<li><a href='detail.php?pro_id=$pro_id'><i class='fa fa-eye'></i></a></li>";
				if( $wish_num > 0){
					echo "<li id='wish'><a href='index.php'><i class='fa fa-heart'></i></a></li>";
						echo "<script>console.log($wish_num,'chandana')</script>";

				}
					else {
						echo "<li ><a href='index.php?wish_list=$pro_id'><i class='fa fa-heart'></i></a></li>";
					}
			echo "</ul>
			<div  class='details'>
				<h5>Price </h5><h4>$ $pro_price</h4>
			</div>
		</div>";
	
	
	}
	}


}


?>