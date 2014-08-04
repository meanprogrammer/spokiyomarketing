<?php
class QualificationLookup {
	var $list = array(
		'1' => 'High School',
		'2' => 'College',
		'3' => 'Masters',
		'4' => 'Doctorate',
		'5' => 'Post Doctoral'
	);
	
	public function getQualificationText($value) {
		return $this->list[$value];
	}
}

class ContactIconLookup {
	var $list = array(
		'Skype' => 'skype-icon',
		'MSN' => 'msn-icon',
		'Yahoo Messenger' => 'ym-icon',
		'Google Talk' => 'gtalk-icon',
		'Viber' => 'viber-icon',
		'WhatsApp' => 'whatsup-icon',
		'LinkedIn' => 'linkedin-icon',
		'Facebook' => 'fb-icon',
		'Google Plus' => 'gplus-icon',
		'Twitter' => 'twitter-icon',
		'Website' => 'website-icon',
		'contact' => 'contact-icon',
		'email' => 'email-icon'
	);
	
	public function getIconCss($type) {
		return $this->list[$type];
	}
}