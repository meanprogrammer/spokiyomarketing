<?php
/**
 * The template for consultant page
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
	Template Name: ConsultantPageTemplate
*/
/*
 	Contact = User
 */
?>

<?php
	$fullpath = get_template_directory()."/codes/";
	include $fullpath."zohocontact.php";
	include_once $fullpath."LookUp.php";
	
	session_start();
	
	$consultant = $_SESSION['logged_user'];

	if($consultant == NULL) {
		header("location:" . get_site_url());
	}
	
	/*if(!isset($_POST['username']) || !isset($_POST['password'])) {
		echo "-1";
		exit;
	}  
	
	$zc = new zohocontact();
	
	$username = $_POST['username'];
	$password = $_POST['password'];

	$consultant = $zc->getUserAccountByCredentials($username, $password);*/ 
	
?>
<?php // var_dump($consultant);die();?>
<div class="container">
	<div class="row">
				<div class="col-md-12" style="padding-left:0;text-align: right;margin-bottom: 5px;">
					<!--  <a href="sign-out" class="btn btn-danger btn-xs">Sign Out</a>-->
					<nav class="navbar navbar-default navbar-override" role="navigation">
					    <div class="row">
					    	<div class="col-md-4 searchbox">
					    		<!-- <input type="text" class="form-control input-lg" style="display: inline-block;" />
					    		<a href="#" class="btn btn-primary btn-lg">Search</a> -->
					    		<div class="input-group">
							      <input type="text" class="form-control input-md">
							      <span class="input-group-btn">
							      <button type="button" class="btn btn-primary btn-md" style="margin-left: -1px">
									  <span class="glyphicon glyphicon-search"></span>
									</button>
							      	<!-- <span class="glyphicon glyphicon-star"></span>
							        <a class="btn btn-default btn-lg" style="margin-left: -1px">Search</a>-->
							      </span>
							    </div><!-- /input-group -->
					    	</div>
					    	<div class="col-md-8">
					    		<ul class="nav navbar-nav navbar-right">
					    			<li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <span class="caret"></span></a>
							          <ul class="dropdown-menu" role="menu">
							            <li><a href="#">Hire Consultant</a></li>
							            <li><a href="#">Look for Opportunity</a></li>
							            <li><a href="#">Run Sales Promotion</a></li>
							            <li><a href="#">Advertise Products</a></li>
							            <li><a href="#">Member Benifits</a></li>
							          </ul>
							        </li>
					    			<li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tools <span class="caret"></span></a>
							          <ul class="dropdown-menu" role="menu">
							            <li><a href="#">Project Approach</a></li>
							            <li><a href="#">Knowledge Center</a></li>
							            <li><a href="#">Career Simulator</a></li>
							            <li><a href="#">Life Plan</a></li>
							            <li><a href="#">Education Support</a></li>
							          </ul>
							        </li>
							        <li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Network <span class="caret"></span></a>
							          <ul class="dropdown-menu" role="menu">
							            <li><a href="#">My Connections</a></li>
							            <li><a href="#">Add Connections</a></li>
							            <li class="divider"></li>
							            <li><a href="#">Career Networks</a></li>
							          </ul>
							        </li>
							        <li class="dropdown">
							          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, <?php echo $consultant['basicInfo']['firstName'];?> <span class="caret"></span></a>
							          <ul class="dropdown-menu" role="menu">
							            <li><a href="#">My Profile</a></li>
							            <li><a href="#">My Portfolio</a></li>
							            <li class="divider"></li>
							            <li><a href="#">Account Settings</a></li>
							            <li><a href="#">Knowledge Center</a></li>
							            <li><a id="signout">Sign Out</a></li>
							          </ul>
							        </li>
							    </ul>
					    	</div>
					    </div>
					</nav>
				</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<!-- <div class="row">
				<div class="col-md-12" style="text-align: right;margin-bottom: 5px;">
					&nbsp;
				</div>
			</div> -->
			<div class="row">
				<div id="picture-container" class="col-md-12 profile-picture-back">
				<a id="picture-edit-button" class="btn btn-xs btn-default" style="display:none;float:right;position: absolute;">Edit</a>
					<img class="img-responsive img-thumbnail" src='<?php echo get_template_directory_uri()."/images/spokiyo/profile-pic-bg.jpg"; ?>' alt="" />
				</div>
			</div>
			<div id="contacts-container" class="row">
				<div class="col-md-12 contacts-container">
					<a id="edit-contactinfo-button" name="edit-contactinfo-button" class="btn btn-xs btn-default contactinfo-edit-button" style="display:none;">Edit</a>
					<ul id="contacts-list">
						<!-- <li class="icon email-icon"><?php echo $consultant['contactInfo']['email']; ?></li>
						<?php
							if(count($consultant['contactInfo']['phoneNumbers']) > 0) {
								$content = $consultant['contactInfo']['phoneNumbers'][0];
							} 
						 ?>
						<li class="icon contact-icon"><?php echo $content['phoneNumber'];?></li>
						
						<li class="icon website-icon">Website</li>
						
						<li class="twitter-icon">Twitter</li>
						<li class="facebook-icon">Facebook</li>
						<li class="linkedin-icon">LinkedIn</li>
						 -->
					</ul>
				</div>
			</div>
			<div class="row" style="background-color: #0093ef;">
				<div class="col-md-12" style="border-bottom: 1px solid #30a5f0;">
					<span class="attribute-title">Attributes</span>
				</div>
			</div>
			<div class="row" style="background-color: #0093ef;">
				<br />
				<div class="col-md-12">
					<span class="att-skills">Skills</span>
				</div>
			</div>
			<div class="row" style="background-color: #0093ef;">
				<div class="col-md-12">
					No skills.
				</div>
			</div>
			<div class="row" style="background-color: #0093ef;">
				<br />
				<div class="col-md-12">
					<span class="att-interests">Interests</span>
				</div>
			</div>
			<div class="row" style="background-color: #0093ef;">
				<div class="col-md-12">
					No interests.
				</div>
			</div>
			<div class="row" style="background-color: #0093ef;">
				<br />
				<div class="col-md-12">
					<span class="att-personality">Personality</span>
				</div>
			</div>
			<div class="row" style="background-color: #0093ef;">
				<div class="col-md-12">
					No personality.
				</div>
			</div>
			<div class="row" style="background-color: #0093ef;">
				<div class="col-md-12">
					<div class="take-test-box">
						<strong>Measure your Attributes</strong> <small>Psychometric tests
							include personality profiles, reasoning tests, motivation
							questionnaires, and ability assessments.</small> <br> <br> <small><a
							class="take-test-link" href="#">Take Interests Test</a> </small><br>
						<small><a class="take-test-link" href="#">Take Personality Test</a>
						</small><br> <small><a class="take-test-link" href="#">Take Aptitude
								Test</a> </small>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<!-- <div class="row">
				<div class="col-md-12" style="text-align: right;margin-bottom: 5px;">
					<a href="#" class="btn btn-danger btn-xs">Sign Out</a>
				</div>
			</div> -->
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default shadow-override">
					  <div class="panel-heading">
					  	<div class="row">
					  		<div class="col-md-6">
					  			<span class="consultant-name"><?php echo $consultant['basicInfo']['lastName'].", ".$consultant['basicInfo']['firstName'];?></span>
					  	  	</div>
					  	  	<div class="col-md-6" style="text-align: right;">
					  	  		
					  	  	</div>
					    </div>
					  </div>
					  <div class="panel-body">
					  	<div class="row">
					  		<div class="col-md-11">	
					    		<span style="color:#727272; text-transform:uppercase; font-weight:bold; font-size: 14px;">bio</span>
					    	</div>
					    	<div class="col-md-1" style="text-align: right;">
					    		<a id="bio-edit-button" name="bio-edit-button" class="btn btn-xs btn-default">Edit</a>
					    	</div>
					    </div>
					    <div class="row">
					    	<div class="col-md-12">
					    		<span id="summaryview"><?php echo $consultant['professionalProfile']['summary']; ?></span>
					    	</div>
					    </div>
					  </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default shadow-override">
					  <div class="panel-body panel-body-override">
					    <ul class="nav nav-tabs content-tab nav-override" id="content-tab">
						  <li><a href="#personal" data-toggle="tab">Personal</a></li>
						  <li><a href="#affiliations" data-toggle="tab">Affiliations</a></li>
						  <li><a href="#financialinfo" data-toggle="tab">Financial Info</a></li>
						  <li><a href="#connection" data-toggle="tab">Connections</a></li>
						  <li><a href="#consultingpreference" data-toggle="tab">Consulting Preference</a></li>
						</ul>
						<div class="tab-content">
							 <div class="tab-pane tab-pane-override" id="personal">
								<div class="row">
									<div class="col-md-12">
									<a class="btn btn-xs btn-default" style="display: none;float:right;" id="personal-edit-button">Edit</a>
										<table class="table table-responsive table-override">
								 			<tr>
									 			<td>Birthday</td>
									 			<td><span id="dateOfBirthView"><?php echo $consultant['basicInfo']['dateOfBirth']; ?></span></td>
								 			</tr>
								 			<tr>
									 			<td>Marital Status</td>
									 			<td><span id="maritalStatusView"><?php echo $consultant['personalDetail']['maritalStatus']; ?></span></td>
								 			</tr>
								 		</table>
									</div>
								</div>
				             </div>
				             <div class="tab-pane tab-pane-override" id="affiliations">
								<div class="row">
									<div class="col-md-12">
										<a id="add-affiliation-button" name="add-affiliation-button" class="btn btn-xs btn-default">Add Affiliations</a>
									</div>
								</div>
				             </div>
				             <div class="tab-pane tab-pane-override" id="financialinfo">
				             	<div class="row">
				             		<div class="col-md-12">
				             			<a id="add-financialinfo-button" class="btn btn-xs btn-default">Add Account</a>
				             		</div>
				             	</div>
				             	<div id="bankaccount-list">				             	
					             <?php if(count($consultant['bankAccounts'] > 0)) {
					             	foreach ($consultant['bankAccounts'] as $bankAccounts) {
					             	?>
					             
									<div class="row">
										<div 
										onmouseenter="showBankAccountEditButton('<?php echo $bankAccounts['id']; ?>')" 
										onmouseleave="hideBankAccountEditButton('<?php echo $bankAccounts['id']; ?>')" 
										class="col-md-12 bankaccountitem">
											<a class="btn btn-xs btn-default" 
												id="<?php echo $bankAccounts['id']; ?>" 
												style="display: none;float:right;"
												onclick="showBankAccountEditModal('<?php echo $bankAccounts['id']; ?>')" >Edit</a>
											<table class="table table-responsive table-override">
									 			<tr>
										 			<td>For Transactions</td>
										 			<td><?php echo $bankAccounts['description']; ?></td>
									 			</tr>
									 			<tr>
										 			<td>Bank Name</td>
										 			<td><?php echo $bankAccounts['bankName'];?></td>
									 			</tr>
									 			<tr>
										 			<td>Bank Account Number</td>
										 			<td><?php echo $bankAccounts['bankAccountNumber'];?></td>
									 			</tr>
									 			<tr>
										 			<td>Credit Card</td>
										 			<td><?php echo $bankAccounts['creditCard'];?></td>
									 			</tr>
									 			<tr>
										 			<td>Credit Card Type</td>
										 			<td><?php echo $bankAccounts['creditCardType'];?></td>
									 			</tr>
									 			<tr>
										 			<td>Credit Card Number</td>
										 			<td><?php echo $bankAccounts['creditCardNumber'];?></td>
									 			</tr>
									 		</table>
									 	</div>
									</div> 
									<?php } 
				             		} ?>
				             		</div>
				             </div>
				             <div class="tab-pane tab-pane-override" id="connection">
								<div class="row">
									<div class="col-md-12">
										<a id="add-connection-button" name="add-connection-button" class="btn btn-xs btn-default">Add Connection</a>
									</div>
								</div>
				             </div>
				             <div class="tab-pane tab-pane-override" id="consultingpreference">
				             	<div class="row">
				             		<div class="col-md-12">
				             		<a class="btn btn-xs btn-default" style="display: none;float:right;" id="consultingpreference-edit-button" name="consultingpreference-edit-button">Edit</a>
										<table class="table table-responsive table-override">
								 			<tr>
									 			<td>Availability</td>
									 			<td><span id="availabilityView"><?php echo $consultant['professionalProfile']['availability']; ?></span></td>
								 			</tr>
								 			<tr>
									 			<td>Rate</td>
									 			<td><span id="rateView"><?php echo $consultant['professionalProfile']['hourlyRate']; ?></span></td>
								 			</tr>
								 			<tr>
									 			<td>Type of Work</td>
									 			<td><span id="typeOfWorkView"><?php echo $consultant['professionalProfile']['typeOfWork'] ?></span></td>
								 			</tr>
								 			<tr>
									 			<td>Shift</td>
									 			<td><span id="workShiftView"><?php echo $consultant['professionalProfile']['shift'] ?></span></td>
								 			</tr>
								 		</table>
								 	</div>
							 	</div>
				             </div>
             			</div>
					  </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default shadow-override">
					  <div class="panel-heading">
						<div class="panel-title">Experience</div>					    
					  </div>
					  <div class="panel-body">
					    <div class="row">
									<div class="col-md-12">
										<a id="addexperiencebutton" class="btn btn-xs btn-default">Add Experience</a>
						</div>
						</div>
						<div id="employmenthistory">
						<?php foreach ($consultant['professionalProfile']['employmentHistory'] as $history) { ?>
						<div
							onmouseenter="showExperienceEditButton('<?php echo $history['id']; ?>')" 
							onmouseleave="hideExperienceEditButton('<?php echo $history['id']; ?>')"  
							class="row">
							
							<div class="col-md-3 experience-dates">
								<?php  
									$fromDate = new DateTime($history['startDate']);
									$toDate = new DateTime($history['endDate']);
									echo $fromDate->format('M Y') . ' - ' . $toDate->format('M Y'); ?>
							</div>
							<div class="col-md-9 experience-details">
							<a class="btn btn-xs btn-default" 
							   id="<?php echo $history['id']; ?>" 
							   style="display: none;float:right;"
							   onclick="showExperienceEditModal('<?php echo $history['id']; ?>')" >Edit</a>
								<span class="experience-role"><?php echo $history['role']; ?></span><br />
								<span class="experience-company"><?php echo $history['company']; ?></span>
							</div>
						</div>
						<?php  } ?>
					  </div>
					  </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default shadow-override">
					  <div class="panel-heading">
						<div class="panel-title">Education</div>					    
					  </div>
					  <div class="panel-body">
					  	<div class="row">
							<div class="col-md-12">
								<a id="addeducationbutton" class="btn btn-xs btn-default">Add Education</a>
							</div>
							
						</div>
						  <div id="educationhistory">
								<?php foreach ($consultant['professionalProfile']['educationHistory'] as $educ) { ?>
								<div
									onmouseenter="showEditButton('<?php echo $educ['id']; ?>')" 
									onmouseleave="hideEditButton('<?php echo $educ['id']; ?>')"   
									class="row">
									<div class="col-md-3 education-dates">
										<?php  
										$educFromDate = new DateTime($educ['startDate']);
										$educToDate = new DateTime($educ['endDate']);
										echo $educFromDate->format('M Y') . ' - ' . $educToDate->format('M Y'); ?>
									</div>
									<div class="col-md-9 education-details">
									<a class="btn btn-xs btn-default" 
									   id="<?php echo $educ['id']; ?>" 
									   style="display: none;float:right;"
									   onclick="showEducationEditModal('<?php echo $educ['id']; ?>')" >Edit</a>
										<span class="education-qualification">
											<?php 
											$qLookup = new QualificationLookup();
											echo $qLookup->getQualificationText( $educ['qualification'] );
											?>
											</span><br />
										<span class="education-school"><?php echo $educ['school']; ?></span>
									</div>
								</div>
								<?php  } ?>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" style="text-align:right;">
						<a id="previewbutton" class="btn btn-lg btn-default">Preview</a>
						<a id="publishbutton" class="btn btn-lg btn-primary">Publish</a>
					</div>
				</div>
			</div>
		</div>
