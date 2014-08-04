<?php
die;
/**
 * The template for adding zoho crm contact
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Spokiyo_Theme
 * @since January 2014
 */

get_header(); ?>


<?php
/*
	TemplateName: 
*/
?>


<?php

$accountowner = $_POST['accountowner'];
$phone = $_POST['phone'];
$accountnumber = $_POST['accountnumber'];
$fax = $_POST['fax'];
$accountname = $_POST['accountname'];
$website = $_POST['website'];
$parentaccount = $_POST['parentaccount'];
$industry = $_POST['industry'];
$accountsite = $_POST['accountsite'];
$ownership = $_POST['ownership'];

$accounttype = $_POST['accounttype'];
$annualrevenue = $_POST['annualrevenue'];
$facebook = $_POST['facebook'];
$linkedin = $_POST['linkedin'];
$billingstreet = $_POST['billingstreet'];
$shippingstreet = $_POST['shippingstreet'];
$billingcity = $_POST['billingcity'];
$shippingcity = $_POST['shippingcity'];
$billingstate = $_POST['billingstate'];
$shippingstate = $_POST['shippingstate'];

$billingcode = $_POST['billingcode'];
$shippingcode = $_POST['shippingcode'];
$billingcountry = $_POST['billingcountry'];
$shippingcountry = $_POST['shippingcountry'];
$bankname = $_POST['bankname'];
$bankaccountno = $_POST['bankaccountno'];
$creditcard = $_POST['creditcard'];
$creditcardno = $_POST['creditcardno'];
$debitcard = $_POST['debitcard'];
$debitcardno = $_POST['debitcardno'];
$description = $_POST['description'];

$data = array(
	'accountowner' => $accountowner,
	'phone' => $phone,
	'accountnumber' => $accountnumber,
	'fax' => $fax,
	'accountname' => $accountname,
	'website' => $website,
	'parentaccount' => $parentaccount,
	'industry' => $industry,
	'accountsite' => $accountsite,
	'ownership' => $ownership,
	'accounttype' => $accounttype,
	'annualrevenue' => $annualrevenue,
	'facebook' => $facebook,
	'linkedin' => $linkedin,
	'billingstreet' => $billingstreet,
	'shippingstreet' => $shippingstreet,
	'billingcity' => $billingcity,
	'shippingcity' => $shippingcity,
	'billingstate' => $billingstate,
	'shippingstate' => $shippingstate,
	'billingcode' => $billingcode,
	'shippingcode' => $shippingcode,
	'billingcountry' => $billingcountry,
	'shippingcountry' => $shippingcountry,
	'bankname' => $bankname,
	'bankaccountno' => $bankaccountno,
	'creditcard' => $creditcard,
	'creditcardno' => $creditcardno,
	'debitcard' => $debitcard,
	'debitcardno' => $debitcardno,
	'description' => $description
);


?>