<?php
			$optionsArray = array(
	'fields' => array(
		'gridFields' => array( 
			'financial_id',
			'project_id',
			'total_project_budget',
			'amount_spent_to_date',
			'remaining_budget',
			'burn_rate',
			'budget_category',
			'allocated_amount',
			'spent_amount',
			'remaining_amount',
			'percent_spent',
			'comments',
			'target_profit_margin',
			'current_profit_margin',
			'reporting_period',
			'created_at',
			'updated_at' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'financial_id' => array( 
				'import_field' 
			),
			'project_id' => array( 
				'import_field1' 
			),
			'total_project_budget' => array( 
				'import_field2' 
			),
			'amount_spent_to_date' => array( 
				'import_field3' 
			),
			'remaining_budget' => array( 
				'import_field4' 
			),
			'burn_rate' => array( 
				'import_field5' 
			),
			'budget_category' => array( 
				'import_field6' 
			),
			'allocated_amount' => array( 
				'import_field7' 
			),
			'spent_amount' => array( 
				'import_field8' 
			),
			'remaining_amount' => array( 
				'import_field9' 
			),
			'percent_spent' => array( 
				'import_field10' 
			),
			'comments' => array( 
				'import_field11' 
			),
			'target_profit_margin' => array( 
				'import_field12' 
			),
			'current_profit_margin' => array( 
				'import_field13' 
			),
			'reporting_period' => array( 
				'import_field14' 
			),
			'created_at' => array( 
				'import_field15' 
			),
			'updated_at' => array( 
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
			'field' => 'financial_id',
			'type' => 'import_field' 
		),
		'import_field1' => array(
			'field' => 'project_id',
			'type' => 'import_field' 
		),
		'import_field2' => array(
			'field' => 'total_project_budget',
			'type' => 'import_field' 
		),
		'import_field3' => array(
			'field' => 'amount_spent_to_date',
			'type' => 'import_field' 
		),
		'import_field4' => array(
			'field' => 'remaining_budget',
			'type' => 'import_field' 
		),
		'import_field5' => array(
			'field' => 'burn_rate',
			'type' => 'import_field' 
		),
		'import_field6' => array(
			'field' => 'budget_category',
			'type' => 'import_field' 
		),
		'import_field7' => array(
			'field' => 'allocated_amount',
			'type' => 'import_field' 
		),
		'import_field8' => array(
			'field' => 'spent_amount',
			'type' => 'import_field' 
		),
		'import_field9' => array(
			'field' => 'remaining_amount',
			'type' => 'import_field' 
		),
		'import_field10' => array(
			'field' => 'percent_spent',
			'type' => 'import_field' 
		),
		'import_field11' => array(
			'field' => 'comments',
			'type' => 'import_field' 
		),
		'import_field12' => array(
			'field' => 'target_profit_margin',
			'type' => 'import_field' 
		),
		'import_field13' => array(
			'field' => 'current_profit_margin',
			'type' => 'import_field' 
		),
		'import_field14' => array(
			'field' => 'reporting_period',
			'type' => 'import_field' 
		),
		'import_field15' => array(
			'field' => 'created_at',
			'type' => 'import_field' 
		),
		'import_field16' => array(
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