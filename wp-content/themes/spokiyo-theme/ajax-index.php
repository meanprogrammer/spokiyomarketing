<?php
/**
 * The ajax gateway for consultant
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Spokiyo_Theme
 * @since January 2014
 */

//get_header(); ?>


<?php
/*
	Template Name: ConsultantAjaxIndexTemplate
*/
/*
 	Contact = User
 */
?>

<?php 
$fullpath = get_template_directory()."/codes/zohocontact.php";
include $fullpath;

$zc = new zohocontact();

$method = $_POST['method'];
$id = $_POST['id'];
$shouldReloadUser = false;
switch ($method) {
	case 'loadcontacts':
		$result = $zc->getContactData($id);
		echo json_encode($result);
		break;
	case 'loadbankaccount':
		$bankAccountId = $_POST['bankAccountId'];
		$result = $zc->getBankAccountById($id, $bankAccountId);
		echo json_encode($result);
		break;
	case 'loadconsultingpreference':
		$result = $zc->getConsultingPreference($id);
		echo json_encode($result);
		break;
	case 'loadexperience':
		$experienceId = $_POST['experienceId'];
		$result = $zc->getExperienceById($id, $experienceId);
		echo json_encode($result);
		break;
	case 'loadeducation':
		$educationId = $_POST['educationId'];
		$result = $zc->getEducationById($id, $educationId);
		echo json_encode($result);
		break;
	case 'loginuseraccount':
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$json = $zc->getUserAccountByCredentials($username, $password); 

	 	if($json != null) {
	 		session_start();
	 		$_SESSION['logged_user'] = $json;
	 		echo 'authenticated';
	 	} else {
	 		echo 'failed';
	 	}
		break;	
	case 'updateuseraccountbio':
		$bio = $_POST['bio'];
		$result = $zc->updateUserAccountBio($id, $bio);
		$shouldReloadUser = true;
		echo json_encode($result);
		break;
	case 'updatefinancialinfo':
		$description = $_POST['description'];
		$bankName = $_POST['bankName'];
		$bankAccountNumber = $_POST['bankAccountNumber'];
		$creditCard = $_POST['creditCard'];
		$creditCardType = $_POST['creditCardType'];
		$creditCardNumber = $_POST['creditCardNumber'];
		$bankAccountId = $_POST['bankAccountId'];
		$result = $zc->saveUserAccountBankAccount($id, $description, $bankName, $bankAccountNumber,
					 $creditCard, $creditCardType, $creditCardNumber, $bankAccountId);
		$shouldReloadUser = true;
		echo json_encode($result);
		break;	
	case 'updateeducation':
		$school = $_POST['school'];
		$qualification = $_POST['qualification'];
		$field = $_POST['field'];
		$grade = $_POST['grade'];
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$educationId = $_POST['educationId']; 
		$result = $zc->saveUserAccountEducation($id, $school, $qualification, $field,
				 $grade, $startDate, $endDate, $educationId);
		$shouldReloadUser = true;
		echo json_encode($result);
		break;
	case 'updatepersonal':
		$maritalstatus = $_POST['maritalStatus'];
		$birthdate = $_POST['dateOfBirth'];
		$result = $zc->updateUserAccountPersonalDetails($id, $maritalstatus, $birthdate);
		$shouldReloadUser = true;
		echo json_encode($result);
		break;
	case 'updateconsultingpref':
		$availability = $_POST['availability'];
		$rate = $_POST['rate'];
		$typeofwork = $_POST['typeofwork'];
		$workshift = $_POST['workshift'];
		$result = $zc->updateConsultingPreference($id, $availability, $rate, $typeofwork, $workshift);
		$shouldReloadUser = true;
		echo json_encode($result);
		break;
	case 'updateexperience':
		$company = $_POST['company'];
		$role = $_POST['role'];
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$experienceId = $_POST['experienceId'];
		$result = $zc->saveUserAccountEmploymentHistory($id, $company, $role, $startDate, $endDate, $experienceId);
		$shouldReloadUser = true;
		echo json_encode($result);
		break;
	case 'updateaddress':
		$type = $_POST['addresstype'];
		$country = $_POST['addresscountry'];
		$province = $_POST['province'];
		$city = $_POST['city'];
		$streetaddress = $_POST['streetaddress'];
		$zipcode = $_POST['zipcode'];
		$result = $zc->saveUserAccountAddress($id, $type, $country, $province, $city, $streetaddress, $zipcode);
		$shouldReloadUser = true;
		echo json_encode( $result );
		break;
	case 'updatephonenumber':
		$type = $_POST['phonetype'];
		$countryCode = $_POST['countrycode'];
		$areaCode = $_POST['areacode'];
		$phoneNumber = $_POST['phonenumber'];
		$result = $zc->saveUserAccountPhoneNumber($id, $type, $countryCode, $areaCode, $phoneNumber);
		$shouldReloadUser = true;
		echo json_encode( $result );
		break;
	case 'updateimhandles':
		$type = $_POST['imtype'];
		$handle = $_POST['imhandle'];
		$result = $zc->saveUserAccountIMHandle($id, $type, $handle);
		$shouldReloadUser = true;
		echo json_encode( $result );
		break;
	case 'updatesocialmedia':
		$type = $_POST['smtype'];
		$accountId = $_POST['accountId'];
		$result = $zc->saveUserAccountSocialMedia($id, $type, $accountId);
		$shouldReloadUser = true;
		echo json_encode( $result );
		break;
}

if($shouldReloadUser) {
	session_start();
	$_SESSION['logged_user'] = $zc->getUserAccountById($id);
}