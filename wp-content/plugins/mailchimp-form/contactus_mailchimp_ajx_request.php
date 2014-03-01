<?php

// loginAlreadyUser handler function...
add_action('wp_ajax_cUsMC_loginAlreadyUser', 'cUsMC_loginAlreadyUser_callback');
function cUsMC_loginAlreadyUser_callback() {
    
    $cUsMC_api = new cUsComAPI_MC();
    $cUs_email = $_REQUEST['email'];
    $cUs_pass = $_REQUEST['pass'];
    
    $cUsMC_API_credentials = $cUsMC_api->getAPICredentials($cUs_email, $cUs_pass); //api hook;
    
    if($cUsMC_API_credentials){
        
        $cUs_json = json_decode($cUsMC_API_credentials);
        
        switch ( $cUs_json->status  ) {
            case 'success':
                
                $cUs_API_Account    = $cUs_json->api_account;
                $cUs_API_Key        = $cUs_json->api_key;
                
                if(strlen(trim($cUs_API_Account)) && strlen(trim($cUs_API_Key))){
                    
                    $aryUserCredentials = array(
                        'API_Account' => $cUs_API_Account,
                        'API_Key'     => $cUs_API_Key
                    );
                    update_option('cUsMC_settings_userCredentials', $aryUserCredentials);
                    
                    $cUsMC_API_getKeysResult = $cUsMC_api->getFormKeysAPI($cUs_API_Account, $cUs_API_Key); //api hook;
                    $old_options = get_option('contactus_settings'); //GET THE NEW OPTIONS
                    
                    $cUs_jsonKeys = json_decode($cUsMC_API_getKeysResult);
                
                    if($cUs_jsonKeys->status == 'success' ){
                        
                        $aryUserData = array( 'uE' => $cUs_email, 'uC' => $cUs_pass );
                        update_option('cUsMC_settings_crypt', $aryUserData);
                        
                        foreach ($cUs_jsonKeys as $oForms => $oForm) {
                            if ($oForms !='status' && $oForm->form_type == 1 && $oForm->default == 1){ //GET DEFAULT CONTACT FORM KEY
                               $defaultFormKey = $oForm->form_key;
                            }
                        }  
                            
                        if(!strlen($defaultFormKey)){
                                //echo 2; //NO ONE CONTACT FORM 
                                
                                $aryResponse = array(
                                    'uE' => $cUs_email,
                                    'uC' => $cUs_pass,
                                    'status' => 2
                                );
                                
                               
                        }else if(empty($old_options)){
                            
                            $aryFormOptions = array('tab_user' => 1,'cus_version' => 'tab'); //DEFAULT SETTINGS / FIRST TIME
                            
                            update_option('cUsMC_FORM_settings', $aryFormOptions );//UPDATE FORM SETTINGS
                            update_option('cUsMC_settings_form_key', $defaultFormKey);//DEFAULT FORM KEYS
                            update_option('cUsMC_settings_form_keys', $cUs_jsonKeys); // ALL FORM KEYS
                            
                            //echo 1;
                            $aryResponse = array('status' => 1);
                            
                        } else{
                            
                            if(strlen($old_options['form_key'])){
                                
                                //print_r($old_options);
                                update_option('cUsMC_FORM_settings', $old_options );//UPDATE FORM SETTINGS
                                update_option('cUsMC_settings_form_key', $defaultFormKey);//DEFAULT FORM KEYS
                                
                                $aryTabPages = get_option('cUsMC_settings_tabpages');
                                $aryInlinePages = get_option('cUsMC_settings_inlinepages');
                                
                                if(!empty($aryTabPages) && is_array($aryTabPages)){
                                    
                                    foreach ($aryTabPages as $pageID){
                                        
                                        $aryFormOptions = array( //LOAD OLD PAGE SETTINGS / FIRST TIME
                                            'tab_user'          => 1,
                                            'form_key'          => $old_options['form_key'],   
                                            'cus_version'       => 'tab'
                                        );

                                        if($pageID != 'home'){
                                            update_post_meta($pageID, 'cUsMC_FormByPage_settings', $aryFormOptions);//SAVE DATA ON POST TYPE PAGE METAS
                                        }else{
                                            update_option('cUsMC_HOME_settings', $aryFormOptions );//UPDATE FORM SETTINGS 
                                        }
                                        
                                    } //endforeach
                                    
                                }
                                    
                                
                                if(!empty($aryInlinePages) && is_array($aryInlinePages)){
                                    foreach ($aryInlinePages as $pageID){
                                        
                                        $aryFormOptions = array( //LOAD OLD PAGE SETTINGS / FIRST TIME
                                            'tab_user'          => 0,
                                            'form_key'          => $old_options['form_key'],   
                                            'cus_version'       => 'inline'
                                        );

                                        if($pageID != 'home'){
                                            update_post_meta($pageID, 'cUsMC_FormByPage_settings', $aryFormOptions);//SAVE DATA ON POST TYPE PAGE METAS
                                        }else{
                                            update_option('cUsMC_HOME_settings', $aryFormOptions );//UPDATE FORM SETTINGS 
                                        }
                                        
                                    } //endforeach
                                }
                                
                                //echo 1;
                                $aryResponse = array('status' => 1);
                                
                            }
                            
                            
                        } //endif
                        
                    }else{
                        $aryResponse = array('status' => 3, 'message' => $cUs_json->error);
                    } //endif;
                    
                }else{
                    $aryResponse = array('status' => 3, 'message' => $cUs_json->error);
                } //endif
                
                break;

            case 'error':
                $aryResponse = array('status' => 3, 'message' => $cUs_json->error);
                break;
            
        } //endswitch
    }
    
    echo json_encode($aryResponse);
    
    die();
}

