<?php
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
	Template Name: ConsultantCreateHandlerTemplate
*/
/*
 	Contact = User
 */
?>

<?php
if($_POST['createhiddenflag'] !== 'create') {
	echo 'failed';
	exit;
} 

$fullpath = get_template_directory()."/codes/zohocontact.php";
include $fullpath;

$zc = new zohocontact();

$contactowner = $_POST['contactowner'];
$leadsource = $_POST['leadsource'];
$accountname = $_POST['accountname'];
$email = $_POST['email'];
$salutation = $_POST['salutation'];
$firstname = $_POST['firstname'];
$phone = $_POST['phone'];
$lastname = $_POST['lastname'];
$mobile = $_POST['mobile'];
$title = $_POST['title'];
$fax = $_POST['fax'];
$department = $_POST['department'];
$dateofbirth = $_POST['dateofbirth'];
$facebook = $_POST['facebook'];
$username = $_POST['username'];
$linkedin = $_POST['linkedin'];
$password = $_POST['password'];
$skypeid = $_POST['skypeid'];
$twitter = $_POST['twitter'];
$mailingstreet = $_POST['mailingstreet'];
$otherstreet = $_POST['otherstreet'];
$mailingcity = $_POST['mailingcity'];
$othercity = $_POST['othercity'];
$mailingstate = $_POST['mailingstate'];
$otherstate = $_POST['otherstate'];
$mailingzip = $_POST['mailingzip'];
$otherzip = $_POST['otherzip'];
$mailingcountry = $_POST['mailingcountry'];
$othercountry = $_POST['othercountry'];
$bankname = $_POST['bankname'];
$bankaccountno = $_POST['bankaccountno'];
$creditcard = $_POST['creditcard'];
$creditcardno = $_POST['creditcardno'];
$debitcard = $_POST['debitcard'];
$debitcardno = $_POST['debitcardno'];
$description = $_POST['description'];

$contact = array(
	'contactowner' => $contactowner,
	'leadsource' => $leadsource,
	'accountname' => $accountname,
	'email' => $email,
	'salutation' => $salutation,
	'firstname' => $firstname,
	'phone' => $phone,
	'lastname' => $lastname,
	'mobile' => $mobile,
	'title' => $title,
	'fax' => $fax,
	'department' => $department,
	'dateofbirth' => $dateofbirth,
	'facebook' => $facebook,
	'username' => $username,
	'linkedin' => $linkedin,
	'password' => $password,
	'skypeid' => $skypeid,
	'twitter' => $twitter,
	'mailingstreet' => $mailingstreet,
	'otherstreet' => $otherstreet,
	'mailingcity' => $mailingcity,
	'othercity' => $othercity,
	'mailingstate' => $mailingstate,
	'otherstate' => $otherstate,
	'mailingzip' => $mailingzip,
	'otherzip' => $otherzip,
	'mailingcountry' => $mailingcountry,
	'othercountry' => $othercountry,
	'bankname' => $bankname,
	'bankaccountno' => $bankaccountno,
	'creditcard' => $creditcard,
	'creditcardno' => $creditcardno,
	'debitcard' => $debitcard,
	'debitcardno' => $debitcardno,
	'description' => $description
);


$mongosaveresult = $zc->mongo_contact_save($contact);
if($mongosaveresult > 0) {
	//Save to zoho
	//$zc->zoho_contact_save($contact);
}

?>