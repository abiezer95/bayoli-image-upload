<?php 

require '../start.php';

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\Details;
use PayPal\Exception\PayPalConnectionException;
// use PayPal\Rest\ApiContext;
// Use PayPal\Auth\OAuthTokenCredential;


// if(!isset($_GET['product'], $_GET['price'])){
//     die();
// }

// $clientId = 'AX_1xQYZ9u7R-HeoARZvtuOyenwccS8EcalKvENSEbihWcRB4WBDoYONIG2Gc7oEXNe_SafXKhOxiFDq';
// $clientId = 'AYc9Gm7IpBs3USn5vuIxDdHDMVA8qkzcCeQtyt4pw7LF6bLrlX80QvnX3P7k6MyQeNE3ib7QC2PWgqzz';
// $clientSecret = 'EDSX-5H0eHmNZnxMkiUnTEzUhzwHpUC6q7g75IsLF_yF1Flvoc7Z3rcWlfNm2SQQ7hhPOl50OAWTMhJB';
// $clientSecret = 'ECnbNOVzqdC-gv4_sbMPWjWUqIda731fdloVih8Q3VcGivRqLf3GvE3_7r3XX8ijk6OeWHow6n6o1mct';

// $apiContext = new ApiContext(
// new OAuthTokenCredential(
//     $clientId,
//     $clientSecret
// ));

// $apiContext->setConfig(
//       array(
//         'log.LogEnabled' => false,
//         // 'log.FileName' => 'PayPal.log',
//         // 'log.LogLevel' => 'DEBUG',
//         'mode' => 'live'
//       )
// );

$product = 'Picture and Prints';
// $price = 65;
$tax = 0.00;

$total = $price + $tax;

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item = new Item();
$item->setName($product)
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setPrice($price);

$itemList = new ItemList();
$itemList->setItems([$item]);

$details = new Details();
$details->setSubtotal($price)
        ->setTax($tax);

$amount = new Amount();
$amount->setCurrency('USD')
    ->setTotal($total)
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('this is a test abiezer')
            ->setInvoiceNumber(uniqid());

$baseUrl = "http://www.bayoli.tk/upload-prints/composer/";
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("$baseUrl/pay.php?success=true&id=$id_order")
             ->setCancelUrl("$baseUrl/pay.php?success=false");

$payment = new Payment();
$payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);

try{

$payment->create($apiContext);

}
catch(PayPalConnectionException $ex){
    $data = json_decode($e->getData());
    // print_r($data);
    echo $data->message;
    die();
}

$approvalUral = $payment->getApprovalLink();

header("Location: {$approvalUral}");