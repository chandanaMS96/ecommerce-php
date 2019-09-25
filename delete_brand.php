<?php 
	include("includes/db.php"); 
	if(isset($_SESSION['user_email']) ){
	if(isset($_GET['delete_brand'])){
	
	$delete_id = $_GET['delete_brand'];
	
	$delete_brand = "delete from brands where brand_id='$delete_id'"; 
	
	$run_delete = mysqli_query($con, $delete_brand); 
	
	if($run_delete){
	
	echo "<script>alert('A Brand has been deleted!')</script>";
	echo "<script>window.open('index.php?view_brands','_self')</script>";
	}
	
	}
}
else
{


echo "<script>window.open('admin_login.php?not_admin =you are not an admin!','_self')</script>";


}




?>