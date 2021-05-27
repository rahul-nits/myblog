<?php ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/blog.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<style type="text/css">
		body{
			background: url(img/blue3.jpg);
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
	</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


	<script type="text/javascript" 
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<title>myBLOG</title>
</head>
<body>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic|Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="col-lg-10">
			<a href="login.php"><img src="img/logo.png" style="max-width: 150px;"></a>
	  		 <!-- <a class="navbar-brand" href="#" style="color: #fff;">myBLOG</a> -->
			
		</div>

		
				  <div class="dropdown">
					    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					      Settings
					    </button>

					    <div class="dropdown-menu">
					    	<?php $login_url = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'] ?>
					  <?php if($login_url == 'localhost/phpblog/index.php'): ?>
					      <a class="dropdown-item" href="login.php">Login</a>
					  <?php elseif(isset($_SESSION['username'])): ?>

						<?php
							$ids = $_SESSION['id'];
					  		$unamesql = "SELECT user_role FROM users WHERE id = '$ids'";
							$uresult = mysqli_query($db, $unamesql) or die('error');
							$urow = mysqli_fetch_assoc($uresult);
							$urole = $urow['user_role'];
						?>

					      	<a class="dropdown-item" href="dashboard.php">Dashboard</a>
					      	<a class="dropdown-item" href="profile.php">Add Profile</a>
					      	<a class="dropdown-item" href="post.php">Add Post</a>
					      	
					      	<a class="dropdown-item" href="logout.php">Logout</a>
					   <?php else: ?>
					      	<a class="dropdown-item" href="login.php">Login</a>
					      	<a class="dropdown-item" href="index.php">Register</a>
					  <?php endif ?>
					    </div>
				  </div>


	  
	</nav>