<?php include "includes/admin_header.php"; ?>

<?php
$session = session_id();
$time = time();
$time_out_by_seconds = 20;
$time_out = $time - $time_out_by_seconds;

$query = "SELECT * FROM users_online WHERE session = '$session'";
$select_online = mysqli_query($connection , $query);
$count = mysqli_num_rows($select_online);

if ($count == NULL){
    $query = "INSERT INTO users_online (session , time) VALUES ('$session' , $time)";
    $send_query = mysqli_query($connection , $query);
}else{
    $query = "UPDATE users_online SET time = $time WHERE session = '$session'";
    $update_query = mysqli_query($connection , $query);
}

$select_users_online = "SELECT * FROM users_online WHERE time > '$time_out'";
$select_query = mysqli_query($connection , $select_users_online);
$count_online_users = mysqli_num_rows($select_query);
?>
    <div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?= $_SESSION['username']; ?></small>
                    </h1>
                    <h1>
                        <?= $count_online_users; ?>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM posts";
                                    $select_all_posts = mysqli_query($connection, $query);
                                    $post_count = mysqli_num_rows($select_all_posts);
                                    echo "<div class='huge'>{$post_count}</div>";
                                    ?>

                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments";
                                    $select_all_comments = mysqli_query($connection, $query);
                                    $comment_count = mysqli_num_rows($select_all_comments);
                                    echo "<div class='huge'>{$comment_count}</div>";
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $select_all_users = mysqli_query($connection, $query);
                                    $user_count = mysqli_num_rows($select_all_users);
                                    echo "<div class='huge'>{$user_count}</div>";
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $select_all_categories = mysqli_query($connection, $query);
                                    $categories_count = mysqli_num_rows($select_all_categories);
                                    echo "<div class='huge'>{$categories_count}</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php
            $query = "SELECT * FROM posts WHERE post_status = 'published' ";
            $select_all_publish_posts = mysqli_query($connection, $query);
            $publish_posts_count = mysqli_num_rows($select_all_publish_posts);

            $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
            $select_all_draft_posts = mysqli_query($connection, $query);
            $draft_posts_count = mysqli_num_rows($select_all_draft_posts);

            $query = "SELECT * FROM comments WHERE comment_status = 'unApproved' ";
            $select_all_unApproved_comments = mysqli_query($connection, $query);
            $unApproved_comments_count = mysqli_num_rows($select_all_unApproved_comments);

            $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
            $select_all_subscribers = mysqli_query($connection, $query);
            $subscriber_count = mysqli_num_rows($select_all_subscribers);
            ?>
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages': ['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                            $element_text = ["All Posts" , "Active Posts" , "Draft Posts" , "Comments" , "Pending Comments" , "Users" , "Subscribers" , "Categories"];
                            $element_count = [$post_count , $publish_posts_count , $draft_posts_count , $comment_count , $unApproved_comments_count , $user_count , $subscriber_count , $categories_count];
                            for ($i = 0;$i < 8;$i++){
                                echo "['$element_text[$i]'" . "," . "$element_count[$i]]," ;
                            }
                            ?>
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>