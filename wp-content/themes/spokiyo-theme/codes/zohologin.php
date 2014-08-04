<?php
class zohologin {
	public static function login($username){
		try {
	  		// create curl resource 
	        $ch = curl_init("http://www.spokiyo.comyr.com/ajax/search.php?username=".$username); 

			//$ch = curl_init("http://www.google.com.ph");
			
	        // set url 
	        //curl_setopt($ch, CURLOPT_URL, ); 
	
	        //return the transfer as a string 
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	        
	        /* allow redirects */
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	
            /* times out after 30s */
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            /* set POST method */
            curl_setopt($ch, CURLOPT_POST, 1);
            /* add POST fields parameters */
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
            
	        // $output contains the output string 
	        $output = curl_exec($ch); 
	        
	        // close curl resource to free up system resources 
	        curl_close($ch);
	        
	        return $output;
		}  catch (Exception $exception) {
            echo 'Exception Message: ' . $exception->getMessage() . '<br/>';
            echo 'Exception Trace: ' . $exception->getTraceAsString();
        }
	}
}