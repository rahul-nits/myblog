<?php 	include 'config/dbconfig.php'; ?>
<?php 	session_start(); ?>
<?php 	if(!isset($_SESSION['username'])): ?>
		<?php 	header('location: dashboard.php'); ?>
<?php 	else: ?>
<?php 	
	
	$id = $_GET['id'];
	$post_query = "SELECT * FROM post WHERE id = '$id'";
 	$post_result = mysqli_query($db, $post_query);
	$post = mysqli_fetch_assoc($post_result);
	$id = $post['id'];
	$title = $post['title'];
	$description = $post['description'];
	$category = $post['category'];
	$f_img = $post['f_img'];
	
 ?>
<?php include 'inc/header.php'; ?>
<legend style="margin-top:30px; text-align: center;">Welcome to myBLOG</legend>
	<div class="container" style="border: 20px solid #5dbdea; padding-top: 10px; padding-bottom: 10px; margin-top: 10px; margin-bottom: 50px;">
		<form action="update.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="f_img" value="<?php echo $f_img; ?>">
			  <fieldset>
			    
			    <legend>Update Post</legend>
					
			    <div class="form-group">
			      <label for="title">Title</label>
		      <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
			    </div>

			    <div class="form-group">
			      
			      <textarea class="form-control" rows="5" cols="10" name="description" placeholder="Description Don't use apostrophe"><?php 	echo $description; ?></textarea>
			    </div>



			    <div class="form-group">
			      <label for="category">Category</label>

			      <select name="category" class="form-control">
			      	
			      	<option><?php 	echo $category; ?></option>
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
			    				<input type="submit" name="update" value="Update Post" class="btn btn-primary" style="width: 120px;  ">

			    				<button class="btn btn-default"><a href="dashboard.php">Back</a></button>
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


<?php 	endif; ?>