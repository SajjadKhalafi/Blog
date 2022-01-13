<?php include "includes/header.php"; ?>
    <div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/navigation.php";?>

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
                    <form action="">
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
                            <th>Id</th>
                            <th>Category Title</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Football National Teams</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Basketball National Teams</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Handball National Teams</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>