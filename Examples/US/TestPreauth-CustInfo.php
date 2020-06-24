<?php

use Moneris\mpgCustInfo;
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

/************************ Transaction Array **********************************/

$txnArray = array(
	type => 'preauth',
	order_id => $orderid,
	cust_id => 'cust',
	amount => $amount,
	pan => $pan,
	expdate => $expdate,
	crypt_type => '7'
);

/************************ CustInfo Object **********************************/

$mpgCustInfo = new mpgCustInfo();

/********************* Set E-mail and Instructions **************/

$email = 'Joe@widgets.com';
$mpgCustInfo->setEmail($email);

$instructions = "Make it fast";
$mpgCustInfo->setInstructions($instructions);

/********************* Create Billing Array and set it **********/

$billing = array(
	first_name => 'Joe',
	last_name => 'Thompson',
	company_name => 'Widget Company Inc.',
	address => '111 Bolts Ave.',
	city => 'Toronto',
	province => 'Ontario',
	postal_code => 'M8T 1T8',
	country => 'Canada',
	phone_number => '416-555-5555',
	fax => '416-555-5555',
	tax1 => '123.45',
	tax2 => '12.34',
	tax3 => '15.45',
	shipping_cost => '456.23'
);

$mpgCustInfo->setBilling($billing);

/********************* Create Shipping Array and set it **********/

$shipping = array(
	first_name => 'Joe',
	last_name => 'Thompson',
	company_name => 'Widget Company Inc.',
	address => '111 Bolts Ave.',
	city => 'Toronto',
	province => 'Ontario',
	postal_code => 'M8T 1T8',
	country => 'Canada',
	phone_number => '416-555-5555',
	fax => '416-555-5555'
);

$mpgCustInfo->setShipping($shipping);

/********************* Create Item Arrays and set them **********/

$item1 = array(
	name => 'item 1 name',
	quantity => '53',
	product_code => 'item 1 product code',
	extended_amount => '1.00'
);

$mpgCustInfo->setItems($item1);

$item2 = array(
	name => 'item 2 name',
	quantity => '53',
	product_code => 'item 2 product code',
	extended_amount => '1.00'
);

$mpgCustInfo->setItems($item2);

/************************ Transaction Object *******************************/

$mpgTxn = new mpgTransaction($txnArray);

/************************ Set CustInfo *************************************/

$mpgTxn->setCustInfo($mpgCustInfo);

/************************ Request Object **********************************/

$mpgRequest = new mpgRequest($mpgTxn);
$mpgRequest->setProcCountryCode("US"); //"CA" for sending transaction to Canadian environment
$mpgRequest->setTestMode(true); //false or comment out this line for production transactions

/************************ mpgHttpsPost Object ******************************/

$mpgHttpPost = new mpgHttpsPost($store_id, $api_token, $mpgRequest);

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


