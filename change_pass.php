<div class="login-box">
	<h2>Change password</h2>
	<form  method="post" action="">
		
		<div >
			<input class="input-item" type="password" name="current_pass" required>
			<label>Current password</label>
		</div>
		<div >
			<input class="input-item" type="password" name="new_pass" required>
			<label>New password</label>
		</div>

		<div >
			<input class="input-item" type="password" name="new_pass_again" required>
			<label>Confirm password</label>
		</div>
	<input type="submit" name="change_pass" value="Change Password">
	</form>
</div>

<?php 



	if(isset($_POST['change_pass'])){
		
		$user = $_SESSION['customer_email']; 
	
		$current_pass = $_POST['current_pass']; 
		$new_pass = $_POST['new_pass']; 
		$new_again = $_POST['new_pass_again']; 
		
		$sel_pass = "select * from customers where customer_pass='$current_pass' AND customer_email='$user'";
		
		$run_pass = mysqli_query($con, $sel_pass); 
		
		$check_pass = mysqli_num_rows($run_pass); 
		
		if($check_pass==0){
		
		echo "<script>alert('Your Current Password is wrong!')</script>";
		exit();
		}
		
		if($new_pass!=$new_again){
		
		echo "<script>alert('New password do not match!')</script>";
		exit();
		}
		else {
		
		$update_pass = "update customers set customer_pass='$new_pass' where customer_email='$user'";
		
		$run_update = mysqli_query($con, $update_pass); 
		
		echo "<script>alert('Your password was updated succesfully!')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
		}
	
	}




?>
