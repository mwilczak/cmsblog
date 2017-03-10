<div class="col-md-4">

                 <!-- Login input -->
                <div class="well">
                   
                   <?php if(isset($_SESSION['role'])): ?>
                       <h4 class="text-center">Zalogowany: <?php echo $_SESSION['username']?></h4>
                       <a href="includes/logout.php" class="btn btn-info form-control">Wyloguj</a>
                   <?php else: ?>
                   <h4> Login</h4>
                    <form action="includes/login.php" method="POST">
                    
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Username">
                    </div>
                    <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    <span class="input-group-btn">
                        
                        <button class="btn btn-primary" name="login" type="submit">LOG IN</button>
                        
                        
                    </span>
                       
                    </div>
                    </form>
                   <?php endif; ?>
                   
                   
                     <!-- search form!-->
                    <!-- /.input-group -->
                </div>

               
                <!-- Blog Search Well -->
                <div class="well">
                   
                    <h4>Blog Search</h4>
                    <form action="search.php" method="POST">
                    
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form> <!-- search form!-->
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                   
                                     <?php
                    
                    $query = "SELECT * FROM category";
                    $selectCategoiresSidebar = mysqli_query($conn, $query);
                    
             
                    
                    ?>
                   
                   
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                        <?php
                         while ($row = mysqli_fetch_assoc($selectCategoiresSidebar)){
                         $catId = $row['id'];
                         $catTitle = $row['cat_title'];

                            echo "<li><a href='./category.php?category=$catId'>{$catTitle}</a></li>";
                             
                        }
                          
                        ?>        
                            </ul>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->

                    <?php include "widget.php";?>
            </div>

