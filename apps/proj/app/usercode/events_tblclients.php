<?php
class eventclass_tblclients  extends TableEventsBase {
	
	function init() {
		$this->events = array(
	 
);
		$this->fieldValues = array(
	'filterLimit' => array(
		 
	),
	'mapIcon' => array(
		 
	),
	'viewCustom' => array(
		 
	),
	'lookupWhere' => array(
		 
	),
	'viewFileText' => array(
		 
	),
	'defaultValue' => array(
		'datecreated' => array(
			'edit' => true 
		),
		'active' => array(
			'edit' => true 
		),
		'billing_country' => array(
			'edit' => true 
		),
		'shipping_city' => array(
			'edit' => true 
		),
		'default_currency' => array(
			'edit' => true 
		),
		'show_primary_contact' => array(
			'edit' => true 
		),
		'registration_confirmed' => array(
			'edit' => true 
		) 
	),
	'autoUpdateValue' => array(
		 
	),
	'uploadFolder' => array(
		 
	),
	'viewPluginInit' => array(
		 
	),
	'editPluginInit' => array(
		'phonenumber' => array(
			'edit' => true 
		) 
	) 
);
			}
	
	public function plugin_phonenumber_efedit( $pageObject ) {
	$this->settings = array();
$this->settings["required"] = false;                    // Wether is mandatory
$this->settings["tooltip"] = "Click here to enter telephone"; // Information tooltip
$this->settings["initialCountry"] = "et";               // Country default
$this->settings["preferredCountries"] = "us";           // Preferred Country
;
return $this->settings;
}

public function default_datecreated_efedit(  ) {
	$defaultValue = date("Y-m-d H:i:s");
return $defaultValue;
}

public function default_active_efedit(  ) {
	$defaultValue = 1;
return $defaultValue;
}

public function default_billing_country_efedit(  ) {
	$defaultValue = 0;
return $defaultValue;
}

public function default_shipping_city_efedit(  ) {
	$defaultValue = 0;
return $defaultValue;
}

public function default_default_currency_efedit(  ) {
	$defaultValue = 0;
return $defaultValue;
}

public function default_show_primary_contact_efedit(  ) {
	$defaultValue = 0;
return $defaultValue;
}

public function default_registration_confirmed_efedit(  ) {
	$defaultValue = 1;
return $defaultValue;
}	

}


?>