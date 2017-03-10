<?php include "db.php"; ?>
<?php  include "../admin/functions.php"; ?>

<?php session_start(); ?>

<?php 

if(isset($_POST['login'])){
    
       loginUser($_POST['username'], $_POST['password']);
        header("Location: ../index.php");
} else {
        header("Location: ../index.php");

}
    




?>