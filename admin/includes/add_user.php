<?php
if (isset($_POST['create_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];


    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $user_password = password_hash($user_password , PASSWORD_BCRYPT , ['cost' => 10]);

    $query = "INSERT INTO users(user_firstname , user_lastname , user_role , username , user_email , user_password)";
    $query .= " VALUES ('$user_firstname' , '$user_lastname' , '$user_role' , '$username' , '$user_email' , '$user_password')";
    $create_user_query = mysqli_query($connection, $query);
    confirmQuery($create_user_query);
    echo "user created : " . "<a href='users.php'>View Users</a>";
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriber">Select Role</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
<!--    <div class="form-group">-->
<!--        <label for="">Post Author</label>-->
<!--        <input type="file" name="image">-->
<!--    </div>-->
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>
</form>
