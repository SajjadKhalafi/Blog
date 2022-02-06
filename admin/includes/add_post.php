<?php
if (isset($_POST['create_post'])) {
    $post_title = escape($_POST['post_title']);
    $post_category_id = escape($_POST['post_category']);
    $post_user = escape($_POST['post_user']);
    $post_status = escape($_POST['post_status']);

    $image_name = escape($_FILES['image']['name']);
    $image_tmp_name = $_FILES['image']['tmp_name'];

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = escape(date("d-m-y"));

    move_uploaded_file($image_tmp_name, "../images/$image_name");

    $query = "INSERT INTO posts(post_category_id , post_title , post_user , post_date , post_image , post_content , post_tags  , post_status)";
    $query .= " VALUES ($post_category_id , '$post_title' , '$post_user' , now() , '$image_name' , '$post_content' , '$post_tags' , '$post_status')";
    $create_post = mysqli_query($connection, $query);
    confirmQuery($create_post);
    $post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post Created: 
            <a href='../post.php?p_id=$post_id'>View Post</a>
             or 
             <a href='posts.php'>Edit More Posts</a>
           </p>";
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Category</label>
        <select name="post_category" id="post_category">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
            confirmQuery($select_categories);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='$cat_id'>$cat_title</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="users">User</label>
        <select name="post_user" id="users">
            <?php
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
            confirmQuery($select_users);
            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                echo "<option value='$username'>$username</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="post_status" id="status">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>
