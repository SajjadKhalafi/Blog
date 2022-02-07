<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)){
        $username = mysqli_real_escape_string($connection , $username);
        $email = mysqli_real_escape_string($connection , $email);
        $password = mysqli_real_escape_string($connection , $password);

        $password = password_hash($password , PASSWORD_BCRYPT , ['cost' => 12]);


        $query = "INSERT INTO users (username , user_email , user_password , user_role) ";
        $query .= "VALUES ('{$username}' , '{$email}' , '{$password}' , 'subscriber' ) ";
        $insert_user_query = mysqli_query($connection , $query);
        if (!$insert_user_query){
            die("QUERY FAILED " . mysqli_error($connection) . ' ' . mysqli_errno($connection));
        }
        $message = "your registration has bin submitted!!";
    }
    else{
        $message = "Fields cannot be empty!";
    }


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
                        <h1>Contact</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <h6 class="text-center"><?= $message ?? ''; ?></h6>

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="Enter Your Email">
                            </div>

                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control"
                                       placeholder="Enter Your Subject">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="body" cols="50" rows="10"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                   value="Submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>


    <?php include "includes/footer.php"; ?>