// loginAlreadyUser handler function...
add_action('wp_ajax_cUsMC_updateDeliveryOptions', 'cUsMC_updateDeliveryOptions_callback');
function cUsMC_updateDeliveryOptions_callback() {
    
    $cUsMC_api = new cUsComAPI_MC(); //CONTACTUS.COM API
    $cUsMC_userData = get_option('cUsMC_settings_userCredentials'); //get the saved user data
    $form_key = $_REQUEST['formkey'];
    
    $postData = array(
        'API_Account'       => $cUsMC_userData['API_Account'],
        'API_Key'           => $cUsMC_userData['API_Key'],
        'Form_Key'          => $_REQUEST['form_key'],
        'MC_apikey'         => $_REQUEST['MC_apikey'],
        'listID'            => $_REQUEST['MC_listID']
    );
    
    $cUsMC_API_result = $cUsMC_api->updateDeliveryOptions($postData, $form_key); //UPDATE DELIVERY OPTIONS;
    
    if($cUsMC_API_result) {

        $cUs_json = json_decode($cUsMC_API_result);

        switch ( $cUs_json->status  ) {

            case 'success':
                echo 1;
                break;
            default :
                echo $cUs_json->error;
                break;
        }
    }
    
    die();
}


// checkMCapikey handler function...
add_action('wp_ajax_cUsMC_checkMCapikey_step1', 'cUsMC_checkMCapikey_step1_callback');
function cUsMC_checkMCapikey_step1_callback() {
        
    $api_key = trim($_REQUEST['apikey']);

    //apis instances
    $MC_api = new mailchimpSF_MCAPI($api_key);//MC API // trying to make just one call since 1.2
    $cUsMC_api = new cUsComAPI_MC(); //CONTACTUS.COM API
    
    $userData = $MC_api->getAccountDetails();
    
    if ( $userData ){
        
        $cUsMC_userData = array(
            'fname' => $userData['contact']['fname'],
            'lname' => $userData['contact']['lname'],
            'email' => $userData['contact']['email'],
            'MC_apikey' => $api_key
        );

        $MC_lists = $MC_api->lists(array(),0,100);
        $MC_lists = $MC_lists['data'];

        update_option('cUsMC_settings_MC_lists', $MC_lists);
        update_option('cUsMC_settings_userData', $cUsMC_userData);
        
        $cUsMC_API_EmailResult = $cUsMC_api->verifyCustomerEmail($userData['contact']['email']); //EMAIL VERIFICATION
        if($cUsMC_API_EmailResult) {
            
            $cUsMC_jsonEmail = json_decode($cUsMC_API_EmailResult);
            
            switch ($cUsMC_jsonEmail->result){
                case 0 :
                    
                    if ( is_array($MC_lists) && !empty($MC_lists) ) {
            
                        foreach ($MC_lists as $key => $list) {
                            $xHTML .= '<option value="' . $list['id'] . '">' . $list['name'] . '</option>';
                        }
                        
                        $aryResponse = array(
                            'fname' => $userData['contact']['fname'],
                            'lname' => $userData['contact']['lname'],
                            'email' => $userData['contact']['email'],
                            'options' => $xHTML,
                            'status' => 1
                        );
                        
                    } else {
                        $aryResponse = array('status' => 5); //empty matrix list
                    } //endif
                    
                    
                    break;
                case 1 :
                    $aryResponse = array(
                        'email'  => $userData['contact']['email'],
                        'status' => 2 ); //ALREDY CUS USER
                    break;
            } //endswitch
            
        }else{  
            $aryResponse = array('status' => 3, 'message'=>'Ouch! unfortunately there has being an error during the application, please try again');
            exit();
        }//endif

    }else{
        $aryResponse = array('status' => 4); //INVALID APIKEY
        //'There something wrong with your MailChimp API Key, please try again!';
    } //endif
    
    echo json_encode($aryResponse);
        
    die();
}

