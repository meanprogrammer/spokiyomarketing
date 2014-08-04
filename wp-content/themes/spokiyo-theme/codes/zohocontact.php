<?php
include_once 'Utilities.php';
include 'zohoconstants.php';
include_once 'LookUp.php';

class zohocontact {

	var $db = NULL;
	var $connectionString = "mongodb://localhost";

	function __construct() {
		$mongoDb = new MongoClient($this->connectionString);
		$this->db = $mongoDb->spokiyo;
	}
	

	public  function doLogin($username) {	
		$url = "https://crm.zoho.com/crm/private/json/Contacts/getSearchRecords";
		$token = "81a928ebed863d880971593a62ce0430";
		
		$parameter = "";
		$parameter = Utilities::setParameter('authtoken', $token, $parameter);
		$parameter = Utilities::setParameter('scope', "crmapi", $parameter);
		$parameter = Utilities::setParameter('newFormat', 2, $parameter);
		
		$select = "Contacts(Contact Owner,Salutation,First Name,";
		$select .= "Last Name,Account Name,Vendor Name,Lead Source,";
		$select .= "Title,Department,Date of Birth,Reports To,";
		$select .= "Email Opt Out,Skype Id,Phone,Mobile,Home Phone,Other Phone,";
		$select .= "Fax,Email,Secondary Email,Assistant,Asst Phone,Mailing Address,";
		$select .= "Other Address,Description,Username,Password)"; 
		
		$parameter = Utilities::setParameter('selectColumns', $select, $parameter);
		$parameter = Utilities::setParameter('searchCondition', sprintf("(Username|=|%s)", $username), $parameter);

		$result = Utilities::sendCurlRequest($url, $parameter);

		//print_r($result);
		
		$arr = json_decode($result, true);

		$list = array();
		foreach ($arr["response"]["result"]["Contacts"]["row"] as $val) {
			$fl = $val["FL"];
			$object = Utilities::createone($fl);
			array_push($list, $object);
		}
		
		return $list;
	}

	public function saveSpokiyoUserAccount($data){
		
		$rv = 0;
		//$mongo = new MongoClient("mongodb://spokiyo:spokiyo1234@kahana.mongohq.com:10014/spokiyo");
		//$db = $mongo->spokiyo;
		$contacts = $this->db->contacts;
		
		//For the instant login after the registration
		$username = $data['loginCredentials']['username'];
		$password = $data['loginCredentials']['password'];
		
		//base64encode password
		if(strlen(trim($data['loginCredentials']['password'])) > 0) {
			 $data['loginCredentials']['password'] = base64_encode($data['loginCredentials']['password']);
		}
		
		$result = $contacts->insert($data);
		$updatedData = NULL;

		try {
			if($result['ok'] == 1) {
				//echo "mongo saved!";
				$rv = 1;
				$updatedData = $this->getUserAccountByCredentials($username, $password);
				//echo "Contact Inserted";
				//header('Location: http://localhost/php_mongo/viewallcontact.php');
			} else {
				$rv = -1;
				//echo "mongo saved failed!";
				//echo "Contact insert failed!";	
				//die;
			}
		} catch (Exception $e) {
			echo  $e;
		}	
		return array(
			'ok' => $result['ok'],
			'data' => $updatedData
		);
	}
	
	public function getUserAccountByCredentials($username, $password) {
		$encoded_password = base64_encode($password);
		$contacts = $this->db->contacts;
		$query = array('loginCredentials.username' => $username, 'loginCredentials.password' => $encoded_password);
		
		$cursor = $contacts->findOne($query);
		return $cursor;
	}
	
	public function getUserAccountById($id) {
		$encoded_password = base64_encode($password);
		
		$contacts = $this->db->contacts;
		$query = array('_id' => new MongoId($id));
		$cursor = $contacts->findOne($query);
		return $cursor;
	}
	
