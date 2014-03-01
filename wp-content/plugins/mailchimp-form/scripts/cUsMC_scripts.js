
var cUsMC_myjq = jQuery.noConflict();

cUsMC_myjq(window).error(function(e){
    e.preventDefault();
});

cUsMC_myjq(document).ready(function($) {
    
    try{
        
        cUsMC_myjq( "#cUsMC_tabs" ).tabs({active: false});
        
        cUsMC_myjq("li.gotohelp a").unbind('click');
        
        cUsMC_myjq( "#cUsMC_exampletabs" ).tabs({active: false});
        cUsMC_myjq('.cUsMC_sendapikey').removeAttr('disabled');
        
        cUsMC_myjq('.selectable_cf, .selectable_tabs_cf').bxSlider({
            slideWidth: 160,
            minSlides: 4,
            maxSlides: 4,
            moveSlides:1,
            infiniteLoop:false,
            pager:false,
            slideMargin: 5
        });
        
        cUsMC_myjq('.template_slider_def, .slider-home, .slider-pages').bxSlider({
            slideWidth: 160,
            minSlides: 4,
            maxSlides: 4,
            moveSlides:1,
            infiniteLoop:false,
            preloadImages:'all', 
            pager:false,
            slideMargin: 5
        });
        
        
        cUsMC_myjq( '.bx-loading' ).hide();//possible js cache eL
        
        cUsMC_myjq( '.options' ).buttonset();
        
        cUsMC_myjq(".tooltip_vL").on('click',function(){
            cUsMC_myjq(".tooltip_mcvideo").tooltip("close");
            cUsMC_myjq(".ui-tooltip").hide();
        });
        
        cUsMC_myjq(".setLabels").tooltip();
        
        cUsMC_myjq(".tooltip_mcvideo").tooltip({
            position: {
                my: "center bottom-20",
                at: "center top",
                using: function( position, feedback ) {
                    cUsMC_myjq( this ).css( position );
                    cUsMC_myjq( "<div>" )
                    .addClass( "arrow" )
                    .addClass( feedback.vertical )
                    .addClass( feedback.horizontal )
                    .appendTo( this );
                }
            },
            content: function(){
                return '<h2 class="tooltip_title">Get your MailChimp api key</h2><span class="tooltip_content"><a href="javascript:;" class="tooltip_vL" id="video_mc_getapikey">Each MailChimp account can generate API keys that are unique to the account.</a></span>';
            }
        }).bind( "mouseleave", function( event ) { 
            event.stopImmediatePropagation(); 
            var fixed = setTimeout('cUsMC_myjq(".tooltip_mcvideo").tooltip("close")', 4000);
            cUsMC_myjq(".tooltip_mcvideo").hover( 
                function(){ 
                    clearTimeout (fixed);
                },
                function(){
                    cUsMC_myjq(".tooltip_mcvideo").tooltip("close");
                } 
            ); 
        });
        

        cUsMC_myjq("#video_mc_getapikey").fancybox({
            'href'	: 'http://vimeo.com/moogaloop.swf?clip_id=78596977',
            'type'	: 'swf',
            'height' : '85%',
            'overlayShow':true,
            'swf'			: {
                'wmode'		: 'transparent',
                'allowfullscreen'	: 'true'
            }
        });
        
        cUsMC_myjq(".tooltip_formsett").fancybox({
            href	: 'http://vimeo.com/moogaloop.swf?clip_id=78596976',
            type	: 'swf',
            height      : '85%',
            overlayShow:true,
            swf: {
                wmode: 'transparent',
                allowfullscreen: 'true'
            }
        });
        
        cUsMC_myjq(".toAdmin__").fancybox({
            'width' : '85%',
            'height' : '75%',
            'autoScale' : true,
            'transitionIn' : 'elastic',
            'transitionOut' : 'elastic',
            'type' : 'iframe',
            beforeShow: function(){
                var iSrc = cUsMC_myjq('.fancybox-iframe').attr('src');
                var newHref = cUsMC_myjq(".toAdmin").attr('rel');
                cUsMC_myjq('.fancybox-iframe').attr({'src':iSrc+newHref});
            },
            afterClose: function(){
                //alert('Closed');
                //cUsMC_myjq( "#dialog-message" ).dialog('close');
            }
        });
        
        cUsMC_myjq(".toDash___").fancybox({
            'width' : '85%',
            'height' : '75%',
            'autoScale' : true,
            'transitionIn' : '',
            'transitionOut' : '',
            'type' : 'iframe',
            beforeShow: function(){
                var iSrc = cUsMC_myjq('.fancybox-iframe').attr('src');
                
                try{
                    cUsMC_myjq.ajax({ type: "POST", dataType:'json', url: ajax_object.ajax_url, data: {action:'cUsMC_getCryptData'},
                        success: function(data) {
                            
                            switch(data.status){
                                case 1:

                                    linkHref = '&uE='+data.uE+"&uC="+data.uC;
                                    cUsMC_myjq('.fancybox-iframe').attr({'src':iSrc+linkHref});
                                break;
                                case 2:
                                    //cUsMC_myjq('.fancybox-iframe').attr({'src':'http://www.contactus.com/test/client-login.php'});
                                    cUsMC_myjq('.fancybox-iframe').attr({'src':'http://www.contactus.com/login/'});
                                break;
                            }
                            
                        },
                        async: false
                    });
                }catch(e){
                    //console.log(e)
                }
                
            },
            afterClose: function(){
                //alert('Closed');
                //cUsMC_myjq( "#dialog-message" ).dialog('close');
            }
        });
        
        cUsMC_myjq( '.form_types' ).buttonset();//TEMPLATE SELECTION
        cUsMC_myjq ('.form_types input[type=radio]').change(function() {
            var form_type = this.value;
            cUsMC_myjq('#Template_Desktop_Form').val('');//RESET ON CHANGE
            cUsMC_myjq('#Template_Desktop_Tab').val('');//RESET ON CHANGE
            switch(form_type){
                case 'contact_form': 
                    cUsMC_myjq( '.Template_Contact_Form' ).fadeIn();
                    cUsMC_myjq( '.Template_Newsletter_Form' ).hide();
                    break;
                case 'newsletter_form':
                    cUsMC_myjq( '.Template_Newsletter_Form' ).fadeIn();
                    cUsMC_myjq( '.Template_Contact_Form' ).hide();
                    break;
            }
        });
        
        cUsMC_myjq(".selectable_cf, .selectable_news").selectable({//SELECTED CONTACT FORM TEMPLATE
            selected: function(event, ui) {
                var idEl = cUsMC_myjq(ui.selected).attr('id');
                cUsMC_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");           
                cUsMC_myjq('#Template_Desktop_Form').val(idEl);           
            }                   
        });
        
        cUsMC_myjq(".selectable_tabs_cf, .selectable_tabs_news").selectable({//SELECTED FORM TAB TEMPLATE
            selected: function(event, ui) {
                var idEl = cUsMC_myjq(ui.selected).attr('id');
                cUsMC_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");           
                cUsMC_myjq('#Template_Desktop_Tab').val(idEl);           
            }                   
        });
        
        cUsMC_myjq(".selectable_ucf, .selectable_unews").selectable({//SELECTED CONTACT FORM TEMPLATE
            selected: function(event, ui) {
                var idEl = cUsMC_myjq(ui.selected).attr('id');
                cUsMC_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");           
                cUsMC_myjq('#uTemplate_Desktop_Form').val(idEl);           
            }                   
        });
        
        cUsMC_myjq(".selectable_tabs_ucf, .selectable_tabs_unews").selectable({//SELECTED FORM TAB TEMPLATE
            selected: function(event, ui) {
                var idEl = cUsMC_myjq(ui.selected).attr('id');
                cUsMC_myjq(ui.selected).addClass("ui-selected").siblings().removeClass("ui-selected");           
                cUsMC_myjq('#uTemplate_Desktop_Tab').val(idEl);           
            }                   
        });
        
        cUsMC_myjq( '#inlineradio' ).buttonset();

        cUsMC_myjq( "#terminology" ).accordion({
            collapsible: true,
            heightStyle: "content",
            active: false,
            icons: { "header": "ui-icon-info", "activeHeader": "ui-icon-arrowreturnthick-1-n" }
        });
        
        cUsMC_myjq( "#user_forms" ).accordion({
            collapsible: true,
            heightStyle: "content",
            active: true,
            icons: { "header": "ui-icon-circle-plus", "activeHeader": "ui-icon-circle-minus" }
        });
        
        cUsMC_myjq( ".user_templates" ).accordion({
            collapsible: true,
            heightStyle: "content",
            icons: { "header": "ui-icon-circle-plus", "activeHeader": "ui-icon-circle-minus" }
        });
        
        cUsMC_myjq( "#form_examples, #tab_examples" ).accordion({
            collapsible: true,
            heightStyle: "content",
            icons: { "header": "ui-icon-info", "activeHeader": "ui-icon-arrowreturnthick-1-n" }
        });
        
        cUsMC_myjq( ".form_templates_aCc" ).accordion({
            collapsible: true,
            heightStyle: "content",
            icons: { "header": "ui-icon-wrench", "activeHeader": "ui-icon-shuffle" }
        });
        
        cUsMC_myjq( ".signup_templates" ).accordion({
            collapsible: true,
            heightStyle: "content",
            icons: { "header": "ui-icon-info", "activeHeader": "ui-icon-arrowreturnthick-1-n" }
        });
       
    }catch(err){
        cUsMC_myjq('.advice_notice').html('Oops, something wrong happened, please try again later!'+err).slideToggle();
    }
    
    
    //LOGIN ALREADY USERS
    cUsMC_myjq('.cUsMC_LoginUser').click(function(){
        var email = cUsMC_myjq('#login_email').val();
        var pass = cUsMC_myjq('#user_pass').val();
        cUsMC_myjq('.loadingMessage').show();
        
        if(!email.length){
            cUsMC_myjq('.advice_notice').html('User Email is a required and valid field!').slideToggle().delay(2000).fadeOut(2000);
            cUsMC_myjq('#login_email').focus();
            cUsMC_myjq('.loadingMessage').fadeOut();
        }else if(!pass.length){
            cUsMC_myjq('.advice_notice').html('User password is a required field!').slideToggle().delay(2000).fadeOut(2000);
            cUsMC_myjq('#user_pass').focus();
            cUsMC_myjq('.loadingMessage').fadeOut();
        }else{
            var bValid = checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. sergio@jquery.com" );  
            if(!bValid){
                cUsMC_myjq('.advice_notice').html('Please enter a valid User Email!').slideToggle().delay(2000).fadeOut(2000);
                cUsMC_myjq('.loadingMessage').fadeOut();
            }else{
                
                cUsMC_myjq('.cUsMC_LoginUser').html('Loading . . .').attr({disabled:'disabled'});
                
                cUsMC_myjq.ajax({ type: "POST", dataType:'json', url: ajax_object.ajax_url, data: {action:'cUsMC_loginAlreadyUser',email:email,pass:pass},
                    success: function(data) {

                        switch(data.status){
                            case 1:
                                
                                cUsMC_myjq('.cUsMC_LoginUser').html('Success . . .').removeAttr('disabled');;
                                
                                message = '<p>Welcome to ContactUs.com.</p>';
                                
                                setTimeout(function(){
                                    cUsMC_myjq('#cUsMC_loginform').slideUp().fadeOut();
                                    location.reload();
                                    
                                    cUsMC_myjq('.loadingMessage').fadeOut();
                                    
                                },1500)
                                cUsMC_myjq('.advice_notice').hide();
                                cUsMC_myjq('.notice').html(message).show().delay(3000).fadeOut();
                                
                            break;
                            case 2:
                                
                                cUsMC_myjq('.cUsMC_LoginUser').html('Error . . .');
                                
                                message = '<p>Seems like you don\'t have one Default Newsletter Form in your ContactUs.com account!.</p>';
                                message += '<p>Please login into your admin panel <a href="libs/toAdmin.php?iframe" class="toAdmin">here</a> and add at least one to continue...</p>';
                                
                                //var linkHref =  cUsMC_myjq(".toAdmin").attr('href');
                                linkHref = cUsMC_myjq(".toAdmin").attr('href') + '&uE='+data.uE+"&uC="+data.uC;
                                
                                cUsMC_myjq(".toAdmin").attr({'href':linkHref})
                                
                                cUsMC_myjq.messageDialogLogin('Contact Form Required!');
                                
                                cUsMC_myjq('.cUsMC_LoginUser').html('Login').removeAttr('disabled');
                                
                                //cUsMC_myjq('.advice_notice').html(message).show().delay(6000).fadeOut();
                                
                                cUsMC_myjq('.loadingMessage').fadeOut();
                                
                            break;
                            case 3:
                                cUsMC_myjq('.cUsMC_LoginUser').html('Login').removeAttr('disabled');
                                message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + data.message + '</b>. <br/> Please try again!</a></p>';
                                cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                                cUsMC_myjq('.loadingMessage').fadeOut();
                            break;
                            default:
                                cUsMC_myjq('.cUsMC_LoginUser').html('Login').removeAttr('disabled');
                                message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + data.message + '</b>. <br/> Please try again!</a></p>';
                                cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                                cUsMC_myjq('.loadingMessage').fadeOut();
                                break;
                        }
                        
                        
                        

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                            cUsMC_myjq('.cUsMC_LoginUser').val('Login').removeAttr('disabled');
                            message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + xhr.status + ' - '+ thrownError +'</b>. <br/> Please try again!</a></p>';
                            cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                            cUsMC_myjq('.loadingMessage').fadeOut();
                    },
                    async: false
                });
            }
        }
    });
    
    //SENT API CREDENTIALS
    cUsMC_myjq('.cUsMC_SentCredentials').click(function(){
        
        var email = cUsMC_myjq('#c_login_email').val();
        var bValid = checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. sergio@jquery.com" );  
        cUsMC_myjq('.loadingMessage').show();
        
        if(!email.length){
                cUsMC_myjq('.advice_notice').html('ContactUs.com Email is required!').slideToggle().delay(2000).fadeOut(2000);
                cUsMC_myjq('#c_login_email').focus();
                cUsMC_myjq('.loadingMessage').fadeOut();
        }else if(!bValid){
                cUsMC_myjq('.advice_notice').html('Please enter a valid Email address!').slideToggle().delay(2000).fadeOut(2000);
                cUsMC_myjq('#c_login_email').focus();
                cUsMC_myjq('.loadingMessage').fadeOut();
        }else{
                
                cUsMC_myjq('.cUsMC_SentCredentials').val('Connecting. . .').attr({disabled:'disabled'});
                
                cUsMC_myjq.ajax({ type: "POST", dataType:'json', url: ajax_object.ajax_url, data: {action:'cUsMC_SentCredentials',email:email},
                    success: function(data) {
                        
                        if(data.status){
                            switch(data.status){
                                case 1:

                                    cUsMC_myjq('.cUsMC_SentCredentials').html('Success . . .').removeAttr('disabled');
                                    
                                    cUsMC_myjq('.sendcredentials').slideUp().fadeOut();
                                    cUsMC_myjq('.cUsMC_save_cred').slideDown().delay(800);
                                    
                                    cUsMC_myjq('.loadingMessage').fadeOut();

                                break;
                                case 2:

                                    cUsMC_myjq('.cUsMC_SentCredentials').val('Sent my Credentials').removeAttr('disabled');
                                    message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + data.message + '</b>. <br/> Please try again!</a></p>';
                                    cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                                    cUsMC_myjq('.loadingMessage').fadeOut();

                                break;
                                default:
                                    cUsMC_myjq('.cUsMC_SentCredentials').html('Login').removeAttr('disabled');
                                    message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + data.message + '</b>. <br/> Please try again!</a></p>';
                                    cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                                    cUsMC_myjq('.loadingMessage').fadeOut();
                                    break;
                            }
                        }else{
                            cUsMC_myjq('.cUsMC_SentCredentials').val('Sent my Credentials').removeAttr('disabled');
                            message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + data.message + '</b>. <br/> Please try again!</a></p>';
                            cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                            cUsMC_myjq('.loadingMessage').fadeOut();
                        }

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                            cUsMC_myjq('.cUsMC_SentCredentials').val('Sent my Credentials').removeAttr('disabled');
                            message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + xhr.status + ' - '+ thrownError +'</b>. <br/> Please try again!</a></p>';
                            cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                            cUsMC_myjq('.loadingMessage').fadeOut();
                    },
                    async: false
                });
            
        }
    });
    
    //SAVE API CREDENTIALS
    cUsMC_myjq('.cUsMC_UpdateCredentials').click(function(){
        
        var API_Account = cUsMC_myjq('#API_Account').val();
        var API_Key = cUsMC_myjq('#API_Key').val();
        
        if(!API_Account.length){
            cUsMC_myjq('.advice_notice').html('ContactUs.com API_Account is required!').slideToggle().delay(2000).fadeOut(2000);
            cUsMC_myjq('#API_Account').focus();
        }else if(!API_Key.length){
            cUsMC_myjq('.advice_notice').html('ContactUs.com API_Key is required!').slideToggle().delay(2000).fadeOut(2000);
            cUsMC_myjq('#API_Key').focus();
        }else{
            
                cUsMC_myjq('.loadingMessage').show();
                
                cUsMC_myjq('.cUsMC_UpdateCredentials').val('Connecting. . .').attr({disabled:'disabled'});
                
                cUsMC_myjq.ajax({ type: "POST", dataType:'json', url: ajax_object.ajax_url, data: {action:'cUsMC_UpdateCredentials',API_Account:API_Account, API_Key:API_Key},
                    success: function(data) {
                        
                        if(data.status){
                            switch(data.status){
                                case 1:

                                    cUsMC_myjq('.cUsMC_UpdateCredentials').html('Success . . .').removeAttr('disabled');
                                    
                                    message = '<p>Welcome to MailChimp Form v2.0 by ContactUs.com.</p>';
                                    cUsMC_myjq('.notice').html(message).show().delay(10000).fadeOut();
                                    
                                    
                                    setTimeout(function(){
                                        cUsMC_myjq('.cUsMC_save_cred').slideUp().fadeOut();
                                        location.reload();

                                        cUsMC_myjq('.loadingMessage').fadeOut();

                                    },1500);
                                    

                                break;
                                case 2:

                                    cUsMC_myjq('.cUsMC_UpdateCredentials').val('Save my Credentials').removeAttr('disabled');
                                    message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + data.message + '</b>. <br/> Please try again!</a></p>';
                                    cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                                    cUsMC_myjq('.loadingMessage').fadeOut();

                                break;
                                default:
                                    cUsMC_myjq('.cUsMC_UpdateCredentials').val('Save my Credentials').removeAttr('disabled');
                                    message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + data.message + '</b>. <br/> Please try again!</a></p>';
                                    cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                                    cUsMC_myjq('.loadingMessage').fadeOut();
                                    break;
                            }
                        }else{
                            cUsMC_myjq('.cUsMC_UpdateCredentials').val('Save my Credentials').removeAttr('disabled');
                            message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + data.message + '</b>. <br/> Please try again!</a></p>';
                            cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                            cUsMC_myjq('.loadingMessage').fadeOut();
                        }

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                            cUsMC_myjq('.cUsMC_UpdateCredentials').val('Save my Credentials').removeAttr('disabled');
                            message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + xhr.status + ' - '+ thrownError +'</b>. <br/> Please try again!</a></p>';
                            cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                            cUsMC_myjq('.loadingMessage').fadeOut();
                    },
                    async: false
                });
        }
    });
    
    
    //SEND API KEY AJAX CALL /////// STEP 1
    try{ 
       cUsMC_myjq('.cUsMC_sendMCpikey').click(function() {
           
           var mcApiKey = cUsMC_myjq('#mc_apikey').val();
           var postData = {};
           
           if(!mcApiKey.length){
               cUsMC_myjq.messageDialog('Required Fields', 'MailChimp API Key is a required field!');
               cUsMC_myjq('#mc_apikey').focus();
           }else{
               
                cUsMC_myjq('.cUsMC_sendMCpikey').val('Loading . . .').attr({disabled:'disabled'});
                cUsMC_myjq('.loadingMessage').show();
                
                postData = {action: 'cUsMC_checkMCapikey_step1', apikey:mcApiKey};
                
                cUsMC_myjq.ajax({ type: "POST", dataType:'json', url: ajax_object.ajax_url, data: postData,
                    success: function(data) {
                        
                        switch(data.status){
                            case 1:
                                message = "Seem like you don't have a ContactUs.com Account, SignUp now, It's Free";
                                cUsMC_myjq('.cUsMC_sendMCpikey').val('Connected . . .');
                                cUsMC_myjq('.advice_notice').html(message).show().delay(6000).fadeOut(800);
                                
                                setTimeout(function(){
                                    
                                    cUsMC_myjq('.loadingMessage').fadeOut();
                                    
                                    cUsMC_myjq('#listid').html(data.options);
                                    cUsMC_myjq('#cUsMC_first_name').val(data.fname);
                                    cUsMC_myjq('#cUsMC_last_name').val(data.lname);
                                    cUsMC_myjq('#cUsMC_email').val(data.email);

                                    cUsMC_myjq('.mc_connect').slideUp().fadeOut();
                                    cUsMC_myjq('.step1').slideDown().delay(800);
                                    
                                },2000);
                                
                            break;
                            case 2:
                                message = 'Welcome Contactus.com User, please login below!';
                                cUsMC_myjq('.advice_notice').hide();
                                cUsMC_myjq('.notice').html(message).show().delay(5000).fadeOut(800);
                                cUsMC_myjq('#login_email').val(data.email).focus();
                                cUsMC_myjq('.loadingMessage').fadeOut();
                                cUsMC_myjq('.cUsMC_sendMCpikey').val('Connected . . .').removeAttr('disabled');
                                
                                setTimeout(function(){

                                    cUsMC_myjq('.mc_connect').slideUp().fadeOut();
                                    cUsMC_myjq('.login_form').slideDown().delay(800);
                                    
                                },2000);
                                
                                
                            break;
                            case 3:
                                cUsMC_myjq('.user-data').fadeIn();
                                cUsMC_myjq('.cUsMC_sendMCpikey').val('If your name is correct, please continue to Step 2').removeAttr('disabled');
                                cUsMC_myjq('.loadingMessage').fadeOut();
                            break;
                            default:
                                message = 'There something wrong with your MailChimp API Key, please try again!';
                                cUsMC_myjq('#apikey').focus();
                                cUsMC_myjq('.advice_notice').html(message).show().delay(2300).fadeOut(800);
                                cUsMC_myjq('.cUsMC_sendMCpikey').val('Connect').removeAttr('disabled');
                                cUsMC_myjq('.loadingMessage').fadeOut();
                                break;
                        }
                        
                        

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                            cUsMC_myjq('.cUsMC_sendMCpikey').val('Connect').removeAttr('disabled');
                            message = '<p>Ouch! unfortunately there has being an error during the application: <br/> <br/> <b>' + xhr.status + ' - '+ thrownError +'</b>. <br/> Please try again!</a></p>';
                            cUsMC_myjq('.advice_notice').html(message).show().delay(10000).fadeOut();
                            cUsMC_myjq('.loadingMessage').fadeOut();
                    },
                    fail: function(){
                       message = '<p>Ouch! unfortunately there has being an error during the application. Please try again!</a></p>';
                       cUsMC_myjq('.cUsMC_sendMCpikey').val('Connect').removeAttr('disabled'); 
                    }
                });
           }
           
            
       });
       
    }catch(err){
        cUsMC_myjq('.advice_notice').html('Oops, something wrong happened, please try again later!').slideToggle().delay(3000).fadeOut(2000);
    }
    
    //SEND API KEY AJAX CALL /////// STEP 1
    try{ 
       cUsMC_myjq('.cUsMC_sendapikey').click(function() {
           
           var mcApiKey = cUsMC_myjq('#apikey').val();
           var mcFname = cUsMC_myjq('#cUsMC_first_name').val();
           var mcLname = cUsMC_myjq('#cUsMC_last_name').val();
           var postData = {};
           cUsMC_myjq('.advice_notice').hide();
           
           if(!mcApiKey.length){
               cUsMC_myjq('.advice_notice').html('MailChimp API Key is a required field!').slideToggle().delay(3000).fadeOut(2000);
               cUsMC_myjq('#apikey').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else{
               
                cUsMC_myjq('.cUsMC_sendapikey').val('Loading . . .').attr({disabled:'disabled'});
                cUsMC_myjq('.loadingMessage').show();
                
                
                postData = {action: 'cUsMC_checkMCapikey', apikey:mcApiKey};
                
                
                cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: postData,
                    success: function(data) {
                        
                        switch(data){
                            case '1':
                                message = 'You are already logged into you MailChimp account, please continue with next steps.';
                                cUsMC_myjq('.cUsMC_sendapikey').val('Connected . . .');
                                setTimeout(function(){
                                    cUsMC_getMClist(mcApiKey);
                                },2000)
                            break;
                            case '2':
                                message = 'There something wrong with your MailChimp API Key, please try again!';
                                cUsMC_myjq('#apikey').focus();
                                cUsMC_myjq('.advice_notice').html(message).show().delay(2300).fadeOut(800);
                                cUsMC_myjq('.cUsMC_sendapikey').val('Continue to Step 2').removeAttr('disabled');
                            break;
                            case '3':
                                cUsMC_myjq('.user-data').fadeIn();
                                cUsMC_myjq('.cUsMC_sendapikey').val('If your name is correct, please continue to Step 2').removeAttr('disabled');
                            break;
                            default:
                                message = 'There something wrong with your MailChimp API Key, please try again!';
                                cUsMC_myjq('#apikey').focus();
                                cUsMC_myjq('.advice_notice').html(message).show().delay(2300).fadeOut(800);
                                cUsMC_myjq('.cUsMC_sendapikey').val('Continue to Step 2').removeAttr('disabled');
                                break;
                        }
                        
                        cUsMC_myjq('.loadingMessage').fadeOut();

                    },
                    fail: function(){
                       message = '<p>Ouch! unfortunately there has being an error during the application. Please try again!</a></p>';
                       cUsMC_myjq('.cUsMC_sendapikey').val('Continue to Step 3').removeAttr('disabled'); 
                    }
                });
           }
           
            
       });
       
       function cUsMC_getMClist(mcApiKey){
           if(!mcApiKey) return false;
           cUsMC_myjq('.loadingMessage').show();
           cUsMC_myjq('.cUsMC_sendapikey').val('Loading Lists. . .')
           cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, dataType: 'json', data: {action:'cUsMC_getMCList',apikey:mcApiKey},
                success: function(data) {
                    switch(data.status){
                        case 1:
                            message = "Seems like you don't have Contact List in you MailChimp Account, please add at least one <a href='http://admin.mailchimp.com/lists/' target='_blank'>here</a> to continue.";
                            cUsMC_myjq('.advice_notice').html(message).slideToggle();
                            
                            cUsMC_myjq('.cUsMC_sendapikey').val('Reloading . . .');
                            
                            setTimeout(function(){
                                cUsMC_myjq('.cUsMC_sendapikey').val('Continue to Step 2').removeAttr('disabled');
                            },3000)
                            
                        break;
                        case 2:
                            message = 'There something wrong with your MailChimp API Key, please try again!';
                            cUsMC_myjq('#apikey').focus();
                            cUsMC_myjq('.advice_notice').html(message).slideToggle().delay(3300).fadeOut(600);
                        break;
                        default:
                            
                            cUsMC_myjq('#listid').html(data.options);
                            cUsMC_myjq('#cUsMC_first_name').val(data.fname);
                            cUsMC_myjq('#cUsMC_last_name').val(data.lname);
                            cUsMC_myjq('#cUsMC_email').val(data.email);
                            
                            
                            cUsMC_myjq('.step1').slideUp().fadeOut();
                            cUsMC_myjq('.step2').slideDown().delay(800);
                        break;
                    }
                    cUsMC_myjq('.loadingMessage').fadeOut();

                },fail: function(){
                   message = '<p>Ouch! unfortunately there has being an error during the application. Please try again!</a></p>';
                   cUsMC_myjq('.cUsMC_sendapikey').val('Continue to Step 3').removeAttr('disabled'); 
                }
            });
       }
       
    }catch(err){
        cUsMC_myjq('.advice_notice').html('Oops, something wrong happened, please try again later!').slideToggle().delay(3000).fadeOut(2000);
    }
    
    
    //SENT LIST ID AJAX CALL /// STEP 2
    try{
        cUsMC_myjq('.cUsMC_Sendlistid').click(function() {
            
           var postData = {};
           
           var mcFname = cUsMC_myjq('#cUsMC_first_name').val();
           var mcLname = cUsMC_myjq('#cUsMC_last_name').val();
           var mcEmail = cUsMC_myjq('#cUsMC_email').val();
           var mcWebsite = cUsMC_myjq('#cUsMC_web').val();
           var cUsMC_webValid = checkURL(mcWebsite);
           
           var mcApiKey = cUsMC_myjq('#apikey').val();
           var mcListID = cUsMC_myjq('#listid').val();
           var mcListName = cUsMC_myjq('#listid option:selected').text();
           cUsMC_myjq('.loadingMessage').show();
           
           if(!mcListName.length){
               cUsMC_myjq('.advice_notice').html('MailChimp List is a required field!').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#listid').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else if(!mcEmail.length){
               cUsMC_myjq('.advice_notice').html('Email is a required field!').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#apikey').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else if( !mcFname.length){
               cUsMC_myjq('.advice_notice').html('Your First Name is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#cUsMC_first_name').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else if( !mcLname.length){
               cUsMC_myjq('.advice_notice').html('Your Last Name is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#cUsMC_last_name').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else if(!mcWebsite.length){
               cUsMC_myjq('.advice_notice').html('Your Website is a required field').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#cUsMC_web').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else if(!cUsMC_webValid){
               cUsMC_myjq('.advice_notice').html('Please, enter one valid website URL').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('#cUsMC_web').focus();
               cUsMC_myjq('.loadingMessage').fadeOut();
           }else{
                cUsMC_myjq('.cUsMC_Sendlistid').val('Loading . . .').attr({disabled:'disabled'});
                
                postData = {action: 'cUsMC_sendClientList', fName:str_clean(mcFname),lName:str_clean(mcLname),listID:mcListID,mcListName:mcListName,Email:mcEmail,website:mcWebsite}
                
                cUsMC_myjq.ajax({ 
                    type: "POST", 
                    url: ajax_object.ajax_url,
                    data: postData,
                    success: function(data) {

                        switch(data){
                            case '1':
                                message = '<h4>Loading Templates . . .</h4>';
                                setTimeout(function(){
                                    cUsMC_myjq('.step1').slideUp().fadeOut();
                                    cUsMC_myjq('.step2').slideDown().delay(800);
                                },3000) 
                            break;
                             
                            default:
                                message = '<p>Ouch! unfortunately there has being an error during the application: <b>' + data + '</b>. Please try again!</a></p>';
                                cUsMC_myjq('.cUsMC_Sendlistid').val('Select Templates').removeAttr('disabled');
                            break;
                        }
                        
                        cUsMC_myjq('.loadingMessage').fadeOut();
                        cUsMC_myjq('.advice_notice').html(message).show().delay(4000).fadeOut(2000);

                    },
                    fail: function(){
                       message = '<p>Ouch! unfortunately there has being an error during the application. Please try again!</a></p>';
                       cUsMC_myjq('.cUsMC_Sendlistid').val('Select Templates').removeAttr('disabled'); 
                    }
                });
           }
           
            
        });
    }catch(err){
        cUsMC_myjq('.advice_notice').html('Oops, something wrong happened, please try again later!').slideToggle().delay(2000).fadeOut(2000);
        cUsMC_myjq('.cUsMC_Sendlistid').val('Select Templates').removeAttr('disabled'); 
    }
    

    
    try{ cUsMC_myjq('#cUsMC_SendTemplates').click(function() {
           
           var Template_Desktop_Form = cUsMC_myjq('#Template_Desktop_Form').val();
           var Template_Desktop_Tab = cUsMC_myjq('#Template_Desktop_Tab').val();
           cUsMC_myjq('.loadingMessage').show();
           
           if(!Template_Desktop_Form.length){
               cUsMC_myjq('.advice_notice').html('Please select your Form Template').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('.loadingMessage').fadeOut();
               cUsMC_myjq( ".signup_templates" ).accordion({ active: 0 });
           }else if(!Template_Desktop_Tab.length){
               cUsMC_myjq('.advice_notice').html('Please select your Tab Template').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('.loadingMessage').fadeOut();
               cUsMC_myjq( ".signup_templates" ).accordion({ active: 1 });
           }else{
                
                cUsMC_myjq('#cUsMC_SendTemplates').val('Loading . . .').attr({disabled:'disabled'});
                
                cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_createCustomer',Template_Desktop_Form:Template_Desktop_Form,Template_Desktop_Tab:Template_Desktop_Tab},
                    success: function(data) {

                        switch(data){
                            case '1':
                                message = '<p>Template saved succesfuly . . . .</p>';
                                message += '<p>Welcome to ContactUs.com, and thank you for your registration.</p>';
                                
                                setTimeout(function(){
                                    cUsMC_myjq('.step3').slideUp().fadeOut();
                                    cUsMC_myjq('.step4').slideDown().delay(800);
                                    location.reload();
                                },2000)
                                break;
                             case '2':
                                message = 'Seems like you already have one Contactus.com Account, Please Login below!';
                                cUsMC_myjq('#cUsMC_SendTemplates').val('Build my account').removeAttr('disabled'); 
                                setTimeout(function(){
                                    cUsMC_myjq('#login_email').val(cUsMC_myjq('#cUsMC_email').val()).focus();
                                    cUsMC_myjq('#cUsMC_userdata').fadeOut();
                                    cUsMC_myjq('#cUsMC_settings').slideDown('slow');
                                    cUsMC_myjq('#cUsMC_loginform').delay(1000).fadeIn();
                                },2000)
                                break;  
                            default:
                                message = '<p>Ouch! unfortunately there has being an error during the application: <b>' + data + '</b>. Please try again!</a></p>';
                                cUsMC_myjq('#cUsMC_SendTemplates').val('Build my account').removeAttr('disabled'); 
                                break;
                        }
                        
                        cUsMC_myjq('.loadingMessage').fadeOut();
                        cUsMC_myjq('.advice_notice').html(message).show().delay(1900).fadeOut(800);

                    },
                    async: false
                });
           }
           
            
        });
    }catch(err){
        cUsMC_myjq('.advice_notice').html('Oops, something wrong happened, please try again later!').slideToggle().delay(2000).fadeOut(2000);
        cUsMC_myjq('#cUsMC_SendTemplates').val('Build my account').removeAttr('disabled'); 
    }
    
    //UPDATE TEMPLATES FOR ALREADY USERS
    try{ cUsMC_myjq('#cUsMC_UpdateTemplates').click(function() {
           
           var Template_Desktop_Form = cUsMC_myjq('#uTemplate_Desktop_Form').val();
           var Template_Desktop_Tab = cUsMC_myjq('#uTemplate_Desktop_Tab').val();
           cUsMC_myjq('.loadingMessage').show();
           
           if(!Template_Desktop_Form.length){
               cUsMC_myjq('.advice_notice').html('Please select your Contact Us Template form').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('.loadingMessage').fadeOut();
               cUsMC_myjq( "#form_examples" ).accordion({ active: 0 });
           }else if(!Template_Desktop_Tab.length){
               cUsMC_myjq('.advice_notice').html('Please select your Contact Us Button Tab Template').slideToggle().delay(2000).fadeOut(2000);
               cUsMC_myjq('.loadingMessage').fadeOut();
               cUsMC_myjq( "#form_examples" ).accordion({ active: 1 });
           }else{
                
                cUsMC_myjq('#cUsMC_UpdateTemplates').val('Loading . . .').attr({disabled:'disabled'});
                
                cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_UpdateTemplates',Template_Desktop_Form:Template_Desktop_Form,Template_Desktop_Tab:Template_Desktop_Tab},
                    success: function(data) {

                        switch(data){
                            case '1':
                                message = '<p>Template saved succesfuly . . . .</p>';
                                
                                setTimeout(function(){
                                    cUsMC_myjq('.step3').slideUp().fadeOut();
                                    cUsMC_myjq('.step4').slideDown().delay(800);
                                    location.reload();
                                },2000)
                                break;
                             
                            default:
                                message = '<p>Ouch! unfortunately there has being an error during the application: <b>' + data + '</b>. Please try again!</a></p>';
                                cUsMC_myjq('#cUsMC_UpdateTemplates').val('Update my template').removeAttr('disabled'); 
                                break;
                        }
                        
                        cUsMC_myjq('.loadingMessage').fadeOut();
                        cUsMC_myjq('.advice_notice').html(message).show().delay(1900).fadeOut(800);

                    },
                    async: false
                });
           }
           
            
        });
    }catch(err){
        cUsMC_myjq('.advice_notice').html('Oops, something wrong happened, please try again later!').slideToggle().delay(2000).fadeOut(2000);
        cUsMC_myjq('#cUsMC_UpdateTemplates').val('Update my template').removeAttr('disabled'); 
    }
    
    try{ cUsMC_myjq('.load_def_formkey').click(function() { //loading default template
            
        cUsMC_myjq('.loadingMessage').show();
          
        cUsMC_myjq('.load_def_formkey').html('Loading . . .');

        cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_LoadDefaultKey'},
            success: function(data) {

                switch(data){
                    case '1':
                        message = '<p>New form Loaded correctly. . . .</p>';
                        cUsMC_myjq('.load_def_formkey').html('Completed . . .');
                        setTimeout(function(){
                            location.reload();
                        },2000)
                        break;
                }

                cUsMC_myjq('.loadingMessage').fadeOut();
                cUsMC_myjq('.advice_notice').html(message).show().delay(1900).fadeOut(800);
                 

            },
            async: false
        });
           
            
        });
    }catch(err){
        cUsMC_myjq('.advice_notice').html('Oops, something wrong happened, please try again later!').slideToggle().delay(2000).fadeOut(2000);
        cUsMC_myjq('.load_def_formkey').html('Update my template'); 
    }
    
    
    cUsMC_myjq.changePageSettings = function(pageID, cus_version, form_key) { //loading default template
        
        if(!cus_version.length){
            cUsMC_myjq('.advice_notice').html('Please select TAB or INLINE').slideToggle().delay(2000).fadeOut(2000);
        }else if(!form_key.length){
            cUsMC_myjq('.advice_notice').html('Please select your Contact Us Form Template').slideToggle().delay(2000).fadeOut(2000);
        }else{
            
            cUsMC_myjq('.save_message_'+pageID).show();
            
            cUsMC_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_changePageSettings',pageID:pageID,cus_version:cus_version, form_key:form_key },
                success: function(data) {

                    switch(data){
                        case '1':
                            message = '<p>Saved Successfully . . . .</p>';
                            cUsMC_myjq('.save_message_'+pageID).html(message);
                            cUsMC_myjq('.save-page-'+pageID).val('Completed . . .');

                            setTimeout(function(){
                                cUsMC_myjq('.save_message_'+pageID).fadeOut();
                                cUsMC_myjq('.save-page-'+pageID).val('Save');
                                cUsMC_myjq('.form-templates-'+pageID).slideUp();
                            },2000);

                            break
                    }

                },
                async: false
            });
        }  
            
    }
    
    cUsMC_myjq.deletePageSettings = function(pageID) { //loading default template

        cUsMC_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_deletePageSettings',pageID:pageID},
            success: function(data) {

                //console.log('Success . . .');

            },
            async: false
        });
           
            
    }
    
    
    //CHANGE FORM TEMPLATES
    cUsMC_myjq.changeFormTemplate = function(formID, form_key, Template_Desktop_Form) { //loading default template
        
        if(!Template_Desktop_Form.length || !form_key.length){
            cUsMC_myjq('.advice_notice').html('Please select your Contact Us Form Template').slideToggle().delay(2000).fadeOut(2000);
        }else{
            
            cUsMC_myjq('.save_message_'+formID).show();
            
            cUsMC_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_changeFormTemplate',Template_Desktop_Form:Template_Desktop_Form, form_key:form_key },
                success: function(data) {

                    switch(data){
                        case '1':
                            message = '<p>Saved Successfully . . . .</p>';
                            cUsMC_myjq('.save_message_'+formID).html(message);
                            cUsMC_myjq('.form_thumb_'+formID).attr('src','https://admin.contactus.com/popup/tpl/'+Template_Desktop_Form+'/scr.png');

                            setTimeout(function(){
                                cUsMC_myjq('.save_message_'+formID).fadeOut();
                            },2000);

                            break
                    }

                },
                async: false
            });
        }  
            
    }
    
    //CHANGE FORM TEMPLATES
    cUsMC_myjq.changeTabTemplate = function(formID, form_key, Template_Desktop_Tab) { //loading default template
        
        
        if(!Template_Desktop_Tab.length || !form_key.length){
            cUsMC_myjq('.advice_notice').html('Please select your Contact Us Tab Template').slideToggle().delay(2000).fadeOut(2000);
        }else{
            
            cUsMC_myjq('.save_tab_message_'+formID).show();
            
            cUsMC_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_changeTabTemplate',Template_Desktop_Tab:Template_Desktop_Tab, form_key:form_key },
                success: function(data) {

                    switch(data){
                        case '1':
                            message = '<p>Saved Successfully . . . .</p>';
                            cUsMC_myjq('.save_tab_message_'+formID).html(message);
                            cUsMC_myjq('.tab_thumb_'+formID).attr('src','https://admin.contactus.com/popup/tpl/'+Template_Desktop_Tab+'/scr.png');

                            setTimeout(function(){
                                cUsMC_myjq('.save_tab_message_'+formID).fadeOut();
                            },2000);

                            break
                    }

                },
                async: false
            });
        }  
            
    }
    
    //UPDATE DELIVERY OPTIONS
    cUsMC_myjq.updateDeliveryOptions = function(formID, form_key, MC_listID, mc_apikey) { //loading default template
        
        if(!MC_listID.length){
            //cUsMC_myjq('.advice_notice').html('Please select your Clients List').slideToggle().delay(2000).fadeOut(2000);
            
            cUsMC_myjq.messageDialog('Required Fields', 'Please select your Clients List');
            
        }else{
            
            cUsMC_myjq('.update_deliv_message_'+formID).show();
            
            try{
               cUsMC_myjq.ajax({type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_updateDeliveryOptions',MC_listID:MC_listID, form_key:form_key, MC_apikey:mc_apikey },
               
                    success: function(data) {

                        switch(data){
                            case '1':
                                message = '<p>Delivery options updated successfully . . . .</p>';
                                cUsMC_myjq('.update_deliv_message_'+formID).html(message);

                                setTimeout(function(){
                                    cUsMC_myjq('.update_deliv_message_'+formID).fadeOut();
                                },2000);

                                break
                            default:
                                cUsMC_myjq('.update_deliv_message_'+formID).html(data);

                                setTimeout(function(){
                                    cUsMC_myjq('.update_deliv_message_'+formID).fadeOut();
                                },8000);
                                break;
                        }

                    },
                    async: false
                });
                
            }catch(e){
                
                cUsMC_myjq('.update_deliv_message_'+formID).html(e);
                
                setTimeout(function(){
                    cUsMC_myjq('.update_deliv_message_'+formID).fadeOut();
                },2000);
            }
            
        }  
            
    }
    
    //GET MC SUSCRIBERS LIST LIST
    cUsMC_myjq.getMailChimpLists = function(formID, mc_apikey) { //loading default template
        
        if(!mc_apikey.length){
            cUsMC_myjq.messageDialog('Required Fields', 'MailChimp API KEY is a required field');
        }else{
            
            cUsMC_myjq('.update_deliv_message_'+formID).show();
            
            try{
               cUsMC_myjq.ajax({type: "POST", dataType: 'json', url: ajax_object.ajax_url, data: {action:'cUsMC_getMCListByKEY', MC_apikey:mc_apikey },
               
                    success: function(data) {

                        switch(data.status){
                            case 1 :
                                message = '<p>Subscribers List Loaded . . . .</p>';
                                cUsMC_myjq('.update_deliv_message_'+formID).html(message);
                                
                                cUsMC_myjq('#user_listid_'+formID).html(data.options);
                                
                                setTimeout(function(){
                                    cUsMC_myjq('.update_deliv_message_'+formID).fadeOut();
                                },2000);

                                break
                            default:
                                cUsMC_myjq('.update_deliv_message_'+formID).html(data.message);

                                setTimeout(function(){
                                    cUsMC_myjq('.update_deliv_message_'+formID).fadeOut();
                                },8000);
                                break;
                        }

                    },
                    async: false
                });
                
            }catch(e){
                
                cUsMC_myjq('.update_deliv_message_'+formID).html(e);
                
                setTimeout(function(){
                    cUsMC_myjq('.update_deliv_message_'+formID).fadeOut();
                },2000);
            }
            
        }  
            
    }
    
    cUsMC_myjq.messageDialog = function(title, msg){
        try{
            cUsMC_myjq( "#dialog-message" ).html(msg);
            cUsMC_myjq( "#dialog-message" ).dialog({
                modal: true,
                title: title,
                minWidth: 520,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        }catch(err){
            //console.log(err);
        }
        
    }
    
    cUsMC_myjq.messageDialogLogin = function(title){
        try{
            cUsMC_myjq( "#dialog-message" ).dialog({
                modal: true,
                title: title,
                minWidth: 520,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        }catch(err){
            //console.log(err);
        }
        
    }
    
    cUsMC_myjq('.cUsMC_LogoutUser').click(function(){
        
        
        cUsMC_myjq( "#dialog-message" ).html('Are you sure you want to quit from MailChimp Form?');
        cUsMC_myjq( "#dialog-message" ).dialog({
            resizable: false,
            width:430,
            title: 'Close your account session?',
            height:180,
            modal: true,
            buttons: {
                "Yes": function() {
                    
                    cUsMC_myjq('.loadingMessage').show();
                    cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_logoutUser'},
                        success: function(data) {
                            cUsMC_myjq('.loadingMessage').fadeOut();
                              location.reload();
                        },
                        async: false
                    });
                    
                    cUsMC_myjq( this ).dialog( "close" );
                    
                },
                Cancel: function() {
                    cUsMC_myjq( this ).dialog( "close" );
                }
            }
        });
        
    });
    
    cUsMC_myjq('.form_version').click(function(){
        
        var value = cUsMC_myjq(this).val();
        var msg = '';
        switch(value){
            case 'select_version':
                msg = '<p>You are about to change to Custom Form Settings. You need to choose what forms go on each page or home page</p>';
                break;
            case 'tab_version':
                msg = '<p>You are about to change to Default Form Settings, only your Default form will show up in all of your site</p>';
                break;
        }
        
        cUsMC_myjq( "#dialog-message" ).html(msg);
        cUsMC_myjq( "#dialog-message" ).dialog({
            resizable: false,
            width:430,
            title: 'Change your Form Settings?',
            height:180,
            modal: true,
            buttons: {
                "Yes": function() {
                    
                    switch(value){
                        case 'select_version':
                            cUsMC_myjq('.tab_button').addClass('gray').removeClass('green').removeAttr('disabled');
                            cUsMC_myjq('.custom').addClass('green').removeClass('disabled').attr({disabled:'disabled'});

                            cUsMC_myjq('.loadingMessage').show();
                            cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_saveCustomSettings',cus_version:'selectable',tab_user:0},
                                success: function(data) {
                                    cUsMC_myjq('.loadingMessage').fadeOut();
                                    cUsMC_myjq('.notice_success').html('<p>Custom settings saved . . .</p>').fadeIn().delay(2000).fadeOut(2000);
                                    //location.reload();
                                },
                                async: false
                            });

                            break;
                        case 'tab_version':
                            cUsMC_myjq('.custom').addClass('gray').removeClass('green').removeAttr('disabled');
                            cUsMC_myjq('.tab_button').removeClass('gray').addClass('green').attr({disabled:'disabled'});

                            cUsMC_myjq('.loadingMessage').show();
                            cUsMC_myjq.ajax({ type: "POST", url: ajax_object.ajax_url, data: {action:'cUsMC_saveCustomSettings',cus_version:'tab',tab_user:1},
                                success: function(data) {
                                    cUsMC_myjq('.loadingMessage').fadeOut();
                                    cUsMC_myjq('.notice_success').html('<p>Tab settings saved . . .</p><p>Your default Contact Form will appear in all your website.</p>').fadeIn().delay(5000).fadeOut(2000);
                                    //location.reload();
                                },
                                async: false
                            });

                            break;
                    }

                    cUsMC_myjq('.cus_versionform').fadeOut();
                    cUsMC_myjq('.' + value).fadeToggle();
                    
                    cUsMC_myjq( this ).dialog( "close" );
                    
                },
                Cancel: function() {
                    cUsMC_myjq( this ).dialog( "close" );
                }
            }
        });
        
    });
   
    
