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
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Post Title</label>
        <input value="<?= $post_title ?>" type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <select name="" id="">
            <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);
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
        <input value="<?= $post_author ?>" type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="">Post Status</label>
        <input value="<?= $post_status ?>" type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <img src="../images/<?= $post_image; ?>" width="100">
    </div>
    <div class="form-group">
        <label for="">Post Tags</label>
        <input value="<?= $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?= $post_content ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Update Post">
    </div>
</form>