	public function update($id, $data) {
		$mongo = new MongoClient("mongodb://localhost");
		$db = $mongo->zoho;
		$contacts = $db->contacts;
		
		$filter = array('_id' => new MongoId($id));
		$update = array('$set' => $data);
		$result = $contacts->update($filter, $update);
		
		return $result;
	}
		/*$result = array();

		foreach ($cursor as $doc) {
			$result['contactowner'] = $doc['contactowner'];
			$result['leadsource'] = $doc['leadsource'];
			$result['accountname'] = $doc['accountname'];
			$result['email'] = $doc['email'];
			$result['firstname'] = $doc['firstname'];
			$result['phone'] = $doc['phone'];
			$result['lastname'] = $doc['lastname'];
			$result['mobile'] = $doc['mobile'];
			$result['title'] = $doc['title'];
			$result['fax'] = $doc['fax'];
			$result['department'] = $doc['department'];
			$result['dateofbirth'] = $doc['dateofbirth'];
			$result['facebook'] = $doc['facebook'];
			$result['username'] = $doc['username'];
			$result['linkedin'] = $doc['linkedin'];
			$result['password'] = $doc['password'];
			$result['skypeid'] = $doc['skypeid'];
			$result['twitter'] = $doc['twitter'];
			$result['mailingstreet'] = $doc['mailingstreet'];
			$result['otherstreet'] = $doc['otherstreet'];
			$result['mailingcity'] = $doc['mailingcity'];
			$result['othercity'] = $doc['othercity'];
			$result['mailingstate'] = $doc['mailingstate'];
			$result['otherstate'] = $doc['otherstate'];
			$result['mailingzip'] = $doc['mailingzip'];
			$result['otherzip'] = $doc['otherzip'];
			$result['mailingcountry'] = $doc['mailingcountry'];
			$result['othercountry'] = $doc['othercountry'];
			$result['bankname'] = $doc['bankname'];
			$result['bankaccountno'] = $doc['bankaccountno'];
			$result['creditcard'] = $doc['creditcard'];
			$result['creditcardno'] = $doc['creditcardno'];
			$result['debitcard'] = $doc['debitcard'];
			$result['debitcardno'] = $doc['debitcardno'];
			$result['description'] = $doc['description'];
		}*/

	
	function zoho_contact_save($data) {
		$xmldata = convert_to_xml($data);
		$parameter = "";
		$parameter = Utilities::setParameter('authtoken', zohoconstants::AUTH_TOKEN, $parameter);
		$parameter = Utilities::setParameter('scope', zohoconstants::ZOHO_SCOPE, $parameter);
		$parameter = Utilities::setParameter('newFormat', 1, $parameter);
		$parameter = Utilities::setParameter('xmlData', $xmldata, $parameter);
		
		$result = Utilities::sendCurlRequest(zohoconstants::CONTACT_INSERT_URL,
										 $parameter);
		return $result;
	}
	
	function convert_to_xml($arr) {
		$xmldata .= '<Contacts>';
		$xmldata .= '<row no="1">';
		//$xmldata .= sprintf('<FL val="First Name">%s</FL>', $arr['firstname']);
		$xmldata .= sprintf('<FL val="Contact Owner">%s</FL>', $arr['contactowner']);
		$xmldata .= sprintf('<FL val="Lead Source">%s</FL>', $arr['leadsource']);
		$xmldata .= sprintf('<FL val="Account Name">%s</FL>', $arr['accountname']);
		$xmldata .= sprintf('<FL val="Email">%s</FL>', $arr['email']);
		$xmldata .= sprintf('<FL val="First Name">%s</FL>', $arr['firstname']);
		$xmldata .= sprintf('<FL val="Phone">%s</FL>', $arr['phone']);
		$xmldata .= sprintf('<FL val="Last Name">%s</FL>', $arr['lastname']);
		$xmldata .= sprintf('<FL val="Mobile">%s</FL>', $arr['mobile']);
		$xmldata .= sprintf('<FL val="Title">%s</FL>', $arr['title']);
		$xmldata .= sprintf('<FL val="Fax">%s</FL>', $arr['fax']);
		$xmldata .= sprintf('<FL val="Department">%s</FL>', $arr['department']);
		$xmldata .= sprintf('<FL val="Date Of Birth">%s</FL>', $arr['dateofbirth']);
		$xmldata .= sprintf('<FL val="Facebook">%s</FL>', $arr['facebook']);
		$xmldata .= sprintf('<FL val="Username">%s</FL>', $arr['username']);
		$xmldata .= sprintf('<FL val="LinkedIn">%s</FL>', $arr['linkedin']);
		$xmldata .= sprintf('<FL val="Password">%s</FL>', $arr['password']);
		$xmldata .= sprintf('<FL val="Skype ID">%s</FL>', $arr['skypeid']);
		$xmldata .= sprintf('<FL val="Twitter">%s</FL>', $arr['twitter']);
		$xmldata .= sprintf('<FL val="Mailing Street">%s</FL>', $arr['mailingstreet']);
		$xmldata .= sprintf('<FL val="Other Street">%s</FL>', $arr['otherstreet']);
		$xmldata .= sprintf('<FL val="Mailing City">%s</FL>', $arr['mailingcity']);
		$xmldata .= sprintf('<FL val="Other City">%s</FL>', $arr['othercity']);
		$xmldata .= sprintf('<FL val="Mailing State">%s</FL>', $arr['mailingstate']);
		$xmldata .= sprintf('<FL val="Other State">%s</FL>', $arr['otherstate']);
		$xmldata .= sprintf('<FL val="Mailing Zip">%s</FL>', $arr['mailingzip']);
		$xmldata .= sprintf('<FL val="Other Zip">%s</FL>', $arr['otherzip']);
		$xmldata .= sprintf('<FL val="Mailing Country">%s</FL>', $arr['mailingcountry']);
		$xmldata .= sprintf('<FL val="Other Country">%s</FL>', $arr['othercountry']);
		$xmldata .= sprintf('<FL val="Bank Name">%s</FL>', $arr['bankname']);
		$xmldata .= sprintf('<FL val="Bank Account No">%s</FL>', $arr['bankaccountno']);
		$xmldata .= sprintf('<FL val="Credit Card">%s</FL>', $arr['creditcard']);
		$xmldata .= sprintf('<FL val="Credit Card No">%s</FL>', $arr['creditcardno']);
		$xmldata .= sprintf('<FL val="Debit Card">%s</FL>', $arr['debitcard']);
		$xmldata .= sprintf('<FL val="Debit Card No">%s</FL>', $arr['debitcardno']);
		$xmldata .= sprintf('<FL val="Description">%s</FL>', $arr['description']);
		$xmldata .= '</row>';
		$xmldata .= '</Contacts>';	
		return $xmldata;
	}
	
