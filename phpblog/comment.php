<?php 	session_start(); ?>
<?php 	if(!isset($_SESSION['username'])): ?>
		<?php 	header('location:dashboard.php'); ?>
<?php 	else: ?>

<?php 	include 'config/dbconfig.php'; ?>
<?php 
	if(isset($_POST['postcomment'])){
		$userid = $_SESSION['id'];
		$username = $_SESSION['username'];
		$postid = $_POST['pid'];
		$comment = $_POST['comment'];
		if($comment != ''){
			$sql = "INSERT INTO comments(user_id, post_id, username, comment) VALUES('$userid', '$postid', '$username', '$comment')";
			$query = mysqli_query($db, $sql) or die('error');
			if($query){
				header("location:view.php?id=" . $postid);
			}
		} 
	}
 ?>

<?php endif; ?>