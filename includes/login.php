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
        echo $row['user_id'];
    }
}