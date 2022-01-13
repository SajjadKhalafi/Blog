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
                <div class="col-xs-6">

                    <?php
                    if (isset($_POST['submit'])) {
                        $category_title = $_POST['cat_title'];
                        if ($category_title == "" || empty($category_title)) {
                            echo "<h5>category title should not be empty</h5>";
                        } else {
                            $query = "INSERT INTO categories(`cat_title`) ";
                            $query .= "VALUE('{$category_title}')";
                            $create_category = mysqli_query($connection , $query);
                            if (!$create_category) {
                                die("something wrong!" . mysqli_error($connection));
                            }
                        }
                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="cat-title">Add Category</label>
                            <input type="text" class="form-control" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="submit" value="Add category">
                        </div>
                    </form>
                </div>
                <div class="col-xs-6">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category Title</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM categories";
                        $select_categories = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($select_categories)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<tr>
                                        <td>{$cat_id}</td>
                                        <td>{$cat_title}</td>
                                    </tr>";
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