<?php include "includes/admin_header.php"; ?>
<?php
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $select_user_profile_query = mysqli_query($connection , $query);
    while($row = mysqli_fetch_array($select_user_profile_query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

if (isset($_POST['edit_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $user_password = password_hash($user_password , PASSWORD_BCRYPT , ['cost' => 10]);

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '$user_firstname' , ";
    $query .= "user_lastname = '$user_lastname' , ";
    $query .= "user_role = '$user_role' , ";
    $query .= "username = '$username' , ";
    $query .= "user_email = '$user_email' , ";
    $query .= "user_password = '$user_password' ";
    $query .= "WHERE username = '$username'";
    $edit_user_query = mysqli_query($connection, $query);
    confirmQuery($edit_user_query);
}

?>
    <div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Firstname</label>
                        <input type="text" class="form-control" name="user_firstname" value="<?= $user_firstname ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Lastname</label>
                        <input type="text" class="form-control" name="user_lastname" value="<?= $user_lastname ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $username ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="user_email" value="<?= $user_email?>">
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input autocomplete="off" type="password" class="form-control" name="user_password">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
                    </div>
                </form>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>