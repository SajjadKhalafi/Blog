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
            <h1 class="page-header">
                Home Page
            </h1>
            <?php
            $per_page = 5;
            $page = $_GET['page'] ?? 1;
            if ($page == "" || $page == 1){
                $page_1 = 0;
            }else{
                $page_1 = ($page * $per_page) - $per_page;
            }

            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                $select_post_query = "SELECT * FROM posts ";
            }else{
                $select_post_query = "SELECT * FROM posts WHERE post_status = 'published' ";
            }

            $post_query_count = mysqli_query($connection , $select_post_query);
            $count = mysqli_num_rows($post_query_count);
            $count = ceil($count / 5);

            $query = "SELECT * FROM posts ";
            if ($_SESSION['user_role'] !== 'admin'){
                $query .= "WHERE post_status = 'published' ";
            }
            $query .= "ORDER BY post_id DESC LIMIT $page_1 , $per_page";
            $select_all_posts_query = mysqli_query($connection, $query);
            if (mysqli_num_rows($select_all_posts_query) === 0)
                echo "<h1 class='text-center'>No Post Sorry</h1>";
            else {
                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 400) . "...";
                    $post_status = $row['post_status'];


                    ?>


                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?= $post_id ?>"><?= $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?= $post_user ?>&p_id=<?= $post_id ?>"><?= $post_user ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post_date ?></p>
                    <hr>
                    <a href="post.php?p_id=<?= $post_id ?>">
                        <img class="img-responsive" src="images/<?= $post_image ?>" alt="">
                    </a>
                    <hr>
                    <p><?= $post_content ?></p><br>
                    <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read More <span
                                class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                    <?php
                }
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>
    <ul class="pager">
        <?php for ($i = 1; $i <= $count; $i++): ?>
            <?php if ($i == $page): ?>
                <li><a class="active_link" href="index.php?page=<?= $i; ?>"><?= $i; ?></a></li>
            <?php else: ?>
                <li><a href="index.php?page=<?= $i; ?>"><?= $i; ?></a></li>
            <?php endif;?>
        <?php endfor; ?>
    </ul>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
