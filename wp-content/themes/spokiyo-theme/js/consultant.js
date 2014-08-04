	$(document).ready(function() {

		/* START - Initialize Date Pickers */
		var educstartdate = $('#educationstartdate').datepicker()
			.on('changeDate', function(ev) {
				educstartdate.hide();
		}).data('datepicker');
				
		var educenddate = $('#educationenddate').datepicker()
			.on('changeDate', function(ev) {
				educenddate.hide();
		}).data('datepicker');

		var expstartdate = $('#employmentstartdate').datepicker()
		.on('changeDate', function(ev) {
			expstartdate.hide();
		}).data('datepicker');
				
		var expenddate = $('#employmentenddate').datepicker()
			.on('changeDate', function(ev) {
				expenddate.hide();
		}).data('datepicker');

		var educenddate = $('#birthdate').datepicker()
		.on('changeDate', function(ev) {
			educenddate.hide();
		}).data('datepicker');
		/* END - Initialize Date Pickers */

		/* Tab */
		$('#content-tab a:first').tab('show');
		$('#contact-tab a:first').tab('show');
		/* Tab */
		
		/* START - Edit Picture on hover */
		$('#picture-container').on("mouseenter", function () {
			$('#picture-edit-button').css('display','inline-block');
		}).on("mouseleave", function () {
			$('#picture-edit-button').css('display','none');
		}); 
		/* END - Edit Picture on hover */
		
		/* START - Edit on hover */
		$('#personal').on("mouseenter", function () {
			$('#personal-edit-button').css('display','inline-block');
		}).on("mouseleave", function () {
			$('#personal-edit-button').css('display','none');
		}); 
		
		$('#contacts-container').on("mouseenter", function () {
			$('#edit-contactinfo-button').css('display','inline-block');
		}).on("mouseleave", function () {
			$('#edit-contactinfo-button').css('display','none');
		});

		$('#consultingpreference').on("mouseenter", function () {
			$('#consultingpreference-edit-button').css('display','inline-block');
		}).on("mouseleave", function () {
			$('#consultingpreference-edit-button').css('display','none');
		});

		/* END - Edit on hover */

		/* START - Modal Popup */
		$('#addeducationbutton').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#educationModal').modal({keyboard:false});
		});

		$('#educationModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			cleareducationform();
		});
		
		$('#addexperiencebutton').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#employmentHistoryModal').modal({keyboard:false});
		});

		$('#employmentHistoryModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			clearexperienceform();
		});
		
		$('#personal-edit-button').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#personalTabModal').modal({keyboard:false});
			$('#birthdate').val($('#dateOfBirthView').text());
			$('#maritalstatus').val($('#maritalStatusView').text());
		});		

		$('#personalTabModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
		});

		$('#add-affiliation-button').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#affiliationsTabModal').modal({keyboard:false});
		});		

		$('#affiliationsTabModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
		});

		/*$('#financialinfo-edit-button').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#financialInfoTabModal').modal({keyboard:false});
		});*/		

		$('#financialInfoTabModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			clearbankaccountform();
		});	
		
		$('#add-financialinfo-button').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#financialInfoTabModal').modal({keyboard:false});
		});		

		$('#financialInfoTabModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
		});	
	
		$('#add-connection-button').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#connectionsTabModal').modal({keyboard:false});
		});		

		$('#connectionsTabModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
		});
		
		$('#consultingpreference-edit-button').click(function() {
			$.ajax({
		        url: wp_urls.wp_full_site_uri + '/ajax-index',
		        type: "post",
		        data: { 
		        		"method" : 'loadconsultingpreference', 
		        		"id" : $('#uaid').val()
		        },
		        error: function() {
		            alert('detail ajax call error.');
		        },
		        success: function(result) {
		        	var data = JSON.parse(result);
		        	$('#availability').val(data['availability']);
	        		$('#rate').val(data['hourlyRate']);
	        		$('#typeofwork').val(data['typeOfWork']);
	        		$('#workshift').val(data['shift']);

					$('html').css('overflow-y', 'hidden');
					$('html').css('margin-right', '15px');
					$('#consultingPreferenceTabModal').modal({keyboard:false});
		        }
		    });
		});		

		$('#consultingPreferenceTabModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
		});

		$('#bio-edit-button').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			 $('#profilesummary').val($('#summaryview').text());
			$('#bioModal').modal({keyboard:false});
		});		

		$('#bioModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
		});

		$('#edit-contactinfo-button').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#contactInfoModal').modal({keyboard:false});
		});		

		$('#contactInfoModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
		});
		/* END - Modal Popup */

		/* ADD ADDRESS */
		$('#add-address-button').click(function(){
			$('#add-address-form').css('display','block');
			$('#address-list').css('display','none');
		});

		$('#cancelsaveaddress').click(function(){
			$('#add-address-form').css('display','none');
			$('#address-list').css('display','block');
		});
		
		$('#saveaddress').click(function() {
			
			$.ajax({
		        url: wp_urls.wp_full_site_uri + '/ajax-index',
		        type: "post",
		        data: { 
		        		"method" : 'updateaddress', 
		        		"id" : $('#uaid').val(), 
		        		"addresstype" : $('#addresstype').val(),
		        		"addresscountry" : $('#addresscountry').val(),
		        		"province" : $('#province').val(),
		        		"city" : $('#city').val(),
		        		"streetaddress" : $('#streetaddress').val(),
		        		"zipcode" : $('#zipcode').val()
		        },
		        error: function() {
		            alert('detail ajax call error.');
		        },
		        success: function(result) {
		        	var data = JSON.parse(result);
		        	if($.trim(data['ok']) == '1') {
		        		
		        		
		        		var html = "<table class='table table-striped table-bordered'>";
					 	html += "<tr><th>Type</th><th>Country</th><th>Province</th><th>City</th><th>Address</th><th>Zip Code</th></tr>";
					 	$.each(data['data'], function(k,v) {
					 		html += "<tr>";
					 		html += "<td>" + v.type + "</td>";
					 		html += "<td>" + v.country + "</td>";
					 		html += "<td>" + v.province + "</td>";
					 		html += "<td>" + v.city + "</td>";
					 		html += "<td>" + v.address + "</td>";
					 		html += "<td>" + v.zipCode + "</td>";
					 	    html += "</tr>";
						});
					 	html += "</table>";
		        		
					 	$('#address-list').html(html);
					 	clearaddaddressform();
		        		$('#add-address-form').css('display','none');
		    			$('#address-list').css('display','block');
		        	}
		        }
		    });
			
			
		});
		
		
		
		/* ADD ADDRESS */
		
		/* ADD PHONE NUMBER */
		$('#add-phonenumber-button').click(function(){
			$('#add-phonenumber-form').css('display','block');
			$('#phonenumber-list').css('display','none');
		});

		$('#cancelsavephonenumber').click(function(){
			$('#add-phonenumber-form').css('display','none');
			$('#phonenumber-list').css('display','block');
		});
		
		$('#savephonenumber').click(function() {
			
			$.ajax({
		        url: wp_urls.wp_full_site_uri + '/ajax-index',
		        type: "post",
		        data: { 
		        		"method" : 'updatephonenumber', 
		        		"id" : $('#uaid').val(), 
		        		"phonetype" : $('#phonetype').val(),
		        		"countrycode" : $('#countrycode').val(),
		        		"areacode" : $('#areacode').val(),
		        		"phonenumber" : $('#phonenumber').val()
		        },
		        error: function() {
		            alert('detail ajax call error.');
		        },
		        success: function(result) {
		        	var data = JSON.parse(result);
		        	if($.trim(data['ok']) == '1') {
		        		
		        		
		        		var html = "<table class='table table-striped table-bordered'>";
					 	html += "<tr><th>Type</th><th>Country Code</th><th>Area Code</th><th>Phone No.</th></tr>";
					 	$.each(data['data'], function(k,v) {
					 		html += "<tr>";
					 		html += "<td>" + v.type + "</td>";
					 		html += "<td>" + v.countryCode + "</td>";
					 		html += "<td>" + v.areaCode + "</td>";
					 		html += "<td>" + v.phoneNumber + "</td>";
					 	    html += "</tr>";
						});
					 	html += "</table>";
		        		
					 	$('#phonenumber-list').html(html);
					 	clearphonenumberform();
						$('#add-phonenumber-form').css('display','none');
						$('#phonenumber-list').css('display','block');
						loadcontacts();
		        	}
		        }
		    });
		});
		
		function clearphonenumberform() {
			$('#phonetype').val('');
    		$('#countrycode').val('');
    		$('#areacode').val('');
    		$('#phonenumber').val('');
		}
		
		/* ADD PHONE NUMBER */
		
		/* ADD IM HANDLE */
		$('#add-im-button').click(function(){
			$('#add-imhandle-form').css('display','block');
			$('#imhandle-list').css('display','none');
		});

		$('#cancelsaveimhandle').click(function(){
			$('#add-imhandle-form').css('display','none');
			$('#imhandle-list').css('display','block');
		});
		
		$('#saveimhandle').click(function() {
			
			$.ajax({
		        url: wp_urls.wp_full_site_uri + '/ajax-index',
		        type: "post",
		        data: { 
		        		"method" : 'updateimhandles', 
		        		"id" : $('#uaid').val(), 
		        		"imtype" : $('#imtype').val(),
		        		"imhandle" : $('#imhandle').val()
		        },
		        error: function() {
		            alert('detail ajax call error.');
		        },
		        success: function(result) {
		        	var data = JSON.parse(result);
		        	if($.trim(data['ok']) == '1') {
		        		var html = "<table class='table table-striped table-bordered'>";
					 	html += "<tr><th>Type</th><th>Handle</th></tr>";
					 	$.each(data['data'], function(k,v) {
					 		html += "<tr>";
					 		html += "<td>" + v.type + "</td>";
					 		html += "<td>" + v.handle + "</td>";
					 	    html += "</tr>";
						});
					 	html += "</table>";
		        		
					 	$('#imhandle-list').html(html);
					 	clearimhandleform();
					 	$('#add-imhandle-form').css('display','none');
						$('#imhandle-list').css('display','block');
						loadcontacts();
		        	}
		        }
		    });
		});
		
		function clearimhandleform() {
			$('#imtype').val('');
    		$('#imhandle').val('');		
		}
		/* ADD IM HANDLE */
		
		
		/* ADD SOCIAL MEDIA */
		$('#add-sm-button').click(function(){
			$('#add-socialmedia-form').css('display','block');
			$('#socialmedia-list').css('display','none');
		});

		$('#cancelsavesocialmedia').click(function(){
			$('#add-socialmedia-form').css('display','none');
			$('#socialmedia-list').css('display','block');
		});
		
		$('#savesocialmedia').click(function() {
			$.ajax({
		        url: wp_urls.wp_full_site_uri + '/ajax-index',
		        type: "post",
		        data: { 
		        		"method" : 'updatesocialmedia', 
		        		"id" : $('#uaid').val(), 
		        		"smtype" : $('#smtype').val(),
		        		"accountId" : $('#socialmediaaccountid').val()
		        },
		        error: function() {
		            alert('detail ajax call error.');
		        },
		        success: function(result) {
		        	var data = JSON.parse(result);
		        	if($.trim(data['ok']) == '1') {
		        		var html = "<table class='table table-striped table-bordered'>";
					 	html += "<tr><th>Type</th><th>AccountId</th></tr>";
					 	$.each(data['data'], function(k,v) {
					 		html += "<tr>";
					 		html += "<td>" + v.type + "</td>";
					 		html += "<td>" + v.accountId + "</td>";
					 	    html += "</tr>";
						});
					 	html += "</table>";
		        		
					 	$('#socialmedia-list').html(html);
					 	clearsocialmediaform();
					 	$('#add-socialmedia-form').css('display','none');
						$('#socialmedia-list').css('display','block');
						loadcontacts();
		        	}
		        }
		    });	
		});
		
		function clearsocialmediaform(){
			$('#smtype').val('');
    		$('#socialmediaaccountid').val('');
		}
		/* ADD SOCIAL MEDIA */
		
		/* SAVE BIO */
		$('#savebiobutton').click(function() {
			 $.ajax({
			        url: wp_urls.wp_full_site_uri + '/ajax-index',
			        type: "post",
			        data: { "method" : 'updateuseraccountbio', "id" : $('#uaid').val(), "bio" : $('#profilesummary').val() },
			        error: function(e) {
			            alert('detail ajax call error.');
			        },
			        success: function(result) {
			        	var data = JSON.parse(result);
			        	if($.trim(data['ok']) == '1') {
			        		$('#summaryview').text(data['data']);
			        		$('#profilesummary').val('');
			        		$('#bioModal').modal('hide');
			        	}
			        }
			    });
		});
		/* SAVE BIO */
		
		/* SAVE PERSONAL TAB */
		$('#savepersonaltab').click(function() {
			 $.ajax({
			        url: wp_urls.wp_full_site_uri + '/ajax-index',
			        type: "post",
			        data: { 
			        		"method" : 'updatepersonal', 
			        		"id" : $('#uaid').val(), 
			        		"dateOfBirth" : $('#birthdate').val(),
			        		"maritalStatus" : $('#maritalstatus').val()
			        },
			        error: function() {
			            alert('detail ajax call error.');
			        },
			        success: function(result) {
			        	var data = JSON.parse(result);
			        	if($.trim(data['ok']) == '1') {
			        		var updatedData = data['data'];
			        		$('#dateOfBirthView').text(updatedData['dateOfBirth']);
			        		$('#maritalStatusView').text(updatedData['maritalStatus']);
			        		$('#birthdate').val(updatedData['dateOfBirth']);
			        		$('#maritalstatus').val(updatedData['maritalStatus']);
			        		$('#personalTabModal').modal('hide');
			        	}
			        }
			    });
		});
		/* SAVE PERSONAL TAB */
		
		/* SAVE CONSULTING PREFERENCES */
		$('#saveconsultingpreftab').click(function() {
			 $.ajax({
			        url: wp_urls.wp_full_site_uri + '/ajax-index',
			        type: "post",
			        data: { 
			        		"method" : 'updateconsultingpref', 
			        		"id" : $('#uaid').val(), 
			        		"availability" : $('#availability').val(),
			        		"rate" : $('#rate').val(),
			        		"typeofwork" : $('#typeofwork').val(),
			        		"workshift" : $('#workshift').val()
			        },
			        error: function() {
			            alert('detail ajax call error.');
			        },
			        success: function(result) {
			        	var data = JSON.parse(result);
			        	if($.trim(data['ok']) == '1') {
			        		var updatedData = data['data'];
			        		$('#availabilityView').text(updatedData['availability']);
			        		$('#rateView').text(updatedData['hourlyRate']);
			        		$('#typeOfWorkView').text(updatedData['typeOfWork']);
			        		$('#workShiftView').text(updatedData['shift']);

			        		$('#consultingPreferenceTabModal').modal('hide');
			        	}
			        }
			    });
		});
		/* SAVE CONSULTING PREFERENCES */
		
		/* START - SAVE EMPLOYMENT HISTORY */
		$('#saveexperiencebutton').click(function() {
			 $.ajax({
			        url: wp_urls.wp_full_site_uri + '/ajax-index',
			        type: "post",
			        data: { 
			        		"method" : 'updateexperience', 
			        		"id" : $('#uaid').val(), 
			        		"company" : $('#companyname').val(),
			        		"role" : $('#employementrole').val(),
			        		"startDate" : $('#employmentstartdate').val(),
			        		"endDate" : $('#employmentenddate').val(),
			        		"experienceId" : $('#experienceIdHidden').val()
			        },
			        error: function() {
			            alert('detail ajax call error.');
			        },
			        success: function(result) {
			        	var data = JSON.parse(result);
			        	if($.trim(data['ok']) == '1') {
			        		$('#employmenthistory').html(renderemploymenthistory(data['data']));
			        		$('#employmentHistoryModal').modal('hide');
			        	}
			        }
			    });
		});
		
		
		function renderemploymenthistory(data){
			var html = '';
			$.each(data, function(k, v) {
				html +=  "<div class='row'" ;
				html += " onmouseenter=\"showExperienceEditButton('"+ v.id['$id'] +"')\"" ;
				html += " onmouseleave=\"hideExperienceEditButton('"+ v.id['$id'] +"')\"";
				html +=  " >";
				html +=  "<div class='col-md-3 experience-dates'>";
				html += v.formattedStartDate + " - " + v.formattedEndDate;
				html +=	"</div>";
				html +=	"<div class='col-md-9 experience-details'>";
				html += "<a class='btn btn-xs btn-default' id='"+ v.id['$id'] +"' style='display: none;float:right;' ";
				html += " onclick=\"showExperienceEditModal('"+ v .id['$id'] +"')\" >Edit</a>";
				html +=	"<span class='experience-role'>"+ v.role +"</span><br>";
				html +=	"<span class='experience-company'>"+ v.company +"</span>";
				html += "</div></div>";
			});
			return html;
		}
		/* END - SAVE EMPLOYMENT HISTORY */
		
		/* SAVE EDUCATION */
		$('#saveeducationbutton').click(function() {
			 $.ajax({
			        url: wp_urls.wp_full_site_uri + '/ajax-index',
			        type: "post",
			        data: { 
			        		"method" : 'updateeducation', 
			        		"id" : $('#uaid').val(), 
			        		"school" : $('#schoolname').val(),
			        		"qualification" : $('#qualification').val(),
			        		"field" : $('#educationfield').val(),
			        		"grade" : $('#educationgrade').val(),
			        		"startDate" : $('#educationstartdate').val(),
			        		"endDate" : $('#educationenddate').val(),
			        		"educationId" : $('#educationIdHidden').val()
			        },
			        error: function() {
			            alert('detail ajax call error.');
			        },
			        success: function(result) {
			        	var data = JSON.parse(result);
			        	if($.trim(data['ok']) == '1') {
			        		$('#educationhistory').html(rendereducation(data['data']));
			        		$('#educationModal').modal('hide');
			        	}
			        }
			    });
		});

		function rendereducation(data){
			var html = '';
			$.each(data, function(k, v) {
				html +=  "<div class='row'";
				html += " onmouseenter=\"showEditButton('" + v.id['$id'] + "')\" ";
				html += " onmouseleave=\"hideEditButton('"+ v.id['$id'] +"')\" ";
				html +=  " >";
				html +=  "<div class='col-md-3 education-dates'>";
				html += v.formattedStartDate + " - " + v.formattedEndDate;
				html +=	"</div>";
				html +=	"<div class='col-md-9 education-details'>";
				html += "<a class=\"btn btn-xs btn-default\" ";
				html += " id='"+ v.id['$id'] +"' ";
				html += " style=\"display: none;float:right;\" ";
				html += " onclick=\"showEducationEditModal('"+ v.id['$id'] +"')\" >Edit</a>";
				html +=	"<span class='education-qualification'>"+ v.qualificationText +"</span><br>";
				html +=	"<span class='education-school'>"+ v.school +"</span>";
				html += "</div></div>";
			});
			return html;
		}
		/* SAVE EDUCATION */
		
		/* SAVE FINANCIAL INFO */
		$('#save-financialinfo-button').click(function() {
			 $.ajax({
			        url: wp_urls.wp_full_site_uri + '/ajax-index',
			        type: "post",
			        data: { 
			        		"method" : 'updatefinancialinfo', 
			        		"id" : $('#uaid').val(), 
			        		"description" : $('#fortransactions').val(),
			        		"bankName" : $('#bankname').val(),
			        		"bankAccountNumber" : $('#accountnumber').val(),
			        		"creditCard" : $('#creditcard').val(),
			        		"creditCardType" : $('#creditcardtype').val(),
			        		"creditCardNumber" : $('#creditcardnumber').val(),
			        		"bankAccountId" : $('#bankAccountIdHidden').val()
			        },
			        error: function() {
			            alert('detail ajax call error.');
			        },
			        success: function(result) {
			        	var data = JSON.parse(result);
			        	if($.trim(data['ok']) == '1') {
			        		var html = '';
			        		$.each(data['data'], function(k, v) {
			        		html += "<div class='row'>";
				        	html += "<div class='col-md-12' ";
				        	html += " onmouseenter=\"showBankAccountEditButton('"+ v.id['$id'] +"')\" "; 
							html +=	" onmouseleave=\"hideBankAccountEditButton('"+ v.id['$id'] +"')\" >";
				        	html +=	"<a id='"+ v.id['$id'] +"' onclick=\"showBankAccountEditModal('"+ v.id['$id'] +"')\" style='display: none; float: right;' class='btn btn-xs btn-default'>Edit</a>";
				        	html +=	"<table class='table table-responsive table-override'>";
							html += "<tr>";
							html += 	"<td>For Transactions</td>";
							html += 	"<td>"+ v.description +"</td>";
							html += "</tr>";
							html += "<tr>";
							html += "<td>Bank Name</td>";
							html += "<td>"+v.bankName+"</td>";
							html += "</tr>";
							html += "<tr>";
							html += "<td>Bank Account Number</td>";
							html += "<td>"+ v.bankAccountNumber +"</td>";
							html += 		"</tr>";
							html += 		"<tr>";
							html +=  			"<td>Credit Card</td>";
							html +=  			"<td>"+v.creditCard+"</td>";
							html += 		"</tr>";
							html += 		"<tr>";
							html +=  			"<td>Credit Card Type</td>";
							html +=  			"<td>"+v.creditCardType+"</td>";
							html += 		"</tr>";
							html += 		"<tr>";
							html += 			"<td>Credit Card Number</td>";
							html += 			"<td>"+v.creditCardNumber+"</td>";
							html += 		"</tr>";
						 	html += "</table></div></div>";
			        		});
			        		
			        		$('#bankaccount-list').html(html);
			        		$('#financialInfoTabModal').modal('hide');
			        	}
			        }
			    });
		});
		/* SAVE FINANCIAL INFO */
		
		/*PENDING*/
		/* EDIT EMAIL BUTTON */
		$('#editemailbutton').click(function(e) {
			var currentText = $('#editemailbutton').text();
			if($.trim(currentText) == 'Edit') {
				$('#emailaddressview').css('display','none');
				$('#emailaddress').css('display','block');
				$('#editemailbutton').text('Save');
			} else {
				//Save here
				
				$('#emailaddressview').css('display','block');
				$('#emailaddress').css('display','none');
				$('#editemailbutton').text('Edit');
			}
			
		});
		/* EDIT EMAIL BUTTON */
		
		loadcontacts();
		
		$('#signout').click(signout);
		
	});

