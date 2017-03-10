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
                         Welcome to posts
                          <small><?php echo $_SESSION['username']; ?></small>
                       </h1>
  
                        <?php
                        
                        if(isset($_GET['source'])){
                            
                            $source = $_GET['source'];

                        }else {
                            $source = "";
                        }
                            switch ($source) {
                                    
                                    case 'addPosts';
                                    include 'includes/addPosts.php';
                                    break;
                                    
                                    case 'editPosts';
                                    include 'includes/editPosts.php';
                                    break;  
                                    
                                    case '200';
                                    echo 'Nice 200';
                                    break;
                                    
                                    default:
                                    include "includes/viewAllPosts.php";   
                                    break;
                                    
                                    
                            }
                        
                        ?>
                         
                         
                          
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/adminFooter.php";?>