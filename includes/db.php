<?php ob_start();


$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = 'coderslab';
$db['db_name'] = 'cms';


foreach($db as $key => $value){
    
    define(strtoupper($key), $value);
}


$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//
//if($conn){
//    
//    echo "We are connected";
//}else {
//    echo "We have problem";
//}



?>
