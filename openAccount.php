<?php
//include the file from connection.php that has db connections
include "./connection.php";
$data = json_decode(file_get_contents('php://input'));
// connect to sql
$connection = sqlConnection();
// insert query from user table
$query = "INSERT INTO user (name,phonenumber,age,address) VALUES (" . "'".$data->username."'" . "," ."'".$data->phno."'" ."," . $data->age . "," . "'".$data->address."'" .")";
//to check whether the connection is true use if condition
if($connection->query($query) == true){
    $accountID = mysqli_insert_id($connection);
    //if the query execution is success display  success msg
    $data = [
        "resultCode" => "B001",
        "message" => "Account Created Successfully",
        "resultMessage" => 'success',
        "data" => [
            "AccountNumber" => $accountID
        ]
        ];
}
//if the query execution is failed display failure msg 
else{
    $data = [
        "resultCode" => "200",
        "message" => "Account Creation failed",
        "resultMessage" => 'failure',
        "data" => []
    ];
}
//echo is used to display the output
echo json_encode($data);
?>