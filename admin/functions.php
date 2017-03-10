<?php

function escape($string) {
    
    global $conn;
    return mysqli_real_escape_string($conn, trim($string));
 
}

function users_online() {
    
    if(isset($_GET['onlineresults'])){
        
        global $conn;
        
        if(!$conn) {
            session_start();
            include("../includes/db.php");
            
            
        $session = session_id();
        $time = time();
        $timeOutSeconds = 05;
        $timeOut = $time - $timeOutSeconds;
        
        $query = "SELECT * FROM users_online WHERE session = '$session' ";
        $sendQuery = mysqli_query($conn, $query);
        $count = mysqli_num_rows($sendQuery);
        
        if($count == NULL) {
            
            mysqli_query($conn, "INSERT INTO users_online(session, time) VALUES ('$session','$time')");
        }else {
            
            mysqli_query($conn, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

        }
            $userOnlineQuery = mysqli_query($conn, "SELECT * FROM users_online WHERE time > '$timeOut'");
            echo $countUsers = mysqli_num_rows($userOnlineQuery); 
            
        }

    } // get request isset
}
users_online();

function check($result) {
        global $conn;
        if (!$result) {

        die("QUERY FAILED" ." ".  mysqli_error($conn));

    }
}


function insertCategories() {
    
            global $conn;
    
            if(isset($_POST['submit']))  {

            $catTitle = $_POST['cat_title'];

            if($catTitle == "" || empty($catTitle)) {

                echo "This field cannot be empty";

            }else{

                $stmt = mysqli_prepare($conn,"INSERT INTO category(cat_title) VALUES (?) ");

                mysqli_stmt_bind_param($stmt, "s", $catTitle);
                mysqli_stmt_execute($stmt);
                
                
                if(!$stmt) {

                    die('Query Filed' . mysqli_error($conn));
                }
          }
                mysqli_stmt_close($stmt);

     }                     
}

function findAllCategories() {
    
        global $conn;

        $query = "SELECT * FROM category";
        $selectCategoires = mysqli_query($conn, $query);


        while ($row = mysqli_fetch_assoc($selectCategoires)){
        $catId = $row['id'];
        $catTitle = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$catId}</td>";
        echo "<td>{$catTitle}</td>";
        echo "<td><a href='categories.php?delete={$catId}'>DELETE</a></td>";
        echo "<td><a href='categories.php?edit={$catId}'>EDIT</a></td>";
        echo "</tr>";

         }

}

function deleteCategories() {
    
    global $conn;
    if(isset($_GET['delete'])) {

    $deleteCat = $_GET['delete'];

    $query = "DELETE FROM category WHERE id= {$deleteCat} ";
    $deleteQuery = mysqli_query($conn, $query);

    header("Location: categories.php"); 

    }
   
}

function isAdmin($username) {
    global $conn;
    $query = "SELECT role FROM user WHERE username = '{$username}' ";
    
    $result = mysqli_query($conn, $query);
    
    check($result);
    
    $row = mysqli_fetch_array($result);
    
    if($row['role'] == 'admin') {
        return true;
    }else {
        return false;
    }
    
}

function checkUsername($username) {
    
    global $conn;
    
    $query = "SELECT username FROM user WHERE username = '{$username}' ";
    $result = mysqli_query($conn, $query);
    
    check($result);
    
    if(mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }
}

function checkEmail($email) {
    
    global $conn;
    
    $query = "SELECT email FROM user WHERE email = '{$email}' ";
    $result = mysqli_query($conn, $query);
    
    check($result);
    
    if(mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }
}

function redirect($location) {
    return("Location:" . $location);
}


function registerUser ($username, $email, $password) {

        global $conn;

        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
            
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));   
        
            
        $query = "INSERT INTO user (username, email, password, role) ";
        $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber')";
        $registerUserQuery = mysqli_query($conn, $query);
            
           check($registerUserQuery);

}

function loginUser($username, $password) {
    global $conn;

    $username = trim($username);
    $password = trim($password);
    
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    
    
    $query = "SELECT * FROM user WHERE username = '{$username}' ";
        
        $selectUser = mysqli_query($conn, $query);
    
    check($selectUser);
    
    while ($row = mysqli_fetch_array($selectUser)) {
        
             $dbId = $row['id'];
             $dbUsername = $row['username'];
             $dbPassword = $row['password'];
             $dbFirstname = $row['firstname'];
             $dbLastname = $row['lastname'];
             $dbRole = $row['role'];
        
    }

    if(password_verify($password, $dbPassword)) {
        $_SESSION['username'] = $dbUsername;
        $_SESSION['firstname'] = $dbFirstname;
        $_SESSION['lastname'] = $dbLastname;
        $_SESSION['role'] = $dbRole;
        $_SESSION['password'] = $dbPassword;
        
        header("Location: ../cms/admin");
//            redirect("/cms/admin/index.php");

    }else {
        header("Location: ../cms/index.php");
//                redirect("/cms/index.php");

    }
}
//funkcja do zastosowania w viewsAllPost refakturacja kodu
//function recordQuery($table) {
//    global $conn;
//    $query = "SELECT * FROM " . $table;
//    $selectAllPost = mysqli_query($conn, $query);
//    $result = mysqli_num_rows($selectAllPost);
//    
//    check($result);
//    
//    return $result;
//    
//}

//function checkStatus($table, $column, $status) {
//    global $conn;
//    $query = "SELECT * FROM $table WHERE $column = '$status' ";
//    $result = mysqli_query($conn, $query);
//    
//    check($result);
//        
//    return mysqli_num_rows($result);
//}
//
//function checkUserRole ($table, $column, $role) {
//    global $conn;
//    $query = "SELECT * FROM $table WHERE $column = '$role' ";
//    $result = mysqli_query($conn, $query);
//    
//    check($result);
//    return mysqli_num_rows($result);
//
//}

//function UnApprove() {
//    global $conn;
//    if(isset($_GET['unapprove'])) {
//        $theCommentId = $_GET['unapprove'];
//        
//        $query = "UPDATE comment SET comment_status = 'unapproved' WHERE id = $theComentId ";
//        $unapprovedCommentQuery = mysqli_query($conn, $query);
//        header("Location: comments.php");
//        
//    }
//}

?>