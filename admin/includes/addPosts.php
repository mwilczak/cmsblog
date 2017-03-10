<?php

    if(isset($_POST['create_post'])){
        
        $postTitle = escape($_POST['title']);
        $postUser = escape($_POST['post_user']);
//        $postAuthor = escape($_POST['post_author']);
        $postCategory = escape($_POST['post_category']);
        $postStatus = escape($_POST['post_status']);
        
        $postImage = escape($_FILES['image']['name']);
        $postImageTemp = escape($_FILES['image']['tmp_name']);
        
        $postTags = escape($_POST['post_tags']);
        $postContent = escape($_POST['post_content']);
        $postDate = date('d-m-y');
        
        
            move_uploaded_file($postImageTemp, "../images/$postImage"); 
        
        $query = "INSERT INTO `post` (post_category_id, post_title, post_user, post_date, post_image, post_content, post_tag, post_status) ";
        
         $query .= "VALUES({$postCategory}, '{$postTitle}', '{$postUser}', now(), '{$postImage}', '{$postContent}', '{$postTags}', '{$postStatus}' ) ";
        
                $createPostQuery = mysqli_query($conn, $query);
        
                check($createPostQuery);
        
        $postId = mysqli_insert_id($conn);
    echo "<p class='bg-success'>Post Added <a href='../post.php?id=$postId' class='btn btn-success'>View Updated Post</a>
         <a href='posts.php' class='btn btn-primary'>Edit More Posts</a></p>";
    }
        


  
?>
  
<form action="" method="POST" enctype="multipart/form-data">
   
   <div class="form-group">
       <label for="title">Post Title</label>
       <input type="text" class="form-control" name="title">
   </div>
    
   <div class="form-group">
       <label for="category">Category</label> <br>
       <select name="post_category" id="">
           
                  <?php  
       
        $query = "SELECT * FROM category";
        $selectCategories = mysqli_query($conn, $query);
        
        check($selectCategories);

        while ($row = mysqli_fetch_assoc($selectCategories)){
        $catId = $row['id'];
        $catTitle = $row['cat_title'];
            
            echo "<option value='$catId'>{$catTitle}</option>";
        }
       
        ?>
                    
       </select>
    </div>
       <div class="form-group">
       <label for="post_user">Post User</label> <br>
       <select name="post_user" id="">
           
                  <?php  
       
        $query = "SELECT * FROM user";
        $selectUsers = mysqli_query($conn, $query);
        
        check($selectUsers);

        while ($row = mysqli_fetch_assoc($selectUsers)){
        $userId = escape($row['id']);
        $postUser = escape($row['username']);
            
            echo "<option value='$postUser'>{$postUser}</option>";
        }
       
        ?>
                    
       </select>
    </div>
    

    
   <div class="form-group">
       <select name="post_status" id="">
           <option value="draft">Post Status</option>
           <option value="draft">Draft</option>
           <option value="published">Publish</option>
       </select>
   </div>
    
   <div class="form-group">
       <label for="post_image">Post Image</label>
       <input type="file" name="image">
   </div>

   <div class="form-group">
       <label for="post_tags">Post Tags</label>
       <input type="text" class="form-control" name="post_tags">
   </div>
        
   <div class="form-group">
       <label for="post_content">Post Content</label>
       <textarea type="text" class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
   </div>
   
   <div class="form-group">
      <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
   </div>
    
  
    
</form>