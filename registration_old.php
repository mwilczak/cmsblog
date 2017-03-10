?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


   <?php  // WYMAGA W TABELI USER KOLUMNY randSalt o domyślnej nazwie $2y$10$ iusesomecrazystrings22 ->dowolny string o długości 22 znaków
    if(isset($_POST['submit'])){
        
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if(!empty($username) && !empty($email) && !empty($password)) {
            
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
        
        $query = "SELECT randSalt FROM user";
        $selectRandSaltQuery = mysqli_query($conn, $query);
        
        if(!$selectRandSaltQuery) {
            
            die ('Query Failed' . mysqli_error($conn));
        }

       while ($row = mysqli_fetch_array($selectRandSaltQuery)){
            
            $salt = $row['randSalt'];
       }     
          $password = crypt($password, $salt);
            
        $query = "INSERT INTO user (username, email, password, role) ";
        $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber')";
        $registerUserQuery = mysqli_query($conn, $query);
            
            if(!$registerUserQuery) {
                
                die ('Query Filed' . ' ' . mysqli_error($conn) .' '. mysqli_errno($conn));
            }
            
        $message = 'Rejestracja potwierdzona';
     
        }else {
            
        $message = 'Pola nie mogą być puste';
        }

    } else {
        $message = '';
    }


?>
   

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                <h6 class="text-center"><?php echo $message;?></h6>   
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="example@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