// checkMCapikey handler function...
add_action('wp_ajax_cUsMC_checkMCapikey', 'cusMC_checkMCapikey_callback');
function cusMC_checkMCapikey_callback() {
        
    $api_key = trim($_REQUEST['apikey']);

    //apis instances
    $MC_api = new mailchimpSF_MCAPI($api_key);//MC API // trying to make just one call since 1.2
    $userData = $MC_api->getAccountDetails();
    
    //print_r($userData);
    
    if ( $userData ){
        
        $cUsMC_userData = array(
            'fname' => $userData['contact']['fname'],
            'lname' => $userData['contact']['lname'],
            'email' => $userData['contact']['email'],
            'MC_apikey' => $api_key
        );

        $MC_lists = $MC_api->lists(array(),0,100);
        $MC_lists = $MC_lists['data'];

        update_option('cUsMC_settings_MC_lists', $MC_lists);
        update_option('cUsMC_settings_userData', $cUsMC_userData);
        
        echo 1; //VALID APIKEY

    }else{
        echo 2; //INVALID APIKEY
        //There something wrong with your MailChimp API Key, please try again!;
    } //endif
        
    die();
}


// getMCList handler function...
add_action('wp_ajax_cUsMC_getMCList', 'cUsMC_getMCList_callback');
function cUsMC_getMCList_callback() {
    
    $MC_lists = get_option('cUsMC_settings_MC_lists'); //get the saved mailchimp user LIST MATRIX
    $userData = get_option('cUsMC_settings_userData'); //get the saved mailchimp user data
    $xHTML = '';

    if($userData){
        
        if ( is_array($MC_lists) && !empty($MC_lists) ) {
            
            foreach( $MC_lists as $key => $list ) { $xHTML .= '<option value="'.$list['id'].'">'.$list['name'].'</option>'; }
            
            $aryResponse = array(
                'options'   => $xHTML,
                'fname'     => $userData['fname'],
                'lname'     => $userData['lname'],
                'email'     => $userData['email']
            );
            
        }else{
            $aryResponse = array('status' => 1); //empty matrix list
        } //endif

    }else{    
        $aryResponse = array('status' => 2); // no user data
    } //endif
    
    echo json_encode($aryResponse);
    
    die();
}

// getMCList handler function...
add_action('wp_ajax_cUsMC_getCryptData', 'cUsMC_getCryptData_callback');
function cUsMC_getCryptData_callback() {
    
    $userData = get_option('cUsMC_settings_crypt'); //get the saved mailchimp user
    
    $aryUserCredentials = get_option('cUsMC_settings_userCredentials'); //get the values, wont work the first time
    $cUs_API_Account    = $aryUserCredentials['API_Account'];
    $cUs_API_Key        = $aryUserCredentials['API_Key'];
    
    if(is_array($aryUserCredentials) && !empty($aryUserCredentials)){
        
        $aryResponse = array(
                            'uE' => $cUs_API_Account,
                            'uC' => $cUs_API_Key,
                            'status' => 1
                        );
    }else{
        $aryResponse = array('status' => 2); //empty matrix list
    }
    
    echo json_encode($aryResponse);
    
    die();
}

// getMCList by MC apikey handler function...
add_action('wp_ajax_cUsMC_getMCListByKEY', 'cUsMC_getMCListByKEY_callback');
function cUsMC_getMCListByKEY_callback() {
    
    $api_key = trim($_REQUEST['MC_apikey']);

    //apis instances
    $MC_api = new mailchimpSF_MCAPI($api_key);//MC API // trying to make just one call since 1.2
    $MC_lists = $MC_api->lists(array(),0,100);
    $MC_lists = $MC_lists['data'];
    
    $xHTML = '';
        
    if ( is_array($MC_lists) && !empty($MC_lists) ) {

        foreach( $MC_lists as $key => $list ) { $xHTML .= '<option value="'.$list['id'].'">'.$list['name'].'</option>'; }

        $aryResponse = array(
            'options'   => $xHTML,
            'status'    => 1
        );

    }else{
        $aryResponse = array('status' => 2, 'message'=>'Empty MailChimp Subscibers List :('); //empty matrix list
    } //endif
    
    echo json_encode($aryResponse);
    
    die();
}


