<?php
function dbConnection() {
	$conn = mysqli_connect('localhost', 'root', '');

	if (mysqli_errno($conn)) {
		die('COULD NOT CONNECT TO DATABASE**');
	}else{
		if(!mysqli_select_db($conn, 'blogi')) {
			die('COULD NOT CONNECT TO DATABASE**');
		}
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


?>
