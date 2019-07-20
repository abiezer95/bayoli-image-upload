<?php

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

require '../database/definitions.php';
require 'start.php';

if(!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'], $_GET['id'])){
$baseUrl = "http://www.bayoli.tk/upload-prints/?payment=0etw0&id=".$_GET['id'];
header("Location: $baseUrl");
 die();
}

if((bool)$_GET['success'] === false){
    die();
}

$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

$payment = Payment::get($paymentId, $apiContext);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try{
    $result = $payment->execute($execute, $apiContext);
    update('order_print', [
        'pay_status' => true
    ], [
        'id' => $_GET['id']
    ]);
    $baseUrl = "http://www.bayoli.tk/upload-prints/?payment=true1&id=".$_GET['id']."&pay=true%26pay%3D1%26dont%20hesitate%20to%20contact%20us";
    header("Location: $baseUrl");
}
catch(Exection $e){
    $data = json_decode($e->getData());
    // print_r($data);
    echo $data->message;
    die();
}
