<?php 
ob_start();
require_once('header.php');
session_start();
if (!isset($_SESSION['user'])) {
	header('Location: index.php');
}
$user = $_SESSION['user'];

// userOldpost($_GET['id']);
$edit = $_GET['id'];
$query = mysqli_query($db, "SELECT title,image,status,post FROM posts WHERE id = '$edit' ");
$oldpost = mysqli_fetch_assoc($query);
$errors = [];
if (isset($_POST['submit'])) {
	if(editPost(array_merge($_POST, $_FILES))){
		$success = "Successfully Saved!.";
	}
} 

?>


<div class="container" style="padding: 50px 0;">

	<div class="section-heading">
		<h4>Edit ARTICLES</h4>
		<div class="line"></div>
	</div>
	<span style="color: green;">
		<?php if (!empty($success)) {
			echo $success;
		} ?>
	</span>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<span style="color: red;"><?php if (!empty($errors['title'])) {echo $errors['title'];} ?></span>
			<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Post Title" name="title" value="<?= $oldpost['title'] ?>">
		</div>
		<div class="form-group">
			<span style="color: red;"><?php if (!empty($errors['file'])) {echo $errors['file'];} ?></span>
			<input type="file" class="form-control" id="exampleInputEmail1"  name="file" value="<?= $oldpost['image'] ?>">
		</div>
		<div class="form-group">
			<select class="form-control"  name="status" >
				<option value="active">publish</option>
				<option value="inactive">draft</option>
			</select>
		</div>

		<div class="form-group">
			<span style="color: red;"><?php if (!empty($errors['post'])) {echo $errors['post'];}  ?></span>
			<textarea class="form-control" placeholder="Start writing" name="post" ><?= $oldpost['post'] ?></textarea>
		</div>
		<button type="submit" name="submit" class="btn vizew-btn w-100 mt-30">Create</button>
	</form>
</div>

<?php require_once('footer.php'); ?>