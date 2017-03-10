<?php include "includes/db.php" ?>

<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- /.navbar-collapse -->


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php
            $perPage = 5;
            if (isset($_GET['page'])) {

                $page = $_GET['page'];
            } else {
                $page = "";
            }

            if ($page == "" || $page == 1) {
                $page1 = 0;
            } else {
                $page1 = ($page * $perPage) - $perPage;
            }

            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

                $postQueryCount = "SELECT * FROM post";
            } else {

                $postQueryCount = "SELECT * FROM post WHERE post_status = 'published'";
            }

            $selectPostQueryCount = mysqli_query($conn, $postQueryCount);
            $counts = mysqli_num_rows($selectPostQueryCount);

            if ($counts < 1) {
                echo "<h1 class='text-center'>W tej chwili nie ma postów </h1>";
            } else {

                $counts = ceil($counts / $perPage);


                $query = "SELECT * FROM post LIMIT $page1, $perPage";

                $selectAllQuery = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($selectAllQuery)) {

                    $postId = $row['id'];
                    $postTitle = $row['post_title'];
                    $postAuthor = $row['post_user'];
                    $postDate = $row['post_date'];
                    $postImage = $row['post_image'];
                    $postContent = substr($row['post_content'], 0, 400);
                    $postStatus = $row['post_status'];
                    ?>   

                    <!-- First Blog Post -->
                    <h2> 
                        <a href="post/<?php echo $postId; ?>"><?php echo $postTitle ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="authorPosts.php?author=<?php echo $postAuthor ?>&id=<?php echo $postId ?>"><?php echo $postAuthor ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
                    <hr>
                    <a href="post.php?id=<?php echo $postId; ?>">
                        <img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo $postContent ?>.</p>
                    <a class="btn btn-primary" href="post.php?id=<?php echo $postId; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>



                <?php }
            }
            ?>



        </div>

        <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>
        <!-- /.row -->

        <hr>

    </div>


    <ul class="pager">

        <?php
        for ($i = 1; $i <= $counts; $i++) {

            if ($i == $page) {

                echo "<li><a class='activ_link' href='index.php?page={$i}'>{$i}</a></li>";
            } else {

                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }
        ?>


    </ul>

    <?php include "includes/footer.php" ?>

