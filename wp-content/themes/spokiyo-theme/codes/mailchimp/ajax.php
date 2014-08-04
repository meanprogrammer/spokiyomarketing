<?php
require_once 'MailChimp.php';
$key = 'de90cec1fc13ec32c7bf93390ff2d4ed-us3';
$email = $_REQUEST['email'];
$mc = new MailChimp($key);
$result = $mc->call('lists/subscribe', array(
                'id'                => '4cbfa5b978',
                'email'             => array('email'=> $email),
                'merge_vars'        => array('FNAME'=>'', 'LNAME'=>''),
                'double_optin'      => false,
                'update_existing'   => true,
                'replace_interests' => false,
                'send_welcome'      => false,
            ));

echo $result['euid'];