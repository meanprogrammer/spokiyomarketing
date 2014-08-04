<?php
die;
/**
 * The template for adding zoho crm account
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
	
?>

<div class="container">
	<form>
		<div class="row">
			<div class="col-md-12">
				<h3>Account Information</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="accountowner" class="align-right">Account Owner:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="accountowner" name="accountowner" />
			</div>
			<div class="col-md-2">
				<label for="phone" class="align-right">Phone:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="phone" name="phone" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="accountnumber" class="align-right">Account Number:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="accountnumber" name="accountnumber" />
			</div>
			<div class="col-md-2">
				<label for="fax" class="align-right">Fax:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="fax" name="fax" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="accountname" class="align-right">*Account Name:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="accountname" name="accountname" />
			</div>
			<div class="col-md-2">
				<label for="website" class="align-right">Website:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="website" name="website" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="parentaccount" class="align-right">Parent Account:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="parentaccount" name="parentaccount" />
			</div>
			<div class="col-md-2">
				<label for="industry" class="align-right">Industry:</label>
			</div>
			<div class="col-md-4">
				<select id="industry" name="industry" class="form-control input-sm">
					<option value="">-None-</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="accountsite" class="align-right">Account Site:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="accountsite" name="accountsite" />
			</div>
			<div class="col-md-2">
				<label for="ownership" class="align-right">Ownership:</label>
			</div>
			<div class="col-md-4">
				<select id="ownership" name="ownership" class="form-control input-sm">
					<option value="">-None-</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="accounttype" class="align-right">Account Type:</label>
			</div>
			<div class="col-md-4">
				<select id="accounttype" name="accounttype" class="form-control input-sm">
					<option value="">-None-</option>
				</select>
			</div>
			<div class="col-md-2">
				<label for="annualrevenue" class="align-right">Annual Revenue:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="annualrevenue" name="annualrevenue" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="facebook" class="align-right">Facebook:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="facebook" name="facebook" />
			</div>
			<div class="col-md-6">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="linkedin" class="align-right">LinkedIn:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="linkedin" name="linkedin" />
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
				<label for="billingstreet" class="align-right">Billing Street:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="billingstreet" name="billingstreet" />
			</div>
			<div class="col-md-2">
				<label for="shippingstreet" class="align-right">Shipping Street:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="shippingstreet" name="shippingstreet" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="billingcity" class="align-right">Billing City:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="billingcity" name="billingcity" />
			</div>
			<div class="col-md-2">
				<label for="shippingcity" class="align-right">Shipping City:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="shippingcity" name="shippingcity" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="billingstate" class="align-right">Billing State:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="billingstate" name="billingstate" />
			</div>
			<div class="col-md-2">
				<label for="shippingstate" class="align-right">Shipping State:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="shippingstate" name="shippingstate" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="billingcode" class="align-right">Billing Code:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="billingcode" name="billingcode" />
			</div>
			<div class="col-md-2">
				<label for="shippingcode" class="align-right">Shipping Code:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="shippingcode" name="shippingcode" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="billingcountry" class="align-right">Billing Country:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="billingcountry" name="billingcountry" />
			</div>
			<div class="col-md-2">
				<label for="shippingcountry" class="align-right">Shipping Country:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="shippingcountry" name="shippingcountry" />
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
				<input type="text" class="form-control input-sm full-width" id="bankaccountno" name="bankaccountno" />
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
				<input type="text" class="form-control input-sm full-width" id="creditcardno" name="creditcardno" />
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
				<input type="text" class="form-control input-sm full-width" id="debitcardno" name="debitcardno" />
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
				<textarea rows="3" cols="50" id="description" name="description" class="form-control"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<input type="submit" id="savecontact" name="savecontact" class="btn btn-primary" value="Save"/>
			</div>
		</div>
	</form>
</div>