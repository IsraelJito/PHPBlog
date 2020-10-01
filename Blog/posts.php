<?php 
ob_start();
require_once('header.php');
session_start();
if (!isset($_SESSION['user'])) {
	header('Location: index.php');
}
$user = $_SESSION['user'];

if (!empty($delsuccess)) {
	$yes = "Successfully Deleted!";
	return $yes;
}
 ?>

 <!-- ##### Login Area Start ##### -->
    <div class="vizew-login-area section-padding-80">
        <div class="">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="login-content">
                        <!-- Section Title -->
                        <div class="section-heading">
                            <h4>VIEW ARTICLES</h4>
                            <div class="line"></div>
                        </div>

                        <div>
                        	<h5><?php if (!empty($yes)) {
                        		echo $yes;
                        	}  ?></h5>
                        </div>
                        <table id="table">
                        	<tr>
                        		<th>S/N</th>
                        		<th>Image</th>
                        		<th>Title</th>
                        		<th>Post</th>
                        		<th>Status</th>
                        		<th>Date Created</th>
                        		<th>Action</th>
                        	</tr>

                        	<?php 
                        	$posts = getUserpost();
                        	$i = 1;
                        	while ($post = mysqli_fetch_assoc($posts)) {
                        		
                        	 ?>
                        	<tr>
                        		  <?php if (isset($_SESSION['user'])) {
                                     global $changeheader;
                                     $changeheader = 1;
                                 }else {
                                    $changeheader = '';
                                 } ?>
                        		<td><?= $i++?></td>
                        		<td><img src="img/<?= $post['image']?>"></td>
                        		<td><?= $post['title']?></td>
                        		<td><?= $post['post']?></td>
                        		<td><?= $post['status']?></td>
                        		<td><?= $post['created_at']?></td>
                        		<td><a href="delete.php?id=<?= $post['id'] ?>" style="background: red; padding: 5px;">Delete!</a><br><br><a href="edit.php?id=<?= $post['id'] ?>" style="background: blue; padding: 5px;">Edit!</a></td>
                        	</tr>

                        <?php
                        // if ($i == 5) {
                        // 	break;
                        // }
                         } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require('footer.php') ?>