// sendClientList handler function...
add_action('wp_ajax_cUsMC_sendClientList', 'cUsMC_sendClientList_callback');
function cUsMC_sendClientList_callback() {
    
    
    if       ( !strlen($_REQUEST['fName']) ){  echo 'Missing First Name, is required fieldsss!';      die();
    }elseif  ( !strlen($_REQUEST['lName']) ){  echo 'Missing Last Name, is required field!';       die();
    }elseif  ( !strlen($_REQUEST['Email']) ){  echo 'Missing/Invalid Email, is required field!';   die();
    }elseif  ( !strlen($_REQUEST['website'])){ echo 'Missing Website, is required field!';         die();
    }else{
    
        $cUsMC_userData = get_option('cUsMC_settings_userData'); //get the saved mailchimp user data
        
        $postData = array(
            'fname' => $_REQUEST['fName'],
            'lname' => $_REQUEST['lName'],
            'email' => $_REQUEST['Email'],
            'MC_apikey' => $cUsMC_userData['MC_apikey'],
            'website' => $_REQUEST['website'],
            'listID' => $_REQUEST['listID'],
            'mcListName' => $_REQUEST['mcListName']
        );

        if(update_option('cUsMC_settings_userData', $postData)) {
            echo 1;//GREAT
        } //endif
         
    } //endif
    
    die();
}


// cUsMC_createCustomer handler function...
add_action('wp_ajax_cUsMC_createCustomer', 'cUsMC_createCustomer_callback');
function cUsMC_createCustomer_callback() {
    
    $cUsMC_userData = get_option('cUsMC_settings_userData'); //get the saved user data
    
    if      ( !strlen($cUsMC_userData['fname']) ){      echo 'Missing First Name, is required fieldsss!';      die();
    }elseif  ( !strlen($cUsMC_userData['lname']) ){      echo 'Missing Last Name, is required field!';       die();
    }elseif  ( !strlen($cUsMC_userData['email']) ){      echo 'Missing/Invalid Email, is required field!';   die();
    }elseif  ( !strlen($cUsMC_userData['website']) ){    echo 'Missing Website, is required field!';         die();
    }elseif  ( !strlen($_REQUEST['Template_Desktop_Form']) ){    echo 'Missing Form Template!';         die();
    }elseif  ( !strlen($_REQUEST['Template_Desktop_Tab']) ){   echo 'Missing Tab Template!';         die();
    }else{
        
        $cUsMC_api = new cUsComAPI_MC(); //CONTACTUS.COM API
        
        $postData = array(
            'fname' => $cUsMC_userData['fname'],
            'lname' => $cUsMC_userData['lname'],
            'email' => $cUsMC_userData['email'],
            'website' => $cUsMC_userData['website'],
            'MC_apikey' => $cUsMC_userData['MC_apikey'],
            'listID' => $cUsMC_userData['listID'],
            'Template_Desktop_Form' => $_REQUEST['Template_Desktop_Form'],
            'Template_Desktop_Tab' => $_REQUEST['Template_Desktop_Tab']
        );
        
        $cUsMC_API_result = $cUsMC_api->createCustomer($postData);
        
        if($cUsMC_API_result) {

            $cUs_json = json_decode($cUsMC_API_result);

            switch ( $cUs_json->status  ) {

                case 'success':
                    echo 1;//GREAT
                    update_option('cUsMC_settings_form_key', $cUs_json->form_key ); //finally get form key form contactus.com // SESSION IN
                    $aryFormOptions = array( //DEFAULT SETTINGS / FIRST TIME
                        'tab_user'          => 1,
                        'cus_version'       => 'tab'
                    ); 
                    update_option('cUsMC_FORM_settings', $aryFormOptions );//UPDATE FORM SETTINGS
                    update_option('cUsMC_settings_userData', $postData);
                    
                    $cUs_API_Account    = $cUs_json->api_account;
                    $cUs_API_Key        = $cUs_json->api_key;
                    
                    $aryUserCredentials = array(
                        'API_Account' => $cUs_API_Account,
                        'API_Key'     => $cUs_API_Key
                    );
                    update_option('cUsMC_settings_userCredentials', $aryUserCredentials);
                    

                break;

                case 'error':

                    if($cUs_json->error[0] == 'Email exists'){
                        echo 2;//ALREDY CUS USER
                        //$cUsMC_api->resetData(); //RESET DATA
                    }else{
                        //ANY ERROR
                        echo $cUs_json->error;
                        //$cUsMC_api->resetData(); //RESET DATA
                    } //endif
                    
                break;


            } //endswitch
            
        }else{
             //echo 3;//API ERROR
             echo $cUs_json->error;
             // $cUsMC_api->resetData(); //RESET DATA
        } //endif
        
         
    } //endif;
    
    die();
}

