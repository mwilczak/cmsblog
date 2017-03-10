        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms">Home Page</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                 
                                   <?php 
                    if(isset($_SESSION['role']) == 'admin'){
                        
                     echo "<li><a href='/cms/admin'>GO TO ADMIN</a></li>";

                    } 

                    ?>
                  
                  <?php
                    
                    $query = "SELECT * FROM category LIMIT 5";
                    $selectAllQuery = mysqli_query($conn, $query);
                    
                    while ($row = mysqli_fetch_assoc($selectAllQuery)){
                     $catId = $row['id'];
                     $catTitle = $row['cat_title'];
                        
                     $categoryClass = '';
                        
                     $registrationClass = '';
                        
                     $contactClass = '';
                        
                     $pageName = basename($_SERVER['PHP_SELF']); 
                     
                     $registration = 'registration.php';
                     $contact = 'contact.php';
                        
                        if(isset($_GET['category']) && $_GET['category'] == $catId) {
                            
                            $categoryClass = 'active';
                        } else if ($pageName == $registration) {
                            
                            $registrationClass = 'active';
                        } else if ($pageName == $contact) {
                            
                            $contactClass = 'active';
                        }
                        
                        echo "<li class='$categoryClass'><a href='/cms/category.php?category={$catId}'>{$catTitle}</a></li>";
                    }
                    
                    
                    ?>
  
                   
<!--
                    <li>
                        <a href="admin">Admin</a>
                    </li>
-->
                     <li class="<?php echo $contactClass;?>">
                        <a href="/cms/contact.php">Contact</a>
                    </li>
                    <li class="<?php echo $registrationClass;?>">
                        <a href="/cms/registration.php">Register Now!</a>
                    </li>                    

                <?php 
                    
                    if(isset($_SESSION['role'])){
                        
                        if(isset($_GET['id'])) {
                            
                            $postId = $_GET['id'];
                             
                            echo "<li><a href='/cms/admin/posts.php?source=editPosts&pId={$postId}'>Edit Post</a></li>";
                        }
                        
                        
                    }
                    
                    
                    ?>    
                    
                
                </ul>
                
                
                
            </div>
                    </div>
        <!-- /.container -->
    </nav>