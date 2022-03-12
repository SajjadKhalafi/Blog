<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>
        <?php
        if (isset($_GET['edit'])) {
            $cat_id = escape($_GET['edit']);

            $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
            $select_categories = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                ?>
                <input type="text" value="<?php if (isset($cat_title)){echo $cat_title;} ?>" class="form-control" name="cat_title">
                <?php
            }
        }
        ?>
        <?php
        if (isset($_POST['update_category'])){
            $cat_title = escape($_POST['cat_title']);

            $stmt = mysqli_prepare($connection , "UPDATE categories SET cat_title = ? WHERE cat_id = ?");
            mysqli_stmt_bind_param($stmt , "si" , $cat_title , $cat_id);
            mysqli_stmt_execute($stmt);
            redirect("categories.php");
        }
        ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_category" value="Update category">
    </div>
</form>