                <!-- EDIT CATEGORY FORM-->
            <form action="" method="POST">
            <div class="form-group">
            <label for="cat-title">Edit Category</label>

               <?php

                if(isset($_GET['edit'])){
                        $editID = $_GET['edit'];

                    $query = "SELECT * FROM category WHERE id ={$editID} ";
                    $selectCategoriesId = mysqli_query($conn, $query);


                    while ($row = mysqli_fetch_assoc($selectCategoriesId)){
                    $catId = $row['id'];
                    $catTitle = $row['cat_title'];

                    ?>


        <input value="<?php if(isset($catTitle)) {  echo $catTitle;} ?>" class="form-control" type="text" name="cat_title">



           <?php  } } ?>


           <?php
                  // Update category

        if(isset($_POST['update_category'])) {

            $updateCatTitle = escape($_POST['cat_title']);

            $stmt = mysqli_prepare($conn, "UPDATE category SET cat_title = ? WHERE id= ? ");
            
            mysqli_stmt_bind_param($stmt, "si", $updateCatTitle, $catId);
            mysqli_stmt_execute($stmt);

 

                    if(!$stmt){

                        die('Query Failed' . mysqli_error($conn));
                    }

            mysqli_stmt_close($stmt);
            
            header("Location: categories.php"); 


        }


          ?>



            </div>
             <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_category" value="Update category">
            </div>                               


        </form>        