<?php
			$optionsArray = array(
	'totals' => array(
		'year_project_id' => array(
			'totalsType' => '' 
		),
		'project_id' => array(
			'totalsType' => '' 
		),
		'project_name' => array(
			'totalsType' => '' 
		),
		'client' => array(
			'totalsType' => '' 
		),
		'start_date' => array(
			'totalsType' => '' 
		),
		'end_date' => array(
			'totalsType' => '' 
		),
		'current_status_id' => array(
			'totalsType' => '' 
		),
		'remark' => array(
			'totalsType' => '' 
		),
		'year' => array(
			'totalsType' => '' 
		),
		'created_at' => array(
			'totalsType' => '' 
		),
		'updated_at' => array(
			'totalsType' => '' 
		) 
	),
	'fields' => array(
		'gridFields' => array( 
			'year_project_id',
			'project_id',
			'project_name',
			'client',
			'start_date',
			'end_date',
			'current_status_id',
			'remark',
			'year',
			'created_at',
			'updated_at' 
		),
		'exportFields' => array( 
			'year_project_id',
			'project_id',
			'project_name',
			'client',
			'start_date',
			'end_date',
			'current_status_id',
			'remark',
			'year',
			'created_at',
			'updated_at' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'year_project_id' => array( 
				'export_field' 
			),
			'project_id' => array( 
				'export_field1' 
			),
			'project_name' => array( 
				'export_field2' 
			),
			'client' => array( 
				'export_field3' 
			),
			'start_date' => array( 
				'export_field4' 
			),
			'end_date' => array( 
				'export_field5' 
			),
			'current_status_id' => array( 
				'export_field6' 
			),
			'remark' => array( 
				'export_field7' 
			),
			'year' => array( 
				'export_field8' 
			),
			'created_at' => array( 
				'export_field9' 
			),
			'updated_at' => array( 
				'export_field10' 
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
					'export_header' 
				),
				'grid' => array( 
					'export_field',
					'export_field1',
					'export_field2',
					'export_field3',
					'export_field4',
					'export_field5',
					'export_field6',
					'export_field7',
					'export_field8',
					'export_field9',
					'export_field10' 
				),
				'footer' => array( 
					'export_export',
					'export_cancel' 
				) 
			),
			'formXtTags' => array(
				'supertop' => array( 
					 
				) 
			),
			'itemForms' => array(
				'export_header' => 'top',
				'export_field' => 'grid',
				'export_field1' => 'grid',
				'export_field2' => 'grid',
				'export_field3' => 'grid',
				'export_field4' => 'grid',
				'export_field5' => 'grid',
				'export_field6' => 'grid',
				'export_field7' => 'grid',
				'export_field8' => 'grid',
				'export_field9' => 'grid',
				'export_field10' => 'grid',
				'export_export' => 'footer',
				'export_cancel' => 'footer' 
			),
			'itemLocations' => array(
				 
			),
			'itemVisiblity' => array(
				 
			) 
		),
		'itemsByType' => array(
			'export_header' => array( 
				'export_header' 
			),
			'export_export' => array( 
				'export_export' 
			),
			'export_cancel' => array( 
				'export_cancel' 
			),
			'export_field' => array( 
				'export_field',
				'export_field1',
				'export_field2',
				'export_field3',
				'export_field4',
				'export_field5',
				'export_field6',
				'export_field7',
				'export_field8',
				'export_field9',
				'export_field10' 
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
	),
	'export' => array(
		'format' => 2,
		'selectFields' => false,
		'delimiter' => ',',
		'selectDelimiter' => false,
		'exportFileTypes' => array(
			'excel' => true,
			'word' => true,
			'csv' => true,
			'xml' => false 
		) 
	) 
);
			$pageArray = array(
	'id' => 'export',
	'type' => 'export',
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
			'modelId' => 'export-header',
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
						'export_header' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'grid' => array(
			'modelId' => 'export-grid',
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
						'export_field',
						'export_field1',
						'export_field2',
						'export_field3',
						'export_field4',
						'export_field5',
						'export_field6',
						'export_field7',
						'export_field8',
						'export_field9',
						'export_field10' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'footer' => array(
			'modelId' => 'export-footer',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1' 
						),
						array(
							'cell' => 'c2' 
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
				),
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						'export_export',
						'export_cancel' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		) 
	),
	'items' => array(
		'export_header' => array(
			'type' => 'export_header' 
		),
		'export_export' => array(
			'type' => 'export_export' 
		),
		'export_cancel' => array(
			'type' => 'export_cancel' 
		),
		'export_field' => array(
			'field' => 'year_project_id',
			'type' => 'export_field' 
		),
		'export_field1' => array(
			'field' => 'project_id',
			'type' => 'export_field' 
		),
		'export_field2' => array(
			'field' => 'project_name',
			'type' => 'export_field' 
		),
		'export_field3' => array(
			'field' => 'client',
			'type' => 'export_field' 
		),
		'export_field4' => array(
			'field' => 'start_date',
			'type' => 'export_field' 
		),
		'export_field5' => array(
			'field' => 'end_date',
			'type' => 'export_field' 
		),
		'export_field6' => array(
			'field' => 'current_status_id',
			'type' => 'export_field' 
		),
		'export_field7' => array(
			'field' => 'remark',
			'type' => 'export_field' 
		),
		'export_field8' => array(
			'field' => 'year',
			'type' => 'export_field' 
		),
		'export_field9' => array(
			'field' => 'created_at',
			'type' => 'export_field' 
		),
		'export_field10' => array(
			'field' => 'updated_at',
			'type' => 'export_field' 
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
		 
	),
	'exportFormat' => 2,
	'exportDelimiter' => ',',
	'exportSelectDelimiter' => false,
	'exportSelectFields' => false 
);
		?>