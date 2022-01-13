<?php
function insert_category()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $category_title = $_POST['cat_title'];
        if ($category_title == "" || empty($category_title)) {
            echo "<h5>category title should not be empty</h5>";
        } else {
            $query = "INSERT INTO categories(`cat_title`) ";
            $query .= "VALUE('{$category_title}')";
            $create_category = mysqli_query($connection, $query);
            header("Location: categories.php");
            if (!$create_category) {
                die("something wrong!" . mysqli_error($connection));
            }
        }
    }
}
