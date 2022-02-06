<?php include "includes/admin_header.php"; ?>
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
                        <small>Author</small>
                    </h1>
                </div>
                <div class="col-xs-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>In Response To</th>
                            <th>Date</th>
                            <th>Approve</th>
                            <th>UnApprove</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM comments WHERE comment_post_id = " . escape($_GET['id']) . " ORDER BY comment_id DESC";
                        $select_comments = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($select_comments)) {
                            $comment_id = $row['comment_id'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_author = $row['comment_author'];
                            $comment_content = $row['comment_content'];
                            $comment_email = $row['comment_email'];
                            $comment_status = $row['comment_status'];
                            $comment_date = $row['comment_date'];


                            echo "<tr>";
                            echo "<td>{$comment_id}</td>";
                            echo "<td>{$comment_author}</td>";
                            echo "<td>{$comment_content}</td>";

                            // display categoey title
                            echo "<td>{$comment_email}</td>";
                            echo "<td>{$comment_status}</td>";

                            $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
                            $select_post_by_comment_id = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($select_post_by_comment_id)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                            }

                            echo "<td>{$comment_date}</td>";
                            echo "<td><a href='post_comments.php?id=$_GET[id]&approve=$comment_id'>Approve</a></td>";
                            echo "<td><a href='post_comments.php?id=$_GET[id]&unApprove=$comment_id'>UnApprove</a></td>";
                            echo "<td><a href='post_comments.php?id=$_GET[id]&delete=$comment_id' class='btn btn-danger btn-sm'>Delete</a></td>";
                            echo "</tr>";
                        }
                        ?>

                        <?php

                        if (isset($_GET['approve'])) {
                            $comment_id = escape($_GET['approve']);
                            $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $comment_id";
                            $deleteComment = mysqli_query($connection, $query);
                            header("Location: post_comments.php?id=$_GET[id]");
                        }

                        if (isset($_GET['unApprove'])) {
                            $comment_id = escape($_GET['unApprove']);
                            $query = "UPDATE comments SET comment_status = 'unApproved' WHERE comment_id = $comment_id";
                            $deleteComment = mysqli_query($connection, $query);
                            header("Location: post_comments.php?id=$_GET[id]");
                        }
                        if (isset($_GET['delete'])) {
                            $comment_id = escape($_GET['delete']);
                            $query = "DELETE FROM comments WHERE comment_id = $comment_id";
                            $deleteComment = mysqli_query($connection, $query);
                            header("Location: post_comments.php?id=$_GET[id]");
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>