	public function updateUserAccountBio($id, $bio) {
		$contacts = $this->db->contacts;
		$criteria = array("_id" => new MongoId($id));
		$result = $contacts->update($criteria, array('$set' => array("professionalProfile.summary" => stripslashes($bio))));	

		return array(
			'ok' => $result['ok'],
			'data' => stripslashes($bio)
		);
	}
	
	public function updateUserAccountPersonalDetails($id, $maritalStatus, $birthdate) {
		$contacts = $this->db->contacts;
		$criteria = array("_id" => new MongoId($id));

		$result = $contacts->update(
				$criteria, 
				array('$set' => 
					array("personalDetail.maritalStatus" => $maritalStatus, 
					"basicInfo.dateOfBirth" => $birthdate)
				)
		);
		
				
		$updatedData = NULL;
		
		/* return the updated address list */
		if($result['ok'] == 1) {
			$updatedData = $this->getUserAccountById($id);
		}
		
		return array(
			'ok' => $result['ok'],
			'data' => array(	
						'maritalStatus' => $updatedData['personalDetail']['maritalStatus'],
						'dateOfBirth' => $updatedData['basicInfo']['dateOfBirth']
					  )
		);
	}
	
	public function updateConsultingPreference($id, $availability, $rate, $typeOfWork, 
											$workshift) {
		$contacts = $this->db->contacts;
		$criteria = array("_id" => new MongoId($id));
		$result = $contacts->update(
				$criteria, 
				array('$set' => 
					array("professionalProfile.availability" => $availability, 
					"professionalProfile.hourlyRate" => $rate,
					"professionalProfile.typeOfWork" => $typeOfWork,
					"professionalProfile.shift" => $workshift)
				)
		);
		
		$updatedData = NULL;
		
		/* return the updated address list */
		if($result['ok'] == 1) {
			$updatedData = $this->getUserAccountById($id);
		}
		
		return array(
			'ok' => $result['ok'],
			'data' => array(
						'availability' => $updatedData['professionalProfile']['availability'],
						'hourlyRate' => $updatedData['professionalProfile']['hourlyRate'],
						'typeOfWork' => $updatedData['professionalProfile']['typeOfWork'],
						'shift' => $updatedData['professionalProfile']['shift']
					  )
		);
	}
	
