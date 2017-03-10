<?php include "includes/adminHeader.php";?>
    <div id="wrapper">

        <!-- Navigation -->

<?php include "includes/adminNavigation.php";?>
       
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                </div>
 
                <!-- /.row -->

                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php 
                        
                        $query = "SELECT * FROM post";
                        
                        $selectAllPost = mysqli_query($conn, $query);
                        $postsCount = mysqli_num_rows($selectAllPost);
                        echo " <div class='huge'>{$postsCount}</div>";
                        
                        ?>

                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php 
                        
                        $query = "SELECT * FROM comment";
                        $selectAllComments = mysqli_query($conn, $query);
                        $commentsCounts = mysqli_num_rows($selectAllComments);
                        
                        echo "<div class='huge'>{$commentsCounts}</div>";

                        ?>

                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    
                    <?php 
                        
                    $query = "SELECT * FROM user";
                    $selectAllUsers = mysqli_query($conn, $query);
                        $countUsers = mysqli_num_rows($selectAllUsers);
                        
                        echo "<div class='huge'>{$countUsers}</div>";
                        
                        
                    ?>
                    
                    
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                       
                   <?php 
                        
                    $query = "SELECT * FROM category";
                    $selectAllCategories = mysqli_query($conn, $query);
                        $countCategories = mysqli_num_rows($selectAllCategories);
                        
                        echo "<div class='huge'>{$countCategories}</div>";
                        
                        
                    ?>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
                
                        <?php 
                        
                        $query = "SELECT * FROM post WHERE post_status = 'draft' ";
                        
                        $selectAllDraftPost = mysqli_query($conn, $query);
                        $postsDraftCount = mysqli_num_rows($selectAllDraftPost);                       
                
                
                        $query = "SELECT * FROM post WHERE post_status = 'published' ";
                        
                        $selectAllPublishedPost = mysqli_query($conn, $query);
                        $postsPublishedCount = mysqli_num_rows($selectAllPublishedPost);
                
                        $query = "SELECT * FROM comment WHERE comment_status = 'unapproved' ";
                        
                        $selectAllUnapprovedComments = mysqli_query($conn, $query);
                        $unapprovedCommentsCount = mysqli_num_rows($selectAllUnapprovedComments);
                
                        $query = "SELECT * FROM user WHERE role = 'subscriber' ";
                        
                        $selectAllUserSubscriber = mysqli_query($conn, $query);
                        $userSubscribertCount = mysqli_num_rows($selectAllUserSubscriber);
                        
                        ?>
                
<!--    Diagram-->
                <div class="row">
                    <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);
             function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', ''],
        
            <?php 
            $elementText = ['All Posts', 'Active Posts', 'Draft Posts', 'Pending Comments', 'Comments', 'User Subscriber', 'Users', 'Categories'];
            $elementCount = [$postsCount, $postsPublishedCount, $postsDraftCount, $unapprovedCommentsCount, $commentsCounts, $userSubscribertCount, $countUsers, $countCategories];
            
                for ($i=0; $i < 8 ; $i++) {
                    
                    echo "['{$elementText[$i]}'" . "," . "{$elementCount[$i]}],";

                }
            
            ?>
        ]);

        var options = {chart: {
                       title: '',
                        subtitle: '',
                              }
                        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>

          <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

                </div>
                
                </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/adminFooter.php";?>