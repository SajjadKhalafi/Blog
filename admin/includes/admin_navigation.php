<?php
$dashboard_class = '';
$posts_class = '';
$category_class = '';
$comments_class = '';
$users_class = '';
$profile_class = '';

$pageName = basename($_SERVER['PHP_SELF']);
if ($pageName == 'index.php'){
    $dashboard_class = 'active';
}elseif ($pageName == 'posts.php'){
    $posts_class= 'active';
}elseif ($pageName == 'categories.php'){
    $category_class = 'active';
}elseif ($pageName == 'comments.php'){
    $comments_class = 'active';
}elseif ($pageName == 'users.php'){
    $users_class = 'active';
}elseif ($pageName == 'profile.php'){
    $profile_class = 'active';
}
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">CMS Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="">Users Online: <span class="usersonline"></span></a></li>
        <li><a href="../">Home Page</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $_SESSION['username']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="<?= $dashboard_class ?>">
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="<?= $posts_class ?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-file-text fa-fw"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="./posts.php">View All Posts</a>
                    </li>
                    <li>
                        <a href="./posts.php?source=add_post">Add Post</a>
                    </li>
                </ul>
            </li>
            <li class="<?= $category_class ?>">
                <a href="./categories.php"><i class="fa fa-list fa-fw"></i> Categories</a>
            </li>
            <li class="<?= $comments_class ?>">
                <a href="./comments.php"><i class="fa fa-comments fa-fw"></i> Comments</a>
            </li>
            <li class="<?= $users_class ?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-users fa-fw"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="users_dropdown" class="collapse">
                    <li>
                        <a href="./users.php">View All Users</a>
                    </li>
                    <li>
                        <a href="./users.php?source=add_user">Add User</a>
                    </li>
                </ul>
            </li>
            <li class="<?= $profile_class ?>">
                <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>