</div>
<input type="hidden" id="uaid" name="uaid" value="<?php echo $consultant['_id']; ?>" />

<!-- UserEducationEntry Modal -->
<div class="modal" id="educationModal">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add Education</h4>
      </div>
      <div class="modal-body">
        	<table class="table table-responsive table-override">
        		<tr>
        			<td>School</td>
        			<td><input type="text" id="schoolname" name="schoolname" class="form-control input-md" /></td>
        			<td>Qualification</td>
        			<td>
						<select id="qualification" class="form-control input-md">
        					<option value="">--SELECT--</option>
        					<option value="1">High School</option>
        					<option value="2">College</option>
        					<option value="3">Masters</option>
        					<option value="4">Doctorate</option>
        					<option value="5">Post Doctoral</option>
        				</select>
					</td>
        		</tr>
        		<tr>
        			<td>Field</td>
        			<td><input type="text" id="educationfield" name="educationfield" class="form-control input-md" /></td>
        			<td>Grade</td>
        			<td><input type="text" id="educationgrade" name="educationgrade" class="form-control input-md" /></td>
        		</tr>
        		<tr>
        			<td>Start Date</td>
        			<td><input type="text" id="educationstartdate" name="educationstartdate" class="form-control input-md" /></td>
        			<td>End Date</td>
        			<td colspan="3"><input type="text" id="educationenddate" name="educationenddate" class="form-control input-md" /></td>
        		</tr>
        	</table>
        	<input type="hidden" id="educationIdHidden" />
      </div>
      <div class="modal-footer">
      	<button id="saveeducationbutton" type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- UserEducationEntry Modal -->

