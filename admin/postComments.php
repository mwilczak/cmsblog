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
                            Welcome To Comments
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>

                             <table class="table table-bordered table-hover">
                              <thead>
                                  <tr>
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
                                
        $query = "SELECT * FROM comment WHERE comment_post_id =" . mysqli_real_escape_string($conn, $_GET['id']). " ";
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
                echo "<td><a href='postComments.php?delete=$commentId&id=" . $_GET['id'] . "'>DELETE</a></td>";
                echo "</tr>";
        }
            
            ?>
                                   
    </tbody>
</table>                       
                                             
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
        header("Location: postComments.php?id=". $_GET['id'] ."");
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