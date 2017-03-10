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
            $postAuthor = $_GET['author'];
            
        }
    
    
            $query = "SELECT * FROM post WHERE post_user = '{$postAuthor}' ";
            
            $selectAllQuery = mysqli_query($conn, $query);
                    
                    while ($row = mysqli_fetch_assoc($selectAllQuery)){
                        
                      $postTitle = $row['post_title'];
                      $postAuthor = $row['post_user'];
                      $postUser = $row['post_user'];
                      $postDate = $row['post_date'];
                      $postImage = $row['post_image'];
                      $postContent = $row['post_content'];
                ?>   
                   

                <!-- First Blog Post -->
                                             
                                <h1 class="">
                    
                    <small>Wszystkie posty użytkownika:  <?php echo $postAuthor ?></small>
                </h1>

                <h2> 
                    <a href="#"><?php echo $postTitle ?></a>
                </h2>
                <p class="lead">
                    by <?php echo $postAuthor ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
                <hr>
                <p><?php echo $postContent ?>.</p>

    
                                                              
                 <?php   }    ?>
                 
                 
                 
                 
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
                    
                $query = "UPDATE post SET post_comment_count = post_comment_count + 1 ";    
                $query .= "WHERE id = $postId ";    
                $updateCommentCount = mysqli_query($conn, $query);
                }else {
                        
                        echo "<script>alert('Fields cannot be EMPTY')</script>";
                    }
                    
            }
    
                ?>

                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php" ?>

       