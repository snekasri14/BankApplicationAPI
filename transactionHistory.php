<?php
//include the file from connection.php that has db connections
include "./connection.php";
$data = json_decode(file_get_contents('php://input'));
// connect to sql
$connection = sqlConnection();
// select all records from transaction_history table
$query = "select * from transaction_history";
$transactionHistory=[];
//to check whether the connection is true use if 
if($connection->query($query) == true){
    $result=$connection->query($query);
    //Check if records available in transaction_history
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        //while loop iterates each row in the result
        
             while($row=$result->fetch_assoc()){
                //array_push adds one or more elements to the end of an array
                array_push($transactionHistory,$row);
                print_r($transactionHistory);
             }
            
        }
}
//echo is used to display the output
echo json_encode($data);
?>