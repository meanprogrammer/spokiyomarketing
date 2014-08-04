<?php
/**
 * The template for handling login
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
	Template Name: 
*/
?>

<?php
	
	$fullpath = get_template_directory()."/codes/zohocontact.php";
include $fullpath;

	$zc = new zohocontact();
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	$json = $zc->getUserAccountByCredentials($username, $password); 

 	if($json == null || !isset($json)){
 		header("Location: ".get_site_url()."/invalid-login");
 	} else {
 		session_start();
 		$_SESSION['logged_user'] = $json;
 		header("Location: ".get_site_url()."/consultant-detail");
 	}
	
	//echo $json;

	//if(count($json) > 0) {
	//	$user = null;
	//	foreach ($json as $value) {
	//		if($password === base64_decode($value['Password'])) {
	//			//FOUND
	//			$user = $value;
				
	//			session_start();
	//			$_SESSION['logged_user'] = $user;
	//			break;
	//		}
	//	}
	//}
	
	//var_dump( $json );
	
	//echo $username;
	//echo $password;
?>
<div><?php var_dump($json); die;?></div>
<div><?php echo $json['contactowner']; ?></div>
<div><?php echo $json['leadsource']; ?></div>
<div><?php echo $json['accountname']; ?></div>
<div><?php echo $json['email']; ?></div>
<div><?php echo $json['firstname']; ?></div>
<div><?php echo $json['phone']; ?></div>
<div><?php echo $json['lastname']; ?></div>
<div><?php echo $json['mobile']; ?></div>
<div><?php echo $json['title']; ?></div>
<div><?php echo $json['fax']; ?></div>
<div><?php echo $json['department']; ?></div>
<div><?php echo $json['dateofbirth']; ?></div>
<div><?php echo $json['facebook']; ?></div>
<div><?php echo $json['username']; ?></div>
<div><?php echo $json['linkedin']; ?></div>
<div><?php echo $json['password']; ?></div>
<div><?php echo $json['skypeid']; ?></div>
<div><?php echo $json['twitter']; ?></div>
<div><?php echo $json['mailingstreet']; ?></div>
<div><?php echo $json['otherstreet']; ?></div>
<div><?php echo $json['mailingcity']; ?></div>
<div><?php echo $json['othercity']; ?></div>
<div><?php echo $json['mailingstate']; ?></div>
<div><?php echo $json['otherstate']; ?></div>
<div><?php echo $json['mailingzip']; ?></div>
<div><?php echo $json['otherzip']; ?></div>
<div><?php echo $json['mailingcountry']; ?></div>
<div><?php echo $json['othercountry']; ?></div>
<div><?php echo $json['bankname']; ?></div>
<div><?php echo $json['bankaccountno']; ?></div>
<div><?php echo $json['creditcard']; ?></div>
<div><?php echo $json['creditcardno']; ?></div>
<div><?php echo $json['debitcard']; ?></div>
<div><?php echo $json['debitcardno']; ?></div>
<div><?php echo $json['description']; ?></div>