<!-- EmploymentHistory Modal -->
<div class="modal" id="employmentHistoryModal">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Add Experience</h4>
      </div>
      <div class="modal-body">
        	<table class="table table-responsive table-override">
        		<tr>
        			<td>Company</td>
        			<td><input type="text" id="companyname" name="companyname" class="form-control input-md" /></td>
        			<td>Role</td>
        			<td><input type="text" id="employementrole" name="employementrole" class="form-control input-md" /></td>
        		</tr>
        		<tr>
        			<td>Start Date</td>
        			<td><input type="text" id="employmentstartdate" name="employmentstartdate" class="form-control input-md" /></td>
        			<td>End Date</td>
        			<td colspan="3"><input type="text" id="employmentenddate" name="employmentenddate" class="form-control input-md" /></td>
        		</tr>
        	</table>
        	<input id="experienceIdHidden" type="hidden" />
      </div>
      <div class="modal-footer">
      	<button id="saveexperiencebutton" type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- EmploymentHistory Modal -->



<!-- Personal Tab Modal -->
<div class="modal" id="personalTabModal">
  <div class="modal-dialog" style="width:600px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Personal</h4>
      </div>
      <div class="modal-body">
        	<table class="table table-responsive table-override">
        		<tr>
        			<td>Birthday</td>
        			<td><input type="text" id="birthdate" name="birthdate" class="form-control input-md" /></td>
        		</tr>
        		<tr>
        			<td>Marital Status</td>
        			<td>
        				<select id="maritalstatus" name="maritalstatus" class="form-control input-md" style="width: auto !important;">
        					<option value="0">--SELECT--</option>
        					<option value="Single">Single</option>
        					<option value="Married">Married</option>
        					<option value="Divorced">Divorced</option>
        					<option value="Widow">Widow</option>
        				</select>
					</td>
        		</tr>
        	</table>
      </div>
      <div class="modal-footer">
      	<button id="savepersonaltab" name="savepersonaltab" type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Personal Tab Modal -->

