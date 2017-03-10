<?php
    
    if(isset($_GET['edit_user'])) {
        
        $userId = $_GET['edit_user'];
        
        $query = "SELECT * FROM user WHERE id = $userId ";
        $selectUsersQuery = mysqli_query($conn, $query);


        while ($row = mysqli_fetch_assoc($selectUsersQuery)){
        $userId = $row['id'];
        $userName = $row['username'];
        $userPassword = $row['password'];
        $userFirstname = $row['firstname'];
        $userLastname = $row['lastname'];
        $userEmail = $row['email'];
        $userImage = $row['image'];
        $userRole = $row['role'];
        }

            if(isset($_POST['edit_user'])){

                $userFirstname = $_POST['firstname'];
                $userLastname = $_POST['lastname'];
                $userRole = $_POST['role'];
                $username = $_POST['username'];
                $userEmail = $_POST['email'];
                $userPassword = $_POST['password'];

    
    
                    if(!empty($userPassword)){

                        $queryPassword = "SELECT password FROM user WHERE id = $userId ";
                        $getUser = mysqli_query($conn, $queryPassword);
                        check($getUser);

                        $row = mysqli_fetch_array($getUser);

                        $dbUserPassword = $row['password'];

                            if($dbUserPassword != $userPassword) {
                            $hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost'=>12));
                                
                            }else{
                                $hashedPassword = $dbUserPassword;
                                }
                                $query = "UPDATE user SET ";
                                $query .="firstname = '{$userFirstname}', ";
                                $query .="lastname = '{$userLastname}', ";
                                $query .="role = '{$userRole}', ";
                                $query .="username = '{$username}', ";
                                $query .="email = '{$userEmail}', ";
                                $query .="password = '{$hashedPassword}' ";
                                $query .= "WHERE id = {$userId} ";


                            $updateUser = mysqli_query($conn, $query);

                            check($updateUser);

                            echo "User Updated" ." ". "<a class='btn btn-primary' href='users.php'>View Users</a>";
                            
        }

    }
        
}else {
        header("Location: index.php");
    }

  
?>
  
<form action="" method="POST" enctype="multipart/form-data">
   
   <div class="form-group">
       <label for="post_author">Firstname</label>
       <input type="text" value="<?php echo $userFirstname; ?>" class="form-control" name="firstname">
   </div>
    
   <div class="form-group">
       <label for="post_status">Lastname</label>
       <input type="text" value="<?php echo $userLastname; ?>" class="form-control" name="lastname">
   </div>
   
  
    

 <div class="form-group">
       <label for="role">Role</label> <br>
       <select name="role" id="">
       <option value="<?php echo $userRole; ?>"><?php echo $userRole; ?></option>
                  <?php  
       
           if($userRole == 'admin') {
               
               echo  "<option value='subscriber'>subscriber</option>";
   
           }else {
               
               echo "<option value='admin'>admin</option>";

           }
           
        ?>
                    
       </select>
    </div>
        
   <div class="form-group">
       <label for="post_tags">Username</label>
       <input type="text" value="<?php echo $userName; ?>" class="form-control" name="username">
   </div>
        
   <div class="form-group">
       <label for="email">Email</label>
       <input type="email" value="<?php echo $userEmail; ?>" class="form-control" name="email"> 
   </div>
   
      <div class="form-group">
       <label for="password">Password</label>
       <input type="password" value="<?php echo $userPassword; ?>" class="form-control" name="password"> 
   </div>
   
   <div class="form-group">
      <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
   </div>

</form>



    
