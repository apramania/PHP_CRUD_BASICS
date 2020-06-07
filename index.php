<?php
	require ('config/config.php');
	require('config/db.php');


	//Create query
	$query = 'SELECT * FROM posts ORDER BY created_at desc';

	//Get the result
	$result = mysqli_query($conn, $query);

	//Fetch data
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
	//var_dump($posts);

	//Free Result
	mysqli_free_result($result);

	//Close the connection
	mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>
<div class="jumbotron">
	<h1 class="display-3">Posts</h1>
	<hr class="my-4">
	<?php foreach($posts as $post): ?>
		<div class="well-sm">
			<h3 class="lead"><?php echo $post['title']; ?></h3>
			<small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
			<p><?php echo $post['body']; ?></p>
			<a class="btn btn-primary" href=" post.php?id=<?php echo $post['id']; ?>">Read More</a>
		</div>
	<?php endforeach; ?>
</div>
<?php include('inc/footer.php'); ?>