<?php

use Moneris\mpgHttpsPost;
use Moneris\mpgRequest;
use Moneris\mpgTransaction;

/************************ Request Variables **********************************/

$store_id = 'monusqa002';
$api_token = 'qatoken';

/************************ Transaction Variables ******************************/

$orderid = 'ord-' . date("dmy-G:i:s");
$amount = '1.00';
$pan = "4242424242424242";
$expdate = "1111";
$dynamic_descriptor = 'test';

/************************ Transaction Array **********************************/

$txnArray = array(
    type => 'preauth',
    order_id => $orderid,
    cust_id => 'cust',
    amount => $amount,
    pan => $pan,
    expdate => $expdate,
    crypt_type => '7',
    dynamic_descriptor => $dynamic_descriptor
);

/************************ Transaction Object *******************************/

$mpgTxn = new mpgTransaction($txnArray);

/************************ Request Object **********************************/

$mpgRequest = new mpgRequest($mpgTxn);
$mpgRequest->setProcCountryCode("US"); //"CA" for sending transaction to Canadian environment
$mpgRequest->setTestMode(true); //false or comment out this line for production transactions

/************************ mpgHttpsPost Object ******************************/

$mpgHttpPost = new mpgHttpsPost($store_id, $api_token, $mpgRequest);

//Status check example
//$mpgHttpPost = new mpgHttpsPostStatus($store_id,$api_token,$status,$mpgRequest);

/************************ Response Object **********************************/

$mpgResponse = $mpgHttpPost->getMpgResponse();


print("\nCardType = " . $mpgResponse->getCardType());
print("\nTransAmount = " . $mpgResponse->getTransAmount());
print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
print("\nReceiptId = " . $mpgResponse->getReceiptId());
print("\nTransType = " . $mpgResponse->getTransType());
print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
print("\nResponseCode = " . $mpgResponse->getResponseCode());
print("\nMessage = " . $mpgResponse->getMessage());
print("\nAuthCode = " . $mpgResponse->getAuthCode());
print("\nComplete = " . $mpgResponse->getComplete());
print("\nTransDate = " . $mpgResponse->getTransDate());
print("\nTransTime = " . $mpgResponse->getTransTime());
print("\nTimedOut = " . $mpgResponse->getTimedOut());
//print("\nStatusCode = " . $mpgResponse->getStatusCode());
//print("\nStatusMessage = " . $mpgResponse->getStatusMessage());


