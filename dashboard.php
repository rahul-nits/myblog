<?php
 session_start()
 ?>

<?php 
	include 'config/dbconfig.php';
	$id = $_SESSION['id'];

	// $unamesql = "SELECT user_role FROM users WHERE id = '$id'";
	// $uresult = mysqli_query($db, $unamesql) or die('error');
	// $urow = mysqli_fetch_assoc($uresult);
	// echo $urow['user_role'];



	$query = "SELECT * FROM profile WHERE id = '$id'";
	$result = mysqli_query($db, $query) or die('error');
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
			$id = $row['id'];
			$profession = $row['profession'];
			$avatar = $row['avatar'];

		}
	}
	else 
	{
		$profession = 'profession as Blogger';
		$full_url = $full_url = 'img'.'/'.'avatar.png';
		$avatar = $full_url;
	}
 ?>

<?php if(!$_SESSION['username']): ?>
	<?php header('location:login.php') ?>
<?php else: ?>
  <?php include 'inc/header.php'; ?>

  <h1 style="margin-top:30px; text-align: center;">WELCOME TO myBLOG</h1>
 
 <div class="container" style="border: 20px solid #5dbdea; padding-top: 10px; padding-bottom: 10px; margin-top: 10px; margin-bottom: 50px;">

 	<?php 
 		$url = $_SERVER['PHP_SELF'];
 		// $seg = explode('/', $url);
 		// $path = 'localhost'.$seg[0].'/'.$seg[1];
 		// echo $path;
 		$full_url = 'img'.'/'.'avatar.png';
 		// echo $full_url;
 	 ?>

 	 <?php 
 	 	$query = "SELECT * FROM users WHERE id = '$id'";
		$result = mysqli_query($db, $query) or die('error');
		$row = mysqli_fetch_assoc($result);
		$user_role = $row['user_role'];
 	  ?>
 	  <?php if($user_role == 1): ?>
 	  	<!-- style="text-align: center;" -->
 	  	<legend>Admin Dashboard</legend>
 	  <?php else: ?>
 	  	<legend>User Dashboard</legend>
 	  <?php endif ?>

 	<h1 style="text-align: center;"><?php echo $_SESSION['username']; ?></h1>

 	<div class="row">
 		<div class="col-lg-12">
 			<p style="text-align: center;">
 				<img src="<?php echo $avatar; ?>" style="width: 200px; height: 200px; border-radius: 50%;" >
 				<h6 style="text-align: center;"><?php echo $profession; ?></h6>
  			</p>
 		
 		<h3 style="text-align: center;">ALL POSTS</h3>
 		
 		</div>

 	</div>

 		<?php 
 			$post_query = "SELECT * FROM post";
 			$post_result = mysqli_query($db, $post_query);
 			if(mysqli_num_rows($post_result) > 0){
 				while($post = mysqli_fetch_assoc($post_result)){
 					$id = $post['id'];
 					$title = $post['title'];
 					$description = $post['description'];
 					$category = $post['category'];
 					$f_img = $post['f_img'];
 					// echo $f_img;
 					// exit();
 					?>
 					<div class="row" style="border: 12px solid white;">
 						
 						<div class="col-lg-2">	
 							<img style="width: 150px; height: 150px;" src=<?php echo $f_img ?> >	
 						</div>
 						
 						<div class="col-lg-10" style="width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">	
 							<h3><a href=""><?php echo $title; ?></a></h3>
 							<p>	<?php 	echo $description; ?></p>
 							<a href=""><?php 	echo $category; ?></a>
 							<div class="row">
 								<?php if($_SESSION['id']!=1): ?>
 									<div class="col-lg-1"> <a href="view.php?id=<?php echo $id; ?>">View</a>	</div>
 								<?php else: ?>
 									<div class="col-lg-1"> <a href="view.php?id=<?php echo $id; ?>">View</a>	</div>
 									<div class="col-lg-1"> <a href="edit.php?id=<?php echo $id; ?>">Edit</a>	</div>
 									<div class="col-lg-1"> <a href="delete.php?id=<?php echo $id; ?>">Delete</a></div>
 								<?php endif; ?>
 								</div>
 						</div>		 		
 					
 					</div>

 					<?php
 				}
 			}
 		 ?>


 </div>


 
 <?php include 'inc/footer.php'; ?>

 <?php endif; ?>