function signout(){
	/* START - SIGN OUT */
	$.ajax({
        url: wp_urls.wp_full_site_uri + '/sign-out',
        type: "post",
        data: { 
        },
        error: function() {
            alert('detail ajax call error.');
        },
        success: function(result) {
        	window.location.href = wp_urls.wp_full_site_uri;
        }
    });
	/* END - SIGN OUT */
}

function loadcontacts() {
	/* START - LOAD CONTACT DETAILS */
	$.ajax({
        url: wp_urls.wp_full_site_uri + '/ajax-index',
        type: "post",
        data: { 
        		"method" : 'loadcontacts', 
        		"id" : $('#uaid').val()
        },
        error: function() {
            alert('detail ajax call error.');
        },
        success: function(result) {
        	var data = JSON.parse(result);
        	var html = '';
        	$.each(data, function(k, v) {
				html += '<li class="icon '+v.icon+'">' + v.value + '</li>';
				
			});
        	$('#contacts-list').html(html);
        }
    });
	/* END - LOAD CONTACT DETAILS */
}

function showBankAccountEditButton(id) {
	$('#'+id).css('display', 'inline-block');
}

function hideBankAccountEditButton(id) {
	$('#'+id).css('display', 'none');
}

function showBankAccountEditModal(bankAccountId) {
	$.ajax({
        url: wp_urls.wp_full_site_uri + '/ajax-index',
        type: "post",
        data: { 
        		"method" : 'loadbankaccount', 
        		"id" : $('#uaid').val(),
        		"bankAccountId" : bankAccountId
        },
        error: function() {
            alert('detail ajax call error.');
        },
        success: function(result) {
        	var data = JSON.parse(result);
        	$('#fortransactions').val(data['description']);
        	$('#bankname').val(data['bankName']);
        	$('#accountnumber').val(data['bankAccountNumber']);
        	$('#creditcard').val(data['creditCard']);
        	$('#creditcardtype').val(data['creditCardType']);
        	$('#creditcardnumber').val(data['creditCardNumber']);
        	$('#bankAccountIdHidden').val(data['id']['$id']);
        	
        	$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#financialInfoTabModal').modal({keyboard:false});
        }
    });
}

