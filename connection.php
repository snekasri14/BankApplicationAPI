<?php
function sqlConnection (){
    $Servername = "localhost";
    $Username= "root";
    $Password= "";
    $database = 'Bank';
    $conn = mysqli_connect($Servername,$Username,$Password,$database);
    if($conn->connect_error) {
        die("connection failed:".$conn->connect_error);
    }
    return $conn;
}

?>
