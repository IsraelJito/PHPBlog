<?php
function dbConnection() {
	$conn = mysqli_connect('localhost', 'root', '', 'blogi');

	if (mysqli_errno($conn)) {
		die('COULD NOT CONNECT TO DATABASE**');
	}else{
		// if(!mysqli_select_db($conn, 'blogi')) {
		// 	die('COULD NOT CONNECT TO DATABASE**');
		// }
		return $conn;
	}
}

function run_test($data) {
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function signup ($request) {
	global $db, $errors;
	if (empty (run_test($request['full_name']))) {
		$errors[] = "Fullname is required";
	}else{
		if (!preg_match("/^[a-zA-Z ]*$/", run_test($request['full_name']))) {
			$errors[] = "Fullname must contain only letters and white space";
		}
		$full_name = run_test($request['full_name']);
	}

	if (empty(run_test($request['email']))) {
		$errors[] = "Email is required";
	}elseif (filter_var($request['email'], FILTER_VALIDATE_EMAIL) == false) {
		$errors[] = "Please enter a valid email";
	}else {
		$email = run_test($request['email']);
	}

	if (empty($request['password'])) {
		$errors [] = "Password is required";
	}elseif (strlen($request['password']) < 8 || !preg_match("@[A-Z]@", $request['password']) || !preg_match("@[a-z]@", $request['password']) || !preg_match("@[0-9]@", $request['password']) || !preg_match("@[^\w]@", $request['password'])) {
		$errors[] = "Password must be at least 8 characters long and must have uppercase, lowercase, number or special characters";
	}

	if(!empty($request['confirm_password']) && $request['confirm_password'] !== $request['password']) {
		$errors[] = "Password does not match";
	}
	if(empty($errors)) {
		$password = md5($request['password']);
		$query = mysqli_query($db, "INSERT INTO users (full_name, email, password) VALUES ('$full_name', '$email', '$password')");

		if (mysqli_affected_rows($db) == 1) {
			return true;
		}else {
			return false;
		}
	}
}

function login($request) {

	global $db, $error, $emailerr, $passworderr;
	if (empty($request['email'])) {
		$emailerr = "Please Enter Your Username Or Email";
	}
	if (empty($request['password'])) {
		$passworderr = "Please Enter Your Password";
	}
	$email = $request['email'];
	$password = md5($request['password']);
	if (!empty($email) && !empty($password)) {

		$checkuser = "SELECT * FROM users WHERE Email = '$email' and password = '$password' LIMIT 1 ";
		$query = mysqli_query($db, $checkuser);
		// $getuser = mysqli_fetch_arrray($query);
		$no = mysqli_num_rows($query);

		if ($no == 0) {
			$error = "Invalid Email Or Password!";
		}else {
			$data = mysqli_fetch_assoc($query);
			$_SESSION['user'] = $data;
			return true;

			// header('Location: home.php');
		}
	}
}

function createPost($request) {
	global $db, $errors, $user;
	if (empty(filter_var($request{'title'}, FILTER_SANITIZE_STRING))) {
		$errors['title'] = "Your Article Needs A Title";
	}else{
		$title = filter_var($request{'title'}, FILTER_SANITIZE_STRING);
	}
	if (empty($request['file']['name'])) {
		$errors['file'] = "Please choose an image file!";
	}elseif (!getimagesize($request['file']['tmp_name'])) {
		$errors['file'] = "Please choose a valid image";
	}else{
		//pick 10 random numbers from 10000
		$random = rand(10, 10000);
		//shufffle some alphabets and the random 10 numbers
		$string = str_shuffle('ABCDEFGHIzxcvbnmkljhdsa'.$random);
		//explode the file name the user inputed at the . , and take from the end after the .
		$dd=explode(".", $request['file']['name']);
		$extension = end($dd);
		//assign a new image name
		$imageName = $string.'.'.$extension;
	}
	if (empty($request['status'])) {
		$errors['status'] = 'Please choose an option!';
	}else{
		$status = $request['status'];
	}
	if (empty(filter_var($request{'post'}, FILTER_SANITIZE_STRING))) {
		$errors['post'] = "Write your article.";
	}else{
		$post = filter_var($request{'post'}, FILTER_SANITIZE_STRING);
	}
	if (empty($errors)) {
		$user_id = $user['id'];
		if (move_uploaded_file($request['file']['tmp_name'], 'img/'.$imageName)) {
			$query = mysqli_query($db, "INSERT INTO  posts (author_id,title,image,post,status) VALUES ('$user_id','$title','$imageName','$post','$status')");
			if (mysqli_affected_rows($db) != 0) {
				return true;
			}
		}
	}


}

function getPosts() {
	global $db;
	$query = mysqli_query($db, "SELECT id, title, image, post FROM posts WHERE status = 'active' ORDER BY id DESC");
	if (mysqli_num_rows($query) > 0) {
		return $query;
	}
}


function getUserpost() {
	global $db, $user;
	$user_id = $user['id'];
	$query = mysqli_query($db, "SELECT * FROM posts WHERE author_id = '$user_id' ORDER BY id DESC ");
	
		return $query;
}

function editPost($request) {
	global $db, $errors, $edit;
	if (empty(filter_var($request{'title'}, FILTER_SANITIZE_STRING))) {
		$errors['title'] = "Your Article Needs A Title";
	}else{
		$title = filter_var($request{'title'}, FILTER_SANITIZE_STRING);
	}
	if (empty($request['file']['name'])) {
		$errors['file'] = "Please choose an image file!";
	}elseif (!getimagesize($request['file']['tmp_name'])) {
		$errors['file'] = "Please choose a valid image";
	}else{
		//pick 10 random numbers from 10000
		$random = rand(10, 10000);
		//shufffle some alphabets and the random 10 numbers
		$string = str_shuffle('ABCDEFGHIzxcvbnmkljhdsa'.$random);
		//explode the file name the user inputed at the . , and take from the end after the .
		$dd=explode(".", $request['file']['name']);
		$extension = end($dd);
		//assign a new image name
		$imageName = $string.'.'.$extension;
	}
	if (empty($request['status'])) {
		$errors['status'] = 'Please choose an option!';
	}else{
		$status = $request['status'];
	}
	if (empty(filter_var($request{'post'}, FILTER_SANITIZE_STRING))) {
		$errors['post'] = "Write your article.";
	}else{
		$post = filter_var($request{'post'}, FILTER_SANITIZE_STRING);
	}
	if (empty($errors)) {
		$edit = $edit['id'];
		if (move_uploaded_file($request['file']['tmp_name'], 'img/'.$imageName)) {
			$query = mysqli_query($db, "UPDATE posts SET title = '$title' image = '$imageName' post = '$post' status = '$status' WHERE id =  'edit' ");
			if (mysqli_affected_rows($db) > 0) {
				// return true;
				echo "hdgaueiahgrjignksdoivijewONO";
			}
		}
	}

}



?>

<!-- 
md5($request['password']) 
 or `full_name
 Joistrog123@
 $titleerr, $fileerr, $statuserr, $posterr,
 empty($errors['title']) && empty($errors['file']) && empty($errors['status']) && empty($errors['post'])
-->
