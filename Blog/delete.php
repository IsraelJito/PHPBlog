<?php   

require_once('function.php');
$db = dbConnection();
$delete = $_GET['id'];
 if (empty($delete)) {
 	header('Location: posts.php');
 } else {
 	$query = mysqli_query($db, "DELETE FROM posts WHERE id = '$delete' ");
 	if (mysqli_affected_rows($db) > 0) {
 		header('Location: posts.php?');
 	}else {
 		echo "Error Deleting Your Article <a href='posts.php'>Try Again</a> Or For <a href='#'>Help!.</a>";
 	}
 }

?>