<?php
			$optionsArray = array(
	'fields' => array(
		'gridFields' => array( 
			'detail_id',
			'project_id',
			'client',
			'contract_value',
			'project_manager',
			'start_date',
			'technical_lead',
			'end_date',
			'mel_lead',
			'percent_complete',
			'project_coordinator',
			'reporting_period',
			'project_status',
			'last_updated',
			'created_at',
			'updated_at' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'detail_id' => array( 
				'import_field' 
			),
			'project_id' => array( 
				'import_field1' 
			),
			'client' => array( 
				'import_field2' 
			),
			'contract_value' => array( 
				'import_field3' 
			),
			'project_manager' => array( 
				'import_field4' 
			),
			'start_date' => array( 
				'import_field5' 
			),
			'technical_lead' => array( 
				'import_field6' 
			),
			'end_date' => array( 
				'import_field7' 
			),
			'mel_lead' => array( 
				'import_field8' 
			),
			'percent_complete' => array( 
				'import_field9' 
			),
			'project_coordinator' => array( 
				'import_field10' 
			),
			'reporting_period' => array( 
				'import_field11' 
			),
			'project_status' => array( 
				'import_field12' 
			),
			'last_updated' => array( 
				'import_field13' 
			),
			'created_at' => array( 
				'import_field14' 
			),
			'updated_at' => array( 
				'import_field15' 
			) 
		) 
	),
	'pageLinks' => array(
		'edit' => false,
		'add' => false,
		'view' => false,
		'print' => false 
	),
	'layoutHelper' => array(
		'formItems' => array(
			'formItems' => array(
				'supertop' => array( 
					 
				),
				'top' => array( 
					'import_header' 
				),
				'grid' => array( 
					'import_field',
					'import_field1',
					'import_field2',
					'import_field3',
					'import_field4',
					'import_field5',
					'import_field6',
					'import_field7',
					'import_field8',
					'import_field9',
					'import_field10',
					'import_field11',
					'import_field12',
					'import_field13',
					'import_field14',
					'import_field15' 
				) 
			),
			'formXtTags' => array(
				'supertop' => array( 
					 
				) 
			),
			'itemForms' => array(
				'import_header' => 'top',
				'import_field' => 'grid',
				'import_field1' => 'grid',
				'import_field2' => 'grid',
				'import_field3' => 'grid',
				'import_field4' => 'grid',
				'import_field5' => 'grid',
				'import_field6' => 'grid',
				'import_field7' => 'grid',
				'import_field8' => 'grid',
				'import_field9' => 'grid',
				'import_field10' => 'grid',
				'import_field11' => 'grid',
				'import_field12' => 'grid',
				'import_field13' => 'grid',
				'import_field14' => 'grid',
				'import_field15' => 'grid' 
			),
			'itemLocations' => array(
				 
			),
			'itemVisiblity' => array(
				 
			) 
		),
		'itemsByType' => array(
			'import_header' => array( 
				'import_header' 
			),
			'import_field' => array( 
				'import_field',
				'import_field1',
				'import_field2',
				'import_field3',
				'import_field4',
				'import_field5',
				'import_field6',
				'import_field7',
				'import_field8',
				'import_field9',
				'import_field10',
				'import_field11',
				'import_field12',
				'import_field13',
				'import_field14',
				'import_field15' 
			) 
		),
		'cellMaps' => array(
			 
		) 
	),
	'loginForm' => array(
		'loginForm' => 3 
	),
	'page' => array(
		'verticalBar' => false,
		'labeledButtons' => array(
			'update_records' => array(
				 
			),
			'print_pages' => array(
				 
			),
			'register_activate_message' => array(
				 
			),
			'details_found' => array(
				 
			) 
		),
		'hasCustomButtons' => false,
		'customButtons' => array( 
			 
		),
		'codeSnippets' => array( 
			 
		),
		'clickHandlerSnippets' => array( 
			 
		),
		'hasNotifications' => false,
		'menus' => array( 
			 
		),
		'calcTotalsFor' => 1,
		'hasCharts' => false 
	),
	'events' => array(
		'maps' => array( 
			 
		),
		'mapsData' => array(
			 
		),
		'buttons' => array( 
			 
		) 
	) 
);
			$pageArray = array(
	'id' => 'import',
	'type' => 'import',
	'layoutId' => 'first',
	'disabled' => false,
	'default' => 0,
	'forms' => array(
		'supertop' => array(
			'modelId' => 'panel-top',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'top' => array(
			'modelId' => 'import-header',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'import_header' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'grid' => array(
			'modelId' => 'import-grid',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'import_field',
						'import_field1',
						'import_field2',
						'import_field3',
						'import_field4',
						'import_field5',
						'import_field6',
						'import_field7',
						'import_field8',
						'import_field9',
						'import_field10',
						'import_field11',
						'import_field12',
						'import_field13',
						'import_field14',
						'import_field15' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		) 
	),
	'items' => array(
		'import_header' => array(
			'type' => 'import_header' 
		),
		'import_field' => array(
			'field' => 'detail_id',
			'type' => 'import_field' 
		),
		'import_field1' => array(
			'field' => 'project_id',
			'type' => 'import_field' 
		),
		'import_field2' => array(
			'field' => 'client',
			'type' => 'import_field' 
		),
		'import_field3' => array(
			'field' => 'contract_value',
			'type' => 'import_field' 
		),
		'import_field4' => array(
			'field' => 'project_manager',
			'type' => 'import_field' 
		),
		'import_field5' => array(
			'field' => 'start_date',
			'type' => 'import_field' 
		),
		'import_field6' => array(
			'field' => 'technical_lead',
			'type' => 'import_field' 
		),
		'import_field7' => array(
			'field' => 'end_date',
			'type' => 'import_field' 
		),
		'import_field8' => array(
			'field' => 'mel_lead',
			'type' => 'import_field' 
		),
		'import_field9' => array(
			'field' => 'percent_complete',
			'type' => 'import_field' 
		),
		'import_field10' => array(
			'field' => 'project_coordinator',
			'type' => 'import_field' 
		),
		'import_field11' => array(
			'field' => 'reporting_period',
			'type' => 'import_field' 
		),
		'import_field12' => array(
			'field' => 'project_status',
			'type' => 'import_field' 
		),
		'import_field13' => array(
			'field' => 'last_updated',
			'type' => 'import_field' 
		),
		'import_field14' => array(
			'field' => 'created_at',
			'type' => 'import_field' 
		),
		'import_field15' => array(
			'field' => 'updated_at',
			'type' => 'import_field' 
		) 
	),
	'dbProps' => array(
		 
	),
	'version' => 13,
	'imageItem' => array(
		'type' => 'page_image' 
	),
	'imageBgColor' => '#f2f2f2',
	'controlsBgColor' => 'white',
	'imagePosition' => 'right',
	'listTotals' => 1,
	'title' => array(
		 
	) 
);
		?>