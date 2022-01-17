<?php
include "db.php";

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection , $username);
    $password = mysqli_real_escape_string($connection , $password);

    $query = "SELECT * FROM users WHERE username = '$username'";
    $select_query = mysqli_query($connection , $query);
    if (!$select_query){
        die("QUERY FAILED " . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_array($select_query)){
        $db_user_id = $row['user_id'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];
    }
    if ($username !== $db_username && $password !== $db_user_password){
        header("Location: ../index.php");
    }
    elseif ($username == $db_username && $password == $db_user_password){
        header("Location: ../admin");
    }else{
        header("Location: ../index.php");
    }
}