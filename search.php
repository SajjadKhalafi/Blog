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
            if (isset($_POST['submit'])) {
                $search = $_POST['search'];
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ORDER BY post_id DESC";
                $search_query = mysqli_query($connection, $query);

                $count = mysqli_num_rows($search_query);

                if (!$count) {
                    echo "<h1>NO Result</h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 100);
                        ?>
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?= $post_id; ?>"><?= $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="#"><?= $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?= $post_image ?>" alt="">
                        <hr>
                        <p><?= $post_content ?></p>
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
