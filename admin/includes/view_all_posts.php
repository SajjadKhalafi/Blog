<?php
if (isset($_POST['checkboxArray'])) {
    foreach ($_POST['checkboxArray'] as $checkbox) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case "published":
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkbox ";
                $publish_post = mysqli_query($connection, $query);
                confirmQuery($publish_post);
                break;
            case "draft":
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkbox ";
                $draft_post = mysqli_query($connection, $query);
                confirmQuery($draft_post);
                break;
            case "delete":
                $query = "DELETE FROM posts WHERE post_id = $checkbox ";
                $delete_post = mysqli_query($connection, $query);
                confirmQuery($delete_post);
                break;
            case "clone":
                $query = "SELECT * FROM posts WHERE post_id = $checkbox";
                $select_posts = mysqli_query($connection, $query);
                confirmQuery($select_posts);
                while ($row = mysqli_fetch_array($select_posts)){
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comments_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                }

                $query = "INSERT INTO posts(post_category_id , post_title , post_author , post_date , post_image , post_content , post_tags  , post_status)";
                $query .= " VALUES ($post_category_id , '$post_title' , '$post_author' , now() , '$post_image' , '$post_content' , '$post_tags' , '$post_status')";
                $copy_post = mysqli_query($connection, $query);
                confirmQuery($copy_post);
                break;
        }
    }
}
?>

<form action="" method="post">

    <div id="bulkOptionContainer" class="col-xs-4" style="padding: 0">
        <select name="bulk_options" id="" class="form-control">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    </div>

    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th><input type="checkbox" id="selectAllBoxes"></th>
            <th>Id</th>
            <th>User</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View Post</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Views</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        $select_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_user = $row['post_user'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comments_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_view_count = $row['post_view_count'];

            echo "<tr>";
            ?>
            <td><input type='checkbox' class='checkBoxes' name='checkboxArray[]' value='<?= $post_id; ?>'></td>
            <?php
            echo "<td>{$post_id}</td>";

            if (!empty($post_user)){
                echo "<td>{$post_user}</td>";
            }elseif (!empty($post_author)){
                echo "<td>{$post_author}</td>";
            }

            echo "<td>{$post_title}</td>";

            // display categoey title
            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
            $select_categories = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<td>{$cat_title}</td>";
            }
            echo "<td>{$post_status}</td>";
            echo "<td><img src='../images/{$post_image}' width='100'> </td>";
            echo "<td>{$post_tags}</td>";

            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $send_comments_query = mysqli_query($connection , $query);
            $row = mysqli_fetch_array($send_comments_query);
            $comments_count = mysqli_num_rows($send_comments_query);

            echo "<td><a href='post_comments.php?id=$post_id'>{$comments_count}</a></td>";

            echo "<td>{$post_date}</td>";
            echo "<td><a href='../post.php?p_id=$post_id' class='btn btn-info btn-sm'>View Post</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id=$post_id' class='btn btn-primary btn-sm'>Edit</a></td>";
            echo "<td><a href='posts.php?delete=$post_id' onclick=\"return confirm('Are You Sure?') \" class='btn btn-danger btn-sm'>Delete</a></td>";
            echo "<td><a href='posts.php?reset=$post_id'>$post_view_count</a></td>";
            echo "</tr>";
        }
        ?>

        <?php
        if (isset($_GET['delete'])) {
            $post_id = escape($_GET['delete']);
            $query = "DELETE FROM posts WHERE post_id = $post_id";
            $deletePost = mysqli_query($connection, $query);
            header("Location: posts.php");
        }
        ?>

        <?php
        if (isset($_GET['reset'])) {
            $post_id = escape($_GET['reset']);
            $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = $post_id";
            $resetPost = mysqli_query($connection, $query);
            header("Location: posts.php");
        }
        ?>
        </tbody>
    </table>
</form>