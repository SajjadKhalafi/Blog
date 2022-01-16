<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments_count = $row['post_comment_count'];
        $post_date = $row['post_date'];

        echo "<tr>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td>{$post_title}</td>";

        // display categoey title
        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
        $select_categories = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<td>{$cat_title}</td>";
        }
        echo "<td>{$post_status}</td>";
        echo "<td><img src='../images/{$post_image}' width='100'> </td>";
        echo "<td>{$post_tags}</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id=$post_id' class='btn btn-primary btn-sm'>Edit</a></td>";
        echo "<td><a href='posts.php?delete=$post_id' class='btn btn-danger btn-sm'>Delete</a></td>";
        echo "</tr>";
    }
    ?>

    <?php
    if (isset($_GET['delete'])) {
        $post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = $post_id";
        $deletePost = mysqli_query($connection, $query);
        header("Location: posts.php");
    }
    ?>
    </tbody>
</table>