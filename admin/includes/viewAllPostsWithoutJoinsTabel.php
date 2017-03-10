<?php 
include ("deleteModal.php");

if(isset($_POST['checkBoxArray'])){


    foreach($_POST['checkBoxArray'] as $postBoxValueId) {
        
        $bulkOptions = $_POST['bulk_options'];
        
        
        switch ($bulkOptions) {
            case 'published':
            
                $query = "UPDATE post SET post_status = '{$bulkOptions}' WHERE id = {$postBoxValueId} ";
                $updateToPublishedStatus = mysqli_query($conn, $query);
            break;
            case 'draft':
            
                $query = "UPDATE post SET post_status = '{$bulkOptions}' WHERE id = {$postBoxValueId} ";
                $updateToDraftStatus = mysqli_query($conn, $query);
            break;
            case 'delete':
            
                $query = "DELETE FROM post WHERE id = {$postBoxValueId} ";
                $updateToDeleteStatus = mysqli_query($conn, $query);
            break;
                
            case 'clone':
                
                $query = "SELECT * FROM post WHERE id = {$postBoxValueId} ";
                $selectPostQuery = mysqli_query($conn, $query);
                
                while ($row = mysqli_fetch_array($selectPostQuery)){
                    
                    $postTitle = $row['post_title'];
                    $postCategoryId = $row['post_category_id'];
                    $postDate = $row['post_date'];
                    $postAuthor = $row['post_author'];
                    $postUser = $row['post_user'];
                    $postStatus = $row['post_status'];
                    $postImage = $row['post_image'];
                    $postTags = $row['post_tag'];
                    $postContent = $row['post_content'];
                }
                    $query = "INSERT INTO `post` (post_category_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tag, post_status) ";
        
                    $query .= "VALUES({$postCategoryId}, '{$postTitle}', '{$postAuthor}', '{$postUser}', now(), '{$postImage}', '{$postContent}', '{$postTags}', '{$postStatus}' ) ";
                
                    $copyQuery = mysqli_query($conn, $query);
                if(!$copyQuery) {
                    die('Query Filed'. mysqli_error($conn));
                }
                break;
        }
    }



}



?>
                            

    
    <form action="" method="POST">
                             

    <table class="table table-bordered table-hover">
                             
        <div id="bulkOptionContainer" class="col-xs-4" style="padding: 0px">
           
            <select class="form-control" id="" name="bulk_options" >
                
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
                
                
            </select>
            
        </div> 
        <div class="col-xs-4">
           <input type="submit" name="submit" class="btn btn-success" value="Apply"> 
           <a href="./posts.php?source=addPosts" class="btn btn-primary">Add New</a>
            
        </div>                                        
                             
                              <thead>
                                  <tr>
                                      <th><input id="selectAllBoxes" type="checkbox"></th>
                                      <th>ID</th>
                                      <th>User</th>
                                      <th>Title</th>
                                      <th>Category</th>
                                      <th>Status</th>
                                      <th>Image</th>
                                      <th>Tags</th>
                                      <th><a href='../admin/comments.php'>Comments</a></th>
                                      <th>Date</th>
                                      <th>Views</th> 
                                      <th>View Post</th>
                                      <th>Edit</th>
                                      <th>Delete</th>
                                  </tr>
                              </thead>
                          
                            <tbody>
                            
                                   <?php
                                
        $query = "SELECT * FROM post ORDER BY id DESC ";
        $selectPosts = mysqli_query($conn, $query);


        while ($row = mysqli_fetch_assoc($selectPosts)){
        $postId = $row['id'];
        $postAuthor = $row['post_author'];
        $postUser = $row['post_user'];
        $postTitle = $row['post_title'];
        $postCategory = $row['post_category_id'];
        $postStatus = $row['post_status'];
        $postImage = $row['post_image'];
        $postTags = $row['post_tag'];
        $postComments = $row['post_comment_count'];
        $postDate = $row['post_date'];
        $postViewsCount = $row['post_views_count'];
            
                echo "<tr>";
            ?>
               <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $postId;?>"></td>
                
            <?php
                echo "<td>{$postId}</td>";
                if(!empty($postAuthor)){
                echo "<td>{$postAuthor}</td>";
                }elseif(!empty($postUser)){
                echo "<td>{$postUser}</td>";

                }
                
                echo "<td>{$postTitle}</td>";
            
            
            $query = "SELECT * FROM category WHERE id = {$postCategory} ";
            $selectCategoriesId = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($selectCategoriesId)){
            $catId = $row['id'];
            $catTitle = $row['cat_title'];
              
            
                echo "<td>$catTitle</td>";
            
            }
            
                echo "<td>{$postStatus}</td>";
                echo "<td><img width='100' src='../images/{$postImage}'></td>";
                echo "<td>{$postTags}</td>";
            
                $query = "SELECT * FROM comment WHERE comment_post_id = $postId";
                $sendCommentQuery = mysqli_query($conn, $query);
                
                $row = mysqli_fetch_array($sendCommentQuery);
                $commentId = $row['id'];
                
                $countComments = mysqli_num_rows($sendCommentQuery);
            
                echo "<td><a href='postComments.php?id={$postId}'>{$countComments}</a></td>";
            
            
                echo "<td>{$postDate}</td>";              
                echo "<td><a href='posts.php?reset={$postId}'>{$postViewsCount}</a></td>";              
                echo "<td><a href='../post.php?id={$postId}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=editPosts&pId={$postId}'>EDIT</a></td>";
            echo "<td><a rel='$postId' href='javascrpit:void(0)' class='delete_link'>DELETE</a></td>";
//            echo "<td><a onClick=\"javascript: return confirm('Are you sure to delete?'); \" href='posts.php?delete={$postId}'>DELETE</a></td>";
                echo "</tr>";
        }
                          ?>
                                   
    </tbody>
</table>                       
</form>                                             
<?php
    
    if(isset($_GET['delete'])) {
        
        $thePostId = $_GET['delete'];
        
        $query = "DELETE FROM post WHERE id={$thePostId} ";
        
        $deletePost = mysqli_query($conn, $query);
        header("Location: posts.php");
    }
    if(isset($_GET['reset'])) {
        
        $thePostId = $_GET['reset'];
        
        $query = "UPDATE post SET post_views_count = 0 WHERE id = {$thePostId} ";
        
        $resetViewsCount = mysqli_query($conn, $query);
        header("Location: posts.php");
    }

                         
?>


<script>

jQuery(document).ready(function(){
    
    jQuery(".delete_link").on('click', function(){
        
        var id = jQuery(this).attr("rel");
        var deleteUrl = "posts.php?delete="+ id +" ";
        
        
        jQuery(".modal_delete_link").attr("href", deleteUrl);
        
        jQuery("#myModal").modal('show');
        
    });
    
    
});



</script>