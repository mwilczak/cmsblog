<?php
if(isset($_POST['checkBoxArray'])){


    foreach($_POST['checkBoxArray'] as $commentBoxValueId) {
        
        $bulkOptions = $_POST['bulk_options'];
        
        
        switch ($bulkOptions) {
            case 'approved':
            
                $query = "UPDATE comment SET comment_status = '{$bulkOptions}' WHERE id = {$commentBoxValueId} ";
                $updateToApprovedStatus = mysqli_query($conn, $query);
            break;
            case 'unapproved':
            
                $query = "UPDATE comment SET comment_status = '{$bulkOptions}' WHERE id = {$commentBoxValueId} ";
                $updateToUnapprovedStatus = mysqli_query($conn, $query);
            break;
            case 'delete':
            
                $query = "DELETE FROM comment WHERE id = {$commentBoxValueId} ";
                $updateToDeleteStatus = mysqli_query($conn, $query);
            break;
                
            case 'clone':
                
                $query = "SELECT * FROM comment WHERE id = {$commentBoxValueId} ";
                $selectComments = mysqli_query($conn, $query);
                
                    
                    while ($row = mysqli_fetch_array($selectComments)){
                    $commentPostId = $row['comment_post_id'];
                    $commentAuthor = $row['comment_author'];
                    $commentContent = $row['comment_content'];
                    $commentEmail = $row['comment_email'];
                    $commentStatus = $row['comment_status'];
                    $commentDate = $row['comment_date'];
                }
                    $query = "INSERT INTO `comment` (comment_post_id, comment_author, comment_content, comment_email, comment_status, comment_date) ";
        
                    $query .= "VALUES({$commentPostId}, '{$commentAuthor}', '{$commentContent}', '{$commentEmail}', '{$commentStatus}', now() )";
                
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
             
    <div id="bulkOptionContainer" class="col-xs-4" style="padding: 0px">
           
            <select class="form-control" id="" name="bulk_options" >
                
                <option value="">Select Options</option>
                <option value="approve">Approve</option>
                <option value="unapprove">Unapprove</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
                
                
            </select>
            
        </div> 
        <div class="col-xs-4">
           <input type="submit" name="submit" class="btn btn-success" value="Apply"> 
            
        </div>                              

                             
                      
                             
            <table class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th><input id="selectAllBoxes" type="checkbox"></th>
                                      <th>ID</th>
                                      <th>Author</th>
                                      <th>Comment</th>
                                      <th>Email</th>
                                      <th>Status</th>
                                      <th>In response to</th>
                                      <th>Date</th>
                                      <th>Approve</th>
                                      <th>Unapprove</th>
                                      <th>Delete</th>
                                  </tr>
                              </thead>
                          
                            <tbody>
                            
                                   <?php
                                
        $query = "SELECT * FROM comment";
        $selectComments = mysqli_query($conn, $query);


        while ($row = mysqli_fetch_assoc($selectComments)){
        $commentId = $row['id'];
        $commentPostId = $row['comment_post_id'];
        $commentAuthor = $row['comment_author'];
        $commentContent = $row['comment_content'];
        $commentEmail = $row['comment_email'];
        $commentStatus = $row['comment_status'];
        $commentDate = $row['comment_date'];

            
                echo "<tr>";
            ?>
               <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $commentId;?>"></td>
                
            <?php
                echo "<td>{$commentId}</td>";
                echo "<td>{$commentAuthor}</td>";
                echo "<td>{$commentContent}</td>";
                echo "<td>{$commentEmail}</td>";
                echo "<td>{$commentStatus}</td>";
            
            
                $query = "SELECT * FROM post WHERE id = $commentPostId";
                $selectPostIdQuery = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($selectPostIdQuery)) {
                    
                    $postId = $row['id'];
                    $postTitle = $row['post_title'];
                    $postTitle = $row['post_title'];
                    
                        echo "<td><a href='../post.php?id=$postId'>{$postTitle}</td>";

                }
                            
            
                echo "<td>{$commentDate}</td>";
                echo "<td><a href='./comments.php?approve=$commentId'>APPROVE</a></td>";
                echo "<td><a href='comments.php?unapprove=$commentId'>UNAPPROVE</a></td>";
                echo "<td><a href='comments.php?delete=$commentId'>DELETE</a></td>";
                echo "</tr>";
        }
            
            
                                ?>
                                   
    </tbody>
</table>                       
</form>                                         
<?php

    if(isset($_GET['approve'])) {
        
        $theCommentId = $_GET['approve'];
        
        $query = "UPDATE comment SET comment_status = 'approved' WHERE id = $theCommentId";
        
        $approveCommentQuery = mysqli_query($conn, $query);
        header("Location: comments.php");
    }


    if(isset($_GET['unapprove'])) {
        
        $theCommentId = $_GET['unapprove'];
        
        $query = "UPDATE comment SET comment_status = 'unapproved' WHERE id = $theCommentId";
        
        $unapproveCommentQuery = mysqli_query($conn, $query);
        header("Location: comments.php");
    }






    
    if(isset($_GET['delete'])) {
        
        $theCommentId = $_GET['delete'];
        
        $query = "DELETE FROM comment WHERE id={$theCommentId} ";
        
        $deleteComment = mysqli_query($conn, $query);
        header("Location: comments.php");
    }


  
                                
?>