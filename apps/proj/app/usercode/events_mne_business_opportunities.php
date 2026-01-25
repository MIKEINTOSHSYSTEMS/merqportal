<?php
class eventclass_mne_business_opportunities  extends TableEventsBase {
	
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
		'date_identified' => array(
			'edit' => true 
		),
		'created_at' => array(
			'edit' => true 
		) 
	),
	'autoUpdateValue' => array(
		'updated_at' => array(
			'edit' => true 
		) 
	),
	'uploadFolder' => array(
		 
	),
	'viewPluginInit' => array(
		 
	),
	'editPluginInit' => array(
		 
	) 
);
			}
	
	public function default_date_identified_efedit(  ) {
	$defaultValue = date("Y-m-d H:i:s");
return $defaultValue;
}

public function default_created_at_efedit(  ) {
	$defaultValue = date("Y-m-d H:i:s");
return $defaultValue;
}

public function autoupdate_updated_at_efedit(  ) {
	$defaultValue = date("Y-m-d H:i:s");
return $defaultValue;
}	

}


?>