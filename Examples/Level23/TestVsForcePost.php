<?php

use Moneris\mpgHttpsPost;
use Moneris\mpgRequest;
use Moneris\mpgTransaction;

/**************************** Request Variables *******************************/

$store_id = 'moneris';
$api_token = 'hurgle';
//$status = 'false';

/************************* Transactional Variables ****************************/

$type = 'vsforcepost';
$cust_id = 'CUST13343';
$order_id = 'ord-' . date("dmy-G:i:s");
$amount = '5.00';
$pan = '4242424254545454';
$expiry_date = '2012';
$auth_code = '123456';
$crypt = '7';
$national_tax = "1.23";
$merchant_vat_no = "gstno111";
$local_tax = "2.34";
$customer_vat_no = "gstno999";
$cri = "CUST-REF-002";
$customerCode = "ccvsfp";
$invoiceNumber = "invsfp";
$local_tax_no = "ltaxno";

/*********************** Transactional Associative Array **********************/

$txnArray = array(
	'type' => $type,
	'order_id' => $order_id,
	'amount' => $amount,
	'pan' => $pan,
	'expdate' => $expiry_date,
	'auth_code' => $auth_code,
	'crypt_type' => $crypt,
	'national_tax' => $national_tax,
	'merchant_vat_no' => $merchant_vat_no,
	'local_tax' => $local_tax,
	'customer_vat_no' => $customer_vat_no,
	'cri' => $cri,
	'local_tax_no' => $local_tax_no
);

/**************************** Transaction Object *****************************/

$mpgTxn = new mpgTransaction($txnArray);

/****************************** Request Object *******************************/

$mpgRequest = new mpgRequest($mpgTxn);
$mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
$mpgRequest->setTestMode(true); //false or comment out this line for production transactions

/***************************** HTTPS Post Object *****************************/

$mpgHttpPost = new mpgHttpsPost($store_id, $api_token, $mpgRequest);

//Status check example
//$mpgHttpPost = new mpgHttpsPostStatus($store_id,$api_token,$status,$mpgRequest);

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
print("\nAuthCode = " . $mpgResponse->getAuthCode());
print("\nComplete = " . $mpgResponse->getComplete());
print("\nTransDate = " . $mpgResponse->getTransDate());
print("\nTransTime = " . $mpgResponse->getTransTime());
print("\nTicket = " . $mpgResponse->getTicket());
print("\nTimedOut = " . $mpgResponse->getTimedOut());
//print("\nStatusCode = " . $mpgResponse->getStatusCode());
//print("\nStatusMessage = " . $mpgResponse->getStatusMessage());



