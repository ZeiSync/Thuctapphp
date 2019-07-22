<?php 
	include('config/db_connect.php');


	if(isset($_POST['delete'])){
		$id_to_delete = mysqli_real_escape_string($connect, $_POST['id_to_delete']);
		$sql = "DELETE FROM pizza_order WHERE id = $id_to_delete";
		if(mysqli_query($connect, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($connect);
		}
	}


	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
		$id = mysqli_real_escape_string($connect, $_GET['id']);
		// make sql
		$sql = "SELECT * FROM pizza_order WHERE id = $id";
		// get the query result
		$result = mysqli_query($connect, $sql);
		// fetch result in array format
		$pizzas = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		mysqli_close($connect);
	}
?>


<!DOCTYPE html>
<html>
	<?php include('temp/header.php'); ?>
	<div class="container center">
		<?php if($pizzas): ?>
			<h4><?php echo $pizzas['pizza']; ?></h4>
			<p>Created by <?php echo $pizzas['email']; ?></p>
			<p><?php echo date($pizzas['create_at']); ?></p>
			<h5>Ingredients:</h5>
			<p><?php echo $pizzas['ingerdient']; ?></p>

			<!-- DELETE FORM -->
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $pizzas['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>

		<?php else: ?>
			<h5>No such pizza exists.</h5>
		<?php endif ?>
	</div>
	<?php include('temp/footer.php')?>
</html>