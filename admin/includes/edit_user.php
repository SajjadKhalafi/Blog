<?php
if (isset($_GET['edit_user'])){
    $user_id = $_GET['edit_user'];
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $select_query = mysqli_query($connection , $query);
    while ($row = mysqli_fetch_assoc($select_query)){
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
    }
}
if (isset($_POST['edit_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];

//    $image_name = $_FILES['image']['name'];
//    $image_tmp_name = $_FILES['image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
//    $post_date = date("d-m-y");


    $query = "INSERT INTO users(user_firstname , user_lastname , user_role , username , user_email , user_password)";
    $query .= " VALUES ('$user_firstname' , '$user_lastname' , '$user_role' , '$username' , '$user_email' , '$user_password')";
    $create_user_query = mysqli_query($connection, $query);
    confirmQuery($create_user_query);
    header("Location: users.php");
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
            <option value="<?= $user_role;?>"><?= $user_role ?></option>
            <?php
            if ($user_role === "admin"){
                echo "<option value='subscriber'>subscriber</option>";
            }else{
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
        <input type="email" class="form-control" name="user_email" value="<?= $user_email?>">
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?= $user_password ?>">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>
</form>
