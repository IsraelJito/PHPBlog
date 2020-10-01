<?php 
ob_start();
require_once('header.php');
session_start();
if (!isset($_SESSION['user'])) {
	header('Location: index.php');
}
$user = $_SESSION['user'];
$errors = [];
if (isset($_POST['submit'])) {
	if(createPost(array_merge($_POST, $_FILES))){
		$success = "Successfully created a blog post";
	}
}

?>
<div class="container">
	<h1>Welcome <?= $_SESSION['user']['full_name']; ?>!..</h1>

<img src="" style="height: 200px; width: 200px; border-radius: 50%; background-color: #ccc;">
<form><input type="file" name="profile_pic" ></form>
<p style="text-align: end;"><a href="posts.php" style="color: blue;">View My Posts</a></p>
</div>



<!-- ##### Login Area Start ##### -->
<div class="vizew-login-area section-padding-80" style="padding-bottom: 0;">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-6">
				<div class="login-content">
					<!-- Section Title -->
					<div class="section-heading">
						<h4>CREATE ARTICLES</h4>
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
							<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Post Title" name="title" >
							<div class="form-group">
								<span style="color: red;"><?php if (!empty($errors['file'])) {echo $errors['file'];} ?></span>
								<input type="file" class="form-control" id="exampleInputEmail1"  name="file">
							</div>
							<div class="form-group">
								<select class="form-control"  name="status" >
									<option value="active">publish</option>
									<option value="inactive">draft</option>
								</select>
							</div>

							<div class="form-group">
								<span style="color: red;"><?php if (!empty($errors['post'])) {echo $errors['post'];}  ?></span>
								<textarea class="form-control" placeholder="Start writing" name="post" ></textarea>
							</div>
							<button type="submit" name="submit" class="btn vizew-btn w-100 mt-30">Create</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<span class="container"><a href="logout.php" style="color: red;">Logout</a></span>


<?php require_once('footer.php') ?>