// loginAlreadyUser handler function...
add_action('wp_ajax_cUsMC_LoadDefaultKey', 'cUsMC_LoadDefaultKey_callback');
function cUsMC_LoadDefaultKey_callback() {
    $cUsMC_api = new cUsComAPI_MC();
    $cUsMC_userData = get_option('cUsMC_settings_userData'); //get the saved user data
    $cUs_email = $cUsMC_userData['email'];
    $cUs_pass = $cUsMC_userData['credential'];
    
    $cUsMC_API_result = $cUsMC_api->getFormKeysAPI($cUs_email, $cUs_pass); //api hook;
    if($cUsMC_API_result){
        $cUs_json = json_decode($cUsMC_API_result);

        switch ( $cUs_json->status  ) {
            case 'success':
                
                foreach ($cUs_json as $oForms => $oForm) {
                    if ($oForms !='status' && $oForm->form_type == 1 && $oForm->default == 1){//GET DEFAULT CONTACT FORM KEY
                       $defaultFormKey = $oForm->form_key;
                    }
                }
                
                update_option('cUsMC_settings_form_key', $defaultFormKey); 
                
                echo 1;
                break;

            case 'error':
                echo $cUs_json->error;
                //$cUsMC_api->resetData(); //RESET DATA
                break;
        } //endswitch
    }
    
    die();
}


// cUsMC_verifyCustomerEmail handler function...
add_action('wp_ajax_cUsMC_verifyCustomerEmail', 'cUsMC_verifyCustomerEmail_callback');
function cUsMC_verifyCustomerEmail_callback() {
    
    if      ( !strlen($_REQUEST['fName']) ){      echo 'Missing First Name, is required fieldsss!';      die();
    }elseif  ( !strlen($_REQUEST['lName']) ){      echo 'Missing Last Name, is required field!';       die();
    }elseif  ( !strlen($_REQUEST['Email']) ){      echo 'Missing/Invalid Email, is required field!';   die();
    }elseif  ( !strlen($_REQUEST['website']) ){    echo 'Missing Website, is required field!';         die();
    }else{
        
        $cUsMC_api = new cUsComAPI_MC(); //CONTACTUS.COM API
        
        $postData = array(
            'fname' => $_REQUEST['fName'],
            'lname' => $_REQUEST['lName'],
            'email' => $_REQUEST['Email'],
            'website' => $_REQUEST['website']
        );

        $cUsMC_API_EmailResult = $cUsMC_api->verifyCustomerEmail($_REQUEST['Email']); //EMAIL VERIFICATION
        if($cUsMC_API_EmailResult) {
            
            $cUsMC_jsonEmail = json_decode($cUsMC_API_EmailResult);
            
            switch ($cUsMC_jsonEmail->result){
                case 0 :
                    //echo 'No Existe';
                    echo 1;
                    update_option('cUsMC_settings_userData', $postData);
                    break;
                case 1 :
                    //echo 'Existe';
                    echo 2;//ALREDY CUS USER
                    delete_option('cUsMC_settings_userData');
                    break;
            } //endswitch
            
        }else{  
            echo 'Ouch! unfortunately there has being an error during the application, please try again';
            exit();
        }//endif
         
    } //endif
    
    die();
}

// cUsMC_verifyCustomerEmail handler function...
add_action('wp_ajax_cUsMC_SentCredentials', 'cUsMC_SentCredentials_callback');
function cUsMC_SentCredentials_callback() {
    
    if ( !strlen($_REQUEST['email']) ){ 
        echo 'Missing Email, is required!'; 
        die();
    }else{
        
        $cUsMC_api = new cUsComAPI_MC(); //CONTACTUS.COM API

        $cUsMC_API_EmailResult = $cUsMC_api->verifyCustomerEmail($_REQUEST['email']); //EMAIL VERIFICATION
        
        if($cUsMC_API_EmailResult) {
            
            $cUsMC_jsonEmail = json_decode($cUsMC_API_EmailResult);
            
            switch ($cUsMC_jsonEmail->result){
                case 0 :
                    //echo 'No Existe';
                    $aryResponse = array('status' => 2, 'message' => $cUsMC_jsonEmail->message);
                    break;
                case 1 :
                    
                    //echo 1;//ALREDY CUS USER
                    
                    $cUsMC_API_Result = $cUsMC_api->sendAPICredentials($_REQUEST['email']); //EMAIL VERIFICATION
                    $cUsMC_jsonCredentials = json_decode($cUsMC_API_Result);
                    
                    $aryResponse = array('status'    => 1);
                    
                    break;
            } //endswitch
            
        }else{
            $aryResponse = array('status'    => 3, 'message'=> 'Ouch! unfortunately there has being an error during the application, please try again');
            exit();
        }//endif
         
    } //endif
    
    echo json_encode($aryResponse);
    
    die();
}