//    cUsMC_myjq('.tab_button').click(function(){
//        //var value = cUsMC_myjq(this).val();
//        //cUsMC_myjq('.tab_user').val(value);
//        cUsMC_myjq('.loadingMessage').show();
//       
//        setTimeout(function(){
//            cUsMC_myjq('#cUsMC_button').submit();
//        },1500);
//        
//    });
//    
//    cUsMC_myjq('.custom').click(function(){
//       
//        
//    });
    
    cUsMC_myjq('.btab_enabled').click(function(){
        var value = cUsMC_myjq(this).val();
        cUsMC_myjq('.tab_user').val(value);
        cUsMC_myjq('.loadingMessage').show();
       
        setTimeout(function(){
            cUsMC_myjq('#cUsMC_button').submit();
        },1500);
        
    });
    
    cUsMC_myjq('#contactus_settings_page').change(function(){
        cUsMC_myjq('.show_preview').fadeOut();
        cUsMC_myjq('.save_page').fadeOut( "highlight" ).fadeIn().val('>> Save your settings');
    });
    
    cUsMC_myjq('.callout-button').click(function() {
        cUsMC_myjq('.getting_wpr').slideToggle('slow');
    });
    
    cUsMC_myjq('#cUsMC_yes').click(function() {
        cUsMC_myjq('#cUsMC_userdata, #cUsMC_templates').fadeOut();
        cUsMC_myjq('#cUsMC_settings').slideDown('slow');
        cUsMC_myjq('#cUsMC_loginform').delay(600).fadeIn();
        
        cUsMC_myjq(this).addClass('active');
        cUsMC_myjq('#cUsMC_no').removeClass('active');
        
    });
    cUsMC_myjq('#cUsMC_no').click(function() {
        cUsMC_myjq('#cUsMC_loginform, #cUsMC_templates').fadeOut();
        cUsMC_myjq('#cUsMC_settings').slideDown('slow');
        cUsMC_myjq('#cUsMC_userdata').delay(600).fadeIn();
        
        cUsMC_myjq(this).addClass('active');
        cUsMC_myjq('#cUsMC_yes').removeClass('active');
        
    });
    
//    cUsMC_myjq('.examples_gallery').fancybox({
//        helpers: {
//            title : {
//                type : 'float'
//            }
//        }
//    });
    
    cUsMC_myjq('.form_template, .step2').css("display","none");
    
    function checkRegexp( o, regexp, n ) {
        if ( !( regexp.test( o ) ) ) {
            return false;
        } else {
            return true;
        }
    }
    
    function checkURL(url) {
        return /^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/.test(url);
    }
    
    function str_clean(str){
           
        str = str.replace("'" , " ");
        str = str.replace("," , "");
        str = str.replace("\"" , "");
        str = str.replace("/" , "");

        return str;
    }
    
    cUsMC_myjq('.insertShortcode').click(function(){
        //console.log('Code')
    });
    
    function contactUs_mediainsert() {
        //console.log('sentTo');
        send_to_editor('[show-contactus.com-form]');
    }
    
    
    
});
