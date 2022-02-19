<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $errors = [
        'username' => '',
        'email' => '',
        'password' => ''
    ];

    if ($username == '')
        $errors['username'] = "Username cannot be empty";
    elseif (strlen($username) < 4)
        $errors['username'] = "Username needs to be longer";
    elseif (username_exists($username))
        $errors['username'] = "Username already exists, pick another one";

    if ($email == '')
        $errors['email'] = "Email cannot be empty";
    elseif (email_exists($email))
        $errors['email'] = "Email already exists, <a href='index.php'>Please Login</a>";

    if ($password == '')
        $errors['password'] = 'Password cannot be empty';
}
?>
<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h6 class="text-center"><?= $message ?? ''; ?></h6>
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                       placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                   value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>


    <?php include "includes/footer.php"; ?>