function showExperienceEditButton(id) {
	$('#'+id).css('display', 'inline-block');
}

function hideExperienceEditButton(id) {
	$('#'+id).css('display', 'none');
}

function showExperienceEditModal(experienceId) {
	$.ajax({
        url: wp_urls.wp_full_site_uri + '/ajax-index',
        type: "post",
        data: { 
        		"method" : 'loadexperience', 
        		"id" : $('#uaid').val(),
        		"experienceId" : experienceId
        },
        error: function() {
            alert('detail ajax call error.');
        },
        success: function(result) {
        	var data = JSON.parse(result);
        	$('#companyname').val(data['company']);
        	$('#employementrole').val(data['role']);
        	$('#employmentstartdate').val(data['startDate']);
        	$('#employmentenddate').val(data['endDate']);
        	$('#experienceIdHidden').val(data['id']['$id']);

        	$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#employmentHistoryModal').modal({keyboard:false});
        }
    });
}

function showEditButton(id) {
	$('#'+id).css('display', 'inline-block');
}

function hideEditButton(id) {
	$('#'+id).css('display', 'none');
}

function showEducationEditModal(educationId) {
	$.ajax({
        url: wp_urls.wp_full_site_uri + '/ajax-index',
        type: "post",
        data: { 
        		"method" : 'loadeducation', 
        		"id" : $('#uaid').val(),
        		"educationId" : educationId
        },
        error: function() {
            alert('detail ajax call error.');
        },
        success: function(result) {
        	var data = JSON.parse(result);
        	$('#schoolname').val(data['school']);
        	$('#qualification').val(data['qualification']);
        	$('#educationfield').val(data['field']);
        	$('#educationgrade').val(data['grade']);
        	$('#educationstartdate').val(data['startDate']);
        	$('#educationenddate').val(data['endDate']);
        	
        	$('#educationIdHidden').val(data['id']['$id']);

        	$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#educationModal').modal({keyboard:false});
        }
    });
}

function cleareducationform() {
	$('#schoolname').val('');
	$('#qualification').val('');
	$('#educationfield').val('');
	$('#educationgrade').val('');
	$('#educationstartdate').val('');
	$('#educationenddate').val('');
	$('#educationIdHidden').val('');
}

function clearexperienceform() {
	$('#companyname').val('');
	$('#employementrole').val('');
	$('#employmentstartdate').val('');
	$('#employmentenddate').val('');
	$('#experienceIdHidden').val('');
}

function clearbankaccountform() {
	$('#fortransactions').val('');
	$('#bankname').val('');
	$('#accountnumber').val('');
	$('#creditcard').val('');
	$('#creditcardtype').val('');
	$('#creditcardnumber').val('');
	$('#bankAccountIdHidden').val('');
}

function clearaddaddressform(){
	$('#addresstype').val('');
	$('#addresscountry').val('');
	$('#province').val('');
	$('#city').val('');
	$('#streetaddress').val('');
	$('#zipcode').val('');	
}