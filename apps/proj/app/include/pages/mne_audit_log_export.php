<?php
			$optionsArray = array(
	'totals' => array(
		'audit_id' => array(
			'totalsType' => '' 
		),
		'user_id' => array(
			'totalsType' => '' 
		),
		'action' => array(
			'totalsType' => '' 
		),
		'table_name' => array(
			'totalsType' => '' 
		),
		'record_id' => array(
			'totalsType' => '' 
		),
		'old_values' => array(
			'totalsType' => '' 
		),
		'new_values' => array(
			'totalsType' => '' 
		),
		'ip_address' => array(
			'totalsType' => '' 
		),
		'user_agent' => array(
			'totalsType' => '' 
		),
		'created_at' => array(
			'totalsType' => '' 
		) 
	),
	'fields' => array(
		'gridFields' => array( 
			'audit_id',
			'user_id',
			'action',
			'table_name',
			'record_id',
			'old_values',
			'new_values',
			'ip_address',
			'user_agent',
			'created_at' 
		),
		'exportFields' => array( 
			'audit_id',
			'user_id',
			'action',
			'table_name',
			'record_id',
			'old_values',
			'new_values',
			'ip_address',
			'user_agent',
			'created_at' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'audit_id' => array( 
				'export_field' 
			),
			'user_id' => array( 
				'export_field1' 
			),
			'action' => array( 
				'export_field2' 
			),
			'table_name' => array( 
				'export_field3' 
			),
			'record_id' => array( 
				'export_field4' 
			),
			'old_values' => array( 
				'export_field5' 
			),
			'new_values' => array( 
				'export_field6' 
			),
			'ip_address' => array( 
				'export_field7' 
			),
			'user_agent' => array( 
				'export_field8' 
			),
			'created_at' => array( 
				'export_field9' 
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
					'export_field9' 
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
				'export_field9' 
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
						'export_field9' 
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
			'field' => 'audit_id',
			'type' => 'export_field' 
		),
		'export_field1' => array(
			'field' => 'user_id',
			'type' => 'export_field' 
		),
		'export_field2' => array(
			'field' => 'action',
			'type' => 'export_field' 
		),
		'export_field3' => array(
			'field' => 'table_name',
			'type' => 'export_field' 
		),
		'export_field4' => array(
			'field' => 'record_id',
			'type' => 'export_field' 
		),
		'export_field5' => array(
			'field' => 'old_values',
			'type' => 'export_field' 
		),
		'export_field6' => array(
			'field' => 'new_values',
			'type' => 'export_field' 
		),
		'export_field7' => array(
			'field' => 'ip_address',
			'type' => 'export_field' 
		),
		'export_field8' => array(
			'field' => 'user_agent',
			'type' => 'export_field' 
		),
		'export_field9' => array(
			'field' => 'created_at',
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