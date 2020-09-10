<?php 
ob_start();
require_once('header.php');
$errors = [];
if (isset($_POST['submit'])) {
    if (signup($_POST)) {
        header('Location: home.php');
    }
}


?>

 <!-- ##### Breadcrumb Area Start ##### -->
    <div class="vizew-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
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
                            <h4>Sign Up</h4>
                            <div class="line"></div>
                        </div>

                        <?php if (!empty($errors)) { ?>
                            <div class="alert alert-success">
                                <ul>
                                    <?php foreach ($errors as $error) {?>
                                        <li><?= $error ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Full Name.." name="full_name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email.." name="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password.." name="password">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password.." name="confirm_password">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Agree to terms and conditions</label>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn vizew-btn w-100 mt-30">Sign Up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Login Area End ##### -->

<?php require_once('footer.php')?>