<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("location: index.php");
    
    }
}
require('layouts/auth/header.php');
if (isset($_POST['submit_register'])) {
   
    require_once 'controllers/auth.php';
    $auth = new auth();
    $auth->register($_REQUEST);
}
?>
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-6 offset-md-2 col-lg-6 offset-lg-2 col-xl-6 offset-xl-2 mx-auto">
                <div class="login-brand">
                    <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['error_login'])) { ?>
                            <div class="alert alert-danger mb-2">
                                <div class="alert-body">
                                    <?php echo $_SESSION['error_login']; ?>
                                </div>
                            </div>
                        <?php } ?>
                        <form action="register.php" method="POST">
                            <div class="form-group">
                                <label for="first_name">Name</label>
                                <input id="first_name" type="text" class="form-control" name="name" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control" name="username">
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email">
                                <div class="invalid-feedback">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="password" class="d-block">Password</label>
                                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                                    <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="password2" class="d-block">Password Confirmation</label>
                                    <input id="password2" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>


                            <div class="form-group">
                                <button type="submit" name="submit_register" class="btn btn-primary btn-lg btn-block">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-5 text-muted text-center">
                    Don't have an account? <a href="register.php">Create One</a>
                </div>
                <div class="simple-footer">
                    Copyright &copy; Codevector <?= date('Y') ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require('layouts/auth/footer.php');
?>