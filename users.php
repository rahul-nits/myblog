<?php session_start(); ?>
<?php if (!isset($_SESSION['username'])): ?>
	<?php header('location: dashboard.php'); ?>
<?php else: ?>
	<?php 
		include 'config/dbconfig.php';
		include 'inc/header.php';
	 ?>

	 	<legend style="margin-top:30px; text-align: center;">Welcome to myBLOG</legend>
		<div class="container" style="border: 20px solid #5dbdea; padding-top: 10px; padding-bottom: 10px; margin-top: 10px; margin-bottom: 50px;">

			<legend>View All Users</legend>

			
		</div>
	 <?php include 'inc/footer.php'; ?>
<?php endif ?>