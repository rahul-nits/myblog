<?php 
	session_start();
	include 'config/dbconfig.php';
	if (isset($_POST['login'])) {
		# code...
		$email = $_POST['email'];
		$password = $_POST['password'];
		if ($email != '' && $password != '') {
			# code...
			$passwd = sha1($password);
			$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$passwd'";	
			$result = mysqli_query($db, $sql) or die('error');
			if (mysqli_num_rows($result)>0) {
				# code...
				while($row = mysqli_fetch_assoc($result)){
					$id = $row['id'];
					$username = $row['username'];
					$email = $row['email'];
					$password = $row['password'];

					$_SESSION['id'] = $id;
					$_SESSION['username'] = $username;
					$_SESSION['email'] = $email;
					$_SESSION['password'] = $password;
					header('Location: dashboard.php');
					// $data = array(
					// 	'id' => $id;
					// 	'username' => $username;
					// 	'email' => $email;
					// 	'password' => $password;
					// )
				}
			}
			else{
				$error = 'Username or Password is incorrect!';
			}
		}
		else{
			$error = "Please fill all the details!";
		}
	}
 ?>

<?php if(isset($_SESSION['username'])): ?>
	<?php header('location:dashboard.php') ?>
<?php else: ?>

<?php include 'inc/header.php'; ?>
	<legend style="margin-top:30px; text-align: center;">Welcome to myBLOG</legend>
	<div class="container" style="border: 20px solid #5dbdea; padding-top: 10px; padding-bottom: 10px; margin-top: 10px; margin-bottom: 50px;">
		<form action="login.php" method="POST">
			  <fieldset>
			    
			    <legend>Login Here</legend>
			
			    <div class="form-group">
			      <label for="email">Email address</label>
		      <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
			      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
			    </div>
			    <div class="form-group">
			      <label for="password">Password</label>
			      <input type="password" class="form-control" name="password" placeholder="Password">
			    </div>

			    <div class="row">
			    	<div class="col-md-6">
			    		<div class="form-group">
			    			<div class="col-lg-10" style="padding: 0px;">
			    				<input type="submit" name="login" value="Login" class="btn btn-primary" style="width: 100px;  ">
			    				<button type="reset" class="btn btn-default">Cancel</button>
			    			</div>
			    		</div>
			    	</div>
			    </div>

			    <div class="row" style="margin-left: inherit;">
			    	<div class="form-group">
			    		<div class="col-lg-60">
			    			
			    		<?php if (isset($_POST['login'])) : ?>
			    			<div class="alert alert-dismissible alert-warning">
			    				<p><?php echo $error; ?></p>
			    			</div>
			    		<?php endif ?>
			    		</div>
			    	</div>
			    </div>
			    
			    </fieldset>
			    
  		</form>
	</div>


<?php include 'inc/footer.php'; ?>

<?php endif; ?>