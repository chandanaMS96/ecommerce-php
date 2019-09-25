<?php 
	include("includes/db.php"); 
	if(isset($_SESSION['user_email']) ){
	if(isset($_GET['delete_c'])){
	
	$delete_id = $_GET['delete_c'];
	
	$delete_c = "delete from customers where customer_id='$delete_id'"; 
	
	$run_delete = mysqli_query($con, $delete_c); 
	
	if($run_delete){
	
	echo "<script>alert('A customer has been deleted!')</script>";
	echo "<script>window.open('index.php?view_customers','_self')</script>";
	}
	
	}


}
else{
	echo "<script>window.open('admin_login.php?not_admin =you are not an admin!','_self')</script>";
}


?>