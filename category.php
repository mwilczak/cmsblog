<?php include "includes/db.php" ?>

<?php include "includes/header.php" ?>
<?php include "admin/functions.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- /.navbar-collapse -->


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php
            if (isset($_GET['category'])) {

                $postCategoryId = $_GET['category'];

                if (isset($_SESSION['username'])) {

                    $statement1 = mysqli_prepare($conn, "SELECT id, post_title, post_user, post_date, post_image, post_content FROM post WHERE post_category_id = ?");



//            $query = "SELECT * FROM post WHERE post_category_id = $postCategoryId ";
                } else {

                    $statement2 = mysqli_prepare($conn, "SELECT id, post_title, post_user, post_date, post_image, post_content FROM post WHERE post_category_id = ? AND post_status = ? ");

                    $published = 'published'; //stworzona zmienna z stala wartoscia bo do mysqli_stmt_bind_param nie mozna dac 'published'
//            $query = "SELECT * FROM post WHERE post_category_id = $postCategoryId AND post_status = 'published' ";
                }

                if (isset($statement1)) {

                    mysqli_stmt_bind_param($statement1, "i", $postCategoryId);  // i -> integer liczba  za ?

                    mysqli_stmt_execute($statement1);

                    mysqli_stmt_bind_result($statement1, $postId, $postTitle, $postUser, $postDate, $postImage, $postContent);

                    $stmt = $statement1;
                } else {

                    mysqli_stmt_bind_param($statement2, "is", $postCategoryId, $published); // sa dwa paramtery integer i string 

                    mysqli_stmt_execute($statement2);

                    mysqli_stmt_bind_result($statement2, $postId, $postTitle, $postUser, $postDate, $postImage, $postContent);

                    $stmt = $statement2; // przypisujemy do tej samej zmiennej zeby użyc ponizej 
                }


//            $selectAllQuery = mysqli_query($conn, $query);
//                if(mysqli_stmt_num_rows($stmt) === 0) {     //wczesniej było mysqli_num_rows ($selectAllQuery 
//                        echo "<h1 class='text-center'>W tej chwili nie ma postów w tej kategorii</h1>"; //przeniesone na dół kodu
//
//                }

                while (mysqli_stmt_fetch($stmt)):


                    ?>   



                    <!-- First Blog Post -->
                    <h2> 
                        <a href="/cms/post.php<?php echo $postId; ?>"><?php echo $postTitle ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="authorPosts.php?author=<?php echo $postUser ?>&id=<?php echo $postId ?>"><?php echo $postUser ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
                    <hr>
                    <img class="img-responsive" src="/cms/images/<?php echo $postImage ?>" alt="">
                    <hr>
                    <p><?php echo $postContent ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>


    <?php
    endwhile;
} else {

    header:("Location: index.php");
}
if (mysqli_stmt_num_rows($stmt) === 0) {     //wczesniej było mysqli_num_rows ($selectAllQuery 
    echo "<h1 class='text-center'>W tej chwili nie ma postów w tej kategorii</h1>";
} mysqli_stmt_close($stmt); //zamykamy statment
?>



        </div>

        <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        <!-- /.row -->

        <hr>

            <?php include "includes/footer.php" ?>

