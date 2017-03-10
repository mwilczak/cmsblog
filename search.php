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
    
                 
            if(isset ($_POST['submit'])){
                
                $search = $_POST['search'];
                
                $query = "SELECT * FROM post WHERE post_tag LIKE '%$search%' ";
                $searchQuery = mysqli_query($conn, $query);
                
                if(!$searchQuery){
                    die("Query Failed" . mysqli_error($conn));
                }
                
                $count = mysqli_num_rows($searchQuery);
                if($count == 0) {
                     
                    echo "<h1> NO RESULT </h1>";
                    
                }else{
                                $query = "SELECT * FROM post";
            
                    
                    while ($row = mysqli_fetch_assoc($searchQuery)){
                        
                      $postTitle = $row['post_title'];
                      $postAuthor = $row['post_author'];
                      $postDate = $row['post_date'];
                      $postImage = $row['post_image'];
                      $postContent = $row['post_content'];
                ?>   
                   
                        
                             
                                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2> 
                    <a href="#"><?php echo $postTitle ?></a>
                </h2>
                <p class="lead">
                    by <a href="/cms/index"><?php echo $postAuthor ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
                <hr>
                <img class="img-responsive" src="/cms/images/<?php echo $postImage ?>" alt="">
                <hr>
                <p><?php echo $postContent ?>.</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                                                              
                 <?php   }    

                }
            }?>
          


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php" ?>

       