<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];

    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date("d-m-y");
//    $post_comment_count = 0;

    move_uploaded_file($image_tmp_name, "../images/$image_name");

    $query = "INSERT INTO posts(post_category_id , post_title , post_author , post_date , post_image , post_content , post_tags  , post_status)";
    $query .= " VALUES ($post_category_id , '$post_title' , '$post_author' , now() , '$image_name' , '$post_content' , '$post_tags' , '$post_status')";
    $create_post = mysqli_query($connection, $query);
    confirmQuery($create_post);
    header("Location: posts.php");
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
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
        <label for="">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <select name="post_status" id="">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Post Author</label>
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