	function saveUserAccountEmploymentHistory($id, $company, $role, 
							$startDate, $endDate, $experienceId) {
		$contacts = $this->db->contacts;
		$criteria = array("_id" => new MongoId($id));
		
		if(strlen($experienceId) > 0) {
			 /*$contacts->update($criteria,
     			array('$pull'=> array('professionalProfile.employmentHistory'
     				 => array('id' => new MongoId($experienceId)))));*/
			$result = $contacts->update(
				array('professionalProfile.employmentHistory' => array(
					'$elemMatch' => array('id' => new MongoId($experienceId)))), 
				array('$set' => 
					array('professionalProfile.employmentHistory.$.company' => $company,
						'professionalProfile.employmentHistory.$.role' => $role,
						'professionalProfile.employmentHistory.$.startDate' => $startDate,
						'professionalProfile.employmentHistory.$.endDate' => $endDate
					)
				)
			);
		} else {
			$history = array(
				'id' => new MongoId(),
				'serialNumber' => $this->getlastcount($id, 'employmentHistory'),
				'company' => $company,
				'role' => $role,
				'startDate' => $datestart,
				'endDate' => $dateend
			);

			$result = $contacts->update(
					$criteria, 
					array('$push' => 
						array("professionalProfile.employmentHistory" => $history)
					)
			);
		}
		
		$updatedData = NULL;
		
		if($result['ok'] == 1) {
			$updatedData = $this->getUserAccountById($id);
		}
		$employmentHistory = NULL;
		if($updatedData != NULL) {
			$employmentHistory = $updatedData['professionalProfile']['employmentHistory'];
			foreach ($employmentHistory as $eKey => $eValue) {
				$formattedStartDate = new DateTime($eValue['startDate']);
				$formattedEndDate = new DateTime($eValue['endDate']);
				$employmentHistory[$eKey]['formattedStartDate'] = $formattedStartDate->format('M Y');
				$employmentHistory[$eKey]['formattedEndDate'] = $formattedEndDate->format('M Y');
			}
		}
		
		return array(
			'ok' => $result['ok'],
			'data' => $employmentHistory
		);
	}
	
	public function saveUserAccountEducation($id, $school, $qualification, 
					$field, $grade, $startDate, $endDate, $educationId) {
		$contacts = $this->db->contacts;
		$criteria = array("_id" => new MongoId($id));
		$result = NULL;
		if(strlen($educationId) > 0) {
			/* $contacts->update($criteria,
     			array('$pull'=> array('professionalProfile.educationHistory'
     				 => array('id' => new MongoId($educationId)))));
     				*/ 
			
			$result = $contacts->update(
				array('professionalProfile.educationHistory' => array(
					'$elemMatch' => array('id' => new MongoId($educationId)))), 
				array('$set' => 
					array('professionalProfile.educationHistory.$.school' => $school,
						'professionalProfile.educationHistory.$.qualification' => $qualification,
						'professionalProfile.educationHistory.$.field' => $field,
						'professionalProfile.educationHistory.$.grade' => $grade,
						'professionalProfile.educationHistory.$.startDate' => $startDate,
						'professionalProfile.educationHistory.$.endDate' => $endDate
					)
				)
			);
				
		} else {
			$history = array(
				'id' => new MongoId(),
				'serialNumber' => $this->getlastcount($id, 'educationHistory'),
				'school' => $school,
				'qualification' => $qualification,
				'field' => $field,
				'grade' => $grade,
				'startDate' => $startDate,
				'endDate' => $endDate
			);

			$result = $contacts->update(
					$criteria, 
					array('$push' => 
						array("professionalProfile.educationHistory" => $history)
					)
			);
		}
		
		$updatedData = NULL;
		
		if($result['ok'] == 1) {
			$updatedData = $this->getUserAccountById($id);
		}
		
		$educationHistory = NULL;
		$qLookup = new QualificationLookup();
		if($updatedData != NULL) {
			$educationHistory = $updatedData['professionalProfile']['educationHistory'];
			foreach ($educationHistory as $eKey => $eValue) {
				$formattedStartDate = new DateTime($eValue['startDate']);
				$formattedEndDate = new DateTime($eValue['endDate']);
				$educationHistory[$eKey]['formattedStartDate'] = $formattedStartDate->format('M Y');
				$educationHistory[$eKey]['formattedEndDate'] = $formattedEndDate->format('M Y');
				$educationHistory[$eKey]['qualificationText'] = $qLookup->getQualificationText($eValue['qualification']);
			}
		}
		
		return array(
			'ok' => $result['ok'],
			'data' => $educationHistory
		);
	}
	
