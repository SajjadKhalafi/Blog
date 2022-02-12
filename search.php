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
                Search for
                "<?= $_POST['search']; ?>"
            </h1>
            <?php
            if (isset($_POST['submit'])) {
                $search = $_POST['search'];
                $query = "SELECT * FROM posts ";
                $query .= "WHERE post_tags LIKE '%$search%' ";
                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'admin'){
                    $query .= "AND post_status = 'published' ";
                }
                $query .= " ORDER BY post_id DESC";
                $search_query = mysqli_query($connection, $query);

                $count = mysqli_num_rows($search_query);

                if (!$count) {
                    echo "<h2 class='text-center'>NO Result</h2>";
                } else {
                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 400) . "...";
                        ?>


                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?= $post_id; ?>"><?= $post_title ?></a>
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
                        <a class="btn btn-primary" href="post.php?p_id=<?= $post_id; ?>">Read More <span
                                    class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                        <?php
                    }
                }

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
