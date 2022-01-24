<?php include "includes/db.php"; ?>
<?php session_start(); ?>
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
            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
                $post_author = $_GET['author'];
            }
            echo "                <h1 class='page-header'>
                    All Posts by 
                    <small>$post_author</small>
                </h1>";
            $query = "SELECT * FROM posts WHERE post_author = '$post_author' ORDER BY post_id DESC";
            $select_all_posts_by_author_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_by_author_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'], 0, 500);
                $post_status = $row['post_status'];
                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?= $post_id ?>"><?= $post_title ?></a>
                </h2>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?= $post_id ?>">
                    <img class="img-responsive" src="images/<?= $post_image ?>" alt="">
                </a>
                <hr>
                <p><?= $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php
            }
            ?>
        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