// cUsMC_verifyCustomerEmail handler function...
add_action('wp_ajax_cUsMC_UpdateCredentials', 'cUsMC_UpdateCredentials_callback');
function cUsMC_UpdateCredentials_callback() {
    
    
    if ( !strlen($_REQUEST['API_Account']) ){ 
        echo 'Missing API_Account, is required!';  die();
    }elseif ( !strlen($_REQUEST['API_Key']) ){ 
        echo 'Missing API_Key, is required!';  die();
    }else{
        
        $cUsMC_api = new cUsComAPI_MC();
        
        $aryTabPages = get_option('cUsMC_settings_tabpages');
        $aryInlinePages = get_option('cUsMC_settings_inlinepages');
        
        $cUsMC_API_getKeysResult = $cUsMC_api->getFormKeysAPI($_REQUEST['API_Account'], $_REQUEST['API_Key']); //api hook;
                    
        $cUs_jsonKeys = json_decode($cUsMC_API_getKeysResult);

        if($cUs_jsonKeys->status == 'success' ){
            
            $aryUserCredentials = array(
                'API_Account' => $_REQUEST['API_Account'],
                'API_Key'     => $_REQUEST['API_Key']
            );
            
            update_option('cUsMC_settings_userCredentials', $aryUserCredentials);
            
            
            foreach ($cUs_jsonKeys as $oForms => $oForm) {
                if ($oForms !='status' && $oForm->form_type == 1 && $oForm->default == 1){ //GET DEFAULT CONTACT FORM KEY
                   $defaultFormKey = $oForm->form_key;
                }
            }
            
            $form_key = (strlen($defaultFormKey)) ? $defaultFormKey : get_option('cUsMC_settings_form_key');
        
            update_option('cUsMC_settings_form_key', $defaultFormKey);//DEFAULT FORM KEYS

            if(strlen($defaultFormKey)){
                $userData = get_option('cUsMC_settings_userData');
                $postData = array(
                    'API_Account'       => $_REQUEST['API_Account'],
                    'API_Key'           => $_REQUEST['API_Key'],
                    'Form_Key'          => $defaultFormKey,
                    'MC_apikey'         => $userData['MC_apikey'],
                    'listID'            => $userData['listID']
                );

                $cUsMC_API_result = $cUsMC_api->updateDeliveryOptions($postData, $defaultFormKey); //UPDATE DELIVERY OPTIONS;
            }

            if(!empty($aryTabPages) && is_array($aryTabPages)){

                foreach ($aryTabPages as $pageID){

                    $aryFormOptions = array( //LOAD OLD PAGE SETTINGS / FIRST TIME
                        'tab_user'          => 1,
                        'form_key'          => $form_key,   
                        'cus_version'       => 'tab'
                    );

                    if($pageID != 'home'){
                        update_post_meta($pageID, 'cUsMC_FormByPage_settings', $aryFormOptions);//SAVE DATA ON POST TYPE PAGE METAS
                    }else{
                        update_option('cUsMC_HOME_settings', $aryFormOptions );//UPDATE FORM SETTINGS 
                    }

                } //endforeach

            }

            if(!empty($aryInlinePages) && is_array($aryInlinePages)){
                foreach ($aryInlinePages as $pageID){

                    $aryFormOptions = array( //LOAD OLD PAGE SETTINGS / FIRST TIME
                        'tab_user'          => 0,
                        'form_key'          => $form_key,   
                        'cus_version'       => 'inline'
                    );

                    if($pageID != 'home'){
                        update_post_meta($pageID, 'cUsMC_FormByPage_settings', $aryFormOptions);//SAVE DATA ON POST TYPE PAGE METAS
                    }else{
                        update_option('cUsMC_HOME_settings', $aryFormOptions );//UPDATE FORM SETTINGS 
                    }

                } //endforeach
            }


            $aryResponse = array('status' => 1);
        }else{    
            $aryResponse = array('status' => 2, 'message' => $cUs_jsonKeys->status .' / '. $cUs_jsonKeys->error);
        }//get api key
        
        
        
         
    } //endif
    
    echo json_encode($aryResponse);
    
    die();
}

// cUsMC_UpdateTemplates handler function...
add_action('wp_ajax_cUsMC_UpdateTemplates', 'cUsMC_UpdateTemplates_callback');
function cUsMC_UpdateTemplates_callback() {
    
    $cUsMC_userData = get_option('cUsMC_settings_userData'); //get the saved user data
    
    if      ( !strlen($cUsMC_userData['email']) ){      echo 'Missing/Invalid Email, is required field!';   die();
    }elseif  ( !strlen($_REQUEST['Template_Desktop_Form']) ){    echo 'Missing Form Template!';         die();
    }elseif  ( !strlen($_REQUEST['Template_Desktop_Tab']) ){   echo 'Missing Tab Template!';         die();
    }else{
        
        $cUsMC_api = new cUsComAPI_MC(); //CONTACTUS.COM API
        $form_key       = get_option('cUsMC_settings_form_key');
        $postData = array(
            'email' => $cUsMC_userData['email'],
            'credential' => $cUsMC_userData['credential'],
            'Template_Desktop_Form' => $_REQUEST['Template_Desktop_Form'],
            'Template_Desktop_Tab' => $_REQUEST['Template_Desktop_Tab']
        );
        
        $cUsMC_API_result = $cUsMC_api->updateFormSettings($postData, $form_key);
        
        if($cUsMC_API_result) {

            $cUs_json = json_decode($cUsMC_API_result);

            switch ( $cUs_json->status  ) {

                case 'success':
                    echo 1;//GREAT
                break;

                case 'error':
                    //ANY ERROR
                    echo $cUs_json->error;
                    //$cUsMC_api->resetData(); //RESET DATA
                break;

            } //endswitch
            
        }else{
             //echo 3;//API ERROR
             echo $cUs_json->error;
             // $cUsMC_api->resetData(); //RESET DATA
        } //endif
        
         
    } //endif
    
    die();
}

