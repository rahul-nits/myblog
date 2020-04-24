<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])): ?>
	<?php header('location:dashboard.php'); ?>
<?php else: ?>
	<?php include 'config/dbconfig.php'; ?>
	<?php include 'inc/header.php'; ?>

	<?php 
		$del_id = $_GET['id'];
		$del_sql = "SELECT * FROM post WHERE id = '$del_id'";
		$del_result = mysqli_query($db, $del_sql);
		$dell = mysqli_fetch_assoc($del_result);
		$img_del_path = $dell['f_img'];

		$arrayofdel = explode('/', $img_del_path);
 		$endofdel = end($arrayofdel);

 		unlink("assets/featuredimages/" .$endofdel);

 		$delete_sql = "DELETE FROM post WHERE id = '$del_id'";
 		$query = $db->query($delete_sql);
 		if($query){
 			header('location:dashboard.php');
 		}
		// echo $endofdel;
		// exit();
	 ?>
	<?php include 'inc/footer.php'; ?>
<?php endif; ?>