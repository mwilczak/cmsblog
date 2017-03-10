<?php

    if(isset($_POST['create_user'])){
        
        $userFirstname = escape($_POST['firstname']);
        $userLastname = escape($_POST['lastname']);
        $userRole = escape($_POST['role']);
        $username = escape($_POST['username']);
        $userEmail = escape($_POST['email']);
        $userPassword = escape($_POST['password']);

        $userPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost'=>10));   

        
        $query = "INSERT INTO `user` (firstname, lastname, role, username, email, password) ";
        
        $query .= "VALUES('{$userFirstname}', '{$userLastname}', '{$userRole}', '{$username}', '{$userEmail}', '{$userPassword}') ";
        
                $createUserQuery = mysqli_query($conn, $query);
        
                check($createUserQuery);
        
        echo "USER CREATED" . " " . "<a href='users.php' class='btn btn-success'>View Users</a>";
        
    }
        


  
?>
  
<form action="#" method="POST" enctype="multipart/form-data">
   
   <div class="form-group">
       <label for="post_author">Firstname</label>
       <input type="text" class="form-control" name="firstname">
   </div>
    
   <div class="form-group">
       <label for="post_status">Lastname</label>
       <input type="text" class="form-control" name="lastname">
   </div>
   
  
<div class="form-group">
       <label for="role">Role</label> <br>
       <select name="role" id="">
       
       <option value="subscriber">Select Options</option>
       <option value="admin">Admin</option>
       <option value="subscriber">Subscriber</option>
       
    </select>
    </div>
    
<!--
   <div class="form-group">
       <label for="post_image">Post Image</label>
       <input type="file" name="image">
   </div>
-->

   <div class="form-group">
       <label for="post_tags">Username</label>
       <input type="text" class="form-control" name="username">
   </div>
        
   <div class="form-group">
       <label for="email">Email</label>
       <input type="email" class="form-control" name="email"> 
   </div>
   
      <div class="form-group">
       <label for="password">Password</label>
       <input type="password" class="form-control" name="password"> 
   </div>
   
   <div class="form-group">
      <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
   </div>
    
  
    
</form>