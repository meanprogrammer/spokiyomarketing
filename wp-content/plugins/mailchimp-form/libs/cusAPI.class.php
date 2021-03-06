<?php

error_reporting(0);

//CONTACTUS.COM API V1.9
//www.contactus.com
//2013 copyright

class cUsComAPI_MC {
    
    var $v = '1.9a';
    
    public function cUsComAPI_MC(){
        $cUs_email = '';
        $cUs_formkey = '';
        
        return TRUE;
    }
    
    public function getAPICredentials($cUs_email, $cUs_pass){
    
        $cUs_email = preg_replace( '/\s+/', '%20', $cUs_email );

        $ch = curl_init();

        $strCURLOPT  = 'https://api.contactus.com/api2.php';
        $strCURLOPT .= '?API_Account=AC132f1ca7ff5040732b787564996a02b46cc4b58d';
        $strCURLOPT .= '&API_Key=cd690cf4f450950e857b417710b656923cf4b579';
        $strCURLOPT .= '&API_Action=getAPICredentials';
        $strCURLOPT .= '&Email=' . trim($cUs_email);
        $strCURLOPT .= '&Password=' . trim($cUs_pass);

        curl_setopt($ch, CURLOPT_URL, $strCURLOPT);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);  
        curl_close($ch);

        return $content;
    }
    
    public function sendAPICredentials($cUs_email){
    
        $cUs_email = preg_replace( '/\s+/', '%20', $cUs_email );

        $ch = curl_init();

        $strCURLOPT  = 'https://api.contactus.com/api2.php';
        $strCURLOPT .= '?API_Account=AC132f1ca7ff5040732b787564996a02b46cc4b58d';
        $strCURLOPT .= '&API_Key=cd690cf4f450950e857b417710b656923cf4b579';
        $strCURLOPT .= '&API_Action=sendAPICredentials';
        $strCURLOPT .= '&Email=' . trim($cUs_email);

        curl_setopt($ch, CURLOPT_URL, $strCURLOPT);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);  
        curl_close($ch);

        return $content;
    }
    
    public function createCustomer($postData){
        
        if      ( !strlen($postData['fname']) ){      echo ' "Missing First Name, is required field!" ' ; 
        }elseif  ( !strlen($postData['lname']) ){      echo ' "Missing Last Name, is required field!" ';
        }elseif  ( !strlen($postData['email']) ){      echo ' "Missing Email, is required field!" ';
        }elseif  ( !strlen($postData['website']) ){    echo ' "Missing Website, is required field!" ';
        }else{
         
            $postData = preg_replace( '/\s+/', '%20', $postData );

            $ch = curl_init();

            $strCURLOPT  = 'https://api.contactus.com/api2.php';
            $strCURLOPT .= '?API_Account=AC132f1ca7ff5040732b787564996a02b46cc4b58d';
            $strCURLOPT .= '&API_Key=cd690cf4f450950e857b417710b656923cf4b579';
            $strCURLOPT .= '&API_Action=createSignupCustomer';
            $strCURLOPT .= '&First_Name='.trim($postData['fname']);
            $strCURLOPT .= '&Last_Name='.trim($postData['lname']);
            $strCURLOPT .= '&Email='.trim($postData['email']);
            $strCURLOPT .= '&Website='.esc_url(trim($postData['website']));;
            $strCURLOPT .= '&IP_Address='.$this->getIP();
            $strCURLOPT .= '&MailChimp_Delivery_Api_Key='.trim($postData['MC_apikey']);
            $strCURLOPT .= '&MailChimp_Delivery_Unique_List_ID='.trim($postData['listID']);
            $strCURLOPT .= '&Template_Desktop_Form='.trim($postData['Template_Desktop_Form']);
            $strCURLOPT .= '&Template_Desktop_Tab='.trim($postData['Template_Desktop_Tab']);
            $strCURLOPT .= '&Auto_Activate=1';
            $strCURLOPT .= '&API_Credentials=1';
            $strCURLOPT .= '&Promotion_Code=WPMC';
            $strCURLOPT .= '&Version=mc|2.0';

            curl_setopt($ch, CURLOPT_URL, $strCURLOPT);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $content = curl_exec($ch);
            curl_close($ch);
            
            return $content;
            
        } //endif
        
    }
    
    public function verifyCustomerEmail($cUs_email){
    
        $cUs_email = preg_replace( '/\s+/', '%20', $cUs_email );

        $ch = curl_init();

        $strCURLOPT  = 'https://api.contactus.com/api2.php';
        $strCURLOPT .= '?API_Account=AC132f1ca7ff5040732b787564996a02b46cc4b58d';
        $strCURLOPT .= '&API_Key=cd690cf4f450950e857b417710b656923cf4b579';
        $strCURLOPT .= '&API_Action=verifyCustomerEmail';
        $strCURLOPT .= '&Email=' . trim($cUs_email);

        curl_setopt($ch, CURLOPT_URL, $strCURLOPT);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);  
        curl_close($ch);

        return $content;
    }
    
    public function getTemplatesAndTabsAll($formType, $selType){
        
        if(!strlen($formType) || !strlen($selType)) return false;
        
        $ch = curl_init();

        $strCURLOPT  = 'https://api.contactus.com/api2.php';
        $strCURLOPT .= '?API_Account=AC132f1ca7ff5040732b787564996a02b46cc4b58d';
        $strCURLOPT .= '&API_Key=cd690cf4f450950e857b417710b656923cf4b579';
        $strCURLOPT .= '&API_Action=getTemplatesAndTabsAll';
        $strCURLOPT .= '&Form_Type=' . trim($formType);
        $strCURLOPT .= '&Selection_Type=' . trim($selType);

        curl_setopt($ch, CURLOPT_URL, $strCURLOPT);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);  
        curl_close($ch);

        return $content;
    }
    
    public function getTemplatesAndTabsFree($aryTemplates){
        
        $contacFormTemplates = $this->getTemplatesAndTabsAll('1', 'Template_Desktop_Form');
        $contacFormTemplates = json_decode($contacFormTemplates);
        $contacFormTemplates = $contacFormTemplates->data;
    }
    
    public function getTemplatesAndTabsAllowed($formType, $selType, $cUs_API_Account, $cUs_API_Key){
        
        if(!strlen($formType) || !strlen($selType) || !strlen($cUs_API_Account) || !strlen($cUs_API_Key)) return false;
        
        $ch = curl_init();

        $strCURLOPT  = 'https://api.contactus.com/api2.php';
        $strCURLOPT .= '?API_Account='.trim($cUs_API_Account);
        $strCURLOPT .= '&API_Key='.trim($cUs_API_Key);
        $strCURLOPT .= '&API_Action=getTemplatesAndTabsAllowed';
        $strCURLOPT .= '&Form_Type=' . trim($formType);
        $strCURLOPT .= '&Selection_Type=' . trim($selType);

        curl_setopt($ch, CURLOPT_URL, $strCURLOPT);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);  
        curl_close($ch);

        return $content;
    }
    
    public function getFormKeysAPI($cUs_API_Account, $cUs_API_Key){
        
        $ch = curl_init();

        $strCURLOPT  = 'https://api.contactus.com/api2.php';
        $strCURLOPT .= '?API_Account='.trim($cUs_API_Account);
        $strCURLOPT .= '&API_Key='.trim($cUs_API_Key);
        $strCURLOPT .= '&API_Action=getFormKeys';

        curl_setopt($ch, CURLOPT_URL, $strCURLOPT);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);  
        curl_close($ch);

        return $content;
    }
    
    public function getFormKeyAPI($cUs_email, $cUs_pass){
    
        $cUs_email = preg_replace( '/\s+/', '%20', $cUs_email );

        $ch = curl_init();

        $strCURLOPT  = 'https://api.contactus.com/api2.php';
        $strCURLOPT .= '?API_Account=AC00000bb19ec0c1dd1fe715ef23afa9cf';
        $strCURLOPT .= '&API_Key=00000bb19ec0c1dd1fe715ef23afa9cf';
        $strCURLOPT .= '&API_Action=getFormKey';
        $strCURLOPT .= '&Email=' . trim($cUs_email);
        $strCURLOPT .= '&Password=' . trim($cUs_pass);

        curl_setopt($ch, CURLOPT_URL, $strCURLOPT);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);  
        curl_close($ch);

        return $content;
    }
    
    public function updateFormSettings($postData, $formkey){
    
        $postData = preg_replace( '/\s+/', '%20', $postData );

        $ch = curl_init();

        $strCURLOPT  = 'https://api.contactus.com/api2.php';
        $strCURLOPT .= '?API_Account='.trim($postData['API_Account']);
        $strCURLOPT .= '&API_Key='.trim($postData['API_Key']);
        $strCURLOPT .= '&API_Action=updateFormSettings';
        $strCURLOPT .= '&Form_Key=' . trim($formkey);
        
        if(strlen($postData['Template_Desktop_Form']))
        $strCURLOPT .= '&Template_Desktop_Form='.trim($postData['Template_Desktop_Form']);
        
        if(strlen($postData['Template_Desktop_Tab']))
        $strCURLOPT .= '&Template_Desktop_Tab='.trim($postData['Template_Desktop_Tab']);

        curl_setopt($ch, CURLOPT_URL, $strCURLOPT);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);  
        curl_close($ch);

        return $content;
    }
    
    public function updateDeliveryOptions($postData, $formkey){
    
        $postData = preg_replace( '/\s+/', '%20', $postData );

        $ch = curl_init();

        $strCURLOPT  = 'https://api.contactus.com/api2.php';
        $strCURLOPT .= '?API_Account=' . trim($postData['API_Account']);
        $strCURLOPT .= '&API_Key=' . trim($postData['API_Key']);
        $strCURLOPT .= '&API_Action=updateDeliveryOptions';
        $strCURLOPT .= '&Form_Key=' . trim($postData['Form_Key']);
        $strCURLOPT .= '&MailChimp_Delivery_Enabled=1';
        $strCURLOPT .= '&MailChimp_Delivery_Api_Key=' . trim($postData['MC_apikey']);
        $strCURLOPT .= '&MailChimp_Delivery_Unique_List_ID=' . trim($postData['listID']);

        curl_setopt($ch, CURLOPT_URL, $strCURLOPT);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);  
        curl_close($ch);

        return $content;
    }
    
    public function getDeliveryOptions($cUs_API_Account, $cUs_API_Key, $formkey){
        
        $ch = curl_init();

        $strCURLOPT  = 'https://api.contactus.com/api2.php';
        $strCURLOPT .= '?API_Account='.trim($cUs_API_Account);
        $strCURLOPT .= '&API_Key='.trim($cUs_API_Key);
        $strCURLOPT .= '&API_Action=getDeliveryOptions';
        $strCURLOPT .= '&Form_Key=' . trim($formkey);

        curl_setopt($ch, CURLOPT_URL, $strCURLOPT);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);  
        curl_close($ch);

        return $content;
    }
    
    public function str_clean($str){
        $str = str_replace( "'", '', $str );
        $str = str_replace( '\'', '', $str );
        
        return $str;
    }


    public function getIP() {

        // Get some headers that may contain the IP address
        $SimpleIP = (isset($REMOTE_ADDR) ? $REMOTE_ADDR :getenv("REMOTE_ADDR"));

        $TrueIP = (isset($HTTP_CUSTOM_FORWARDED_FOR) ? $HTTP_CUSTOM_FORWARDED_FOR : getenv("HTTP_CUSTOM_FORWARDED_FOR"));
        if ($TrueIP == "") $TrueIP = (isset($HTTP_X_FORWARDED_FOR) ? $HTTP_X_FORWARDED_FOR : getenv("HTTP_X_FORWARDED_FOR"));
        if ($TrueIP == "") $TrueIP = (isset($HTTP_X_FORWARDED) ? $HTTP_X_FORWARDED : getenv("HTTP_X_FORWARDED"));
        if ($TrueIP == "") $TrueIP = (isset($HTTP_FORWARDED_FOR) ? $HTTP_FORWARDED_FOR : getenv("HTTP_FORWARDED_FOR"));
        if ($TrueIP == "") $TrueIP = (isset($HTTP_FORWARDED) ? $HTTP_FORWARDED : getenv("HTTP_FORWARDED"));

        $GetProxy = ($TrueIP == "" ? "0" : "1");

        if ($GetProxy == "0") {
            $TrueIP = (isset($HTTP_VIA) ? $HTTP_VIA : getenv("HTTP_VIA"));
            if ($TrueIP == "") $TrueIP = (isset($HTTP_X_COMING_FROM) ? $HTTP_X_COMING_FROM : getenv("HTTP_X_COMING_FROM"));
            if ($TrueIP == "") $TrueIP = (isset($HTTP_COMING_FROM) ? $HTTP_COMING_FROM : getenv("HTTP_COMING_FROM"));
            if ($TrueIP != "") $GetProxy = "2";
        };

        if ($TrueIP == $SimpleIP) $GetProxy = "0";

        // Return the true IP if found, else the proxy IP with a 'p' at the begining
        switch ($GetProxy) {
            case '0':
                // True IP without proxy
                $IP = $SimpleIP;
                break;
            case '1':
                $b = preg_match("%^([0-9]{1,3}\.){3,3}[0-9]{1,3}%", $TrueIP, $IP_array);
                if ($b && (count($IP_array) > 0)) {
                    // True IP behind a proxy
                    $IP = $IP_array[0];
                } else {
                    // Proxy IP
                    $IP = $SimpleIP;
                };
                break;
            case '2':
                // Proxy IP
                $IP = $SimpleIP;
        };

        $IP = trim($IP);
        if (filter_var($IP, FILTER_VALIDATE_IP) && $IP != '127.0.0.1' && $IP != '::1') {
            $vIP = $IP;
        } else {
            $externalContent = file_get_contents('http://checkip.dyndns.com/');
            preg_match('/Current IP Address: ([\[\]:.[0-9a-fA-F]+)</', $externalContent, $m);
            $vIP = $m[1];
        }

        return $IP;
    }
    
    public function resetData(){
        delete_option( 'cUsMC_settings' );
        delete_option( 'cUsMC_FormByPage_settings' );
        delete_option( 'cUsMC_settings_userData' );
        delete_option( 'cUsMC_FORM_settings' );
        delete_option( 'cUsMC_settings_form_key' );
        delete_option( 'cUsMC_HOME_settings' );
        delete_option( 'cUsMC_settings_inlinepages' );
        delete_option( 'cUsMC_settings_tabpages' );
        delete_option( 'cUsMC_settings_userCredentials' );
        delete_option( 'cUsMC_settings_api_key' );  
        delete_option( 'cUsMC_settings_form_key' );  
        delete_option( 'cUsMC_settings_list_Name' );  
        delete_option( 'cUsMC_settings_FormKey_SC' );  
        delete_option( 'cUsMC_settings_list_ID' );  
        
        cUsMC_page_settings_cleaner();
        cUsMC_inline_shortcode_cleaner();
        
        //echo 'deleted data. . .';
        
        return true;
    }
}
?>