	$(document).ready(function(){
		
		$('#testbutton').click(function(){
			alert(wp_urls.wp_full_site_uri);
		});
		
		$('#consultingopplink').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#consultingOpportunityModal').modal({keyboard:false});
		});

		$('#consultingOpportunityModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			
		});

		$('#consultantslink').click(function(){
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#consultantsModal').modal({keyboard:false});
		});

		$('#consultantsModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			
		});

		$('#bpopartnerlink').click(function(){
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#bpoPartnerModal').modal({keyboard:false});
		});

		$('#bpoPartnerModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			
		});


		//$('#signuplink').click(function(){
		//	$('html').css('overflow-y', 'hidden');
		//	$('html').css('margin-right', '15px');
		//	$('#subscribeModal').modal({keyboard:false});
		//});

		$('#subscribeModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			
		});

		$('#signuplink').click(function(){
			
			var email = $('#emailaddresstext').val();
			if(email == ''){
				alert('Please enter your email address.');
				return;
			}
			$('#signuplink').attr('disabled','disabled');
			 $.ajax({
			        url: '<?php echo get_template_directory_uri(); ?>/codes/mailchimp/ajax.php',
			        type: "post",
			        data: { "email" : email },
			        error: function() {
			            alert('detail ajax call error.');
			        },
			        success: function(data) {
				        if(data.length > 0) {
			        		$('#signuplink').removeAttr('disabled');
			        			alert('You have been subscribed to Spokiyo Newsletter. Thank you.');
			        		$('#emailaddresstext').val('');
				        }
			        	//window.location.href="sign-up-complete/";
			        }
			    });
						
		});

		$('#signupbutton').click(function() {

			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#signupModal').modal({keyboard:false});
			loadcaptchacode();
		});

		$('#loginbutton').click(function() {
			$('html').css('overflow-y', 'hidden');
			$('html').css('margin-right', '15px');
			$('#loginModal').modal({keyboard:false});
		});

		
		$('#signupModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			$('div.has-error').removeClass('has-error');
			$('#iagree').removeClass('agree-checkbox-invalid');
			clearsignupform();
		});
		
		$('#loginModal').on('hidden.bs.modal', function (e) {
			$('html').css('margin-right', '0');
			$('html').css('overflow-y', 'auto');
			$('div.has-error').removeClass('has-error');
			clearloginform();
		});
		
		//Validations

		$('#joinbutton').click(function(e){
			var isvalid = true;
			var notemptylist = ['firstname','lastname','email','username','password','retypepassword','captcha'];
			var messages = [];
 
			$('div.has-error').removeClass('has-error');
			$('#validation-messages').html('').removeClass('alert alert-danger');
			$('#iagree').removeClass('agree-checkbox-invalid');
			
			$.each(notemptylist, function(k,v){
				if(!isnotempty(v)){
					isvalid = false;
					$('#'+v).parent().addClass('has-error');
				}
			});

			if(!$('#iagree').is(":checked")) {
				$('#iagree').addClass('agree-checkbox-invalid');
				isvalid = false;
			}
			
			var password, retypepassword;
			password = $('#password').val();
			retypepassword = $('#retypepassword').val();

			if($.trim(password) != $.trim(retypepassword)) {
				isvalid = false;
				messages.push('Password must match.');
			}

			if($.trim($('#captcha').val()).length > 0) {
				$.ajax({
					url: wp_urls.wp_template_uri + '/codes/validatecaptcha.php',
					type: "POST",
					async: false,
					cache: false,
					data: { "captcha": $('#captcha').val() },
					error: function() {
						alert('detail ajax call error.');
					},
					success: function(result) {
						if(result == '-1') {
							isvalid = false;
							messages.push('Invalid captcha code.');
							$('#captcha').parent().addClass('has-error');
							loadcaptchacode();
						}
					}
				});
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
				var firstname = $.trim($('#firstname').val());
				var lastname = $.trim($('#lastname').val());
				var username = $.trim($('#username').val());
				var password = $.trim($('#password').val());
				var email = $.trim($('#email').val());
				disableallcontrols(notemptylist);
				$.ajax({
			        url: 'create-consultant-ajax',
			        type: "post",
			        dataType: "html",
			        data: { 
			        		"createhiddenflag":"create",  
			        		"firstname": firstname,
			        		"lastname":lastname,
			        		"username":username,
			        		"password":password,
			        		"email":email
			        },
			        cache: true,
			        error: function() {
			            alert('detail ajax call error.');
			        },
			        success: function(data) {
			            if($.trim(data) == "1") {
			            	enableallcontrols(notemptylist);
			            	$('#register-consultant-form').submit();
			            } else {
			            	alert('else');
			            }
			            enableallcontrols(notemptylist);
			        }
			    });
			}
		});
		
		$('#consultantloginbutton').click(function(e){
			var isvalid = true;
			var notemptylist = ['loginusername','loginpassword'];

			$('div.has-error').removeClass('has-error');
			
			$.each(notemptylist, function(k,v){
				if(!isnotempty(v)){
					isvalid = false;
					$('#'+v).parent().addClass('has-error');
				}
			});
			
			if(isvalid) {
				var uname = $.trim($('#loginusername').val());
				var pass = $.trim($('#loginpassword').val());
				$.ajax({
			        url: wp_urls.wp_full_site_uri + '/ajax-index',
			        type: "post",
			        dataType: "html",
			        data: { 
			        		"method": 'loginuseraccount',
			        		"username":uname,
			        		"password":pass
			        },
			        cache: true,
			        error: function() {
			            alert('detail ajax call error.');
			        },
			        success: function(data) {
			        	if($.trim(data) === "authenticated") {
			        		window.location = 'consultant-page';
			        	} else {
			        		alert('login not authenticated.');
			        	}
			        }
			    });
			}

		});

	});

	function isnotempty(fieldname) {
		var value = $('#'+fieldname).val();
		return $.trim(value) != '';
	}
	
	function disableallcontrols(list){
		$.each(list, function(k, v){
			$('#'+v).attr('disabled', true);
		});
	}
	
	function enableallcontrols(list){
		$.each(list, function(k, v){
			$('#'+v).removeAttr('disabled');
		});
	}
	
	function loadcaptchacode() {
		$.ajax({
			url: wp_urls.wp_template_uri + '/codes/captcha.php',
			type: "GET",
			cache: false,
			error: function() {
				alert('detail ajax call error.');
			},
			success: function(result) {
				var d = new Date();
				$('#captchaimage').attr('src', wp_urls.wp_template_uri + '/codes/captcha.php?'+ d.getMilliseconds());
			}
		});
	}
	
	function clearloginform() {
		$('#loginusername').val('');
		$('#loginpassword').val('');
	}

	function clearsignupform() {
		$('#firstname').val('');
		$('#lastname').val('');
		$('#username').val('');
		$('#email').val('');
		$('#password').val('');
		$('#retypepassword').val('');
		$('#captcha').val('');
		$("iagree").attr('checked', false); 
	}