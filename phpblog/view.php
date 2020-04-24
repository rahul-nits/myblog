<?php 	session_start(); ?>
<?php 	if(!isset($_SESSION['username'])): ?>
		<?php 	header('location:dashboard.php'); ?>
<?php 	else: ?>

<?php 	include 'config/dbconfig.php'; ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/footer.php'; ?>
<?php $id = $_GET['id']; 
// echo $id;
// exit();
?>
<?php 	
	$post_query = "SELECT * FROM post WHERE id = '$id'";
 			$post_result = mysqli_query($db, $post_query);
			$post = mysqli_fetch_assoc($post_result);
			$id = $post['id'];
// echo $id;
// exit();
			$title = $post['title'];
			$description = $post['description'];
			$category = $post['category'];
			$f_img = $post['f_img'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>My Blog</title>
	<link rel="stylesheet" type="text/css" href="assets/css/blog.css">
</head>
<body>

<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic|Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>

<div class="post">

	<div class="featuredimage" > <img style="width: 200px; height: 200px;" src=<?php echo $f_img; ?>>	</div>
	 
	<div class="category"><?php echo $category; ?></div>
	<h2><?php echo $title; ?></h2>

	<p class="description">
		<?php 	echo $description; ?>
	</p>

	<hr>
	<div class="col-lg-3" >	<a href="dashboard.php" style="color: white; background: #00cc00; ">View Dashboard</a></div>
		<form action="likes.php" method="POST" target="_blank" >
			<input type="hidden" name="id" value=<?php echo $id; ?>>
			<?php 
				$sql = "SELECT * FROM likes WHERE post_id = '$id'";
				$query = mysqli_query($db, $sql) or die('error');
				$cnt_likes = mysqli_num_rows($query);
			?>
			<input type="submit" name="like" value="Like" style="background: none; margin-left: 10px; color: #337ab7; border: none;"><?php echo $cnt_likes; ?>
		</form>

		<form action="dislikes.php" method="POST" target="_blank">
			<input type="hidden" name="id" value=<?php echo $id; ?>>
			<?php 
				$sql = "SELECT * FROM dislikes WHERE post_id = '$id'";
				$query = mysqli_query($db, $sql) or die('error');
				$cnt_dislikes = mysqli_num_rows($query);
			?>
			<input type="submit" name="dislike" value="Dislike" style="background: none; margin-left: 10px; color: #337ab7; border: none;"><?php echo $cnt_dislikes; ?>
		</form>

 <div style="padding-left: 15px;">
 	
				<form  action="comment.php" method="POST">

						<label>Add Comment</label>
						<input type="hidden" name="pid" value=<?php echo $id; ?>>
							<textarea class="form-control" rows="3" cols="5" name="comment" placeholder="comment"></textarea>
							<br>
							<input type="submit" name="postcomment" value="Comment" class="btn btn-primary">
				</form>

				<br>
				<!-- <br> -->
				<h4>All Comments</h4>
				<!-- <hr> -->
				<?php 
					$comm_sql = "SELECT * FROM comments WHERE post_id = '$id' ORDER BY id DESC";
					$comm_query = mysqli_query($db, $comm_sql) or die ('error');
					if(mysqli_num_rows($comm_query)>0){
					// echo "HI";	
						while($comm = mysqli_fetch_assoc($comm_query)){ ?> 
							<hr>
							<?php
							$user = $comm['username'];
							$cmnt = $comm['comment'];
							?>
							<?php echo $cmnt; ?> <br>
							<small>Posted by: <?php echo $user; ?></small>
						<!-- <hr> -->
							<?php
						
						}
					}
				 ?>
 </div>
		

</div>


</body>
</html>

<?php 	endif; ?>