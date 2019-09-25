<?php 
include("includes/db.php");
session_start();
?>

<div> 
	<form method="post" action=""> 
		
		<table width="500" align="center" bgcolor="skyblue"> 
			
			<tr align="center">
				<td colspan="3"><h2>Admin login</h2></td>
			</tr>
			
			<tr>
				<td align="right"><b>Email:</b></td>
				<td><input type="text" name="user_email" placeholder="enter email" required/></td>
			</tr>
			
			<tr>
				<td align="right"><b>Password:</b></td>
				<td><input type="password" name="user_pass" placeholder="enter password" required/></td>
			</tr>
			
			
			<tr align="center">
				<td colspan="3"><input type="submit" name="admin_login" value="Login" /></td>
			</tr>
			
		
		
		</table> 
	
			
	</form>
	
</div>

<?php 
global $con;
if(isset($_POST['admin_login'])){


 	$email = $_POST['user_email'];
 	$pass = $_POST['user_pass'];

 $query = "select * from admins where user_email = '$email' and user_pass ='$pass'";
 $user = mysqli_query($con, $query);

$rows = mysqli_num_rows($user);

if($rows == 0){
echo "<script>alert('you are not an admin');</script>";
}
else{
	$_SESSION['user_email'] = $email;

echo "<script>window.open('index.php','_self')</script>";
}
}
 ?>
