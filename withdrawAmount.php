<?php
// include the file from connection.php that has db connections

include "./connection.php";
$data=json_decode(file_get_contents('php://input'));

//assoc array response with default failure 
$response = [
    'resultCode'=>200,
    'message'=>'Amount deposited failure ',
    'resultMessage'=>'failure',
    'data'=>[
    ]
    ];
    //set a initial value for currentBalance and finalAmount

$currentBalance = 0;
$finalAmount = 0;
//connect to sql

$connection = sqlConnection();

//insert query from transaction_history table

$query="INSERT INTO transaction_history(accountno,type,date,amount) VALUES(" .$data->accountno . "," . "'". 'deposit' . "'" . "," . "'".date('Y-m-d h:i:s')."'" . "," .$data->amount. ")";

//execute the query if it is true

if($connection->query($query) === true)
{

//get the currentBalance from user table accountno

$query = "select currentBalance from user
WHERE id = $data->accountno";
$result = $connection->query($query);

//check if the result of the row has more than 0 row

if($result->num_rows>0){ 

//while loop iterates each row in the result

    while($row=$result->fetch_assoc()){
        $currentBalance=$row['currentBalance'];
    }
    if($data->amount <= $currentBalance){

// to find the finalAmount add currentBalance and depositAmount 

$finalAmount=$currentBalance-$data->amount; 

//update user table with currentBalance

$query="update user set currentBalance=$finalAmount WHERE id=$data->accountno";

//execute the update query

$updateResult=$connection->query($query);

//check if the result of the update query is equal to 1

if($updateResult==1){

    // display the success msg if it is true

    $response = [
        'resultCode'=>200,
        'message'=>'Amount deposited successfully ',
        'resultMessage'=>'success',
        'data'=>[
            'currentBalance'=>$finalAmount
        ]
        ];
}
}
}
}else{
    $response = [
        'resultCode'=>200,
        'message'=>'Insufficient balance',
        'resultMessage'=>'failure',
        'data'=>[
        ]
        ];
}
//echo is used to display the output
echo json_encode($response);
?>

