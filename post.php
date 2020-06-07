<?php
	require('config/config.php');
	require('config/db.php');

	//check for submit
	if(isset($_POST['delete'])){
		//Get form data
		$delete_id = mysqli_real_escape_string($conn,$_POST['delete_id']);

		$query = "DELETE FROM posts WHERE id='$delete_id'";

		if(mysqli_query($conn, $query)){
			header('Location: '.ROOT_URL.'');
		}else{
			echo 'ERROR '.mysqli_error($conn);
		}

	}

	//get id
	$id = mysqli_real_escape_string($conn, $_GET['id']);


	//Create query
	$query = 'SELECT * FROM posts WHERE id = '.$id;

	//Get the result
	$result = mysqli_query($conn, $query);

	//Fetch data
	$post = mysqli_fetch_assoc($result);
	//var_dump($posts);

	//Free Result
	mysqli_free_result($result);

	//Close the connection
	mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>
<div class="jumbotron">
	<a class="btn btn-outline-info" href="<?php echo ROOT_URL; ?>">Back</a>
	<h1 class="display-3">Posts</h1>
	<hr class="my-4">
	
		<div class="well-sm">
			<h1 class="lead"><?php echo $post['title']; ?></h1>
			<small>Created on <?php echo $post['created_at']; ?></small>
			<p><?php echo $post['body']; ?></p>
			<hr>
			<form class="pull-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn btn-danger">
			</form>
			<br>

			<a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id'] ?>" class = "btn btn-primary">Edit</a>
		</div>
</div>
<?php include('inc/footer.php'); ?>