<!-- Affiliation Tab Modal -->
<div class="modal" id="affiliationsTabModal">
  <div class="modal-dialog" style="width:600px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Affiliations</h4>
      </div>
      <div class="modal-body">
        	<table class="table table-responsive table-override">
        		<tr>
        			<td></td>
        		</tr>
        	</table>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Affiliation Tab Modal -->

<!-- Financial Info Tab Modal -->
<div class="modal" id="financialInfoTabModal">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Financial Info</h4>
      </div>
      <div class="modal-body">
        	<table class="table table-responsive table-override">
        		<tr>
        			<td>For Transaction</td>
        			<td><input type="text" id="fortransactions" name="fortransactions" class="form-control input-md" /></td>
        		</tr>
        		<tr>
        			<td>Bank Name</td>
        			<td><input type="text" id="bankname" name="bankname" class="form-control input-md" /></td>
        		</tr>
        		<tr>
        			<td>Account No.</td>
        			<td><input type="text" id="accountnumber" name="accountnumber" class="form-control input-md" /></td>
        		</tr>
        		<tr>
        			<td>Credit Card</td>
        			<td><input type="text" id="creditcard" name="creditcard" class="form-control input-md" /></td>
        		</tr>
        		<tr>
        			<td>Credit Card Type</td>
        			<td><input type="text" id="creditcardtype" name="creditcardtype" class="form-control input-md" /></td>
        		</tr>
        		<tr>
        			<td>Credit Card No.</td>
        			<td><input type="text" id="creditcardnumber" name="creditcardnumber" class="form-control input-md" /></td>
        		</tr>
        	</table>
        	<input type="hidden" id="bankAccountIdHidden" />
      </div>
      <div class="modal-footer">
      	<button id="save-financialinfo-button" type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Financial Info Tab Modal -->

