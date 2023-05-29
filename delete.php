<?php

// include the file from connection.php that has db connections

include "./connection.php";
$data = json_decode(file_get_contents('php://input'));

//assoc array response with default failure 

$response = [
    'resultCode'=> 200,
    'message'=>'account deletion failed ',
    'resultMessage'=>'failure',
    'data'=>[
    ]
    ];

    //set a initial value for currentBalance and finalAmount

$currentBalance = 0;
$finalAmount = 0;

//connect to sql

$connection = sqlConnection();

//assume the table name as as querydeleteUser and delete the records

$querydeleteUser = "delete from user WHERE id = $data->accountno";

//assume the table name as querydeleteTransaction and delete the records

$querydeleteTransaction = "delete from transaction_history WHERE id = $data->accountno";
//execute the query if it is true

if ($connection->query($querydeleteUser) === true)
{

    $response = [
        'resultCode'=>200,
        'message'=>'account deletion is successful in user table ',
        'resultMessage'=>'success',
        'data'=>[
            'currentBalance'=>$finalAmount
        ]
        ];
}
else{
    $response= [
        'resultCode'=>200,
        'message'=>'account deletion failed in user table ',
        'resultMessage'=>'success',
        'data'=>[
            'currentBalance'=>$finalAmount
        ]
        ];

}
//execute querydeleteTransaction if it is true

if($connection->query($querydeleteTransaction)=== true)

{
// if the account deletion is success then display the msg

    $response = [
        'resultCode'=>200,
        'message'=>'account deletion successfully in transaction_history table ',
        'resultMessage'=>'success',
        'data'=>[
            'currentBalance'=> $finalAmount
        ]
        ];
}
else{
    $response = [
        'resultCode'=>200,
        'message'=>'account deletion failed in transaction_history table ',
        'resultMessage'=>'success',
        'data'=>[
            'currentBalance'=> $finalAmount
        ]
        ];

}


//echo is used to display the output
echo json_encode($response);
?>

