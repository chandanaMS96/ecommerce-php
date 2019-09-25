<?php 	
				include("../includes/db.php"); 
				
				$user = $_SESSION['customer_email'];
				
				$get_customer = "select * from customers where customer_email='$user'";
				
				$run_customer = mysqli_query($con, $get_customer); 
				
				$row_customer = mysqli_fetch_array($run_customer); 
				
				$c_id = $row_customer['customer_id'];
				$name = $row_customer['customer_name'];
				$email = $row_customer['customer_email'];
				$pass = $row_customer['customer_pass'];
				$country = $row_customer['customer_country'];
				$city = $row_customer['customer_city'];
				$contact = $row_customer['customer_contact'];
				$address= $row_customer['customer_address'];
				$image = $row_customer['customer_image'];
				$state = $row_customer['customer_state'];
				
				
		?>
		
<div id ="error">
    <ul id = "single_error">
    </ul>
  </div>




<div id="wrapper">
	<div class="form-container">
		<span class="form-heading">Edit your account </span>
		<form action="" method="post" enctype="multipart/form-data" onsubmit="return validation();">
                 
                  <div class="input-group">
				<i class="fa fa-picture-o"></i>
			<input type="file" name="c_image" />
			<span class="bar"></span>
		    </div>

			<div class="input-group">
				<i class="fa fa-user"></i>
			<input type="text"  name="c_name" value="<?php echo $name;?>" required>
			<span class="bar"></span>
		    </div>

		    <div class="input-group">
				<i class="fa fa-envelope"></i>
			<input type="text" type="text" name="c_email" value="<?php echo $email;?>" required>
			<span class="bar"></span>
		    </div>


		     <div class="input-group">
				<i class="fa fa-phone"></i>
			<input type="text" name="c_contact" value="<?php echo $contact;?>"/>
			<span class="bar"></span>
		    </div>

		     <div class="input-group">
				<i class="fa fa-flag"></i>
			<input type="text" name="c_country" value ='<?php echo $country; ?>'>
			<span class="bar"></span>
		    </div>
              
               <div class="input-group">
				<i class="fa  fa-flag-checkered"></i>
			<input type="text" name="c_state" value="<?php echo $state;?>"/>
			<span class="bar"></span>
		    </div> 


		    <div class="input-group">
				<i class="fas fa-city"></i>
			<input type="text" name="c_city" value="<?php echo $city;?>"/>
			<span class="bar"></span>
		    </div>

		   

            <div class="input-group">
				<i class="fa fa-address-card-o"></i>
			<input type="text-area" name="c_address" value="<?php echo $address;?>"/>
			<span class="bar"></span>
		    </div>



		    <div class="input-group">
				<button name="update" type="submit">
					<i class="fab fa-telegram-plane"></i>
				</button>
		    </div>

		</form>
	</div>
</div>


<?php 
	if(isset($_POST['update'])){
	    $ip = getIp();
		$customer_id = $c_id;
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
		echo "<script>console.log($c_image)</script>";
	
		if($c_image == ""){
		
		$update_c = "update customers set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass',customer_city='$c_city', customer_contact='$c_contact',customer_address='$c_address' where customer_id='$customer_id'";
	}
	else{

		move_uploaded_file($c_image_tmp,"customer_images/$c_image");
		 $update_c = "update customers set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass',customer_city='$c_city', customer_contact='$c_contact',customer_address='$c_address',customer_image='$c_image' where customer_id='$customer_id'";
	}
	
		$run_update = mysqli_query($con, $update_c); 
		
		if($run_update){
		
		echo "<script>alert('Your account successfully Updated')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
		
		}
	}





?>