<?php
global $runnerTableSettings;
$runnerTableSettings['Dashboard'] = array(
	'name' => 'Dashboard',
	'type' => 4,
	'shortName' => 'Dashboard',
	'pagesByType' => array(
		'dashboard' => array( 
			'dashboard' 
		) 
	),
	'pageTypes' => array(
		'dashboard' => 'dashboard' 
	),
	'defaultPages' => array(
		'dashboard' => 'dashboard' 
	),
	'afterEditDetails' => 'Dashboard',
	'afterAddDetail' => 'Dashboard',
	'detailsBadgeColor' => 'd2691e',
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'originalTable' => '',
	'originalPagesByType' => array(
		'dashboard' => array( 
			'dashboard' 
		) 
	),
	'originalPageTypes' => array(
		'dashboard' => 'dashboard' 
	),
	'originalDefaultPages' => array(
		'dashboard' => 'dashboard' 
	),
	'searchSettings' => array(
		'caseSensitiveSearch' => false,
		'searchableFields' => array( 
			 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			 
		) 
	),
	'connId' => '',
	'clickActions' => array(
		'row' => array(
			'action' => 'noaction' 
		),
		'fields' => array(
			 
		) 
	),
	'geoCoding' => array(
		'enabled' => false,
		'latField' => '',
		'lonField' => '',
		'addressFields' => array( 
			 
		) 
	),
	'whereTabs' => array( 
		 
	),
	'labels' => array(
		 
	),
	'chartSettings' => array(
		 
	),
	'dataSourceOperations' => array(
		 
	),
	'calendarSettings' => array(
		'categoryColors' => array( 
			 
		) 
	),
	'ganttSettings' => array(
		'categoryColors' => array( 
			 
		) 
	) 
);

global $runnerTableLabels;
if( mlang_getcurrentlang() === 'English' ) {
	$runnerTableLabels['Dashboard'] = array(
	'tableCaption' => 'Dashboard',
	'fieldLabels' => array(
		 
	),
	'fieldTooltips' => array(
		 
	),
	'fieldPlaceholders' => array(
		 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>