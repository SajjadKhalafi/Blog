<?php
if (isset($_GET['edit_user'])) {
    $user_id = escape($_GET['edit_user']);

    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $select_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_query)) {
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
    }
}
if (isset($_POST['edit_user'])) {
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);


    if (!empty($user_password)) {
        $query_pass = "SELECT user_password FROM users WHERE user_id = $user_id";
        $select_pass = mysqli_query($connection, $query_pass);
        confirmQuery($select_pass);
        $row = mysqli_fetch_array($select_pass);
        $db_user_password = $row['user_password'];
        if ($db_user_password != $user_password) {
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, ['cost' => 10]);
        }
        $query = "UPDATE users SET ";
        $query .= "user_firstname = '$user_firstname' , ";
        $query .= "user_lastname = '$user_lastname' , ";
        $query .= "user_role = '$user_role' , ";
        $query .= "username = '$username' , ";
        $query .= "user_email = '$user_email' , ";
        $query .= "user_password = '$hashed_password' ";
        $query .= "WHERE user_id = $user_id";
        $edit_user_query = mysqli_query($connection, $query);
        confirmQuery($edit_user_query);
        echo "User Updated " . "<a href='users.php'>View Users?</a>";
    }

}
?>
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
        <select name="user_role" id="">
            <option value="<?= $user_role; ?>"><?= $user_role ?></option>
            <?php
            if ($user_role === "admin") {
                echo "<option value='subscriber'>subscriber</option>";
            } else {
                echo "<option value='admin'>admin</option>";
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="">Username</label>
        <input type="text" class="form-control" name="username" value="<?= $username ?>">
    </div>
    <!--    <div class="form-group">-->
    <!--        <label for="">Post Author</label>-->
    <!--        <input type="file" name="image">-->
    <!--    </div>-->
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?= $user_email ?>">
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input autocomplete="off" type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>
</form>
