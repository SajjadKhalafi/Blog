<?php

function confirmQuery($result)
{
    global $connection;
    if(!$result){
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