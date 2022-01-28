<?php
if (isset($_GET['p_id'])){
    $p_id = $_GET['p_id'];
$query = "SELECT * FROM posts WHERE post_id = $p_id";
$select_post_by_id = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_post_by_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comments_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}
}
?>

<?php
if (isset($_POST['update_post'])){
    $post_title = mysqli_real_escape_string($connection , $_POST['post_title']);
    $post_category_id = $_POST['post_category'];
    $post_user = $_POST['post_user'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_tmp = $_FILES['post_image']['tmp_name'];
    $post_tags = mysqli_real_escape_string($connection , $_POST['post_tags']);
    $post_content = mysqli_real_escape_string($connection , $_POST['post_content']);

    move_uploaded_file($post_image_tmp , "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $p_id";
        $select_image = mysqli_query($connection, $query);
        confirmQuery($select_image);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }
    }
    $query = "UPDATE posts SET ";
    $query .= "post_title = '$post_title' ,";
    $query .= "post_category_id = '$post_category_id' ,";
    $query .= "post_user = '$post_user' ,";
    $query .= "post_date = now() ,";
    $query .= "post_image = '$post_image' ,";
    $query .= "post_content = '$post_content' ,";
    $query .= "post_tags = '$post_tags' ,";
    $query .= "post_status = '$post_status' ";
    $query .= "WHERE post_id = $p_id";
    $updatePosts = mysqli_query($connection , $query);
    confirmQuery($updatePosts);
    echo "<p class='bg-success'>Post Updated: 
            <a href='../post.php?p_id=$post_id'>View Post</a>
             or 
             <a href='posts.php'>Edit More Posts</a>
           </p>";

}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Post Title</label>
        <input value="<?= $post_title ?>" type="text" class="form-control" name="post_title">
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
                if ($cat_id == $post_category_id){
                    echo "<option value='$cat_id' selected>$cat_title</option>";
                }else{
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
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
            <option value="<?= $post_status ?>"><?= $post_status ?></option>
            <?php
            if ($post_status == 'published'){
                echo "<option value='draft'>Draft</option>";
            }else{
                echo "<option value='published'>Publish</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <img src="../images/<?= $post_image; ?>" width="100">
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="">Post Tags</label>
        <input value="<?= $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?= $post_content ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>