	function getlastcount($id, $index) {
		$count = 0;
		$record = $this->getUserAccountById($id);
		if($record != NULL) {
			$count = count($record['professionalProfile'][$index]);
		}
		return $count + 1;
	}
	
	/* TODO */
	function saveUserAccountBankAccount($id, $fortransactions, $bankname, 
					$bankacctno, $creditcard, $creditcardtype, 
					$creditcardnumber, $bankAccountId) {
		$contacts = $this->db->contacts;
		$criteria = array("_id" => new MongoId($id));

		$result = NULL;
		if(strlen($bankAccountId) > 0) {
			 /*$contacts->update($criteria,
     			array('$pull'=> array('bankAccounts'
     				 => array('id' => new MongoId($bankAccountId)))));*/
			$result = $contacts->update(
				array('bankAccounts' => array(
					'$elemMatch' => array('id' => new MongoId($bankAccountId)))), 
				array('$set' => 
					array('bankAccounts.$.description' => $fortransactions,
						'bankAccounts.$.bankName' => $bankname,
						'bankAccounts.$.bankAccountNumber' => $bankacctno,
						'bankAccounts.$.creditCard' => $creditcard,
						'bankAccounts.$.creditCardType' => $creditcardtype,
						'bankAccounts.$.creditCardNumber' => $creditcardnumber
					)
				)
			);
			
		} else { 
			$bankAccount = array(
				'id' => new MongoId(),
				'description' => $fortransactions,
				'bankName' => $bankname,
				'bankCode' => '',
				'branchName' => '',
				'branchCode' => '',
				'bankAccountName' => '',
				'bankAccountNumber' => $bankacctno,
				'creditCard' => $creditcard,
				'creditCardType' => $creditcardtype,
				'creditCardNumber' => $creditcardnumber
			);
		
			$result = $contacts->update(
					$criteria, 
					array('$push' => 
						array("bankAccounts" => $bankAccount)
					)
			);
		}
		
		$updatedData = NULL;
		/* return the updated address list */
		if($result['ok'] == 1) {
			$updatedData = $this->getUserAccountById($id);
		}
		
		return array(
			'ok' => $result['ok'],
			'data' => $updatedData['bankAccounts']
		);
	}
	
	/*
	 * 
	 */
	function saveUserAccountAddress($id, $type, $country, $province, $city, $address, $zipcode) {
		$contacts = $this->db->contacts;
		$criteria = array("_id" => new MongoId($id));

		$address = array(
			'type' => $type,
			'country' => $country,
			'province' => $province,
			'city' => $city,
			'address' => $address,
			'zipCode' => $zipcode
		);
		$result = $contacts->update(
				$criteria, 
				array('$push' => 
					array("contactInfo.addresses" => $address)
				)
		);
		
		$updatedData = NULL;
		/* return the updated address list */
		if($result['ok'] == 1) {
			$updatedData = $this->getUserAccountById($id);
		}
		
		return array(
			'ok' => $result['ok'],
			'data' => $updatedData['contactInfo']['addresses']
		);
	}
	
	function saveUserAccountPhoneNumber($id, $type, $countryCode, $areaCode, $phoneNumber) {
		$contacts = $this->db->contacts;
		$criteria = array("_id" => new MongoId($id));

		$address = array(
			'type' => $type,
			'countryCode' => $countryCode,
			'areaCode' => $areaCode,
			'phoneNumber' => $phoneNumber
		);
		$result = $contacts->update(
				$criteria, 
				array('$push' => 
					array("contactInfo.phoneNumbers" => $address)
				)
		);
		
		$updatedData = NULL;
		/* return the updated address list */
		if($result['ok'] == 1) {
			$updatedData = $this->getUserAccountById($id);
		}
		return array(
			'ok' => $result['ok'],
			'data' => $updatedData['contactInfo']['phoneNumbers']
		);
	}
	
	function saveUserAccountIMHandle($id, $type, $handle) {
		$contacts = $this->db->contacts;
		$criteria = array("_id" => new MongoId($id));

		$im = array(
			'type' => $type,
			'handle' => $handle
		);
		$result = $contacts->update(
				$criteria, 
				array('$push' => 
					array("contactInfo.imHandles" => $im)
				)
		);
		
		$updatedData = NULL;
		/* return the updated address list */
		if($result['ok'] == 1) {
			$updatedData = $this->getUserAccountById($id);
		}
		return array(
			'ok' => $result['ok'],
			'data' => $updatedData['contactInfo']['imHandles']
		);
	}
	
