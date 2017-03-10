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
        
        if(isset($_GET['id'])) {
            
            $postId = $_GET['id'];
            
        
            $viewQuery = "UPDATE post SET post_views_count = post_views_count + 1 WHERE id = {$postId} ";
            $sendViewQuery = mysqli_query($conn, $viewQuery);
            
            if(!$sendViewQuery) {
                die("QUERY FILED" . mysqli_error($conn));
            }
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                
                     $query = "SELECT * FROM post WHERE id = $postId ";

                
            }else {
                    
                $query = "SELECT * FROM post WHERE id = $postId AND post_status = 'published' ";

            }
    
            
            $selectAllQuery = mysqli_query($conn, $query);
            
                if(mysqli_num_rows($selectAllQuery) < 1){
                        echo "<h1 class='text-center'>W tej chwili nie ma postów w tej kategorii</h1>";

                } else {
                    
                    
                    while ($row = mysqli_fetch_assoc($selectAllQuery)){
                        
                      $postTitle = $row['post_title'];
                      $postAuthor = $row['post_user'];
                      $postDate = $row['post_date'];
                      $postImage = $row['post_image'];
                      $postContent = $row['post_content'];
                ?>   


                <!-- First Blog Post -->
                <h2> 
                    <a href="#"><?php echo $postTitle ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $postAuthor ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
                <hr>
                <p><?php echo $postContent ?>.</p>

                <hr>

                                 
                 <?php   }   

                
                ?>
                 
                 
                 
                 
                 <!-- Blog Comments -->
                 
                 
                 <?php
                
             if(isset($_POST['create_comment'])) {
                    
                        $postId = $_GET['id'];
                        $commentAuthor = $_POST['comment_author'];
                        $commentEmail = $_POST['comment_email'];
                        $commentContent = $_POST['comment_content'];
                    
                    if (!empty($commentAuthor) && !empty($commentEmail) && !empty($commentContent)) {
                        
                        
                $query = "INSERT INTO comment (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                $query .= "VALUES ($postId, '{$commentAuthor}', '{$commentEmail}', '{$commentContent}', 'unapproved', now())";
                    
                $createCommentQuery = mysqli_query($conn, $query); 
                    
                    if(!$createCommentQuery) {
                        die('QUERY FAILED' ." ". mysqli_error($conn));
                    }

                }else {
                        
                        echo "<script>alert('Fields cannot be EMPTY')</script>";
                    }
                    
            }
    
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form aciton="" method="POST" role="form">
                       
                        <div class="form-group">
                            <input type="text" class="form-control" name="comment_author" placeholder="Name">
                        </div>               
                                
                        <div class="form-group">
                            <input type="email" class="form-control" name="comment_email" placeholder="Email">
                        </div>
                       
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="comment_content" placeholder="Comment"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
            <?php
                $query = "SELECT * FROM comment WHERE comment_post_id = {$postId} ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY id DESC ";
                
                $selectCommentQuery = mysqli_query($conn, $query);
                
                if(!$selectCommentQuery) {
                    
                    die('Query Failed' . mysqli_error($conn));
                }
               while ($row = mysqli_fetch_array($selectCommentQuery)) {
                   
                   $commentDate = $row['comment_date'];
                   $commentContent = $row['comment_content'];
                   $commentAuthor = $row['comment_author'];
                   
                ?>   
                
                
                               
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $commentAuthor; ?>
                            <small><?php echo $commentDate; ?></small>
                        </h4>
                        <?php echo $commentContent; ?>
                    </div>
                </div>

         
                
                
            <?php   
               }  }  } else {
            
            header("Location:index.php");
        }?> 
               

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php" ?>

       