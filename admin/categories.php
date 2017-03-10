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
                            Category
                            <small>Zalogowany: <?php echo $_SESSION['username']; ?></small>
                        </h1>
                        
                        <div class="col-xs-6"> 
                        
                      <?php  insertCategories();?>    <!--ADD CATEGORY FORM-->                                                                                                       
                            <form action="" method="POST">
                                <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add category">
                                </div>
                            </form>
                            
                            
                            <?php  //update and include
                            
                            if(isset($_GET['edit'])){
                                
                                $catId = $_GET['edit'];
                                
                                include "includes/editCategories.php";
                                
                            }

                            ?>

                        </div>

                        <div class="col-xs-6">

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php findAllCategories(); //wyswietlanie wszystkich kategorii ?>

                                <?php  deleteCategories();  //usuwanie kategorii  ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/adminFooter.php";?>