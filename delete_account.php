
<form action="" method="post" id="delete-account">

<ul >
	<li><input type="submit" name="yes" value="Yes I want" />
</li>
<li><input type="submit" name="no" value="No it was by mistake" /></li>

</ul>
</form>
<?php 
include("../includes/db.php"); 

	$user = $_SESSION['customer_email']; 
	
	if(isset($_POST['yes'])){
	
	$delete_customer = "delete from customers where customer_email='$user'";
	
	$run_customer = mysqli_query($con,$delete_customer); 
	session_destroy();
	
	echo "<script>alert('We are really sorry, your account has been deleted!')</script>";
	session_destroy();
	echo "<script>window.open('../index.php','_self')</script>";
	}
	if(isset($_POST['no'])){
	
	echo "<script>alert('oh!! be crefull next time!')</script>";
	echo "<script>window.open('my_account.php','_self')</script>";
	
	}
	


?>