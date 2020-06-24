<?php

##
## Example php -q TestPurchase.php store1
##

use Moneris\mpgHttpsPost;
use Moneris\mpgRequest;
use Moneris\mpgTransaction;

/**************************** Request Variables *******************************/

$store_id = 'store2';
$api_token = 'yesguy';

/************************* Transactional Variables ****************************/

$type = 'vdotme_refund';
$cust_id = 'cust id';
$order_id = 'ord-110515-16:01:19';
$txn_number = '721359-1_10';
$amount = '0.05';
$crypt = '7';
$dynamic_descriptor = '123';

/*********************** Transactional Associative Array **********************/

$txnArray = array(
	'type' => $type,
	'order_id' => $order_id,
	'txn_number' => $txn_number,
	'amount' => $amount,
	'crypt_type' => $crypt,
	'cust_id' => $cust_id,
	'dynamic_descriptor' => $dynamic_descriptor
);

/**************************** Transaction Object *****************************/

$mpgTxn = new mpgTransaction($txnArray);

/****************************** Request Object *******************************/

$mpgRequest = new mpgRequest($mpgTxn);
$mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
$mpgRequest->setTestMode(true); //false or comment out this line for production transactions

/***************************** HTTPS Post Object *****************************/

$mpgHttpPost = new mpgHttpsPost($store_id, $api_token, $mpgRequest);

/******************************* Response ************************************/

$mpgResponse = $mpgHttpPost->getMpgResponse();

print("\nCardType = " . $mpgResponse->getCardType());
print("\nTransAmount = " . $mpgResponse->getTransAmount());
print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
print("\nReceiptId = " . $mpgResponse->getReceiptId());
print("\nTransType = " . $mpgResponse->getTransType());
print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
print("\nResponseCode = " . $mpgResponse->getResponseCode());
print("\nISO = " . $mpgResponse->getISO());
print("\nMessage = " . $mpgResponse->getMessage());
print("\nIsVisaDebit = " . $mpgResponse->getIsVisaDebit());
print("\nAuthCode = " . $mpgResponse->getAuthCode());
print("\nComplete = " . $mpgResponse->getComplete());
print("\nTransDate = " . $mpgResponse->getTransDate());
print("\nTransTime = " . $mpgResponse->getTransTime());
print("\nTicket = " . $mpgResponse->getTicket());
print("\nTimedOut = " . $mpgResponse->getTimedOut());



