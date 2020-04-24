<?php session_start(); ?>
<?php if(!isset($_SESSION['username'])): ?>
	<?php header('location: dashboard.php'); ?>
<?php else: ?>
	<?php 
	// echo "1"; exit(); 
	?>
	<?php 
		include 'config/dbconfig.php';
		$user_id = $_SESSION['id'];
		if(isset($_POST['dislike'])){
			$post_id = $_POST['id'];
			$existid = "SELECT id FROM dislikes WHERE user_id = '$user_id' and post_id = '$post_id'";
			$existres = mysqli_query($db, $existid);
			$ress = mysqli_fetch_assoc($existres);
			$idd = $ress['id'];
			// $resultexist = mysqli_query($db, $existsql) or die('error');
			// echo $resultexist['user_idd'];
			
			if(mysqli_num_rows($existres)>0){
				// echo "exists";
				// exit();
				$sqldelete = "DELETE FROM dislikes WHERE id = '$idd'";
				mysqli_query($db, $sqldelete);
				header('location: view.php?id='.$post_id);
			}
			else{
				// $location = ;
				// echo $location;
				// exit();
			$sql = "INSERT INTO dislikes(user_id, post_id) VALUES('$user_id', '$post_id')";
			mysqli_query($db, $sql);
				header('location: view.php?id='.$post_id);
			}
		}

	 ?>
<?php endif; ?>