	function saveUserAccountSocialMedia($id, $type, $accountId) {
		$contacts = $this->db->contacts;
		$criteria = array("_id" => new MongoId($id));

		$sm = array(
			'type' => $type,
			'accountId' => $accountId
		);
		$result = $contacts->update(
				$criteria, 
				array('$push' => 
					array("contactInfo.socialMediaAccounts" => $sm)
				)
		);
		$updatedData = NULL;
		/* return the updated address list */
		if($result['ok'] == 1) {
			$updatedData = $this->getUserAccountById($id);
		}
		return array(
			'ok' => $result['ok'],
			'data' => $updatedData['contactInfo']['socialMediaAccounts']
		);
	}
	
	function getContactData($id) {
		$user = $this->getUserAccountById($id);
		$contactDisplay = array();
		$iconLookup = new ContactIconLookup();
		if($user != NULL) {
			$contactinfo = $user['contactInfo'];
			$email = $contactinfo['email'];
			array_push($contactDisplay, array('type' => 'email', 'value' => $email, 'icon' => $iconLookup->getIconCss('email')));
			
			foreach ($contactinfo['phoneNumbers'] as $pn) {
				//TODO: Consider area code and country code
				array_push($contactDisplay, 
					array(
						'type' => $pn['type'], 
						'value' => $pn['phoneNumber'],
						'icon' => $iconLookup->getIconCss('contact')
					));
			}
			
			foreach ($contactinfo['imHandles'] as $imh) {
				array_push($contactDisplay,
					array(
						'type' => $imh['type'],
						'value' => $imh['handle'],
						'icon' => $iconLookup->getIconCss($imh['type'])
					));
			}
			
			foreach ($contactinfo['socialMediaAccounts'] as $sma) {
				array_push($contactDisplay,
					array(
						'type' => $sma['type'],
						'value' => $sma['accountId'],
						'icon' => $iconLookup->getIconCss($sma['type'])
					));
			}
		}
		return $contactDisplay;
	}
	
	/*function updateemailaddress($id, $type, $accountId) {
		$contacts = $this->db->contacts;
		$criteria = array("_id" => new MongoId($id));

		$sm = array(
			'type' => $type,
			'accountId' => $accountId
		);
		$result = $contacts->update(
				$criteria, 
				array('$push' => 
					array("contactInfo.socialMediaAccounts" => $sm)
				)
		);
		$updatedData = NULL;

		if($result['ok'] == 1) {
			$updatedData = $this->getUserAccountById($id);
		}
		return array(
			'ok' => $result['ok'],
			'data' => $updatedData['contactInfo']['socialMediaAccounts']
		);
	}*/
	
	function getBankAccountById($accountId, $bankAccountId) {
		$account = $this->getUserAccountById($accountId);
		$data = NULL;
		if($accountId != NULL) {
			foreach ($account['bankAccounts'] as $ba) {
				if($ba['id'] == $bankAccountId) {
					$data = $ba;
					break;
				}
			}
		}
		return $data;
	}
	
	function getExperienceById($accountId, $experienceId) {
		$account = $this->getUserAccountById($accountId);
		$data = NULL;
		if($accountId != NULL) {
			foreach ($account['professionalProfile']['employmentHistory'] as $exp) {
				if($exp['id'] == $experienceId) {
					$data = $exp;
					break;
				}
			}
		}
		return $data;
	}
	
	function getEducationById($accountId, $educationId) {
		$account = $this->getUserAccountById($accountId);
		$data = NULL;
		if($accountId != NULL) {
			foreach ($account['professionalProfile']['educationHistory'] as $educ) {
				if($educ['id'] == $educationId) {
					$data = $educ;
					break;
				}
			}
		}
		return $data;
	}
	
	function getConsultingPreference($id) {
		$account = $this->getUserAccountById($id);
		$data = NULL;
		if($account != NULL) {
			$data = array(
				'availability' => $account['professionalProfile']['availability'],
				'hourlyRate' => $account['professionalProfile']['hourlyRate'],
				'typeOfWork' => $account['professionalProfile']['typeOfWork'],
				'shift' => $account['professionalProfile']['shift']
			);
		}
		return $data;
	}
	
}