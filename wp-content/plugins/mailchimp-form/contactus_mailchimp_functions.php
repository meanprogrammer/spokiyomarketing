<?php

if (!function_exists('cUsMC_admin_header')) {

    function cUsMC_admin_header() {
        global $current_screen;

        if ($current_screen->id == 'toplevel_page_cUs_malchimp_plugin') {
            
            wp_enqueue_style( 'cUsMC_Styles', plugins_url('style/cUsMC_style.css', __FILE__), false, '1');
            wp_enqueue_style( 'fancybox', plugins_url('scripts/fancybox/jquery.fancybox.css', __FILE__), false, '1');
            wp_enqueue_style( 'bxslider', plugins_url('scripts/bxslider/jquery.bxslider.css', __FILE__), false, '1');
            wp_enqueue_style( 'wp-jquery-ui-dialog' );

            wp_register_script( 'cUsMC_Scripts', plugins_url('scripts/cUsMC_scripts.js?pluginurl=' . dirname(__FILE__), __FILE__), array('jquery'), '1.0', true);
            wp_localize_script( 'cUsMC_Scripts', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
            wp_register_script( 'fancybox', plugins_url('scripts/fancybox/jquery.fancybox.pack.js', __FILE__), array('jquery'), '2.0.0', true);
            wp_register_script( 'tooltip', plugins_url('scripts/jquery-ui-custom/jquery-ui-1.10.3.custom.min.js', __FILE__), array('jquery'), '1.10.3', true);
            wp_register_script( 'bxslider', plugins_url('scripts/bxslider/jquery.bxslider.js', __FILE__), array('jquery'), '4.1.1', true);

            wp_enqueue_script( 'jquery' ); //JQUERY WP CORE
            wp_enqueue_script( 'jquery-ui-core' );
            wp_enqueue_script( 'jquery-ui-accordion' );
            wp_enqueue_script( 'jquery-ui-tabs' );
            wp_enqueue_script( 'jquery-ui-button' );
            wp_enqueue_script( 'jquery-ui-selectable' );
            wp_enqueue_script( 'jquery-ui-dialog' );
            wp_enqueue_script( 'fancybox' );
            wp_enqueue_script( 'tooltip' );
            wp_enqueue_script( 'bxslider' );
            
            wp_enqueue_script('cUsMC_Scripts');
        }
    }

}
add_action('admin_enqueue_scripts', 'cUsMC_admin_header'); // cUsMC_admin_header hook
//END CONTACTUS.COM PLUGIN STYLES CSS

function cUsMC_plugin_links($links, $file) {
    if ($file == plugin_basename(__FILE__)) {
        $links[] = '<a target="_blank" style="color: #42a851; font-weight: bold;" href="http://help.contactus.com/">' . __("Get Support", "cus_plugin") . '</a>';
    }
    return $links;
}

add_filter('plugin_row_meta', 'cUsMC_plugin_links', 10, 2);


/*
 * Register the settings
 */
add_action('admin_init', 'cUsMC_register_settings');

function cUsMC_register_settings() {
    return false;
}

function cUsMC_settings_validate($args) {

    //make sure you return the args
    return $args;
}

//Display the validation errors and update messages

/*
 * Admin notices
 */

function cUsMC_admin_notices() {
    settings_errors();
}

add_action('admin_notices', 'cUsMC_admin_notices');

if ( is_admin() ) {
    add_action('media_buttons', 'cUsMC_set_media_cus_forminsert_button', 100);
    function cUsMC_set_media_cus_forminsert_button() {
        $xHtml_mediaButton = '<a href="javascript:;" class="insertShortcode" title="'.__('Insert Contactus.com Form').'">';
            $xHtml_mediaButton .= '<img hspace="5" src="'.plugins_url('style/images/favicon.gif', __FILE__).'" alt="'.__('Insert ContactUs.com Form').'" />';
        $xHtml_mediaButton .= '</a>';
        //print $xHtml_mediaButton;
    }
}


function cUsMC_JS_into_html() {
    if (!is_admin()) {
        
        //$pageID = get_the_ID();//bug
        $pageID         = ( get_the_ID() == 1) ? 'home' : get_the_ID();//bug fixed
        $pageSettings = get_post_meta( $pageID, 'cUsMC_FormByPage_settings', false );
        
        if($pageID == 'home'){
            $pageSettings = get_option('cUsMC_HOME_settings');//UPDATE FORM SETTINGS 
        }
        
        if(is_array($pageSettings) && !empty($pageSettings)){ //NEW VERSION 3.0
            
            if ($pageID == 'home') {
                $boolTab = $pageSettings['tab_user'];
                $cus_version = $pageSettings['cus_version'];
                $form_key = $pageSettings['form_key'];
            }else{
                $boolTab        = $pageSettings[0]['tab_user'];
                $cus_version    = $pageSettings[0]['cus_version'];
                $form_key       = $pageSettings[0]['form_key'];
            }
            
            if($cus_version == 'tab'){
                
                $userJScode = '<script type="text/javascript" src="//cdn.contactus.com/cdn/forms/' . $form_key . '/contactus.js"></script>';
            
                echo $userJScode;
            }//endif
            
        }else{ //PREVIOUS VERSIONS
            
            $formOptions    = get_option('cUsMC_FORM_settings');//GET THE NEW FORM OPTIONS
            $getTabPages    = get_option('cUsMC_settings_tabpages');

            $getInlinePages = get_option('cUsMC_settings_inlinepages');
            $form_key       = get_option('cUsMC_settings_form_key');
            $pageID         = ( get_the_ID() == 1) ? 'home' : get_the_ID();

            $boolTab = $formOptions['tab_user'];
            $cus_version = $formOptions['cus_version'];

            $userJScode = '<script type="text/javascript" src="//cdn.contactus.com/cdn/forms/' . $form_key . '/contactus.js"></script>';

            //the theme must have the wp_footer() function included
            //include the contactUs.com JS before the </body> tag
            switch ($cus_version) {
                case 'tab':
                    if (strlen($form_key) && $boolTab){
                        echo $userJScode;
                    }
                    break;
                case 'selectable':
                    if (strlen($form_key) && is_array($getTabPages) && in_array($pageID, $getTabPages)){
                        echo $userJScode;
                    };
                    break;
            }
            
        } //endif
        
    }
}
add_action('wp_footer', 'cUsMC_JS_into_html'); // ADD JS BEFORE BODY TAG

function cUsMC_inline_home() {

    $formOptions    = get_option('cUsMC_FORM_settings');//GET THE NEW FORM OPTIONS
    $form_key       = get_option('cUsMC_settings_form_key');
    $cus_version    = $formOptions['cus_version'];
    if ($cus_version == 'inline' || $cus_version == 'selectable') {
        $inlineJS_output = '<div style="min-height: 300px; min-width: 350px;clear:both;"><script type="text/javascript" src="//cdn.contactus.com/cdn/forms/' . $form_key . '/inline.js"></script></div>';
    }else{
        $inlineJS_output = '';
    }

    echo $inlineJS_output;
}

function cUsMC_page_settings_cleaner() {
    $aryPages = get_pages();
    foreach ($aryPages as $oPage) {
        delete_post_meta($oPage->ID, 'cUsMC_FormByPage_settings');//reset values
        cUsMC_inline_shortcode_cleaner_by_ID($oPage->ID); //RESET SC
    }
}

function cUsMC_inline_shortcode_cleaner() {
    $aryPages = get_pages();
    foreach ($aryPages as $oPage) {
        $pageContent = $oPage->post_content;
        $pageContent = str_replace('[show-mailchimp-form]', '', $pageContent);
        $aryPage = array();
        $aryPage['ID'] = $oPage->ID;
        $aryPage['post_content'] = $pageContent;
        wp_update_post($aryPage);
    }
}

function cUsMC_inline_shortcode_cleaner_by_ID($inline_req_page_id) {
    $oPage = get_page( $inline_req_page_id );
    
    $pageContent = $oPage->post_content;
    $pageContent = str_replace('[show-mailchimp-inline-form]', '', $pageContent);
    $pageContent = str_replace('[show-mailchimp-form]', '', $pageContent);
    $aryPage = array();
    $aryPage['ID'] = $oPage->ID;
    $aryPage['post_content'] = $pageContent;
    
    wp_update_post($aryPage);
    
}

function cus_mc_shortcode_cleaner() {
    $aryPages = get_pages();
    foreach ($aryPages as $oPage) {
        $pageContent = $oPage->post_content;
        $pageContent = str_replace('[show-mailchimp-inline-form]', '', $pageContent);
        $aryPage = array();
        $aryPage['ID'] = $oPage->ID;
        $aryPage['post_content'] = $pageContent;
        wp_update_post($aryPage);
    }
}

add_shortcode("show-mailchimp-form", "cUsMC_shortcode_handler"); //[show-mailchimp-form]

function cUsMC_shortcode_handler($aryFormParemeters) {
    
    $cUsMC_credentials = get_option('cUsMC_settings_userCredentials'); //GET USERS CREDENTIALS V2.0 API 1.9
    
    if(!empty($cUsMC_credentials)){ 
        
        $pageID = get_the_ID();
        $pageSettings = get_post_meta( $pageID, 'cUsMC_FormByPage_settings', false );
        $inlineJS_output = '';

        if(is_array($pageSettings) && !empty($pageSettings)){ //NEW VERSION 3.0

            $boolTab        = $pageSettings[0]['tab_user'];
            $cus_version    = $pageSettings[0]['cus_version'];
            $form_key       = $pageSettings[0]['form_key'];

            if ($cus_version == 'inline' || $cus_version == 'selectable') {
               
                $inlineJS_output = '<div style="min-height: 200px; min-width: 340px; clear:both;"><script type="text/javascript" src="//cdn.contactus.com/cdn/forms/' . $form_key . '/inline.js"></script></div>';
               
            }

        }elseif(is_array($aryFormParemeters)){

            if($aryFormParemeters['version'] == 'tab'){
                $Fkey = $aryFormParemeters['formkey'];
                update_option('cUsMC_settings_FormKey_SC', $Fkey);
                do_action('wp_footer', $Fkey);
                add_action('wp_footer', 'cUsMC_shortcodeTab'); // ADD JS BEFORE BODY TAG
            }else{
                
                $inlineJS_output = '<div style="min-height: 200px; min-width: 340px; clear:both;"><script type="text/javascript" src="//cdn.contactus.com/cdn/forms/' . $aryFormParemeters['formkey'] . '/inline.js"></script></div>';
                
            }

        }else{   //OLDER VERSION < 1.2.5 //UPDATE 
            $formOptions    = get_option('cUsMC_FORM_settings');//GET THE NEW FORM OPTIONS
            $form_key       = get_option('cUsMC_settings_form_key');
            $cus_version    = $formOptions['cus_version'];

            if ($cus_version == 'inline' || $cus_version == 'selectable'){
                
                $inlineJS_output = '<div style="min-height: 200px; min-width: 340px; clear:both;"><script type="text/javascript" src="//cdn.contactus.com/cdn/forms/' . $form_key . '/inline.js"></script></div>';
                
            }

        }

        return $inlineJS_output;
    }else{
        
        return '<p>MailChimp by ContactUs.com user Credentials Missing . . . <br/>Please Login Again <a href="'.get_admin_url().'admin.php?page=cUs_form_plugin" target="_blank">here</a>, Thank You.</p>';
        
    }
    
}


add_shortcode("show-mailchimp-inline-form", "cus_mc_shortcode_handler"); //[show-contactus.com-form]

function cus_mc_shortcode_handler() {

    $formOptions    = get_option('cUsMC_FORM_settings');//GET THE NEW FORM OPTIONS
    $form_key       = get_option('cUsMC_settings_form_key');
    $cus_version    = $formOptions['cus_version'];
    if ($cus_version == 'inline' || $cus_version == 'selectable') :
        
        $inlineJS_output = '<div style="min-height: 200px; min-width: 340px; clear:both;"><script type="text/javascript" src="//cdn.contactus.com/cdn/forms/' . $form_key . '/inline.js"></script></div>';
    
    else:
        $inlineJS_output = '';
    endif;

    return $inlineJS_output;
}

function cUsMC_shortcodeTab($Args) {
    
    $form_key = get_option('cUsMC_settings_FormKey_SC');
    
    if ( !is_admin() && strlen($form_key) ) {
        $userJScode = '<script type="text/javascript" src="//cdn.contactus.com/cdn/forms/' . $form_key . '/contactus.js"></script>';
        echo $userJScode;
    }
}


function cUsMC_inline_shortcode_add($inline_req_page_id) {
    
    if($inline_req_page_id != 'home'){
        $oPage = get_page($inline_req_page_id);
        $pageContent = $oPage->post_content;
        $pageContent = $pageContent . "\n[show-mailchimp-form]";
        $aryPage = array();
        $aryPage['ID'] = $inline_req_page_id;
        $aryPage['post_content'] = $pageContent;
        
        cUsMC_inline_shortcode_cleaner_by_ID($inline_req_page_id);
        
        return wp_update_post($aryPage);
        
    }
    
}

$cus_dirbase = trailingslashit(basename(dirname(__FILE__)));
$cus_dir = trailingslashit(WP_PLUGIN_DIR) . $cus_dirbase;
$cus_url = trailingslashit(WP_PLUGIN_URL) . $cus_dirbase;
define('cUsMC_DIR', $cus_dir);
define('cUsMC_URL', $cus_url);

// WIDGET CALL
function contactus_mc_register_widgets() {
    register_widget('contactus_mailchimp_Widget');
}

add_action('widgets_init', 'contactus_mc_register_widgets');

//CONTACTUS.COM ADD FORM TO PLUGIN PAGE

// Add option page in admin menu
if (!function_exists('cUsMC_admin_menu')) {

    function cUsMC_admin_menu() {
        add_menu_page('MailChimp Form by ContactUs.com', 'MailChimp Form', 'edit_themes', 'cUs_malchimp_plugin', 'cUsMC_menu_render', plugins_url("style/images/mailchimp_icon_16.png", __FILE__));
    }

}
add_action('admin_menu', 'cUsMC_admin_menu'); // cUsMC_admin_menu hook

if (!function_exists('cUsMC_plugin_db_uninstall')) {

    function cUsMC_plugin_db_uninstall() {

        $cUsMC_api = new cUsComAPI_MC();
        $cUsMC_api->resetData(); //RESET DATA
        
        cUsMC_page_settings_cleaner();
        
    }
    
}
register_uninstall_hook(__FILE__, 'cUsMC_plugin_db_uninstall');


/* Display a notice that can be dismissed */
add_action('admin_notices', 'cUsMC_update_admin_notice');
function cUsMC_update_admin_notice() {
	global $current_user ;
        $user_id = $current_user->ID;
        $aryUserCredentials = get_option('cUsMC_settings_userCredentials');
        $form_key       = get_option('cUsMC_settings_form_key');
        $cUs_API_Account    = $aryUserCredentials['API_Account'];
        $cUs_API_Key        = $aryUserCredentials['API_Key'];
        
	if ( ! get_user_meta($user_id, 'cUsMC_ignore_notice') && !strlen($cUs_API_Account) && !strlen($cUs_API_Key) && strlen($form_key)) {
            echo '<div class="updated"><p>';
            printf(__('MailChimp Form has been updated!. Pleas take time to activate your new live features <a href="%1$s">here</a>. | <a href="%2$s">Hide Notice</a>'), 'admin.php?page=cUs_malchimp_plugin', '?cUsMC_ignore_notice=0');
            echo "</p></div>";
	}
}
add_action('admin_init', 'cUsMC_nag_ignore');
function cUsMC_nag_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['cUsMC_ignore_notice']) && '0' == $_GET['cUsMC_ignore_notice'] ) {
             add_user_meta($user_id, 'cUsMC_ignore_notice', 'true', true);
	}
}


?>