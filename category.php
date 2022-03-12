<?php include "includes/db.php"; ?>
<!--Header-->
<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            $query = "SELECT * FROM categories WHERE cat_id = $_GET[category]";
            $cat_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($cat_query)) {
                $cat_title = $row['cat_title'];
            }
            ?>
            <h1 class="page-header">
                All Posts for
                <small><?= $cat_title ?></small>
            </h1>
            <?php
            if (isset($_GET['category'])) {
                $post_category_id = $_GET['category'];
            }
            if (isset($_SESSION['username']) && is_admin($_SESSION['username'])) {
                $stmt1 = mysqli_prepare($connection, "SELECT post_id, post_title , post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? ORDER BY post_id DESC");
            }else{
                $stmt2 = mysqli_prepare($connection, "SELECT post_id, post_title , post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ? ORDER BY post_id DESC");
                $published = 'published';
            }
            if (isset($stmt1)){
                mysqli_stmt_bind_param($stmt1 , "i" , $post_category_id);
                mysqli_stmt_execute($stmt1);
                mysqli_stmt_bind_result($stmt1 , $post_id , $post_title , $post_author , $post_date , $post_image , $post_content);
                $stmt = $stmt1;
            }else{
                mysqli_stmt_bind_param($stmt2 , "is" , $post_category_id , $published);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2 , $post_id , $post_title , $post_author , $post_date , $post_image , $post_content);
                $stmt = $stmt2;
            }
            if (mysqli_stmt_num_rows($stmt) < 1)
                echo "<h1 class='text-center'>No Post Sorry</h1>";
            while (mysqli_stmt_fetch($stmt)): ?>


                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?= $post_id ?>"><?= $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by
                        <a href="author_posts.php?author=<?= $post_author ?>&p_id=<?= $post_id ?>"><?= $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post_date ?></p>
                    <hr>
                    <a href="post.php?p_id=<?= $post_id ?>">
                        <img class="img-responsive" src="images/<?= $post_image ?>" alt="">
                    </a>
                    <hr>
                    <p><?= substr($post_content , 0 , 400) . "..."; ?></p><br>
                    <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read More <span
                                class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                    <?php endwhile; ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
