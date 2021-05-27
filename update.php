<?php 
	session_start();

 ?>

 <?php 
 	include 'config/dbconfig.php';
 	if (isset($_FILES['f_img'])) {
 		# code...
 		$post_id = $_POST['id'];
 		$upl_f_img = $_POST['f_img'];
 		$title = $_POST['title'];
 		$description = $_POST['description'];
 		$category = $_POST['category'];
 		if($title != '' && $description != '' && $category != ''){
 			$uploadok =1;
 			$file_name = $_FILES['f_img']['name'];
 			$file_size = $_FILES['f_img']['size'];


 			$file_tmp = $_FILES['f_img']['tmp_name'];
 			// echo $upl_f_img;
 			// exit();
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

 				$image_path = explode('/', $upl_f_img);
 				$image = $image_path[6];
 				$img_del_path = "assets/featuredimages/" .$image;
 				// unlink("$img_del_path");

 				// move_uploaded_file($file_tmp, "assets/featuredimages/" . $file_name);
 				$url = $_SERVER['HTTP_REFERER'];
 				$seg = explode('/', $url);
 				$path = $seg[0].'/'.$seg[1].'/'.$seg[2].'/'.$seg[3];
 				$full_url = $path.'/'.'assets/featuredimages/'.$file_name;
 				$id = $_SESSION['id'];
 				$queryp = "SELECT * FROM users WHERE id = '$id'";
				$resultp = mysqli_query($db, $queryp) or die('error');
				$rowp = mysqli_fetch_assoc($resultp);
				$urole = $rowp['user_role'];
 				// $urole = "SELECT user_role FROM users where id = '$id'";
		 		// 		echo $full_url;
 				// exit();
 				$sql = "UPDATE post SET title = '$title', description = '$description', category = '$category', f_img = '$full_url' WHERE id = '$post_id'";

 				

 				$query = $dbh->query($sql);
 				if($query){
 					unlink("$img_del_path");

 				move_uploaded_file($file_tmp, "assets/featuredimages/" . $file_name);
 					// echo $sql;
 					// exit();
 					header('location:dashboard.php');
 				}
 				else{
 					
 					echo "<script>alert('unable to Edit your Post');</script>";
 					header('location:dashboard.php');
 					// $msg = 'Failed to upload image!';
 					// exit();
 				}
 			}
 		}
 		else{
 			$msg = 'Please fill all the details!';
 		}

 	}
  ?>