add_action('wp_ajax_cUsMC_changeFormTemplate', 'cUsMC_changeFormTemplate_callback');
function cUsMC_changeFormTemplate_callback() {
    
    $cUsMC_userData = get_option('cUsMC_settings_userCredentials'); //get the saved user data
   
    if       ( !strlen($cUsMC_userData['API_Account']) ){     echo 'Missing API Account!';   die();
    }elseif  ( !strlen($cUsMC_userData['API_Key']) ){         echo 'Missing Form Key!';         die();
    }elseif  ( !strlen($_REQUEST['Template_Desktop_Form']) ){    echo 'Missing Form Template!';         die();
    }elseif  ( !strlen($_REQUEST['form_key']) ){    echo 'Missing Form Key!';         die();
    }else{
        
        $cUsMC_api = new cUsComAPI_MC(); //CONTACTUS.COM API
        $form_key = $_REQUEST['form_key'];
        
        $postData = array(
            'API_Account'       => $cUsMC_userData['API_Account'],
            'API_Key'           => $cUsMC_userData['API_Key'],
            'Template_Desktop_Form' => $_REQUEST['Template_Desktop_Form']
        );
        
        $cUsMC_API_result = $cUsMC_api->updateFormSettings($postData, $form_key);
        
        if($cUsMC_API_result) {

            $cUs_json = json_decode($cUsMC_API_result);

            switch ( $cUs_json->status  ) {

                case 'success':
                    echo 1;//GREAT

                break;

                case 'error':
                    //ANY ERROR
                    echo $cUs_json->error;
                    //$cUsMC_api->resetData(); //RESET DATA
                break;


            } //endswitch
            
        }else{
             //echo 3;//API ERROR
             echo $cUs_json->error;
             // $cUsMC_api->resetData(); //RESET DATA
        } //endif
        
         
    } //endif
    
    die();
}

add_action('wp_ajax_cUsMC_changeTabTemplate', 'cUsMC_changeTabTemplate_callback');
function cUsMC_changeTabTemplate_callback() {
    
    $cUsMC_userData = get_option('cUsMC_settings_userCredentials'); //get the saved user data
   
    if       ( !strlen($cUsMC_userData['API_Account']) ){     echo 'Missing API Account!';   die();
    }elseif  ( !strlen($cUsMC_userData['API_Key']) ){         echo 'Missing Form Key!';         die();
    }elseif  ( !strlen($_REQUEST['Template_Desktop_Tab']) ){    echo 'Missing Tab Template!';         die();
    }elseif  ( !strlen($_REQUEST['form_key']) ){    echo 'Missing Form Key!';         die();
    }else{
        
        $cUsMC_api = new cUsComAPI_MC(); //CONTACTUS.COM API
        $form_key = $_REQUEST['form_key'];
        
        $postData = array(
            'API_Account'       => $cUsMC_userData['API_Account'],
            'API_Key'           => $cUsMC_userData['API_Key'],
            'Template_Desktop_Tab' => $_REQUEST['Template_Desktop_Tab']
        );
        
        $cUsMC_API_result = $cUsMC_api->updateFormSettings($postData, $form_key);
        if($cUsMC_API_result) {

            $cUs_json = json_decode($cUsMC_API_result);

            switch ( $cUs_json->status  ) {

                case 'success':
                    echo 1;//GREAT

                break;

                case 'error':
                    //ANY ERROR
                    echo $cUs_json->error;
                    //$cUsMC_api->resetData(); //RESET DATA
                break;


            } //endswitch;
            
        }else{
             //echo 3;//API ERROR
             echo $cUs_json->error;
             // $cUsMC_api->resetData(); //RESET DATA
        } //endif
        
         
    } //endif
    
    die();
}



// save custom selected pages handler function...
add_action('wp_ajax_cUsMC_saveCustomSettings', 'cUsMC_saveCustomSettings_callback');
function cUsMC_saveCustomSettings_callback() {
    
    $aryFormOptions = array( //DEFAULT SETTINGS / FIRST TIME
        'tab_user'          => $_REQUEST['tab_user'],
        'cus_version'       => $_REQUEST['cus_version']
    ); 
    update_option('cUsMC_FORM_settings', $aryFormOptions );//UPDATE FORM SETTINGS
    
    cUsMC_page_settings_cleaner();
    
    delete_option( 'cUsMC_settings_inlinepages' );
    delete_option( 'cUsMC_settings_tabpages' );
   
    
    die();
}