<!-- Connection Tab Modal -->
<div class="modal" id="connectionsTabModal">
  <div class="modal-dialog" style="width:600px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Connections</h4>
      </div>
      <div class="modal-body">
        	<table class="table table-responsive table-override">
        		<tr>
        			<td></td>
        		</tr>
        	</table>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Connection Tab Modal -->

<!-- Consulting Preference Tab Modal -->
<div class="modal" id="consultingPreferenceTabModal">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Consulting Preferences</h4>
      </div>
      <div class="modal-body">
        	<table class="table table-responsive table-override">
        		<tr>
        			<td>Availability</td>
        			<td><input type="text" id="availability" name="availability" class="form-control input-md input-margin-override" /></td>
        		</tr>
        		<tr>
        			<td>Rate</td>
        			<td><input type="text" id="rate" name="rate" class="form-control input-md input-margin-override" /></td>
        		</tr>
        		<tr>
        			<td>Type Of Work</td>
        			<td>
        				<select id="typeofwork" id="typeofwork" class="input-sm input-margin-override">
        					<option value="Individual">Individual</option>
        					<option value="Team">Team</option>
        					<option value="Team/Individual">Team/Individual</option>
        				</select>
        			</td>
        		</tr>
        		<tr>
        			<td>Shift</td>
        			<td>
        				<select id="workshift" name="workshift" class="input-sm input-margin-override">
        					<option value="0">--SELECT--</option>
        					<option value="Morning">Morning</option>
        					<option value="Mid">Mid</option>
        					<option value="Night">Night</option>
        				</select>
					</td>
        		</tr>
        	</table>
      </div>
      <div class="modal-footer">
      	<button id="saveconsultingpreftab" type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Consulting Preference Tab Modal -->

