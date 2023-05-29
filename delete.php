<?php
// include the file from connection.php that has db connections
include "./connection.php";
$data=json_decode(file_get_contents('php://input'));
//assoc array response with default failure 
$response=[
    'resultCode'=>200,
    'message'=>'account deletion failed ',
    'resultMessage'=>'failure',
    'data'=>[
    ]
    ];
    //set a initial value for currentbalance and finalAmount
$currentbalance=0;
$finalAmount=0;
//connect to sql
$connection=sqlConnection();
//assume user table as query and delete the records
$query="delete from user WHERE id=$data->accountno";
//assume transaction_history table as query 2 and delete the records
$query1="delete from transaction_history WHERE id=$data->accountno";
//execute the query if it is true
if($connection->query($query)=== true)
{

    $response=[
        'resultCode'=>200,
        'message'=>'account deletion successfully in user table ',
        'resultMessage'=>'success',
        'data'=>[
            'currentBalance'=>$finalAmount
        ]
        ];
}
else{
    $response=[
        'resultCode'=>200,
        'message'=>'account deletion failed in user table ',
        'resultMessage'=>'success',
        'data'=>[
            'currentBalance'=>$finalAmount
        ]
        ];

}
//execute query1 if it is true
if($connection->query($query1)=== true)
{
// if the account deletion is successfully deleted display the msg
    $response=[
        'resultCode'=>200,
        'message'=>'account deletion successfully in transaction_history table ',
        'resultMessage'=>'success',
        'data'=>[
            'currentBalance'=>$finalAmount
        ]
        ];
}
else{
    $response=[
        'resultCode'=>200,
        'message'=>'account deletion failed in transaction_history table ',
        'resultMessage'=>'success',
        'data'=>[
            'currentBalance'=>$finalAmount
        ]
        ];

}

//
//echo is used to display the output
echo json_encode($response);
?>