// save custom selected pages handler function...
add_action('wp_ajax_cUsMC_deletePageSettings', 'cUsMC_deletePageSettings_callback');
function cUsMC_deletePageSettings_callback() {
    
    $pageID = $_REQUEST['pageID'];
    
    delete_post_meta($pageID, 'cUsMC_FormByPage_settings');//reset values
    cUsMC_inline_shortcode_cleaner_by_ID($pageID); //RESET SC
    
    $aryTabPages = get_option('cUsMC_settings_tabpages');
    $aryTabPages = cUsMC_removePage($pageID,$aryTabPages);
    update_option( 'cUsMC_settings_tabpages', $aryTabPages); //UPDATE OPTIONS
            
    $aryInlinePages = get_option('cUsMC_settings_inlinepages');
    $aryInlinePages = cUsMC_removePage($pageID,$aryInlinePages);
    update_option( 'cUsMC_settings_inlinepages', $aryInlinePages); //UPDATE OPTIONS
    
    die();
}

// save custom selected pages handler function...
add_action('wp_ajax_cUsMC_changePageSettings', 'cUsMC_changePageSettings_callback');
function cUsMC_changePageSettings_callback() {
    
    $pageID = $_REQUEST['pageID'];
    delete_post_meta($pageID, 'cUsMC_FormByPage_settings');//reset values
    cUsMC_inline_shortcode_cleaner_by_ID($pageID); //RESET SC
    $aryTabPages = get_option('cUsMC_settings_tabpages');
    $aryInlinePages = get_option('cUsMC_settings_inlinepages');
    
    switch ($_REQUEST['cus_version']){
        case 'tab':
            
            $tabUser = 1;
            
            $aryTabPages[] = $pageID;
            $aryTabPages = array_unique($aryTabPages);
            update_option('cUsMC_settings_tabpages', $aryTabPages); //UPDATE OPTIONS
            
            if(!empty($aryInlinePages)){
                $aryInlinePages = cUsMC_removePage($pageID,$aryInlinePages);
                update_option( 'cUsMC_settings_inlinepages', $aryInlinePages); //UPDATE OPTIONS
            }
            
            echo 1;
            
            break;
        case 'inline':
            
            $tabUser = 0;
            
            $aryInlinePages[] = $pageID;
            $aryInlinePages = array_unique($aryInlinePages);
            update_option( 'cUsMC_settings_inlinepages', $aryInlinePages); //UPDATE OPTIONS
            
            if(!empty($aryTabPages)){
                $aryTabPages = cUsMC_removePage($pageID,$aryTabPages);
                update_option( 'cUsMC_settings_tabpages', $aryTabPages); //UPDATE OPTIONS
            }
            
            cUsMC_inline_shortcode_add($pageID); //ADDING SHORTCODE FOR INLINE PAGES
            
            echo 1;
            
            break;
    } //endswitch
    
    $aryFormOptions = array( //DEFAULT SETTINGS / FIRST TIME
        'tab_user'          => $tabUser,
        'form_key'          => $_REQUEST['form_key'],   
        'cus_version'       => $_REQUEST['cus_version']
    );
    
    if($pageID != 'home'){
        update_post_meta($pageID, 'cUsMC_FormByPage_settings', $aryFormOptions);//SAVE DATA ON POST TYPE PAGE METAS
    }else{
       update_option('cUsMC_HOME_settings', $aryFormOptions );//UPDATE FORM SETTINGS 
    }
    
    die();
}

function cUsMC_removePage($valueToSearch, $arrayToSearch){
    $key = array_search($valueToSearch,$arrayToSearch);
    if($key!==false){
        unset($arrayToSearch[$key]);
    }
    return $arrayToSearch;
}

// logoutUser handler function...
add_action('wp_ajax_cUsMC_logoutUser', 'cUsMC_logoutUser_callback');
function cUsMC_logoutUser_callback() {
    
    $cUsMC_api = new cUsComAPI_MC();
    $cUsMC_api->resetData(); //RESET DATA
    
    echo 'Deleted.... User data'; //none list
    
    die();
}

//GET TEMPLATES LIST

// sendTemplateID handler function...
add_action('wp_ajax_cUsMC_getTemplates', 'cUsMC_getTemplates_callback');
function cUsMC_getTemplates_callback() {
    echo 1; //none list
    
    die();
}

// sendTemplateID handler function...
add_action('wp_ajax_cUsMC_sendTemplateID', 'cUsMC_sendTemplateID_callback');
function cUsMC_sendTemplateID_callback() {
    echo 1; //none list
    
    die();
}


?>