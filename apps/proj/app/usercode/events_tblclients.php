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

}


?>