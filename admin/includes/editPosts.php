<?php

    if(isset($_GET['pId'])) {
        
        $thePostEditId = $_GET['pId'];

    }
  


        $query = "SELECT * FROM post WHERE id = $thePostEditId ";
        $selectPostsById = mysqli_query($conn, $query);
 

     while ($row = mysqli_fetch_assoc($selectPostsById)){
        $postId = $row['id'];
        $postUser = $row['post_user'];
        $postTitle = $row['post_title'];
        $postCategoryId = $row['post_category_id'];
        $postStatus = $row['post_status'];
        $postImage = $row['post_image'];
        $postContent = $row['post_content'];
        $postTags = $row['post_tag'];
        $postComments = $row['post_comment_count'];
        $postDate = $row['post_date'];
         
        }


    if(isset($_POST['update_post'])) {
        
        $postUser = $_POST['post_user'];
        $postTitle = $_POST['post_title'];
        $postCategory = $_POST['post_category'];
        $postStatus = $_POST['post_status'];
        $postImage = $_FILES['image']['name'];
        $postImageTemp = $_FILES['image']['tmp_name'];
        $postContent = $_POST['post_content'];
        $postTags = $_POST['post_tags'];
        
        move_uploaded_file($postImageTemp, "../images/$postImage"); 
        
                if(empty($postImage)) {
                    
                    $query = "SELECT * FROM post WHERE id = $thePostEditId ";
                    $selectImage = mysqli_query($conn, $query);
                    
                    while($row = mysqli_fetch_array($selectImage)) {
                        
                        $postImage = $row['post_image'];
                    }
                    
                }
                
                    $query = "UPDATE post SET ";
                    $query .="post_title = '{$postTitle}', ";
                    $query .="post_category_id = '$postCategory', ";
                    $query .="post_date = now(), ";
                    $query .="post_user = '{$postUser}', ";
                    $query .="post_status = '{$postStatus}', ";
                    $query .="post_tag = '{$postTags}', ";
                    $query .="post_content = '{$postContent}', ";
                    $query .="post_image = '{$postImage}' ";
                    $query .= "WHERE id = {$thePostEditId} ";
        
            $updatePost = mysqli_query($conn, $query);
        
            check($updatePost);
        
            echo "<p class='bg-success'>Post Updated <a href='../post.php?id=$postId' class='btn btn-success'>View Updated Post</a>
             <a href='posts.php' class='btn btn-primary'>Edit More Posts</a></p>";
    }
?>
  

  
  
  <form action="" method="POST" enctype="multipart/form-data">
   
   <div class="form-group">
       <label for="title">Post Titile</label>
       <input value="<?php echo $postTitle; ?>" type="text" class="form-control" name="post_title">
   </div>
    
   <div class="form-group">
      <label for="post_category">Category</label>
       <select name="post_category" id="">
           
                  <?php  
       
        $query = "SELECT * FROM category";
        $selectCategories = mysqli_query($conn, $query);
        
        check($selectCategories);

        while ($row = mysqli_fetch_assoc($selectCategories)){
        $catId = $row['id'];
        $catTitle = $row['cat_title'];
            
            
            if($catId == $postCategoryId){
            
            echo "<option selected value='$catId'>{$catTitle}</option>";

            }else {
            
             echo "<option value='$catId'>{$catTitle}</option>";

            }
        }
           
       
        ?>
           
           
           
       </select>
      
   </div>
    
        
       <div class="form-group">
       <label for="post_user">Post User</label> <br>
       <select name="post_user" id="">
        <?php  echo "<option value='$postUser'>{$postUser}</option>"; ?>
                  <?php  
       
        $query = "SELECT * FROM user";
        $selectUsers = mysqli_query($conn, $query);
        
        check($selectUsers);

        while ($row = mysqli_fetch_assoc($selectUsers)){
        $userId = $row['id'];
        $postUser = $row['username'];
            
            echo "<option value='$postUser'>{$postUser}</option>";
        }
       
        ?>
                    
       </select>
    </div>
    
    
<!--
   <div class="form-group">
       <label for="post_author">Post Author</label>
       <input value="<?php //echo $postAuthor; ?>" type="text" class="form-control" name="post_author">
   </div>
-->
   
   <div class="form-group">
     <label for="post_status">Status</label>
     <select name="post_status" id="">
       
       <option value='<?php echo $postStatus; ?>'><?php echo $postStatus; ?></option>
       
       <?php 
                if ($postStatus == 'published') {
                    
                    echo "<option value='draft'>Draft</option>";

                }else {
                    echo "<option value='published'>Publish</option>";
                }
         
         ?>
       
     </select>
   </div>
    
   <div class="form-group">
      <img width="100" src="../images/<?php echo $postImage;?>" alt="">
      <input type="file" name="image">
   </div>

   <div class="form-group">
       <label for="post_tags">Post Tags</label>
       <input value="<?php echo $postTags; ?>" type="text" class="form-control" name="post_tags">
   </div>
        
   <div class="form-group">
       <label for="post_content">Post Content</label>
       <textarea  type="text" class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo str_replace('\r\n','<br>', $postContent); ?> </textarea>
   </div>
   
   <div class="form-group">
      <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
   </div>
  
</form>