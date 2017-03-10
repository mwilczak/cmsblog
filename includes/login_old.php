<?php include "db.php"; ?>
<?php session_start(); ?>

<?php 

if(isset($_POST['login'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    
    
    $query = "SELECT * FROM user WHERE username = '{$username}' ";
        
        $selectUser = mysqli_query($conn, $query);
    
        if(!$selectUser){
            
            die("Query Failed" . " " . mysqli_error($conn));
            
            
        }
    
    
    
    while ($row = mysqli_fetch_array($selectUser)) {
        
             $dbId = $row['id'];
             $dbUsername = $row['username'];
             $dbPassword = $row['password'];
             $dbFirstname = $row['firstname'];
             $dbLastname = $row['lastname'];
             $dbRole = $row['role'];
        
    }
    
    $password = crypt($password, $dbPassword);

    
    if($username === $dbUsername && $password === $dbPassword) {
        $_SESSION['username'] = $dbUsername;
        $_SESSION['firstname'] = $dbFirstname;
        $_SESSION['lastname'] = $dbLastname;
        $_SESSION['role'] = $dbRole;
        $_SESSION['password'] = $dbPassword;
        
        header("Location: ../admin");

    } else {
        header("Location: ../index.php");

    }
    
}




?>