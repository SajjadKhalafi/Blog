<?php
function redirect($location)
{
    header("Location: " . $location);
    exit;
}

function ifItIsMethod($method=null)
{
    if ($_SERVER["REQUEST_METHOD"] == strtoupper($method)){
        return true;
    }else{
        return false;
    }
}

function isLoggedIn()
{
    if (isset($_SESSION['user_role'])){
        return true;
    }else{
        return false;
    }
}

function checkIfUserLoggedInAndRedirect($redirectLocation=null)
{
    if (isLoggedIn()){
        redirect($redirectLocation);
    }
}

function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

function users_online()
{
    if (isset($_GET['onlineUsers'])) {
        global $connection;
        if (!$connection) {
            session_start();
            include "../includes/db.php";
            $session = session_id();
            $time = time();
            $time_out_by_seconds = 02;
            $time_out = $time - $time_out_by_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $select_online = mysqli_query($connection, $query);
            $count = mysqli_num_rows($select_online);

            if ($count == NULL) {
                $query = "INSERT INTO users_online (session , time) VALUES ('$session' , $time)";
                $send_query = mysqli_query($connection, $query);
            } else {
                $query = "UPDATE users_online SET time = $time WHERE session = '$session'";
                $update_query = mysqli_query($connection, $query);
            }

            $select_users_online = "SELECT * FROM users_online WHERE time > '$time_out'";
            $select_query = mysqli_query($connection, $select_users_online);
            echo $count_online_users = mysqli_num_rows($select_query);
        }
    }
}

users_online();

function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("Query Failed " . mysqli_error($connection));
    }
}

function insert_category()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $category_title = $_POST['cat_title'];
        if ($category_title == "" || empty($category_title)) {
            echo "<h5>category title should not be empty</h5>";
        } else {
            $stmt = mysqli_prepare($connection , "INSERT INTO categories(`cat_title`) VALUES (?)");
            mysqli_stmt_bind_param($stmt , "s" , $category_title);
            mysqli_stmt_execute($stmt);
            header("Location: categories.php");
            if (!$stmt) {
                die("something wrong!" . mysqli_error($connection));
            }
            mysqli_stmt_close($stmt);
        }
    }
}

function selectAllCategories()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>
                  <td>{$cat_id}</td>
                  <td>{$cat_title}</td>
                  <td><a href='categories.php?delete={$cat_id}' class='btn btn-sm btn-danger'>Delete</a></td>
                  <td><a href='categories.php?edit={$cat_id}' class='btn btn-sm btn-primary'>Edit</a></td>
              </tr>";
    }
}

function deleteCategory()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $getCatID = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$getCatID}";
        $deleteCategory = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function recordCount($table)
{
    global $connection;
    $query = "SELECT * FROM $table";
    $select_all_posts = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_posts);
    confirmQuery($result);
    return $result;
}

function checkStatus($table, $column, $status)
{
    global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$status' ";
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result);
}

function checkUserRole($table, $column, $role)
{
    global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$role' ";
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result);
}

function is_admin($username)
{
    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    $row = mysqli_fetch_array($result);
    if ($row['user_role'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

function username_exists($username)
{
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function email_exists($email)
{
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    if (mysqli_num_rows($result) > 0)
        return true;
    else
        return false;
}

function register_user($username, $email, $password)
{
    global $connection;

    $username = escape($username);
    $email = escape($email);
    $password = escape($password);

    $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    $query = "INSERT INTO users (username , user_email , user_password , user_role) ";
    $query .= "VALUES ('{$username}' , '{$email}' , '{$password}' , 'subscriber' ) ";
    $insert_user_query = mysqli_query($connection, $query);
    confirmQuery($insert_user_query);

}

function login_user($username, $password)
{
    global $connection;

    $username = trim($username);
    $password = trim($password);

    $username = escape($username);
    $password = escape($password);

    $query = "SELECT * FROM users WHERE username = '$username'";
    $select_query = mysqli_query($connection, $query);
    confirmQuery($select_query);
    while ($row = mysqli_fetch_array($select_query)) {
        $db_user_id = $row['user_id'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];

        if ($username === $db_username && password_verify($password, $db_user_password)) {
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            redirect("/cms/admin/");
        } else {
            return false;
        }
    }
    return true;

}