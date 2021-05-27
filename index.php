<?php 
	include 'config/dbconfig.php';
	if (isset($_POST['register'])) {
		# code...
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		if ($username != '' && $email != '' && $password != '') {
			# code...
			$pwd_hash = sha1($password);
			$sql = "INSERT INTO users (username, email, password, user_role) values ('$username', '$email', '$pwd_hash', 0)";
			$query = $db->query($sql);
			if($query){
				header('location:login.php');
			} 
			else{
				$error = 'Failed to register user!';
			}
			echo "<script>alert('Success');</script>";
		}
		else
		{
			$error = 'Please Fill all the details!';
		}
	}
 ?>
<?php include 'inc/header.php'; ?>
	 <h1 style="margin-top:30px; text-align: center;">WELCOME TO myBLOG</h1>
 
 <div class="container" style="border: 20px solid #5dbdea; padding-top: 10px; padding-bottom: 10px; margin-top: 10px; margin-bottom: 50px;">

		<form action="index.php" method="POST">
			  <fieldset>
			    <h3>Register Here <span style="font-size: small;">to view our BLOGS</span>	</h3>
			  
			    <div class="form-group">
			      <label for="username">Username</label>
			      <input type="text" class="form-control" name="username" placeholder="Username">
			    </div>

			    <div class="form-group">
			      <label for="email">Email address</label>
			      <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
			      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			    </div>
			    <div class="form-group">
			      <label for="password">Password</label>
			      <input type="password" class="form-control" name="password" placeholder="Password">
			    </div>

			    <div class="row">
			    	<div class="col-md-6">
			    		<div class="form-group">
			    			<div class="col-lg-10" style="padding: 0px;">
			    				<input type="submit" name="register" value="Register" class="btn btn-primary" style="width: 100px;  ">
			    				<button type="reset" class="btn btn-default">Cancel</button>
			    			</div>
			    		</div>
			    	</div>
			    </div>

			    <div class="row" style="margin-left: inherit;">
			    	<div class="form-group">
			    		<div class="col-lg-60">
			    			
			    		<?php if (isset($_POST['register'])) : ?>
			    			<div class="alert alert-dismissible alert-warning">
			    				<p><?php echo $error; ?></p>
			    				
			    			</div>
			    		<?php endif ?>
			    		</div>
			    	</div>
			    </div>
			    
			    </fieldset>
			    
  		</form>

  		<h3 style="font-size: medium;"><a href="login.php">Login</a> if already register</h3>



	</div>
<?php include 'inc/footer.php'; ?>