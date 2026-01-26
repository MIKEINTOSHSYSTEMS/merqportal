<?php
			$optionsArray = array(
	'fields' => array(
		'gridFields' => array( 
			'indicator_id',
			'thematic_area',
			'importance',
			'indicator_name',
			'indicator_description',
			'indicator_type',
			'disaggregated_by',
			'data_type',
			'data_source',
			'reporting_frequency',
			'responsible_body',
			'known_data_limitation',
			'current_status',
			'target_value',
			'created_at',
			'updated_at',
			'is_active' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'indicator_id' => array( 
				'import_field' 
			),
			'thematic_area' => array( 
				'import_field1' 
			),
			'importance' => array( 
				'import_field2' 
			),
			'indicator_name' => array( 
				'import_field3' 
			),
			'indicator_description' => array( 
				'import_field4' 
			),
			'indicator_type' => array( 
				'import_field5' 
			),
			'disaggregated_by' => array( 
				'import_field6' 
			),
			'data_type' => array( 
				'import_field7' 
			),
			'data_source' => array( 
				'import_field8' 
			),
			'reporting_frequency' => array( 
				'import_field9' 
			),
			'responsible_body' => array( 
				'import_field10' 
			),
			'known_data_limitation' => array( 
				'import_field11' 
			),
			'current_status' => array( 
				'import_field12' 
			),
			'target_value' => array( 
				'import_field13' 
			),
			'created_at' => array( 
				'import_field14' 
			),
			'updated_at' => array( 
				'import_field15' 
			),
			'is_active' => array( 
				'import_field16' 
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
					'import_field15',
					'import_field16' 
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
				'import_field15' => 'grid',
				'import_field16' => 'grid' 
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
				'import_field15',
				'import_field16' 
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
						'import_field15',
						'import_field16' 
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
			'field' => 'indicator_id',
			'type' => 'import_field' 
		),
		'import_field1' => array(
			'field' => 'thematic_area',
			'type' => 'import_field' 
		),
		'import_field2' => array(
			'field' => 'importance',
			'type' => 'import_field' 
		),
		'import_field3' => array(
			'field' => 'indicator_name',
			'type' => 'import_field' 
		),
		'import_field4' => array(
			'field' => 'indicator_description',
			'type' => 'import_field' 
		),
		'import_field5' => array(
			'field' => 'indicator_type',
			'type' => 'import_field' 
		),
		'import_field6' => array(
			'field' => 'disaggregated_by',
			'type' => 'import_field' 
		),
		'import_field7' => array(
			'field' => 'data_type',
			'type' => 'import_field' 
		),
		'import_field8' => array(
			'field' => 'data_source',
			'type' => 'import_field' 
		),
		'import_field9' => array(
			'field' => 'reporting_frequency',
			'type' => 'import_field' 
		),
		'import_field10' => array(
			'field' => 'responsible_body',
			'type' => 'import_field' 
		),
		'import_field11' => array(
			'field' => 'known_data_limitation',
			'type' => 'import_field' 
		),
		'import_field12' => array(
			'field' => 'current_status',
			'type' => 'import_field' 
		),
		'import_field13' => array(
			'field' => 'target_value',
			'type' => 'import_field' 
		),
		'import_field14' => array(
			'field' => 'created_at',
			'type' => 'import_field' 
		),
		'import_field15' => array(
			'field' => 'updated_at',
			'type' => 'import_field' 
		),
		'import_field16' => array(
			'field' => 'is_active',
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