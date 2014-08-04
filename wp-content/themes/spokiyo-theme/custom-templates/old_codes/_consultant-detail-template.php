<?php
/**
 * The template for user detail
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
/*
 	Contact = User
 */
?>

<?php
session_start();
$user = $_SESSION['logged_user'];
 
?>

<div class="container">
		<div></div>
		<div class="row">
			<div class="col-md-12">
				<h3>Contact Information</h3>
			</div>
		</div>
		<a href="edit-consultant" class="btn btn-default btn-sm" >Edit</a>
		<table class="table table-bordered table-striped">
			<tr>
				<td width="20%"><strong>Contact Owner:</strong></td>
				<td width="30%"><span><?php echo $user['contactowner']; ?></span></td>
				<td width="20%"><strong>Lead Source:</strong></td>
				<td width="30%"><span><?php echo $user['leadsource']; ?></span></td>
			</tr>
			<tr>
				<td width="20%"><strong>Account Name:</strong></td>
				<td width="30%"><span><?php echo $user['accountname']; ?></span></td>
				<td width="20%"><strong>Email:</strong></td>
				<td width="30%"><span><?php echo $user['email']; ?></span></td>
			</tr>
			<tr>
				<td width="20%"><strong>First Name:</strong></td>
				<td width="30%"><span><?php echo $user['firstname']; ?></span></td>
				<td width="20%"><strong>Phone:</strong></td>
				<td width="30%"><span><?php echo $user['phone']; ?></span></td>
			</tr>
			<tr>
				<td width="20%"><strong>Last Name:</strong></td>
				<td width="30%"><span><?php echo $user['lastname']; ?></span></td>
				<td width="20%"><strong>Mobile:</strong></td>
				<td width="30%"><span><?php echo $user['mobile']; ?></span></td>
			</tr>
			<tr>
				<td width="20%"><strong>Title:</strong></td>
				<td width="30%"><span><?php echo $user['title']; ?></span></td>
				<td width="20%"><strong>Fax:</strong></td>
				<td width="30%"><span><?php echo $user['fax']; ?></span></td>
			</tr>
			<tr>
				<td width="20%"><strong>Department:</strong></td>
				<td width="30%"><span><?php echo $user['department']; ?></span></td>
				<td width="20%"><strong>Date of Birth:</strong></td>
				<td width="30%"><span><?php echo $user['dateofbirth']; ?></span></td>
			</tr>
			<tr>
				<td width="20%"><strong>Facebook:</strong></td>
				<td width="30%"><span><?php echo $user['facebook']; ?></span></td>
				<td width="20%"><strong>Username:</strong></td>
				<td width="30%"><span><?php echo $user['username']; ?></span></td>
			</tr>
			<tr>
				<td width="20%"><strong>LinkedIn:</strong></td>
				<td width="30%"><span><?php echo $user['linkedin']; ?></span></td>
				<td width="20%"><strong>Password:</strong></td>
				<td width="30%"><span><?php echo $user['password']; ?></span></td>
			</tr>
			<tr>
				<td width="20%"><strong>Skype ID:</strong></td>
				<td colspan="3" width="80%"><span><?php echo $user['skypeid']; ?></span></td>
			</tr>
			<tr>
				<td width="20%"><strong>Twitter:</strong></td>
				<td colspan="3" width="80%"><span><?php echo $user['twitter']; ?></span></td>
			</tr>
		</table>
		<div class="row">
			<div class="col-md-12">
				<h3>Address Information</h3>
			</div>
		</div>
		<table class="table table-bordered table-striped">
			<tr>
				<td width="20%"><strong>Mailing Street:</strong></td>
				<td width="30%"><span><?php echo $user['mailingstreet']; ?></span></td>
				<td width="20%"><strong>Other Street:</strong></td>
				<td width="30%"><span><?php echo $user['otherstreet']; ?></span></td>
			</tr>
			<tr>
				<td><strong>Mailing City:</strong></td>
				<td><span><?php echo $user['mailingcity']; ?></span></td>
				<td><strong>Other City:</strong></td>
				<td><span><?php echo $user['othercity']; ?></span></td>
			</tr>
			<tr>
				<td><strong>Mailing State:</strong></td>
				<td><span><?php echo $user['mailingstate']; ?></span></td>
				<td><strong>Other State:</strong></td>
				<td><span><?php echo $user['otherstate']; ?></span></td>
			</tr>
			<tr>
				<td><strong>Mailing Zip:</strong></td>
				<td><span><?php echo $user['mailingzip']; ?></span></td>
				<td><strong>Other Zip:</strong></td>
				<td><span><?php echo $user['otherzip']; ?></span></td>
			</tr>
			<tr>
				<td><strong>Mailing Country:</strong></td>
				<td><span><?php echo $user['mailingcountry']; ?></span></td>
				<td><strong>Other Country:</strong></td>
				<td><span><?php echo $user['othercountry']; ?></span></td>
			</tr>
		</table>
		<div class="row">
			<div class="col-md-12">
				<h3>Financial Information</h3>
			</div>
		</div>
		<table class="table table-bordered table-striped">
			<tr>
				<td width="20%"><strong>Bank Name:</strong></td>
				<td width="30%"><span><?php echo $user['bankname']; ?></span></td>
				<td width="20%"><strong>Bank Account No.:</strong></td>
				<td width="30%"><span><?php echo $user['bankaccountno']; ?></span></td>
			</tr>
			<tr>
				<td width="20%"><strong>Credit Card:</strong></td>
				<td width="30%"><span><?php echo $user['creditcard']; ?></span></td>
				<td width="20%"><strong>Credit Card No.:</strong></td>
				<td width="30%"><span><?php echo $user['creditcardno']; ?></span></td>
			</tr>
			<tr>
				<td width="20%"><strong>Debit Card:</strong></td>
				<td width="30%"><span><?php echo $user['debitcard']; ?></span></td>
				<td width="20%"><strong>Debit Card No.:</strong></td>
				<td width="30%"><span><?php echo $user['debitcardno']; ?></span></td>
			</tr>
		</table>
		<div class="row">
			<div class="col-md-12">
				<h3>Additional Information</h3>
			</div>
		</div>
		<table class="table table-bordered table-striped">
			<tr>
				<td width="20%"><strong>Description:</strong></td>
				<td colspan="3" width="80%"><span><?php echo $user['description']; ?></span></td>
			</tr>
		</table>
		<div class="row"></div>
</div>