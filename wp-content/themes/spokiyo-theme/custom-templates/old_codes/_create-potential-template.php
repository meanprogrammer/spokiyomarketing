<?php
die;
/**
 * The template for adding zoho crm potential
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
				<h3>Potential Information</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="potentialowner" class="align-right">Potential Owner:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="potentialowner" name="potentialowner" />
			</div>
			<div class="col-md-2">
				<label for="budget" class="align-right">Budget:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="budget" name="budget" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="potentialname" class="align-right">*Potential Name:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="potentialname" name="potentialname" />
			</div>
			<div class="col-md-2">
				<label for="stage" class="align-right">*Stage:</label>
			</div>
			<div class="col-md-4">
				<select id="stage" name="stage" class="form-control input-sm">
					<option value="">-None-</option>
				</select>
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
				<label for="closingstage" class="align-right">*Closing Date:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" placeholder="MM/dd/yyyy" id="closingstage" name="closingstage" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="type" class="align-right">Type:</label>
			</div>
			<div class="col-md-4">
				<select id="type" name="type" class="form-control input-sm">
					<option value="">-None-</option>
				</select>
			</div>
			<div class="col-md-2">
				<label for="probability" class="align-right">Probability (%):</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="probability" name="probability" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="contactname" class="align-right">Contact Name:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="contactname" name="contactname" />
			</div>
			<div class="col-md-6">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Additional Information</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="campaignsource" class="align-right">Campaign Source:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="campaignsource" name="campaignsource" />
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
				<label for="description" class="align-right">Description:</label>
			</div>
			<div class="col-md-4">
				<textarea type="text" row="5" cols="30" class="form-control input-sm full-width" id="description" name="description" >
				</textarea>
			</div>
			<div class="col-md-2">
				<label for="nextstep" class="align-right">Next Step:</label>
			</div>
			<div class="col-md-4">
				<input type="text" class="form-control input-sm full-width" id="nextstep" name="nextstep" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Preferences</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="industry" class="align-right">Industry:</label>
			</div>
			<div class="col-md-4">
				<select name="industry" id="industry" style="width:100% !important;" multiple="multiple" >
			        <option>Accounting</option>
			        <option>Advertising</option>
			        <option>Airline</option>
			        <option>Audit</option>
			     </select> 
			</div>
			<div class="col-md-2">
				<label for="interests" class="align-right">Interests:</label>
			</div>
			<div class="col-md-4">
				<select name="interests" id="interests" style="width:100% !important;" multiple="multiple" >
			        <option>Arts & Culture</option>
			        <option>Computer Programming</option>
			        <option>Cooking</option>
			        <option>Dancing</option>
			     </select> 
			</div>
		</div>
	</form>
</div>