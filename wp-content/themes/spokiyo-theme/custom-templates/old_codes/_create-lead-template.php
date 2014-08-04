<?php
die;
/**
 * The template for adding zoho crm lead
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
				<h3>Lead Information</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="leadowner" class="align-right">Lead Owner:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="leadowner" name="leadowner" />
			</div>
			<div class="col-md-2">
				<label for="leadsource" class="align-right">Lead Source:</label>
			</div>
			<div class="col-md-4">
				<select id="leadsource" name="leadsource" class="form-control input-sm">
					<option value="">-None-</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="company" class="align-right">*Company:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="company" name="company" />
			</div>
			<div class="col-md-2">
				<label for="leadstatus" class="align-right">Lead Status:</label>
			</div>
			<div class="col-md-4">
				<select id="leadstatus" name="leadstatus" class="form-control input-sm">
					<option value="">-None-</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="firstname" class="align-right">First Name:</label>
			</div>
			<div class="col-md-4">
				<select style="width:30%;display:inline;vertical-align:top !important;" class="form-control input-sm">
						<option value="">-None-</option>
						<option value="Mr.">Mr.</option>
						<option value="Mrs.">Mrs.</option>
						<option value="Ms.">Ms.</option>
						<option value="Dr.">Dr.</option>
						<option value="Prof.">Prof.</option>
				</select>
				<input class="form-control input-sm" style="display:inline;width:68%;" type="text" id="firstname" name="firstname" />
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
				<label for="lastname" class="align-right">*Last Name:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="lastname" name="lastname" />
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
				<label for="title" class="align-right">Title:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="title" name="title" />
			</div>
			<div class="col-md-2">
				<label for="noofemployees" class="align-right">No Of Employees:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="noofemployees" name="noofemployees" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="email" class="align-right">Email:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="email" name="email" />
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
				<label for="phone" class="align-right">Phone:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="phone" name="phone" />
			</div>
			<div class="col-md-6">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="mobile" class="align-right">Mobile:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="mobile" name="mobile" />
			</div>
			<div class="col-md-6">
				&nbsp;
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="fax" class="align-right">Fax:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="fax" name="fax" />
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
				<label for="street" class="align-right">Street:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="street" name="street" />
			</div>
			<div class="col-md-2">
				<label for="city" class="align-right">City:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="city" name="city" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="state" class="align-right">State:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="state" name="state" />
			</div>
			<div class="col-md-2">
				<label for="zipcode" class="align-right">Zip Code:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="zipcode" name="zipcode" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="country" class="align-right">Country:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="country" name="country" />
			</div>
			<div class="col-md-6">
				&nbsp;
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