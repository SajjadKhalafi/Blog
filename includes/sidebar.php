<?php

?>
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <form action="/cms/search" method="post">
            <h4>Blog Search</h4>
            <div class="input-group">
                    <input name="search" type="text" class="form-control">
                    <span class="input-group-btn">
                        <button name="submit" class="btn btn-default" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Login -->
    <div class="well">
        <?php if (!isset($_SESSION['username'])): ?>
            <form action="/cms/login.php" method="post">
                <h4>Login</h4>
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Enter Username">
                </div>
                <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    <span class="input-group-btn">
                            <button name="login" class="btn btn-primary" type="submit">
                                Submit
                            </button>
                        </span>
                </div>
            </form>
        <?php else: ?>
            <h4>Logged in as <?= $_SESSION['username']; ?></h4>
            <a class="btn btn-primary" href="includes/logout.php">Logout</a>
        <?php endif; ?>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    $query = "SELECT * FROM categories";
                    $select_categories_sidebar = mysqli_query($connection , $query);
                    while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='/cms/category/$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>

</div>