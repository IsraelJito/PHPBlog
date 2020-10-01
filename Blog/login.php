<?php 
ob_start();
require_once('header.php');
session_start();
$error = $emailerr = $passworderr = "";
if (isset($_POST['login'])) {
   if (login($_POST)) {
       header('Location: home.php');   
   }
} 
// if (session_start() == true) {
//     echo "SESSION STARTED";
// }else {
//     header('Location: index.php');
// }
?>



<!-- ##### Breadcrumb Area Start ##### -->
<div class="vizew-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ##### Breadcrumb Area End ##### -->

<!-- ##### Login Area Start ##### -->
<div class="vizew-login-area section-padding-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="login-content">
                    <!-- Section Title -->
                    <div class="section-heading">
                        <h4>Login!</h4>
                        <div class="line"></div>

                        <div style="color: red;">
                            <?php 
                            echo $error;
                            ?>
                        </div>
                        
                    </div>
                    <form action="" method="post">
                        <div class="form-group">

                            <div style="color: red;">
                                <?php 
                                echo $emailerr;
                                ?>
                            </div>

                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email or Full Name">
                        </div>
                        
                        <div style="color: red;">
                            <?php 
                            echo $passworderr;
                            ?>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                            </div>
                        </div>
                        <button type="submit" name="login" class="btn vizew-btn w-100 mt-30">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Login Area End ##### -->

<?php require_once('footer.php'); ?>