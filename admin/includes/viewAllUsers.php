
        <table class="table table-bordered table-hover text-center">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Username</th>
                                      <th>Firstname</th>
                                      <th>Lastname</th>
                                      <th>Email</th>
                                      <th>Role</th>
                                      <th class="text-center">Change To Admin</th>
                                      <th class="text-center">Change To Subscriber</th>
                                      <th>Edit</th>
                                      <th>Delete</th>
 
                                  </tr>
                              </thead>
                          
                            <tbody>
                            
                                   <?php
                                
        $query = "SELECT * FROM user";
        $selectUsers = mysqli_query($conn, $query);


        while ($row = mysqli_fetch_assoc($selectUsers)){
        $userId = $row['id'];
        $userName = $row['username'];
        $userPassword = $row['password'];
        $userFirstname = $row['firstname'];
        $userLastname = $row['lastname'];
        $userEmail = $row['email'];
        $userImage = $row['image'];
        $userRole = $row['role'];

            
                echo "<tr>";
                echo "<td>{$userId}</td>";
                echo "<td>{$userName}</td>";
                echo "<td>{$userFirstname}</td>";
            
                
//            $query = "SELECT * FROM category WHERE id = {$postCategory} ";
//            $selectCategoriesId = mysqli_query($conn, $query);
//
//            while ($row = mysqli_fetch_assoc($selectCategoriesId)){
//            $catId = $row['id'];
//            $catTitle = $row['cat_title'];
//              
//            
//                echo "<td>$catTitle</td>";
//            
//            }
            
                echo "<td>{$userLastname}</td>";
                echo "<td>{$userEmail}</td>";
                echo "<td>{$userRole}</td>";
            
            
//                $query = "SELECT * FROM post WHERE id = $commentPostId";
//                $selectPostIdQuery = mysqli_query($conn, $query);
//                while($row = mysqli_fetch_assoc($selectPostIdQuery)) {
//                    
//                    $postId = $row['id'];
//                    $postTitle = $row['post_title'];
//                    $postTitle = $row['post_title'];
//                    
//                        echo "<td><a href='../post.php?id=$postId'>{$postTitle}</td>";
//
//                }
                            
            
                echo "<td><a href='./users.php?change_to_admin={$userId}'>Admin</a></td>";
                echo "<td><a href='users.php?change_to_sub={$userId}'>Subscriber</a></td>";
                echo "<td><a href='users.php?source=editUsers&edit_user={$userId}'>EDIT</a></td>";
                echo "<td><a href='users.php?delete={$userId}'>DELETE</a></td>";
                echo "</tr>";
        }
            
            
                                ?>
                                   
    </tbody>
</table>                       
                                             
<?php

    if(isset($_GET['change_to_admin'])) {
        
        $userId = $_GET['change_to_admin'];
        
        $query = "UPDATE user SET role = 'admin' WHERE id = $userId";
        
        $changeAdminQuery = mysqli_query($conn, $query);
        header("Location: users.php");
    }


    if(isset($_GET['change_to_sub'])) {
        
        $userId = $_GET['change_to_sub'];
        
        $query = "UPDATE user SET role = 'subscriber' WHERE id = $userId";
        
        $changeSubscriberQuery = mysqli_query($conn, $query);
        header("Location: users.php");
    }



    
    if(isset($_GET['delete'])) {
        
        if(isset($_SESSION['role'])){
            
            if($_SESSION['role'] == 'admin'){
        
        $userId = mysqli_real_escape_string($conn, $_GET['delete']);
        
        $query = "DELETE FROM user WHERE id={$userId} ";
        
        $deleteUser = mysqli_query($conn, $query);
        header("Location: users.php");
    }
  }
}
                                
?>