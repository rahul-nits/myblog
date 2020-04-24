<?php 
	session_start();

 ?>

 <?php 
 	include 'config/dbconfig.php';
 	if (isset($_POST['profile'])) {
 		# code...
 		$profession = $_POST['profession'];
 		if($profession != ''){
 			$uploadok =1;
 			$file_name = $_FILES['avatar']['name'];
 			$file_size = $_FILES['avatar']['size'];
 			$file_tmp = $_FILES['avatar']['tmp_name'];
 			$file_type = $_FILES['avatar']['type'];
 			$target_dir = "assets/uploads";

 			$target_file = $target_dir . basename($_FILES['avatar']['name']);
 			$check = getimagesize($_FILES['avatar']['tmp_name']);
 			// $text = end(explode('.', $_FILES['avatar']['name']));
 			$arrayofupload = explode('.', $_FILES['avatar']['name']);
 			$endofupload = end($arrayofupload);
 			// print_r($endofupload);
 			$file_ext = strtolower($endofupload);
 			// exit();
 			$extension = array('jpeg', 'jpg', 'png');
 			if (in_array($file_ext, $extension) == false) {
 				# code...
 				$msg = 'Choose Only jpg, jpeg or png format!';
 			}
 			if (file_exists($target_file)) {
 				# code...
 				$msg = 'Sorry File already exist!';
 			}
 			if ($check == false) {
 				# code...
 				$msg = 'File is not an Image!';
 			}
 			if(empty($msg) == true){
 				move_uploaded_file($file_tmp, "assets/uploads/" . $file_name);
 				$url = $_SERVER['HTTP_REFERER'];
 				$seg = explode('/', $url);
 				$path = $seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3];
 				$full_url = $path.'/'.'assets/uploads/'.$file_name;
 				$id = $_SESSION['id'];


 			// 	$queryp = "SELECT * FROM users WHERE id = '$id'";
				// $resultp = mysqli_query($db, $queryp) or die('error');
				// $rowp = mysqli_fetch_assoc($resultp);
				// $urole = $rowp['user_role'];
		 				// echo $id;
 				// exit();
 				// $urole = "SELECT user_role FROM users where id = '$id'";
 				$sql = "INSERT INTO profile(profession, avatar, user_role) VALUES('$profession', '$full_url', '$id')";
 				$query = $dbh->query($sql);
 				if($query){
 					header('location:dashboard.php');
 				}
 				else{
 					$msg = 'Failed to upload image!';
 				}
 			}
 		}
 		else{
 			$msg = 'Please fill all the details!';
 		}

 	}
  ?>

 <?php if (!isset($_SESSION['username'])): ?>
 	<?php header('location: dashboard.php') ?>
 <?php else: ?>

<?php include 'inc/header.php'; ?>
	<legend style="margin-top:30px; text-align: center;">Welcome to myBLOG</legend>
	<div class="container" style="border: 20px solid #5dbdea; padding-top: 10px; padding-bottom: 10px; margin-top: 10px; margin-bottom: 50px;">
		<form action="profile.php" method="POST" enctype="multipart/form-data">
			  <fieldset>
			    
			    <legend>Add Profile Here</legend>
			
			    <div class="form-group">
			      <label for="profession">Profession</label>
		      <input type="text" class="form-control" name="profession" aria-describedby="emailHelp" placeholder="Enter your designation">
			      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
			    </div>
			    <div class="form-group">
			      <label for="avatar">Avatar</label>
			      <input type="file" class="form-control" name="avatar" placeholder="Avatar">
			    </div>

			    <div class="row">
			    	<div class="col-md-6">
			    		<div class="form-group">
			    			<div class="col-lg-10" style="padding: 0px;">
			    				<input type="submit" name="profile" value="Add Profile" class="btn btn-primary" style="width: 120px;  ">
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
			    				<p><?php echo $msg; ?></p>
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