<?php
/*
  Plugin Name: MailChimp Form by ContactUs.com
  Plugin URI:  http://help.contactus.com/hc/en-us/sections/200214566-MailChimp-Plugin-by-ContactUs-com
  Description: The MailChimp Form Plugin by ContactUs.com
  Author: contactus.com
  Version: 2.0
  Author URI: http://www.contactus.com/
  License: GPLv2 or later
*/

/*
  Copyright 2013  ContactUs.com  ( help.contacus.com )
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists('cUsComAPI_MC')) {
    require_once('libs/cusAPI.class.php');
}

if (!class_exists('mailchimpSF_MCAPI')) {
    require_once('libs/miniMCAPI.class.php');
}

//AJAX REQUEST HOOKS
require_once('contactus_mailchimp_ajx_request.php');

//WIDGET CALL
include_once('contactus_mailchimp_widget.php');

//ADMIN HOOKS
require_once('contactus_mailchimp_functions.php');

if (!function_exists('cUsMC_menu_render')) {

    function cUsMC_menu_render() {
        
        $cUsMC_api = new cUsComAPI_MC(); //CONTACTUS.   COM API
        
        $aryUserCredentials = get_option('cUsMC_settings_userCredentials'); //get the values, wont work the first time
        $cUs_API_Account    = $aryUserCredentials['API_Account'];
        $cUs_API_Key        = $aryUserCredentials['API_Key'];
        
        $options        = get_option('cUsMC_settings_userData'); //get the values, wont work the first time
        $formOptions    = get_option('cUsMC_FORM_settings');//GET THE NEW FORM OPTIONS
        
        $form_key       = get_option('cUsMC_settings_form_key');
        $cus_version    = $formOptions['cus_version'];
        
        $settingsMessage = '';
        $home_cus_version = '';
        
        ?>
        <div id="dialog-message">
            <p>Seems like you don't have a Default Newsletter Form in your ContactUs.com account!.</p>
            <p>To create a Newsletter Form in your ContactUs.com account <a href="<?php echo plugins_url('libs/toAdmin.php?iframe', __FILE__) ?>" target="_blank" class="toAdmin" rel="toAdmin"> click here</a>, go to Form Settings > "Add New Form" > "Add Newsletter Form > "Save" and try to login again. </p>
        </div>
        <script> var template_url = '<?php echo plugins_url(); ?>/mailchimp-form/'; </script>
        <div class="plugin_wrap">
            <div class="cUsMC_header">
                <h2>MailChimp <span> by</span><a href="http://www.contactus.com" target="_blank"><img src="<?php echo plugins_url('style/images/header-logo.png', __FILE__) ;  ?>"/></a> </h2>
                
                <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><a href="<?php echo plugins_url('libs/toAdmin.php?iframe&uE='.$cUs_API_Account.'&uC='.$cUs_API_Key, __FILE__) ?>" target="_blank" rel="toDash" class="toDash btn">Go to my Dashboard Analytics</a><?php } ?>
                
                <div class="social_shares">
                    <a href="http://on.fb.me/HqI1hd" target="_blank" title="Follow Us on Facebook for new product updates"><img src="<?php echo plugins_url('style/images/cu-facebook-m.png', __FILE__) ;  ?> " alt="Follow Us on Facebook for new product updates"/></a>
                    <a href="http://bit.ly/18DW6O4" target="_blank" title="Follow Us on Google+"><img src="<?php echo plugins_url('style/images/cu-googleplus-m.png', __FILE__) ;  ?> " /></a>
                    <a href="http://linkd.in/1ivr9kK" target="_blank" title="Follow Us on LinkedIn"><img src="<?php echo plugins_url('style/images/cu-linkedin-m.png', __FILE__) ;  ?> " /></a>
                    <a href="http://bit.ly/16NxNh5" target="_blank" title="Follow Us on Twitter"><img src="<?php echo plugins_url('style/images/cu-twitter-m.png', __FILE__) ;  ?> " /></a>
                    <a href="http://bit.ly/1dPwnub" target="_blank" title="Find tutorials on our Youtube channel"><img src="<?php echo plugins_url('style/images/cu-youtube-m.png', __FILE__) ;  ?> " alt="Find tutorials on our Youtube channel" /></a>
                </div>
                
            </div> 
            <div class="cUsMC_formset">
                <div id="cUsMC_tabs">
                    <ul>
                        <?php if ( ! strlen($form_key) ){ ?><li><a href="#tabs-1">MailChimp Form Plugin</a></li><?php }; ?>
                        <?php if ( strlen($form_key) && !strlen($cUs_API_Account) ){ ?><li><a href="#tabs-1">Update</a></li><?php } ?>
                        <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><li><a href="#tabs-1">Form Settings</a></li><?php } ?>
                        <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><li><a href="#tabs-2">Forms Library</a></li><?php } ?>
                        <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><li><a href="#tabs-3">Advanced</a></li><?php } ?>
                        <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><li class="gotohelp"><a href="http://help.contactus.com/hc/en-us/sections/200214566-MailChimp-Plugin-by-ContactUs-com" target="_blank">Documentation</a></li><?php } ?>
                        <?php if ( strlen($form_key) && strlen($cUs_API_Account) ){ ?><li><a href="#tabs-4">Account</a></li><?php } ?>
                    </ul>

                    <?php
                    if (!strlen($form_key)){ //NOT LOGGED
                        
                        global $current_user;
                        get_currentuserinfo();
                        
                        ?>
                    
                        <div id="tabs-1">
                            
                            <div class="left-content">
                                <div class="first_step">
                                    <h2>Welcome MailChimp User!</h2>
                                        
                                    <p>You'll need your MailChimp API key to connect your signup form to your MailChimp account</p>
                                </div>

                                <div id="cUsMC_settings">

                                    <div class="loadingMessage"></div>
                                    <div class="advice_notice">Advices....</div>
                                    <div class="notice">Ok....</div>
                                    
                                    <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_userdata" name="cUsMC_userdata" class="steps mc_connect" onsubmit="return false;">
                                        
                                        <table class="form-table">
                                            <tr>
                                                <th><label class="labelform" for="mc_apikey">Enter your MailChimp API Key</label></th>
                                                <td>
                                                    <input class="inputform" name="mc_apikey" id="mc_apikey" type="text" value="">
                                                    <br /><span> Where can I find my API Key? </span><a class="question tooltip tooltip_mcvideo" href="#" title="">?</a> - <a href="https://admin.mailchimp.com/account/api/" target="_blank" class="blue_link">Get My API Key</a>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <table class="form-table">    
                                            <tr>
                                                <th></th><td><input id="craccbtn" class="btn orange cUsMC_sendMCpikey" value="Connect" type="button" /></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <p class="small">We will use your API information get  your MailChimp mailing list options, account information and to retrieve your ContactUs.com user information. Your MailChimp account will remain secure.</p>
                                                    <p class="small">If you don't have a ContactUs.com account, you will be prompted to create a free account. You will also be granted access to our lead management dashboard, obtain form analytics, customization options and advanced plugin support.</p>
                                                    <p class="small">By creating an account with ContactUs.com you agree to our <a href="http://www.contactus.com/terms-of-service/" target="_blank" class="blue_link">terms and conditions</a> and our <a href="http://www.contactus.com/privacy-security/" target="_blank" class="blue_link">privacy policy</a>. We’re serious about protecting your information, and making sure it remains yours.</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                    

                                    <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_loginformd" name="cUsMC_loginform" class="steps login_form" onsubmit="return false;">
                                        <h3>ContactUs.com Login</h3>

                                        <table class="form-table">

                                            <tr>
                                                <th><label class="labelform" for="login_email">Email</label><br>
                                                <td><input class="inputform" name="cUsMC_settings[login_email]" id="login_email" type="text"></td>
                                            </tr>
                                            <tr>
                                                <th><label class="labelform" for="user_pass">Password</label></th>
                                                <td><input class="inputform" name="cUsMC_settings[user_pass]" id="user_pass" type="password"></td>
                                            </tr>
                                            <tr><th></th>
                                                <td>
                                                    <button id="loginbtn" class="btn orange cUsMC_LoginUser" value="Login" type="submit">Login</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>
                                                    <a href="http://www.contactus.com/login/" target="_blank">I forgot my password</a>
                                                </td>
                                            </tr>

                                        </table>
                                    </form>

                                    
                                    
                                    <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_sendlistid" name="cUsMC_sendkey" class="steps step1" onsubmit="return false;">
                                        <h3>1) Register for ContactUs.com</h3>
                                        
                                        <table class="form-table">
                                            <tr>
                                                <th><label class="labelform" for="listid">Select your MailChimp Subscribers List <a class="question tooltip tooltip_mcvideo" href="#" title="">?</a></label></th>
                                                <td>
                                                    <select name="listid" id="listid"></select>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <table class="form-table user-data">
                                            
                                            <h4>Please, check if your information is correct!</h4>
                                            
                                            <tr>
                                                <th><label class="labelform" for="cUsMC_first_name">Your First Name</label></th>
                                                <td><input class="inputform" name="cUsMC_first_name" id="cUsMC_first_name" type="text" value="<?php echo $current_user->user_firstname; ?>"></td>
                                            </tr>
                                            <tr>
                                                <th><label class="labelform" for="cUsMC_last_name">Your Last Name</label></th>
                                                <td><input class="inputform" name="cUsMC_last_name" id="cUsMC_last_name" type="text" value="<?php echo $current_user->user_lastname; ?>"></td>
                                            </tr>
                                            <tr>
                                                <th><label class="labelform" for="cUsMC_email">Your email</label></th>
                                                <td><input class="inputform" placeholder="Change your email if it is a different" name="cUsMC_email" id="cUsMC_email" type="text" value="<?php echo $current_user->user_email; ?>"><br /></td>
                                            </tr>
                                            <tr>
                                                <th><label class="labelform" for="cUsMC_web">Your Website</label></th>
                                                <td><input class="inputform" placeholder="Website (http://www.example.com)" name="cUsMC_web" id="cUsMC_web" type="text" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>"><br /></td>
                                            </tr>
                                        </table>
                                        <table class="form-table">
                                            <tr>
                                                <th></th><td><input id="craccbtn" class="btn orange cUsMC_Sendlistid" value="Select Templates" type="button" /></td>
                                            </tr>
                                        </table>
                                    </form>
                                    
                                    <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_templates" name="cUsMC_templates" class="steps step2" onsubmit="return false;">
                                        <h3>2) Let's create your first Form</h3>
                                       
                                        <div class="signup_templates">
                                            <h4>Select your Form Template</h4>

                                            <div>
                                                <div class="terminology_c Template_Contact_Form form_templates">
                                                    
                                                    <div class="template_slider slider_forms template_slider_def">
                                                        <?php
                                                        
                                                        $contacFormTemplates = $cUsMC_api->getTemplatesAndTabsAll('1', 'Template_Desktop_Form');
                                                        $contacFormTemplates = json_decode($contacFormTemplates);
                                                        $contacFormTemplates = $contacFormTemplates->data;
                                                        
                                                        if(is_array($contacFormTemplates)){
                                                                
                                                                foreach ($contacFormTemplates as $formTpl) {
                                                                    if ($formTpl->free){  ?>
                                                                    
                                                                    <span class="tpl item template-form" rel="<?php echo $formTpl->id; ?>">
                                                                        <img src="<?php echo $formTpl->thumbnail; ?>" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $formTpl->name; ?>" />
                                                                        <span class="captions">
                                                                            <p>
                                                                                Form Name:<?php echo $formTpl->name; ?>
                                                                            </p>
                                                                        </span>
                                                                        <span class="def_bak"></span>
                                                                    </span>

                                                                    <?php 
                                                                    
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </div>
                                                   
                                                </div>
                                                
                                                <script>
                                                    jQuery('.template-form').click(function(){
                                                        jQuery('#Template_Desktop_Form').val( jQuery(this).attr('rel') );
                                                        jQuery('.slider_forms .item').removeClass('default');
                                                        jQuery(this).addClass('default');
                                                    });
                                                </script>
                                                
                                                
                                                
                                            </div>
                                            <h4>Select your Tab Template</h4>
                                            <div>
                                                <div class="terminology_c Template_Contact_Form form_templates">
                                                    
                                                    
                                                    <div class="template_slider slider_tabs template_slider_def">
                                                        <?php
                                                        
                                                        $contacFormTabTemplates = $cUsMC_api->getTemplatesAndTabsAll('1', 'Template_Desktop_Tab');
                                                        $contacFormTabTemplates = json_decode($contacFormTabTemplates);
                                                        $contacFormTabTemplates = $contacFormTabTemplates->data;

                                                        if(is_array($contacFormTabTemplates)){
                                                                
                                                                foreach ($contacFormTabTemplates as $formTpl) {
                                                                    if ($formTpl->free){  ?>
                                                                    
                                                                    <span class="tpl item template-tab" rel="<?php echo $formTpl->id; ?>">
                                                                        <img src="<?php echo $formTpl->thumbnail; ?>" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $formTpl->name; ?>" />
                                                                        <span class="captions">
                                                                            <p>
                                                                                Tab Name:<?php echo $formTpl->name; ?>
                                                                            </p>
                                                                        </span>
                                                                        <span class="def_bak"></span>
                                                                    </span>

                                                                    <?php 
                                                                    
                                                                    } //endif
                                                                } //endforeach
                                                        }
                                                        
                                                        ?>
                                                        
                                                    </div>
                                                    
                                                   
                                                </div>
                                                <script>
                                                    jQuery('.template-tab').click(function(){
                                                        jQuery('#Template_Desktop_Tab').val( jQuery(this).attr('rel') );
                                                        jQuery('.slider_tabs .item').removeClass('default');
                                                        jQuery(this).addClass('default');
                                                    });
                                                </script>
                                                
                                            </div>

                                        </div> 
                                        <table class="form-table">
                                            <tr>
                                                <th></th><td><input id="cUsMC_SendTemplates" class="btn orange" value="Create account" type="submit" /></td>
                                            </tr>
                                            <tr>
                                                <th></th><td>By clicking Create my account, you agree to <a href="http://www.contactus.com/terms-of-service/" target="_blank">the ContactUs.com Terms of Service.</a></td>
                                            </tr>
                                            <input type="hidden" value="" name="Template_Desktop_Form" id="Template_Desktop_Form" />
                                            <input type="hidden" value="" name="Template_Desktop_Tab" id="Template_Desktop_Tab" />
                                        </table>
                                    </form>
                                    

                                </div>
                            </div><!-- // TAB LEFT -->
                            
                            <div class="right-content">
                                <div class="upgrade_features">
                                    
                                    <h3 class="review">Plugin Overview</h3>
                                    
                                    <div class="video">
                                        <iframe src="//player.vimeo.com/video/78597168" width="100%" height="auto" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                    </div>
                                    
                                    <p><a href="http://www.contactus.com/wordpress-plugins/" target="_blank" class="btn large lightblue">Other plugins by ContactUs.com</a></p>
                                    
                                    <h3>Discover our great features</h3>
                                    <p>Enjoying the Free version of ContactUs.com? You will Love ContactUs.com Pro versions.</p>
                                    
                                    <a href="http://www.contactus.com/pricing-plans/" target="_blank" class="btn large orange">Upgrade Your Account</a>
                                    
                                    <p><a href="http://help.contactus.com/" target="_blank" class="btn large lightblue">Support</a></p>
                                    
                                </div>
                            </div><!-- // TAB RIGHT -->

                        </div> <!-- // TAB 1 -->
                    
                    <?php }else{
                        
                        global $current_user;
                        get_currentuserinfo();
                        
                        $cUsMC_API_getFormKeys = $cUsMC_api->getFormKeysAPI($cUs_API_Account, $cUs_API_Key); //api hook;
                        
                        ?>
                    
                    <?php if(strlen($cUs_API_Account)){ //UPDATE OLD USERS ?>    
                        
                    <div id="tabs-1">
                            
                            <div class="left-content">
                                <h2>Form Settings</h2>
                                <?php echo (strlen($settingsMessage)) ? $settingsMessage :''; ?>
                                <div id="message" class="updated fade notice_success"></div>
                                <div class="advice_notice"></div>
                                <div class="loadingMessage"></div>
                                
                                <div class="versions_options">
                                   
                                    
                                    <button class="form_version btn tab_button <?php echo ( $cus_version == 'tab' )?'green':'gray'; ?>" value="tab_version" <?php echo ( $cus_version == 'tab' )?'disabled="disabled"':''; ?>>DEFAULT FORM</button> 
                                    <button class="form_version btn custom <?php echo ( $cus_version == 'selectable' )?'green':'gray'; ?>" value="select_version" <?php echo ( $cus_version == 'selectable' )?'disabled="disabled"':''; ?> >CUSTOM</button>
                                    
                                    <p>If you just want a simple  form on all pages, use the default form. <br/>When you activate custom form Settings, your default form is deactivated automatically. Select the pages you want the form to be shown in, and customize the form for every page.If you already clicked on custom, click the default form button to reinstate default settings.</p>
                                    <p>View a quick tutorial here <a class="setLabels tooltip_formsett media_link" href="#" title="Click to watch the video"> Link</a></p>
                                    
                                    
                                </div>

                                <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_button" class="cus_versionform tab_version <?php echo ( strlen($cus_version) && $cus_version != 'tab')?'hidden':''; ?>" name="cUsMC_button">
                                   
                                    <input type="hidden" class="tab_user" name="tab_user" value="1" />
                                    <input type="hidden" name="cus_version" value="tab" />
                                    <input type="hidden" value="settings" name="option" />
                                    
                                </form>


                                <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_selectable" class="cus_versionform select_version <?php echo ( !strlen($cus_version) || $cus_version == 'tab')?'hidden':''; ?>" name="cUsMC_selectable">
                                    <h3 class="form_title">Page Selection  <a href="post-new.php?post_type=page">Create a new page <span>+</span></a></h3> 
                                    <div class="pageselect_cont">
                                    <?php 
                                        $mypages = get_pages( array( 'parent' => 0, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) ); 
                                        
                                        if( is_array($mypages) ) {  //GET WP PAGES
                                            
                                            $getTabPages = get_option('cUsMC_settings_tabpages');
                                            $getInlinePages = get_option('cUsMC_settings_inlinepages');
                                            
                                            if(!empty($getTabPages) && in_array('home', $getTabPages)){
                                                $getHomePage         = get_option('cUsMC_HOME_settings');
                                                $home_boolTab        = $getHomePage['tab_user'];
                                                $home_cus_version    = $getHomePage['cus_version'];
                                                $home_form_key       = $getHomePage['form_key'];
                                            }
                                            
                                            ?>
                                        <ul class="selectable_pages">
                                            
                                            <li class="ui-widget-content">
                                                 
                                                <div class="page_title">
                                                    <span class="title">Home Page</span>
                                                    <span class="bullet ui-icon ui-icon-circle-zoomin">
                                                        <a class="setLabels" target="_blank" href="<?php echo get_option('home'); ?>" title="Home Preview">&nbsp;</a>
                                                    </span>
                                                </div>

                                                <div class="options home">
                                                    <input type="radio" name="pages[home]" class="home-page" id="pageradio-home" value="tab" <?php echo (is_array($getTabPages) && in_array('home', $getTabPages) || $home_cus_version == 'tab') ? 'checked' : '' ?> />
                                                    <label class="label-home setLabels" for="pageradio-home" title="Will show up as a floating tab">Tab</label>
                                                    
                                                    <?php if(is_array($getInlinePages) && in_array('home', $getInlinePages) || $home_cus_version == 'inline') { ?>
                                                    <input type="radio" name="pages[home]" value="inline" id="pageradio-home-2" class="home-page" <?php echo (is_array($getInlinePages) && in_array('home', $getInlinePages) || $home_cus_version == 'inline') ? 'checked' : '' ?> />
                                                    <label class="label-home setLabels" for="pageradio-home-2" title="Inline Form appear in your website layout and posts">Inline</label>
                                                    <?php } ?>
                                                    
                                                    <a class="ui-state-default ui-corner-all pageclear-home" href="javascript:;" title="Clear Home page settings"><label class="ui-icon ui-icon-circle-close">&nbsp;</label></a>
                                                </div>
                                                
                                                <div class="form_template form-templates-home">
                                                    <h4>Pick which form you would like on this page</h4>
                                                    <div class="template_slider slider-home">
                                                        <?php
                                                        
                                                        if($cUsMC_API_getFormKeys){
                                                                $cUs_json = json_decode($cUsMC_API_getFormKeys);

                                                                switch ( $cUs_json->status  ) {
                                                                    case 'success':
                                                                        foreach ($cUs_json as $oForms => $oForm) {
                                                                            if ($oForms !='status' && $oForm->form_type == 1) { //GET DEFAULT CONTACT FORM KEY 
                                                                                ?>
                                                        
                                                                            <span class="<?php echo ( ( strlen($home_form_key)  && $home_form_key == $oForm->form_key) || $form_key == $oForm->form_key )?'default':'tpl'?> item template-home" rel="<?php echo $oForm->form_key ?>">
                                                                                <img src="https://admin.contactus.com/popup/tpl/<?php echo $oForm->template_desktop_form ?>/scr.png" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $oForm->form_name ?> - Form Key: <?php echo $oForm->form_key ?>" />
                                                                                <img class="tab tab-home" src="https://admin.contactus.com/popup/tpl/<?php echo $oForm->template_desktop_tab ?>/scr.png" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $oForm->form_name ?> - Form Key: <?php echo $oForm->form_key ?>" />
                                                                                <span class="captions">
                                                                                    <p>
                                                                                        Form Name:<?php echo $oForm->form_name ?><br>
                                                                                        Form Key: <?php echo $oForm->form_key ?>
                                                                                    </p>
                                                                                </span>
                                                                                <span class="def_bak"></span>
                                                                            </span>

                                                                            <?php 
                                                                            
                                                                            }
                                                                        }
                                                                        
                                                                        break;
                                                                        
                                                                } //endswitch
                                                            }
                                                        ?>
                                                    </div>

                                                    <div class="save-options">
                                                        <input type="button" class="btn lightblue small save-page save-page-home" value="Save" />
                                                    </div>
                                                    <div class="save_message save_message_home">
                                                        <p>Sending . . .</p>
                                                    </div>
                                                </div>

                                                <input type="hidden" class="cus_version_home" value="<?php echo $cus_version; ?>" />
                                                <input type="hidden" class="form_key_home" value="<?php echo (strlen($form_page_key)) ? $form_page_key : $form_key ; ?>" />
                                                
                                            </li>
                                            <script>
                                                jQuery('.pageclear-home').click(function(){

                                                    if(confirm('Do you want to delete your settings in this page?')){
                                                        jQuery('.home-page').removeAttr('checked');
                                                        jQuery('.label-home').removeClass('ui-state-active');

                                                        jQuery('.template-home').removeClass('default');

                                                        jQuery.deletePageSettings('home');

                                                    }

                                                });
                                                jQuery('.home-page').click(function(){
                                                    
                                                    jQuery('.form_template').fadeOut();
                                                    jQuery('.form-templates-home').slideDown();

                                                    jQuery('.cus_version_home').val( jQuery(this).val() );
                                                    
                                                    var version = jQuery(this).val();
                                                    if(version == 'tab'){
                                                        jQuery('img.tab-home').show();
                                                    }else{
                                                        jQuery('img.tab-home').hide();
                                                    }

                                                });
                                                jQuery('.template-home').click(function(){
                                                    jQuery('.form_key_home').val( jQuery(this).attr('rel') );
                                                    jQuery('.slider-home .item').removeClass('default');
                                                    jQuery(this).addClass('default');
                                                });
                                                jQuery('.save-page-home').click(function(){ 
                                                    var cus_version_home = jQuery('.cus_version_home').val();
                                                    var form_key_home = jQuery('.form_key_home').val();

                                                    var changePage = jQuery.changePageSettings('home', cus_version_home, form_key_home); 

                                                });
                                            </script>
                                                <?php 
                                                
                                                foreach( $mypages as $page ) { //all wp pages 
                                                
                                                    $pageSettings = get_post_meta( $page->ID, 'cUsMC_FormByPage_settings', false );

                                                    if(is_array($pageSettings) && !empty($pageSettings)){ //NEW VERSION 3.0

                                                        $cus_version    = $pageSettings[0]['cus_version'];
                                                        $form_page_key  = $pageSettings[0]['form_key'];

                                                    }
                                                
                                                ?>
                                            
                                                    <li class="ui-widget-content">
                                                        
                                                        <div class="page_title">
                                                            <span class="title"><?php echo $page->post_title; ?></span>
                                                            <span class="bullet ui-icon ui-icon-circle-zoomin">
                                                                <a class="setLabels" target="_blank" href="<?php echo get_permalink( $page->ID ) ;?>" title="Preview <?php echo $page->post_title; ?> page">&nbsp;</a>
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="options">
                                                            <input type="radio" name="pages[<?php echo $page->ID ; ?>]" value="tab" id="pageradio-<?php echo $page->ID ; ?>-1" class="<?php echo $page->ID ; ?>-page" <?php echo (is_array($getTabPages) && in_array($page->ID, $getTabPages) || $cus_version == 'tab')?'checked':'' ?> />
                                                            <label class="setLabels label-<?php echo $page->ID ; ?>" for="pageradio-<?php echo $page->ID ; ?>-1" title="Will show up as a floating tab">Tab</label>
                                                            <input type="radio" name="pages[<?php echo $page->ID ; ?>]" value="inline" id="pageradio-<?php echo $page->ID ; ?>-2" class="<?php echo $page->ID ; ?>-page" <?php echo (is_array($getInlinePages) && in_array($page->ID, $getInlinePages) || $cus_version == 'inline')?'checked':'' ?> />
                                                            <label class="setLabels label-<?php echo $page->ID ; ?>" for="pageradio-<?php echo $page->ID ; ?>-2" title="The form was added by inserting a short code in your page. You can change its location by moving the short code within the page content">Inline</label>
                                                            <a class="ui-state-default ui-corner-all pageclear-<?php echo $page->ID ; ?>" href="javascript:;" title="Clear <?php echo $page->post_title; ?> page settings"><label class="ui-icon ui-icon-circle-close">&nbsp;</label></a>
                                                        </div>
                                                        
                                                        <div class="form_template form-templates-<?php echo $page->ID ; ?>">
                                                            <h4>Pick which Form/Tab combination you would like on <?php echo $page->post_title; ?> page</h4>
                                                            <div class="template_slider slider-pages slider-<?php echo $page->ID ; ?>">
                                                                <?php 
                                                                
                                                                if($cUsMC_API_getFormKeys){
                                                                        
                                                                    $cUs_json = json_decode($cUsMC_API_getFormKeys);

                                                                        switch ( $cUs_json->status  ) {
                                                                            case 'success':
                                                                                foreach ($cUs_json as $oForms => $oForm) {
                                                                                    if ($oForms !='status' && $oForm->form_type == 1){//GET DEFAULT CONTACT FORM KEY ?>
                                                                                    <span class="<?php echo ( (strlen($form_page_key) && $form_page_key == $oForm->form_key) || $form_key == $oForm->form_key)?'default':'tpl'?> item template-<?php echo $page->ID ; ?>" rel="<?php echo $oForm->form_key ?>">
                                                                                        <img src="https://admin.contactus.com/popup/tpl/<?php echo $oForm->template_desktop_form ?>/scr.png" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $oForm->form_name ?> - Form Key: <?php echo $oForm->form_key ?>" />
                                                                                        
                                                                                        <img class="tab tab-<?php echo $page->ID ; ?>" src="https://admin.contactus.com/popup/tpl/<?php echo $oForm->template_desktop_tab ?>/scr.png" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $oForm->form_name ?> - Form Key: <?php echo $oForm->form_key ?>" />
                                                                                        
                                                                                        <span class="captions">
                                                                                            <p>
                                                                                                Form Name:<?php echo $oForm->form_name ?><br>
                                                                                                Form Key: <?php echo $oForm->form_key ?>
                                                                                            </p>
                                                                                        </span>
                                                                                        <span class="def_bak"></span>
                                                                                    </span>

                                                                                    <?php
                                                                                    
                                                                                    }
                                                                                }
                                                                                break;
                                                                        } //endswitch
                                                                    }
                                                                    
                                                                ?>
                                                            </div>
                                                            
                                                            <div class="save-options">
                                                                <input type="button" class="btn lightblue small save-page save-page-<?php echo $page->ID ; ?>" value="Save" />
                                                            </div>
                                                            <div class="save_message save_message_<?php echo $page->ID ; ?>">
                                                                <p>Sending . . .</p>
                                                            </div>
                                                        </div>
                                                        
                                                        <input type="hidden" class="cus_version_<?php echo $page->ID ; ?>" value="<?php echo $cus_version; ?>" />
                                                        <input type="hidden" class="form_key_<?php echo $page->ID ; ?>" value="<?php echo (strlen($form_page_key)) ? $form_page_key : $form_key ; ?>" />
                                                        
                                                    </li>
                                                    <script>
                                                        jQuery('.pageclear-<?php echo $page->ID ; ?>').click(function(){
                                                            
                                                            if(confirm('Do you want to delete your settings in this page?')){
                                                                jQuery('.<?php echo $page->ID ; ?>-page').removeAttr('checked');
                                                                jQuery('.label-<?php echo $page->ID ; ?>').removeClass('ui-state-active');
                                                                
                                                                jQuery('.template-<?php echo $page->ID ; ?>').removeClass('default');
                                                                
                                                                jQuery.deletePageSettings(<?php echo $page->ID ; ?>);
                                                                
                                                            }
                                                            
                                                        });
                                                        jQuery('.<?php echo $page->ID ; ?>-page').click(function(){
                                                            jQuery('.form_template').fadeOut();
                                                            jQuery('.form-templates-<?php echo $page->ID ; ?>').slideDown();
                                                            
                                                            jQuery('.cus_version_<?php echo $page->ID ; ?>').val( jQuery(this).val() );
                                                            
                                                            var version = jQuery(this).val();
                                                            
                                                            if(version == 'tab'){
                                                                jQuery('img.tab-<?php echo $page->ID ; ?>').show();
                                                            }else{
                                                                jQuery('img.tab-<?php echo $page->ID ; ?>').hide();
                                                            }
                                                            
                                                            
                                                        });
                                                        jQuery('.template-<?php echo $page->ID ; ?>').click(function(){
                                                            jQuery('.form_key_<?php echo $page->ID ; ?>').val( jQuery(this).attr('rel') );
                                                            jQuery('.slider-<?php echo $page->ID ; ?> .item').removeClass('default');
                                                            jQuery(this).addClass('default');
                                                        });
                                                        jQuery('.save-page-<?php echo $page->ID ; ?>').click(function(){ 
                                                            var cus_version_<?php echo $page->ID ; ?> = jQuery('.cus_version_<?php echo $page->ID ; ?>').val();
                                                            var form_key_<?php echo $page->ID ; ?> = jQuery('.form_key_<?php echo $page->ID ; ?>').val();
                                                            var changePage = jQuery.changePageSettings(<?php echo $page->ID ; ?>, cus_version_<?php echo $page->ID ; ?>, form_key_<?php echo $page->ID ; ?>);
                                                            
                                                        });
                                                    </script>
                                            <?php 
                                                
                                                $cus_version = '';
                                                $form_page_key = '';
                                                
                                                
                                                } // endforeach all wp pages 
                                            ?>
                                                    
                                        </ul>
                                      
                                        <?php 
                                            
                                        } //endif get wp pages 
                                        
                                        ?>
                                    </div>
                                    <input type="hidden" name="cus_version" value="selectable" />
                                    <input type="hidden" value="settings" name="option" />
                                </form>
                                
                            </div><!-- // TAB LEFT -->
                            
                            <div class="right-content">
                                <div class="upgrade_features">
                                    
                                    <h3 class="review">Give us a 5 stars review on </h3>
                                    <a href="http://wordpress.org/support/view/plugin-reviews/contactuscom?rate=5#postform" target="_blank">Wordpress.org <img src="<?php echo plugins_url('style/images/five_stars.png', __FILE__) ;?> " /></a><br/><br/>
                                    
                                    <h3 class="review">Plugin Overview</h3> 
                                    
                                    <div class="video">
                                        
                                        <iframe src="//player.vimeo.com/video/78597168" width="100%" height="auto" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                        
                                    </div>
                                    
                                    <p><a href="http://www.contactus.com/wordpress-plugins/" target="_blank" class="btn large lightblue">Other plugins by ContactUs.com</a></p>
                                    
                                    <h3>Discover our great features</h3>
                                    <p>Enjoying the Free version of ContactUs.com? You will Love ContactUs.com Pro versions.</p>
                                    
                                    <a href="http://www.contactus.com/pricing-plans/" target="_blank" class="btn large orange">Upgrade Your Account</a>
                                    
                                    <p><a href="http://help.contactus.com/" target="_blank" class="btn large lightblue">Support</a></p>
                                    
                                </div>
                                 
                            </div><!-- // TAB RIGHT -->
                            
                        </div>
                        
                        <div id="tabs-2">
                            
                                <div class="left-content">
                                    <div class="versions_options">
                                        <h2>Change Form/Tab Design</h2>
                                        <p>Change your form template, tab template within plugin.</p>

                                        <div class="advice_notice">Advices....</div>

                                        <div class="user_templates">

                                            <?php 
                                            if($cUsMC_API_getFormKeys){
                                                    $cUs_json = json_decode($cUsMC_API_getFormKeys);

                                                    switch ( $cUs_json->status  ) {
                                                        case 'success':
                                                            foreach ($cUs_json as $oForms => $oForm) {
                                                                if ($oForms !='status' && $oForm->form_type == 1){ //GET CONTACT FORMS KEY 
                                                                
                                                                $formID = $oForms;
                                                                
                                                                $cUsMC_API_getDeliveryOptions = $cUsMC_api->getDeliveryOptions($cUs_API_Account, $cUs_API_Key, $oForm->form_key); //api hook;    
                                                                
                                                                ?>
                                                                
                                                                <h3>Form Name: <?php echo $oForm->form_name ?> <?php echo ($oForm->default == 1)?' - [ Default ]':''?></h3>
                                                                
                                                                <div>
                                                                    <div class="terminology_c">
                                                                        
                                                                        <div class="template_info">
                                                                            <div class="template-thumb">
                                                                                <p><b>Template Form:</b> <?php echo $oForm->template_desktop_form ?></p>
                                                                                <span class="thumb"><img src="https://admin.contactus.com/popup/tpl/<?php echo $oForm->template_desktop_form ?>/scr.png" class="form_thumb_<?php echo $formID; ?>" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $oForm->form_name ?> - Form Key: <?php echo $oForm->form_key ?>" /></span>

                                                                                <p><b>Template Tab:</b> <?php echo $oForm->template_desktop_tab ?></p>
                                                                                <img src="https://admin.contactus.com/popup/tpl/<?php echo $oForm->template_desktop_tab ?>/scr.png" class="tab_thumb_<?php echo $formID; ?>" alt="<?php echo $oForm->form_name ?>" title="Form Name:<?php echo $oForm->form_name ?> - Form Key: <?php echo $oForm->form_key ?>" />
                                                                            </div>
                                                                            <div class="template-desc">
                                                                                <p><b>Form Key:</b> <?php echo $oForm->form_key ?></p>
                                                                                <p><b>Website URL:</b> <?php echo $oForm->website_url ?></p>
                                                                                <p><b>Template Mobile Form:</b> <?php echo $oForm->template_mobile_form ?></p>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <h4>Use this information for advanced settings <a href="javascript:;" class="blue_link" onclick="jQuery( '#cUsMC_tabs' ).tabs({ active: 2 })"> Go to Advanced Tab </a></h4>
                                                                        
                                                                        <div class="template-selection">
                                                                            
                                                                                                            
                                                                                <div class="form_templates_aCc">
                                                                                    
                                                                                    <h4>MailChimp Delivery Options</h4>
                                                                                    <div>
                                                                                        <div class="form_templates terminology_c">
                                                                                            <?php
                                                                                            if ($cUsMC_API_getDeliveryOptions) {
                                                                                                
                                                                                                $cUs_jsonDelivery = json_decode($cUsMC_API_getDeliveryOptions);
                                                                                                $cUs_jsonDeliveryMC = $cUs_jsonDelivery->mailchimp;
                                                                                                $api_key = $cUs_jsonDeliveryMC->mailchimp_api_key;
                                                                                                $mc_listID = $cUs_jsonDeliveryMC->mailchimp_unique_list_id;
                                                                                                
                                                                                                $MC_api = new mailchimpSF_MCAPI($api_key);//MC API // trying to make just one call since 1.2
                                                                                                
                                                                                                $MC_lists = $MC_api->lists(array(),0,100);
                                                                                                $MC_lists = $MC_lists['data'];
                                                                                                
                                                                                            }
                                                                                            
                                                                                            ?>
                                                                                            
                                                                                            <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_userdata" name="cUsMC_userdata" class="steps" onsubmit="return false;">
                                                                                                
                                                                                                <table class="form-table">
                                                                                                    <tr>
                                                                                                        <th><label class="labelform" for="apikey_<?php echo $formID;?>">MailChimp API Key</label></th>
                                                                                                        <td>
                                                                                                            <input placeholder="Enter your MailChimp API KEY" class="inputform" name="apikey_<?php echo $formID;?>" id="apikey_<?php echo $formID;?>" type="text" value="<?php echo $cUs_jsonDeliveryMC->mailchimp_api_key; ?>">
                                                                                                            <input type="button" class="button-primary" id="get_lists_<?php echo $formID;?>" value="Get Lists" />
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th><label class="labelform" for="user_listid_<?php echo $formID;?>">Subscribers List</label></th>
                                                                                                        <td>
                                                                                                            <select name="user_listid" id="user_listid_<?php echo $formID;?>">
                                                                                                                <?php
                                                                                                                if (!empty($MC_lists) && is_array($MC_lists)) {
                                                                                                                    foreach ($MC_lists as $key => $list) {
                                                                                                                        ?>
                                                                                                                        <option value="<?php echo $list['id'] ?>" <?php echo ($mc_listID == $list['id'])?'selected="selected"' :''  ?>><?php echo $list['name'] ?></option>
                                                                                                                    <?php }
                                                                                                                }else{ ?> 
                                                                                                                        <option value="">Add one MailChimp Lists at least</option>
                                                                                                                    <?php
                                                                                                                }
                                                                                                                ?>
                                                                                                            </select>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>

                                                                                                <p>
                                                                                                    <input class="btn lightblue sendtemplate save-delivey-<?php echo $formID;?>" value="Update" type="button" />
                                                                                                </p>
                                                                                                
                                                                                            </form>
                                                                                            
                                                                                            <div class="save_message delivery update_deliv_message_<?php echo $formID ; ?>">
                                                                                                <p>Sending . . .</p>
                                                                                            </div>
                                                                                            <script>
                                                                                            
                                                                                                jQuery('.save-delivey-<?php echo $formID;?>').click(function(){ 

                                                                                                    var mc_listid_<?php echo $formID;?> = jQuery('#user_listid_<?php echo $formID;?>').val();
                                                                                                    var mc_apikey_<?php echo $formID;?> = jQuery('#apikey_<?php echo $formID; ?>').val();
                                                                                                    var mc_form_key = '<?php echo $oForm->form_key; ?>';

                                                                                                    jQuery.updateDeliveryOptions(<?php echo $formID;?>, mc_form_key, mc_listid_<?php echo $formID;?>, mc_apikey_<?php echo $formID;?>);

                                                                                                });
                                                                                                
                                                                                                jQuery('#get_lists_<?php echo $formID;?>').click(function(){ 

                                                                                                    var mc_apikey_<?php echo $formID;?> = jQuery('#apikey_<?php echo $formID; ?>').val();
                                                                                                    var formID = '<?php echo $formID;?>';

                                                                                                    jQuery.getMailChimpLists(formID, mc_apikey_<?php echo $formID;?>);

                                                                                                });

                                                                                            </script>
                                                                                            
                                                                                        </div>
                                                                                    </div>

                                                                                    <h4>Change Your Form Template here</h4>
                                                                                    <div>
                                                                                        <div class="form_templates terminology_c Template_Contact_Form">
                                                                                            
                                                                                            <?php

                                                                                            $contacFormTemplates = $cUsMC_api->getTemplatesAndTabsAllowed('1', 'Template_Desktop_Form', $cUs_API_Account, $cUs_API_Key);
                                                                                            $contacFormTemplates = json_decode($contacFormTemplates);
                                                                                            $contacFormTemplates = $contacFormTemplates->data;

                                                                                            if(!empty($contacFormTemplates)) { 
                                                                                                
                                                                                            ?>
                                                                                            
                                                                                                <div class="template_slider slider-<?php echo $formID; ?>">
                                                                                                    
                                                                                                    <?php 
                                                                                                    
                                                                                                    $iF = 0;
                                                                                                    $activeF = 0;
                                                                                                    
                                                                                                    foreach ($contacFormTemplates as $formTpl) {
                                                                                                        if( $oForm->template_desktop_form == $formTpl->id ){
                                                                                                           $activeF = $iF;
                                                                                                           $iF = 0;
                                                                                                        }
                                                                                                        ?> 
                                                                                                        
                                                                                                        <span class="<?php echo (strlen($oForm->template_desktop_form) && $oForm->template_desktop_form == $formTpl->id)?'default':'tpl'?> item template-<?php echo $formTpl->id ; ?>" rel="<?php echo $formTpl->id ?>">
                                                                                                           <img src="<?php echo $formTpl->thumbnail ?>"  alt="<?php echo $formTpl->name ?>" title="Form Name:<?php echo $formTpl->name ?>" />
                                                                                                            <span class="captions">
                                                                                                                <p>
                                                                                                                    Form Name:<?php echo $formTpl->name ?><br>
                                                                                                                </p>
                                                                                                            </span>
                                                                                                            <span class="def_bak"></span>
                                                                                                        </span>
                                                                                                    
                                                                                                    <?php
                                                                                                    
                                                                                                        if($activeF == 0 ){
                                                                                                            $iF++;
                                                                                                        }else{
                                                                                                            $activeFr = $activeF;
                                                                                                             $activeF = 0;
                                                                                                        }
                                                                                                            
                                                                                                    
                                                                                                    } //endforeach ?>
                                                                                                    
                                                                                                </div>
                                                                                            
                                                                                            <?php } //endif ?>
                                                                                            
                                                                                            <div class="save_message save_message_<?php echo $formID ; ?>">
                                                                                                <p>Sending . . .</p>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        
                                                                                        <input class="btn lightblue sendtemplate save-formtemplate-<?php echo $formID;?>" value="Save Form Template" type="button" />
                                                                                        
                                                                                        <input type="hidden" value="<?php echo $oForm->template_desktop_form ?>" name="id-formtemplate-<?php echo $formID;?>" id="id_formtemplate_<?php echo $formID;?>" />
                                                                                        <input type="hidden" value="<?php echo $oForm->form_key ?>" name="id-formkey-<?php echo $formID;?>" id="id_formkey_<?php echo $formID;?>" />
                                                                                        
                                                                                        <script>
                                                                                            
                                                                                            jQuery(document).ready(function() {
                                                                                                 
                                                                                                 var slider_<?php echo $formID; ?> = jQuery('.slider-<?php echo $formID; ?>').bxSlider({
                                                                                                                                                        slideWidth: 160,
                                                                                                                                                        minSlides: 4,
                                                                                                                                                        maxSlides: 4,
                                                                                                                                                        speed:200,
                                                                                                                                                        moveSlides:1,
                                                                                                                                                        infiniteLoop:false,
                                                                                                                                                        preloadImages:'all',    
                                                                                                                                                        //captions:true,
                                                                                                                                                        pager:true,
                                                                                                                                                        slideMargin: 5
                                                                                                                                                    });
                                                                                                try{
                                                                                                    //slider_<?php echo $formID; ?>.goToSlide(<?php echo $activeFr; ?>);
                                                                                                }catch(e){
                                                                                                    //console.log(e)
                                                                                                }
                                                                                                
                                                                                                
                                                                                                
                                                                                                jQuery('.slider-<?php echo $formID; ?> > .item').click(function(){
                                                                                                
                                                                                                    jQuery('#id_formtemplate_<?php echo $formID;?>').val( jQuery(this).attr('rel') );
                                                                                                    jQuery('.slider-<?php echo $formID;?> > .item').removeClass('default');

                                                                                                    jQuery(this).addClass('default');

                                                                                                });


                                                                                                jQuery('.save-formtemplate-<?php echo $formID;?>').click(function(){ 

                                                                                                    var id_formtemplate_<?php echo $formID;?> = jQuery('#id_formtemplate_<?php echo $formID;?>').val();
                                                                                                    var id_formkey_<?php echo $formID;?> = jQuery('#id_formkey_<?php echo $formID;?>').val();

                                                                                                    var changeTemplate = jQuery.changeFormTemplate(<?php echo $formID;?>, id_formkey_<?php echo $formID;?>, id_formtemplate_<?php echo $formID;?>);

                                                                                                });
                                                                                                    
                                                                                            });
                                                                                            
                                                                                            
                                                                                            
                                                                                        </script>
                                                                                        
                                                                                    </div>
                                                                                    
                                                                                    
                                                                                    <h4>Change your Tab Template here</h4>
                                                                                    <div>
                                                                                        <div class="form_templates terminology_c Template_Contact_Form">
                                                                                            
                                                                                            <?php

                                                                                            $contacFormTabTemplates = $cUsMC_api->getTemplatesAndTabsAllowed('1', 'Template_Desktop_Tab', $cUs_API_Account, $cUs_API_Key);
                                                                                            $contacFormTabTemplates = json_decode($contacFormTabTemplates);
                                                                                            $contacFormTabTemplates = $contacFormTabTemplates->data;

                                                                                            if(!empty($contacFormTabTemplates)){ ?>
                                                                                                
                                                                                                <div class="template_slider tabslider-<?php echo $formID; ?>">
                                                                                                    <?php 
                                                                                                        
                                                                                                        $iT = 0;
                                                                                                        $activeT = 0;
                                                                                                        $contacFormTabTemplates = array_reverse($contacFormTabTemplates, true);
                                                                                                        foreach ($contacFormTabTemplates as $formTpl) {  
                                                                                                            
                                                                                                                if( $oForm->template_desktop_tab == $formTpl->id ){
                                                                                                                    $activeT = $iT;
                                                                                                                    $iT = 0;
                                                                                                                }

                                                                                                                ?> 

                                                                                                                <span class="<?php echo (strlen($oForm->template_desktop_tab) && $oForm->template_desktop_tab == $formTpl->id)?'default':'tpl'?> item template-<?php echo $formTpl->id ; ?>" rel="<?php echo $formTpl->id ?>">
                                                                                                                    <img src="<?php echo $formTpl->thumbnail ?>"  alt="<?php echo $formTpl->name ?>" title="Tab Name:<?php echo $formTpl->name ?>" />
                                                                                                                    <span class="captions">
                                                                                                                        <p>
                                                                                                                            Tab Name:<?php echo $formTpl->name ?><br>
                                                                                                                        </p>
                                                                                                                    </span>
                                                                                                                    <span class="def_bak"></span>
                                                                                                                </span>

                                                                                                        <?php 

                                                                                                            if($activeT == 0 ){
                                                                                                                $iT++;
                                                                                                            }else{
                                                                                                                $activeTr = $activeT;
                                                                                                                $activeT = 0;
                                                                                                            }
                                                                                                    
                                                                                                     } //endforeach; 
                                                                                                    
                                                                                                    ?>
                                                                                                </div>
                                                                                            
                                                                                            <?php 
                                                                                            
                                                                                            } //endif 
                                                                                            
                                                                                            ?>
                                                                                            
                                                                                            
                                                                                            <div class="save_message save_tab_message_<?php echo $formID ; ?>">
                                                                                                <p>Sending . . .</p>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        
                                                                                        <input class="btn lightblue sendtemplate save-tabtemplate-<?php echo $formID;?>" value="Save Tab" type="button" />
                                                                                        
                                                                                        <input type="hidden" value="<?php echo $oForm->template_desktop_tab ?>" name="id-tabtemplate-<?php echo $formID;?>" id="id_tabtemplate_<?php echo $formID;?>" />
                                                                                        <input type="hidden" value="<?php echo $oForm->form_key ?>" name="id-tabkey-<?php echo $formID;?>" id="id_tabkey_<?php echo $formID;?>" />
                                                                                        
                                                                                        <script>
                                                                                            
                                                                                            jQuery(document).ready(function() {
                                                                                                 
                                                                                                 var tabslider_<?php echo $formID; ?> = jQuery('.tabslider-<?php echo $formID; ?>').bxSlider({
                                                                                                                                                        slideWidth: 160,
                                                                                                                                                        minSlides: 4,
                                                                                                                                                        maxSlides: 4,
                                                                                                                                                        moveSlides:1,
                                                                                                                                                        speed:200,
                                                                                                                                                        infiniteLoop:false,
                                                                                                                                                        preloadImages:'all',    
                                                                                                                                                        //captions:true,
                                                                                                                                                        pager:true,
                                                                                                                                                        slideMargin: 5
                                                                                                                                                    });
                                                                                                try{
                                                                                                    //tabslider_<?php echo $formID; ?>.goToSlide(<?php echo $activeTr; ?>);
                                                                                                }catch(e){
                                                                                                    //console.log(e);
                                                                                                }                                                    
                                                                                                
                                                                                                
                                                                                                jQuery('.tabslider-<?php echo $formID; ?> > .item').click(function(){
                                                                                                
                                                                                                    jQuery('#id_tabtemplate_<?php echo $formID;?>').val( jQuery(this).attr('rel') );
                                                                                                    jQuery('.tabslider-<?php echo $formID;?> > .item').removeClass('default');

                                                                                                    jQuery(this).addClass('default');
                                                                                                });


                                                                                                jQuery('.save-tabtemplate-<?php echo $formID;?>').click(function(){

                                                                                                    var id_tabtemplate_<?php echo $formID;?> = jQuery('#id_tabtemplate_<?php echo $formID;?>').val();
                                                                                                    var id_tabkey_<?php echo $formID;?> = jQuery('#id_tabkey_<?php echo $formID;?>').val();

                                                                                                   jQuery.changeTabTemplate(<?php echo $formID;?>, id_tabkey_<?php echo $formID;?>, id_tabtemplate_<?php echo $formID;?>);

                                                                                                });
                                                                                                
                                                                                            });
                                                                                            
                                                                                            
                                                                                        </script>
                                                                                        
                                                                                    </div>

                                                                                </div> 
                                                                                    
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>

                                                                <?php 
                                                                
                                                                }
                                                            }
                                                            
                                                            break;
                                                            
                                                    } //endswitch
                                                }
                                            ?>


                                        </div>

                                    
                                        <div class="advice_notice">Advices....</div>
                                    </div>
                                </div>
                            
                                <div class="right-content">
                                    <div class="upgrade_features">
                                    
                                        <h3 class="review">Give us a 5 stars review on </h3>
                                        <a href="http://wordpress.org/support/view/plugin-reviews/contactuscom?rate=5#postform" target="_blank">Wordpress.org <img src="<?php echo plugins_url('style/images/five_stars.png', __FILE__) ;?> " /></a><br/><br/>

                                        <h3 class="review">Plugin Overview</h3> 

                                        <div class="video">

                                            <iframe src="//player.vimeo.com/video/78597168" width="100%" height="auto" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

                                        </div>

                                        <p><a href="http://www.contactus.com/wordpress-plugins/" target="_blank" class="btn large lightblue">Other plugins by ContactUs.com</a></p>

                                        <h3>Discover our great features</h3>
                                        <p>Enjoying the Free version of ContactUs.com? You will Love ContactUs.com Pro versions.</p>

                                        <a href="http://www.contactus.com/pricing-plans/" target="_blank" class="btn large orange">Upgrade Your Account</a>

                                        <p><a href="http://help.contactus.com/" target="_blank" class="btn large lightblue">Support</a></p>

                                    </div>
                                </div><!-- // TAB RIGHT -->
                            
                        
                        </div>
                        
                        <div id="tabs-3">
                            <div class="left-content">
                                
                                <h2>ADVANCED ONLY!</h2>
                                <div>
                                    <div class="terminology_c">
                                        <h4>Copy this code into your template to place the form wherever you want it.  If you use this advanced method, do not select any pages from the section on the left or you may end up with the form displayed on your page twice.</h4>
                                        <ul class="hints">
                                            <li><b>Inline</b>
                                                <br/>WP Shortcode: <code> [show-mailchimp-form formkey="FORM KEY HERE" version="inline"] </code>
                                                <br/>Php Snippet:<code>&#60;&#63;php echo do_shortcode("[show-mailchimp-form formkey="FORM KEY HERE" version="inline"]"); &#63;&#62;</code>
                                            </li>
                                            <li><b>Tab</b>
                                                <br/>WP Shortcode:<code> [show-mailchimp-form formkey="FORM KEY HERE" version="tab"] </code>
                                                <br/>Php Snippet:<code>&#60;&#63;php echo do_shortcode("[show-mailchimp-form formkey="FORM KEY HERE" version="tab"]"); &#63;&#62;</code>
                                            </li>
                                            <li><b>Widget Tool</b><br/><p>Go to <a href="widgets.php"><b>Widgets here </b></a> and drag the ContactUs.com widget into one of your widget areas</p></li>
                                            <li><b>Knowledge Base </b><br/><p>Go to <a href="http://help.contactus.com" target="_blank"><b>help.contactus.com</b></a></p></li>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="right-content">
                                <div class="upgrade_features">
                                    
                                    <h3 class="review">Give us a 5 stars review on </h3>
                                    <a href="http://wordpress.org/support/view/plugin-reviews/contactuscom?rate=5#postform" target="_blank">Wordpress.org <img src="<?php echo plugins_url('style/images/five_stars.png', __FILE__) ;?> " /></a><br/><br/>
                                    <h3>Share the plugin with your friends over <a href="mailto:yourfriend@mail.com?subject=Great new WordPress plugin for MailChimp" class="email">email</a></h3>
                                    <h3>Share the plugin on:</h3>
                                    <div class="social_shares">
                                        <a href="javascript:;"
                                           onclick="
                                                    window.open(
                                                      'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('http://wordpress.org/plugins/mailchimp-form/'), 
                                                      'facebook-share-dialog', 
                                                      'width=626,height=436'); 
                                                    return false;"
                                           >Facebook<img src="<?php echo plugins_url('style/images/facebook_link.png', __FILE__) ;  ?> " /></a>
                                        <a href="javascript:;"
                                           onclick="
                                                    window.open(
                                                      'https://twitter.com/intent/tweet?url=http://bit.ly/1688yva&amp;text=Add beautiful, customizable, contact forms, used to generate new web customers by adding an advanced MailChimp Form.', 
                                                      'twitter-tweet-dialog', 
                                                      'width=626,height=436'); 
                                                    return false;"
                                           >Twitter<img src="<?php echo plugins_url('style/images/twitter_link.png', __FILE__) ;  ?> " /></a>
                                        <a href="javascript:;"
                                           onclick="
                                                    window.open(
                                                      'http://www.linkedin.com/cws/share?url=http://wordpress.org/plugins/mailchimp-form/&original_referer=http://wordpress.org/plugins/mailchimp-form/&token=&isFramed=false&lang=en_US', 
                                                      'linkedin-share-dialog', 
                                                      'width=626,height=436'); 
                                                    return false;"
                                           >LinkedIn<img src="<?php echo plugins_url('style/images/linkedin_link.png', __FILE__) ;  ?> " /></a>
                                    </div><br/>
                                    <h3>Discover our great features</h3>
                                    <p>Enjoying the Free version of ContactUs.com? You will Love ContactUs.com Pro versions.</p>
                                    
                                    <a href="http://www.contactus.com/pricing-plans/" target="_blank" class="btn large orange">Upgrade Your Account</a>
                                    
                                </div>
                            </div><!-- // TAB RIGHT -->
                            
                        </div>
                        
                        <div id="tabs-4">
                            
                            <div class="left-content">
                                
                                <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_logout" name="cUsMC_logout" class="steps" onsubmit="return false;">
                                    <h3 class="step_title">Your ContactUs.com Account</h3>
                                    <table class="form-table">
                                        <tr>
                                            <th><label class="labelform">Name</label><br>
                                            <td><span class="cus_names"><?php echo $options['fname'];?> <?php echo $options['lname'];?></span></td>
                                        </tr>
                                        <tr>
                                            <th><label class="labelform">Email</label><br>
                                            <td><span class="cus_email"><?php echo $options['email'];?></span></td>
                                        </tr>
                                       
                                        <tr><th></th>
                                            <td>
                                                <hr/>
                                                <input id="logoutbtn" class="btn orange cUsMC_LogoutUser" value="Unlink Account" type="button">
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            
                            <div class="right-content">
                                <div class="upgrade_features">
                                    
                                    <h3 class="review">Give us a 5 stars review on </h3>
                                    <a href="http://wordpress.org/support/view/plugin-reviews/contactuscom?rate=5#postform" target="_blank">Wordpress.org <img src="<?php echo plugins_url('style/images/five_stars.png', __FILE__) ;?> " /></a><br/><br/>
                                    <h3>Share the plugin with your friends over <a href="mailto:yourfriend@mail.com?subject=Great new WordPress plugin for MailChimp" class="email">email</a></h3>
                                    <h3>Share the plugin on:</h3>
                                    <div class="social_shares">
                                        <a href="javascript:;"
                                           onclick="
                                                    window.open(
                                                      'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('http://wordpress.org/plugins/mailchimp-form/'), 
                                                      'facebook-share-dialog', 
                                                      'width=626,height=436'); 
                                                    return false;"
                                           >Facebook<img src="<?php echo plugins_url('style/images/facebook_link.png', __FILE__) ;  ?> " /></a>
                                        <a href="javascript:;"
                                           onclick="
                                                    window.open(
                                                      'https://twitter.com/intent/tweet?url=http://bit.ly/1688yva&amp;text=Add beautiful, customizable, contact forms, used to generate new web customers by adding an advanced MailChimp Form.', 
                                                      'twitter-tweet-dialog', 
                                                      'width=626,height=436'); 
                                                    return false;"
                                           >Twitter<img src="<?php echo plugins_url('style/images/twitter_link.png', __FILE__) ;  ?> " /></a>
                                        <a href="javascript:;"
                                           onclick="
                                                    window.open(
                                                      'http://www.linkedin.com/cws/share?url=http://wordpress.org/plugins/mailchimp-form/&original_referer=http://wordpress.org/plugins/mailchimp-form/&token=&isFramed=false&lang=en_US', 
                                                      'linkedin-share-dialog', 
                                                      'width=626,height=436'); 
                                                    return false;"
                                           >LinkedIn<img src="<?php echo plugins_url('style/images/linkedin_link.png', __FILE__) ;  ?> " /></a>
                                    </div><br/>
                                    <h3>Discover our great features</h3>
                                    <p>Enjoying the Free version of ContactUs.com? You will Love ContactUs.com Pro versions.</p>
                                    
                                    <a href="http://www.contactus.com/pricing-plans/" target="_blank" class="btn large orange">Upgrade Your Account</a>
                                    
                                </div>
                            </div><!-- // TAB RIGHT -->
                            
                        </div>
                        <?php }else{ ?>
                        <div id="tabs-1">
                            
                            <div class="left-content update">
                                
                                <h3>Important Note:</h3>
                                <p>Hi MailChimp user! Welcome to your V2 MailChimp Form!, in order for the our new cool upgrades to work and made this plugin secure for you, we need to send you your new ContactUs.com Api Credentials via email. This is a one time thing, after up-grade/migration set up, we wont ask this again.</p>
                                

                                <div id="cUsMC_settings">

                                    <div class="loadingMessage"></div>
                                    <div class="advice_notice">Advices....</div>
                                    <div class="notice">Ok....</div>

                                    <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_sent_cred" name="cUsMC_sent_cred" class="steps sendcredentials" onsubmit="return false;">
                                        <h3>ContactUs.com Update</h3>

                                        <table class="form-table">

                                            <tr>
                                                <th><label class="labelform" for="c_login_email">ContactUs.com Email</label><br>
                                                <td><input class="inputform" name="c_login_email" id="c_login_email" type="text" val="<?php echo $options['email'];?>"></td>
                                            </tr>
                                            <tr><th></th>
                                                <td>
                                                    <input id="loginbtn" class="btn lightblue cUsMC_SentCredentials" value="Send my Credentials" type="submit">
                                                </td>
                                            </tr>

                                        </table>
                                    </form>
                                    
                                    <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_save_cred" name="cUsMC_save_cred" class="steps step2 cUsMC_save_cred" onsubmit="return false;">
                                        <h3>ContactUs.com Update</h3>
                                        <p> &#9658; Please check your email inbox and enter your API Credentials below, we sent an email with the subject "ContactUs.com API credentials"</p>
                                        <table class="form-table">

                                            <tr>
                                                <th><label class="labelform" for="API_Account">API_Account</label><br>
                                                <td><input class="inputform" name="API_Account" id="API_Account" type="text"></td>
                                            </tr>
                                            <tr>
                                                <th><label class="labelform" for="API_Key">API_Key</label></th>
                                                <td><input class="inputform" name="API_Key" id="API_Key" type="text"></td>
                                            </tr>
                                            <tr><th></th>
                                                <td>
                                                    <input id="loginbtn" class="btn lightblue cUsMC_UpdateCredentials" value="Save my Credentials" type="submit">
                                                </td>
                                            </tr>

                                        </table>
                                    </form>
                                    
                                    
                                </div>
                                
                          </div>
                            
                          <div class="right-content">
                                <div class="upgrade_features">
                                    
                                    <h3 class="review">Give us a 5 stars review on </h3>
                                    <a href="http://wordpress.org/support/view/plugin-reviews/contactuscom?rate=5#postform" target="_blank">Wordpress.org <img src="<?php echo plugins_url('style/images/five_stars.png', __FILE__) ;?> " /></a><br/><br/>
                                    <h3>Share the plugin with your friends over <a href="mailto:yourfriend@mail.com?subject=Great new WordPress plugin for MailChimp" class="email">email</a></h3>
                                    <h3>Share the plugin on:</h3>
                                    <div class="social_shares">
                                        <a href="javascript:;"
                                           onclick="
                                                    window.open(
                                                      'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('http://wordpress.org/plugins/mailchimp-form/'), 
                                                      'facebook-share-dialog', 
                                                      'width=626,height=436'); 
                                                    return false;"
                                           >Facebook<img src="<?php echo plugins_url('style/images/facebook_link.png', __FILE__) ;  ?> " /></a>
                                        <a href="javascript:;"
                                           onclick="
                                                    window.open(
                                                      'https://twitter.com/intent/tweet?url=http://bit.ly/1688yva&amp;text=Add beautiful, customizable, newsletter forms, used to generate new web customers by adding an advanced MailChimp Form.', 
                                                      'twitter-tweet-dialog', 
                                                      'width=626,height=436'); 
                                                    return false;"
                                           >Twitter<img src="<?php echo plugins_url('style/images/twitter_link.png', __FILE__) ;  ?> " /></a>
                                        <a href="javascript:;"
                                           onclick="
                                                    window.open(
                                                      'http://www.linkedin.com/cws/share?url=http://wordpress.org/plugins/mailchimp-form/&original_referer=http://wordpress.org/plugins/mailchimp-form/&token=&isFramed=false&lang=en_US', 
                                                      'linkedin-share-dialog', 
                                                      'width=626,height=436'); 
                                                    return false;"
                                           >LinkedIn<img src="<?php echo plugins_url('style/images/linkedin_link.png', __FILE__) ;  ?> " /></a>
                                    </div><br/>
                                    <h3>Discover our great features</h3>
                                    <p>Enjoying the Free version of ContactUs.com? You will Love ContactUs.com Pro versions.</p>
                                    
                                    <a href="http://www.contactus.com/pricing-plans/" target="_blank" class="btn large orange">Upgrade Your Account</a>
                                    
                                </div>
                            </div><!-- // TAB RIGHT -->  
                            
                        </div>
                        <?php } //USERS CREDENTIALS UPDATE ?>
                        
                    <?php } //endif not logged ?>

            </div>
        </div>

        <?php
    }

}


//

?>