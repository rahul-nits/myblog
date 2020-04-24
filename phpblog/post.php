<?php 
	session_start();

 ?>

 <?php 
 	include 'config/dbconfig.php';
 	if (isset($_FILES['f_img'])) {
 		# code...
 		$title = $_POST['title'];
 		$description = $_POST['description'];
 		$category = $_POST['category'];
 		if($title != '' && $description != '' && $category != ''){
 			$uploadok =1;
 			$file_name = $_FILES['f_img']['name'];
 			$file_size = $_FILES['f_img']['size'];

// echo $file_name;
// echo $file_size;
 				// exit();
 			$file_tmp = $_FILES['f_img']['tmp_name'];
 			$file_type = $_FILES['f_img']['type'];
 			$target_dir = "assets/featuredimages";

 			$target_file = $target_dir . basename($_FILES['f_img']['name']);
 			$check = getimagesize($_FILES['f_img']['tmp_name']);
 			// $text = end(explode('.', $_FILES['f_img']['name']));
 			$arrayofupload = explode('.', $_FILES['f_img']['name']);
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
 				move_uploaded_file($file_tmp, "assets/featuredimages/" . $file_name);
 				$url = $_SERVER['HTTP_REFERER'];
 				$seg = explode('/', $url);
 				$path = $seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3];
 				$full_url = $path.'/'.'assets/featuredimages/'.$file_name;
 				$id = $_SESSION['id'];


 			// 	$queryp = "SELECT * FROM users WHERE id = '$id'";
				// $resultp = mysqli_query($db, $queryp) or die('error');
				// $rowp = mysqli_fetch_assoc($resultp);
				// $urole = $rowp['user_role'];
		 				
 				// $urole = "SELECT user_role FROM users where id = '$id'";
 				$sql = "INSERT INTO post(title, description, category, f_img, user_role) VALUES('$title', '$description', '$category', '$full_url', '$id')";

 				// echo $file_name;
 				// exit();

 				$query = $db->query($sql);
 				if($query){
 					header('location:dashboard.php');
 				}
 				else{
 					$msg = 'Failed to upload post check all the details!';
 					$img_del_path = "assets/featuredimages/" .$file_name;
 					unlink("$img_del_path");
 					// header('location:dashboard.php');
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
		<form action="post.php" method="POST" enctype="multipart/form-data">
			  <fieldset>
			    
			    <legend>Add Post</legend>
			
			    <div class="form-group">
			      <label for="title">Title</label>
		      <input type="text" class="form-control" name="title" placeholder="Enter Title">
			    </div>

			    <div class="form-group">
			      
			      <textarea class="form-control" rows="5" cols="10" name="description" placeholder="Description Don't use apostrophe"></textarea>
			    </div>



			    <div class="form-group">
			      <label for="category">Category</label>

			      <select name="category" class="form-control">
			      	
			      	<option>Select</option>
			      	<option value="entertainment">Entertainment</option>
			      	<option value="politics">Politics</option>
			      	<option value="sports">Sports</option>
			      	<option value="technology">Technology</option>
			      	
			      </select>
			      
			    </div>
			    <div class="form-group">
			     <label for="featuredimage">Featured Image</label>
			    <input type="file" name="f_img" class="form-control" name="featuredimage" required>
			     </div>
			    <div class="row">
			    	<div class="col-md-6">
			    		<div class="form-group">
			    			<div class="col-lg-10" style="padding: 0px;">
			    				<input type="submit" name="post" value="Add Post" class="btn btn-primary" style="width: 120px;  ">
			    				<button type="reset" class="btn btn-default">Cancel</button>
			    			</div>
			    		</div>
			    	</div>
			    </div>

			    <div class="row" style="margin-left: inherit;">
			    	<div class="form-group">
			    		<div class="col-lg-60">
			    			
			    		<?php if (isset($_POST['post'])) : ?>
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