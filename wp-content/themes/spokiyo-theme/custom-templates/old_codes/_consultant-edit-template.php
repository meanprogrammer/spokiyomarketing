<?php
/**
 * The template for editing user
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
	<form role="form" action="<?php echo get_site_url();?>/update-consultant" method="post">
		<div class="row">
			<div class="col-md-12">
				<h3>Contact Information</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="contactowner" class="align-right">Contact Owner:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="contactowner" name="contactowner" value='<?php echo $user['contactowner']; ?>' />
			</div>
			<div class="col-md-2">
				<label for="leadsource" class="align-right">Lead Source:</label>
			</div>
			<div class="col-md-4">
				<select id="leadsource" name="leadsource" class="form-control input-sm">
					<option value="">-None-</option>
					<option value="Advertisement">Advertisement</option>
					<option value="Cold Call">Cold Call</option>
					<option value="Employee Referral">Employee Referral</option>
					<option value="External Referral">External Referral</option>
					<option value="OnlineStore">OnlineStore</option>
					<option value="Partner">Partner</option>
					<option value="Public Relations">Public Relations</option>
					<option value="Sales Mail Alias">Sales Mail Alias</option>
					<option value="Seminar Partner">Seminar Partner</option>
					<option value="Seminar-Internal">Seminar-Internal</option>
					<option value="Trade Show">Trade Show</option>
					<option value="Web Download">Web Download</option>
					<option value="Web Research">Web Research</option>
					<option value="Web Cases">Web Cases</option>
					<option value="Web Mail">Web Mail</option>
					<option value="Chat">Chat</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="accountname" class="align-right">Account Name:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="accountname" name="accountname" value='<?php echo $user['accountname']; ?>' />
			</div>
			<div class="col-md-2">
				<label for="email" class="align-right">Email:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="email" name="email" value='<?php echo $user['email']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="firstname" class="align-right">First Name:</label>
			</div>
			<div class="col-md-4">
				<select id="salutation" name="salutation" style="width:30%;display:inline;vertical-align:top !important;" class="form-control input-sm">
						<option value="">-None-</option>
						<option value="Mr.">Mr.</option>
						<option value="Mrs.">Mrs.</option>
						<option value="Ms.">Ms.</option>
						<option value="Dr.">Dr.</option>
						<option value="Prof.">Prof.</option>
				</select>
				<input class="form-control input-sm" style="display:inline;width:68%;" type="text" id="firstname" name="firstname" value='<?php echo $user['firstname']; ?>' />
			</div>
			<div class="col-md-2">
				<label for="phone" class="align-right">Phone:</label>				
			</div>
			<div class="col-md-4">
				<input type="text" name="phone" class="form-control input-sm  full-width" id="phone" value='<?php echo $user['phone']; ?>' />
			</div>

		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="lastname" class="align-right">Last Name:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="lastname" name="lastname" value='<?php echo $user['lastname']; ?>' />
			</div>
			<div class="col-md-2">
				<label for="mobile" class="align-right">Mobile:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="mobile" name="mobile" value='<?php echo $user['mobile']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="title" class="align-right">Title:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="title" name="title" value='<?php echo $user['title']; ?>' />
			</div>
			<div class="col-md-2">
				<label for="fax" class="align-right">Fax:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="fax" name="fax" value='<?php echo $user['fax']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="department" class="align-right">Department:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="department" name="department" value='<?php echo $user['department']; ?>' />
			</div>
			<div class="col-md-2">
				<label for="dateofbirth" class="align-right">Date of Birth:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="dateofbirth" name="dateofbirth" value='<?php echo $user['dateofbirth']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="facebook" class="align-right">Facebook:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="facebook" name="facebook" value='<?php echo $user['facebook']; ?>' />
			</div>
			<div class="col-md-6">
				&nbsp;
			</div>
			<!-- <div class="col-md-2">
				<label for="username" class="align-right">Username:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="username" name="username" value='<?php echo $user['username']; ?>' />
			</div> -->
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="linkedin" class="align-right">LinkedIn:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="linkedin" name="linkedin" value='<?php echo $user['linkedin']; ?>' />
			</div>
			<div class="col-md-6">
				&nbsp;
			</div>
			<!-- <div class="col-md-2">
				<label for="password" class="align-right">Password:</label>
			</div>
			<div class="col-md-4">
				<input type="password" class="form-control input-sm full-width" id="password" name="password" value='<?php echo $user['password']; ?>' />
			</div> -->
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="skypeid" class="align-right">Skype ID:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="skypeid" name="skypeid" value='<?php echo $user['skypeid']; ?>' />
			</div>
			<div class="col-md-6">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="twitter" class="align-right">Twitter:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="twitter" name="twitter" value='<?php echo $user['twitter']; ?>' />
			</div>
			<div class="col-md-6">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Address Information</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="mailingstreet" class="align-right">Mailing Street:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="mailingstreet" name="mailingstreet" value='<?php echo $user['mailingstreet']; ?>' />
			</div>
			<div class="col-md-2">
				<label for="otherstreet" class="align-right">Other Street:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="otherstreet" name="otherstreet" value='<?php echo $user['otherstreet']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="mailingcity" class="align-right">Mailing City:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="mailingcity" name="mailingcity" value='<?php echo $user['mailingcity']; ?>' />
			</div>
			<div class="col-md-2">
				<label for="othercity" class="align-right">Other City:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="othercity" name="othercity" value='<?php echo $user['othercity']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="mailingstate" class="align-right">Mailing State:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="mailingstate" name="mailingstate" value='<?php echo $user['mailingstate']; ?>' />
			</div>
			<div class="col-md-2">
				<label for="otherstate" class="align-right">Other State:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="otherstate" name="otherstate" value='<?php echo $user['otherstate']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="mailingzip" class="align-right">Mailing Zip:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="mailingzip" name="mailingzip" value='<?php echo $user['mailingzip']; ?>' />
			</div>
			<div class="col-md-2">
				<label for="otherzip" class="align-right">Other Zip:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="otherzip" name="otherzip" value='<?php echo $user['otherzip']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="mailingcountry" class="align-right">Mailing Country:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="mailingcountry" name="mailingcountry" value='<?php echo $user['mailingcountry']; ?>' />
			</div>
			<div class="col-md-2">
				<label for="othercountry" class="align-right">Other Country:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="othercountry" name="othercountry" value='<?php echo $user['othercountry']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Financial Information</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="bankname" class="align-right">Bank Name:</label>
			</div>
			<div class="col-md-4">
				<select class="form-control input-sm full-width" id="bankname" name="bankname">
					<option value="0">--SELECT--</option>
					<option value="1">BPI</option>
					<option value="2">Metrobank</option>
				</select>
			</div>
			<div class="col-md-2">
				<label for="bankaccountno" class="align-right">Bank Account No.:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="bankaccountno" name="bankaccountno" value='<?php echo $user['bankaccountno']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="creditcard" class="align-right">Credit Card:</label>
			</div>
			<div class="col-md-4">
				<select class="form-control input-sm full-width" id="creditcard" name="creditcard">
					<option value="0">--SELECT--</option>
					<option value="1">BPI</option>
					<option value="2">Metrobank</option>
				</select>
			</div>
			<div class="col-md-2">
				<label for="creditcardno" class="align-right">Credit Card No.:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="creditcardno" name="creditcardno" value='<?php echo $user['creditcardno']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="debitcard" class="align-right">Debit Card:</label>
			</div>
			<div class="col-md-4">
				<select class="form-control input-sm full-width" id="debitcard" name="debitcard">
					<option value="0">--SELECT--</option>
					<option value="1">BPI</option>
					<option value="2">Metrobank</option>
				</select>
			</div>
			<div class="col-md-2">
				<label for="debitcardno" class="align-right">Debit Card No.:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="debitcardno" name="debitcardno" value='<?php echo $user['debitcardno']; ?>' />
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Additional Information</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="description" class="align-right">Description</label>
			</div>
			<div class="col-md-10">
				<textarea rows="3" cols="50" id="description" name="description" class="form-control"><?php echo $user['description']; ?></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input type="submit" id="savecontact" name="savecontact" class="btn btn-primary" value="Save"/>
				<input type="hidden" name="createhiddenflag" id="createhiddenflag" value="create" />
				<input id="consultant_id" name="consultant_id" type="hidden" value='<?php echo $user["_id"];?>' />
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
		var checkin = $('#dateofbirth').datepicker({ width:1000
			}).on('changeDate', function(ev) {
			  checkin.hide();
		}).data('datepicker');
		$('#leadsource').val("<?php echo $user['leadsource']; ?>");
		$('#salutation').val("<?php echo $user['salutation']; ?>");
		$('#bankname').val("<?php echo $user['bankname']; ?>");
		$('#creditcard').val("<?php echo $user['creditcard']; ?>");
		$('#debitcard').val("<?php echo $user['debitcard']; ?>");
		
		$('#savecontact').click(function(){
			var isvalid = true;
			var notemptylist = ['firstname','lastname','username','password','retypepassword'];
			var messages = [];

			$('div.has-error').removeClass('has-error');
			$('#validation-messages').html('').removeClass('alert alert-danger');
			
			$.each(notemptylist, function(k,v){
				if(!isnotempty(v)){
					isvalid = false;
					$('#'+v).parent().addClass('has-error');
				}
			});

			var password, retypepassword;
			password = $('#password').val();
			retypepassword = $('#retypepassword').val();

			if($.trim(password) != $.trim(retypepassword)) {
				isvalid = false;
				messages.push('Password must match.');
			}

			var email = $('#email').val();
			var phone = $('#phone').val();
			var mobile = $('#mobile').val();
			if($.trim(email) == '' && $.trim(phone) == '' && $.trim(mobile) == '') {
				messages.push('Fill up any of email, phone or mobile.');
			}

			var html = '';
			if(messages.length > 0) {
				html += '<ul>';
				$.each(messages, function(a, b){
					html += '<li>'+b+'</li>';
				});
				html += '</ul>';
			}
			if(html.length > 0){
				$('#validation-messages').html(html);
				$('#validation-messages').addClass('alert alert-danger');
			}

			if(isvalid == true) {
				$('#consultant-form').submit();
			}
		});
	    
	});

	function isnotempty(fieldname) {
		var value = $('#'+fieldname).val();
		return $.trim(value) != '';
	}
	
</script>