<!-- Bio Edit Modal -->
<div class="modal" id="bioModal">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">BIO</h4>
      </div>
      <div class="modal-body">
        	<div class="row">
        		<div class="col-md-12">
        			<textarea id="profilesummary" name="profilesummary" rows="5" cols="60" class="form-control input-md"></textarea>
        		</div>
        	</div>
      </div>
      <div class="modal-footer">
      	<button id="savebiobutton" name="savebiobutton" type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Bio Edit Modal -->

<!-- Contact Info Modal -->
<div class="modal" id="contactInfoModal">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Contact Info</h4>
      </div>
      <div class="modal-body">
        	<div class="row">
        		<div class="col-md-2">
        			Email
        		</div>
        		<div class="col-md-10">
        			<span id="emailaddressview" name="emailaddressview"><?php echo $consultant['contactInfo']['email']; ?></span>
        			<input type="text" id="emailaddress" style="display:none;" value="<?php echo $consultant['contactInfo']['email']; ?>" name="emailaddress" class="form-control input-md full-width" />
        		</div>
        		<!-- <div class="col-md-1">
        			<a id="editemailbutton" class="btn btn-xs btn-default">Edit</a>
        		</div> -->
        	</div>
        	<div class="row">
        		<div class="col-md-12">
        			<ul class="nav nav-tabs content-tab nav-override" id="contact-tab">
						  <li><a href="#addresses" data-toggle="tab">Addresses</a></li>
						  <li><a href="#phonenumbers" data-toggle="tab">Phone Numbers</a></li>
						  <li><a href="#imhandles" data-toggle="tab">IM Handles</a></li>
						  <li><a href="#socialmedia" data-toggle="tab">Social Media</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane tab-pane-override" id="addresses">
							<div class="row">
								<div class="col-md-12">
									<a id="add-address-button" name="add-address-button" 
									class="btn btn-default btn-xs">
									Add Address
									</a>
									
								</div>
							</div>
							<div class="row">
								<div id="add-address-form" class="col-md-12 panel panel-default" style="display:none;margin-top: 10px;">
									<table class="table table-responsive table-no-topborder">
										<tr>
											<td>Type</td>
											<td>
												<select id="addresstype" name="addresstype" 
												 class="form-control input-sm">
												 	<option value="">--SELECT--</option>
													<option value="Home">Home</option>
													<option value="Business">Business</option>
													<option value="Billing">Billing</option>
													<option value="Shipping">Shipping</option>
												</select>
											</td>
											<td>Country</td>
											<td>
												<select id="addresscountry" name="addresscountry"
												 class="form-control input-sm">
												 	<option value="">--SELECT--</option>
													<option value="Philippines">Philippines</option>
													<option value="Malta">Malta</option>
													<option value="Italy">Italy</option>
													<option value="Sweden">Sweden</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Province</td>
											<td><input type="text" id="province" name="province" class="form-control input-sm full-width" /></td>
											<td>City</td>
											<td><input type="text" id="city" name="city" class="form-control input-sm full-width" /></td>
										</tr>
										<tr>
											<td>Address</td>
											<td><input type="text" id="streetaddress" name="streetaddress" class="form-control input-sm full-width" /></td>
											<td>Zip Code</td>
											<td><input type="text" id="zipcode" name="zipcode" class="form-control input-sm full-width" /></td>
										</tr>
										<tr>
											<td colspan="4">
												<a id="saveaddress" name="saveaddress" class="btn btn-primary btn-sm">Save</a>
												<a id="cancelsaveaddress" name="cancelsaveaddress" class="btn btn-default btn-sm">Cancel</a>
											</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="row">
								<div id="address-list" class="col-md-12" style="margin-top: 10px;">
									<table class="table table-striped table-bordered">
									 	<tr>
									 		<th>Type</th>
									 		<th>Country</th>
									 		<th>Province</th>
									 		<th>City</th>
									 		<th>Address</th>
									 		<th>Zip Code</th>
									 	</tr>
									 	<?php foreach ($consultant['contactInfo']['addresses'] as $address) {
									 		?>
									 	<tr>
									 		<td><?php echo $address['type'];?></td>
									 		<td><?php echo $address['country'];?></td>
									 		<td><?php echo $address['province'];?></td>
									 		<td><?php echo $address['city'];?></td>
									 		<td><?php echo $address['address'];?></td>
									 		<td><?php echo $address['zipCode'];?></td>
									 	</tr>
									 	<?php }?>
									</table>
								</div>
							</div>
					    </div>
					    <div class="tab-pane tab-pane-override" id="phonenumbers">
							<div class="row">
								<div class="col-md-12">
									<a id="add-phonenumber-button" name="add-phonenumber-button" 
									class="btn btn-default btn-xs">
									Add Phone Number
									</a>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 panel panel-default" id="add-phonenumber-form" style="display: none;margin-top: 10px;">
									<table class="table table-responsive table-no-topborder">
										<tr>
											<td>Type</td>
											<td><input type="text" id="phonetype" name="phonetype" class="form-control input-sm full-width" /></td>
											<td>Country Code</td>
											<td><input type="text" id="countrycode" name="countrycode" class="form-control input-sm full-width" /></td>
										</tr>
										<tr>
											<td>Area Code</td>
											<td><input type="text" id="areacode" name="areacode" class="form-control input-sm full-width" /></td>
											<td>Phone Number</td>
											<td><input type="text" id="phonenumber" name="phonenumber" class="form-control input-sm full-width" /></td>
										</tr>
										<tr>
											<td colspan="4">
												<a id="savephonenumber" name="savephonenumber" class="btn btn-primary btn-sm">Save</a>
												<a id="cancelsavephonenumber" name="cancelsavephonenumber" class="btn btn-default btn-sm">Cancel</a>
											</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="row">
								<div id="phonenumber-list" class="col-md-12" style="margin-top: 10px;">
									<table class="table table-striped table-bordered">
									 	<tr>
									 		<th>Type</th>
									 		<th>Country Code</th>
									 		<th>Area Code</th>
									 		<th>Phone No.</th>
									 	</tr>
									 	<?php foreach ($consultant['contactInfo']['phoneNumbers'] as $phoneNumbers) {
									 	?>
									 		<tr>
									 			<td><?php echo $phoneNumbers['type'];?></td>
									 			<td><?php echo $phoneNumbers['countryCode'];?></td>
									 			<td><?php echo $phoneNumbers['areaCode'];?></td>
									 			<td><?php echo $phoneNumbers['phoneNumber'];?></td>
									 		</tr>
									 	<?php }?>
									</table>
								</div>
							</div>
					    </div>
					    <div class="tab-pane tab-pane-override" id="imhandles">
							<div class="row">
								<div class="col-md-12">
									<a id="add-im-button" name="add-im-button" 
									class="btn btn-default btn-xs">
									Add IM Handle
									</a>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12  panel panel-default" id="add-imhandle-form" style="display: none;margin-top: 10px;">
									<table class="table table-responsive table-no-topborder">
										<tr>
											<td>Type</td>
											<td>
												<select id="imtype" name="imtype"
												 class="form-control input-sm">
												 	<option value="">--SELECT--</option>
													<option value="Skype">Skype</option>
													<option value="MSN">MSN</option>
													<option value="Yahoo Messenger">Yahoo Messenger</option>
													<option value="Google Talk">Google Talk</option>
													<option value="Viber">Viber</option>
													<option value="WhatsApp">WhatsApp</option> 
												</select>
											</td>
										</tr>
										<tr>
										<td>Handle</td>
											<td>
												<input type="text" id="imhandle" name="imhandle" class="form-control input-sm full-width" />
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<a id="saveimhandle" name="saveimhandle" class="btn btn-primary btn-sm">Save</a>
												<a id="cancelsaveimhandle" name="cancelsaveimhandle" class="btn btn-default btn-sm">Cancel</a>
											</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="row">
								<div id="imhandle-list" class="col-md-12" style="margin-top: 10px;">
									<table class="table table-striped table-bordered">
									 	<tr>
									 		<th>Type</th>
									 		<th>Handle</th>
									 	</tr>
									 	<?php foreach ($consultant['contactInfo']['imHandles'] as $imHandles) { ?>
									 	<tr>
									 		<td><?php echo $imHandles['type']; ?></td>
									 		<td><?php echo $imHandles['handle']; ?></td>
									 	</tr>	
									 	<?php } ?>
									</table>
								</div>
							</div>
					    </div>
					    <div class="tab-pane tab-pane-override" id="socialmedia">
							<div class="row">
								<div class="col-md-12">
									<a id="add-sm-button" name="add-sm-button" 
									class="btn btn-default btn-xs">
									Add Social Media
									</a>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 panel panel-default" id="add-socialmedia-form" style="display: none;margin-top: 10px;">
									<table class="table table-responsive table-no-topborder">
										<tr>
											<td>Type</td>
											<td>
												<select id="smtype" name="smtype"
												 class="form-control input-sm">
												 	<option value="">--SELECT--</option>
													<option value="LinkedIn">LinkedIn</option>
													<option value="Facebook">Facebook</option>
													<option value="Google Plus">Google Plus</option>
													<option value="Twitter">Twitter</option>
													<option value="Website">Website</option>
												</select>
											</td>
										</tr>
										<tr>
										<td>Account ID</td>
											<td>
												<input type="text" id="socialmediaaccountid" name="socialmediaaccountid" class="form-control input-sm full-width" />
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<a id="savesocialmedia" name="savesocialmedia" class="btn btn-primary btn-sm">Save</a>
												<a id="cancelsavesocialmedia" name="cancelsavesocialmedia" class="btn btn-default btn-sm">Cancel</a>
											</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="row">
								<div id="socialmedia-list" class="col-md-12" style="margin-top: 10px;">
									<table class="table table-striped table-bordered">
									 	<tr>
									 		<th>Type</th>
									 		<th>AccountId</th>
									 	</tr>
									 	<?php foreach ($consultant['contactInfo']['socialMediaAccounts'] as $socialMediaAccounts) { ?>
									 	<tr>
									 		<td><?php echo $socialMediaAccounts['type']; ?></td>
									 		<td><?php echo $socialMediaAccounts['accountId']; ?></td>
									 	</tr>	
									 	<?php } ?>
									</table>
								</div>
							</div>
					    </div>
					  </div>
        		</div>
        	</div>
      </div>
      <div class="modal-footer">
      	<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Contact Info Modal -->

<script type="text/javascript" src='<?php echo get_template_directory_uri(); ?>/js/consultant.js'></script>
