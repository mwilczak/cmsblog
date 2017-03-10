<?php include "includes/adminHeader.php";?>
    <div id="wrapper">

        <!-- Navigation -->

<?php include "includes/adminNavigation.php";?>
<?php
  
        if(isset($_SESSION['username'])){
            
            $username = $_SESSION['username'];
            
            $query = "SELECT * FROM user WHERE username = '{$username}' ";
            
                $selectQuery = mysqli_query($conn, $query);
            
            while($row = mysqli_fetch_array($selectQuery)){
                
                        $userId = $row['id'];
                        $userName = $row['username'];
                        $userPassword = $row['password'];
                        $userFirstname = $row['firstname'];
                        $userLastname = $row['lastname'];
                        $userEmail = $row['email'];
                        $userImage = $row['image'];
            }
        


            if(isset($_POST['edit_user'])){

                $userFirstname = $_POST['firstname'];
                $userLastname = $_POST['lastname'];
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
                        }
                                $query = "UPDATE user SET ";
                                $query .="firstname = '{$userFirstname}', ";
                                $query .="lastname = '{$userLastname}', ";
                                $query .="username = '{$username}', ";
                                $query .="email = '{$userEmail}', ";
                                $query .="password = '{$hashedPassword}' ";
                                $query .= "WHERE id = {$userId} ";


                            $updateUser = mysqli_query($conn, $query);

                            check($updateUser);
                        

        }

    }
                      
    }
        

?>
       
        <div id="page-wrapper">
                <!-- Page Heading -->
                      <h1 class="page-header">

                         Welcome to admin
                          <small><?php echo $_SESSION['username']; ?></small>
                       </h1>
                       <?php
                          if(isset($_POST['edit_user'])){
                          echo "User Updated" ." ". "<a class='btn btn-primary' href='users.php'>View Users</a>";

                          }
                          
                          ?>
  
                        <form action="#" method="POST" enctype="multipart/form-data">
   
   <div class="form-group">
       <label for="post_author">Firstname</label>
       <input type="text" value="<?php echo $userFirstname; ?>" class="form-control" name="firstname">
   </div>
    
   <div class="form-group">
       <label for="post_status">Lastname</label>
       <input type="text" value="<?php echo $userLastname; ?>" class="form-control" name="lastname">
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
      <input type="submit" class="btn btn-primary" name="edit_user" value="Update User Profile">
   </div>

</form>

  

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/adminFooter.php";?>