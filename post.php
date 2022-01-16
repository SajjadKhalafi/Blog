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
            if (isset($_GET['p_id'])){
                $post_id = $_GET['p_id'];
            }
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $select_all_posts_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?= $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?= $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?= $post_image ?>" alt="">
                <hr>
                <p><?= $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span
                            class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php
            }
            ?>
            <!-- Blog Comments -->

            <!-- Comments Form -->

            <?php
            if (isset($_POST['create_comment'])){
                $comment_post_id = $_GET['p_id'];
                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                $query = "INSERT INTO comments (comment_post_id , comment_author , comment_email , comment_content , comment_status , comment_date)";
                $query .= " VALUES ({$comment_post_id} , '{$comment_author}' , '{$comment_email}' , '{$comment_content}' ,  'Unapproved' , now())";
                $create_comment_query = mysqli_query($connection , $query);
                if (!$create_comment_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                $query .= "WHERE post_id = $post_id";
                $update_post_comment_query = mysqli_query($connection , $query);
                if (!$update_post_comment_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                header("Location: post.php?p_id=$post_id");
            }
            ?>
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="">Author</label>
                        <input type="text" name="comment_author" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="comment_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
            $query .= "AND comment_status = 'Approved' ";
            $query .= "ORDER BY comment_id DESC";
            $select_all_comments = mysqli_query($connection , $query);
            if (!$select_all_comments){
                die("QUERY FAILED " . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_assoc($select_all_comments)){
                $comment_author = $row['comment_author'];
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?= $comment_author; ?>
                            <small><?= $comment_date; ?></small>
                        </h4>
                        <?= $comment_content; ?>
                    </div>
                </div>
            <?php } ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
