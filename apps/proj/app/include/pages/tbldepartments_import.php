<?php
			$optionsArray = array(
	'fields' => array(
		'gridFields' => array( 
			'departmentid',
			'name',
			'imap_username',
			'email',
			'email_from_header',
			'host',
			'password',
			'encryption',
			'folder',
			'delete_after_import',
			'calendar_id',
			'hidefromclient',
			'manager_id',
			'parent_id' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'departmentid' => array( 
				'import_field' 
			),
			'name' => array( 
				'import_field1' 
			),
			'imap_username' => array( 
				'import_field2' 
			),
			'email' => array( 
				'import_field3' 
			),
			'email_from_header' => array( 
				'import_field4' 
			),
			'host' => array( 
				'import_field5' 
			),
			'password' => array( 
				'import_field6' 
			),
			'encryption' => array( 
				'import_field7' 
			),
			'folder' => array( 
				'import_field8' 
			),
			'delete_after_import' => array( 
				'import_field9' 
			),
			'calendar_id' => array( 
				'import_field10' 
			),
			'hidefromclient' => array( 
				'import_field11' 
			),
			'manager_id' => array( 
				'import_field12' 
			),
			'parent_id' => array( 
				'import_field13' 
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
					'import_field13' 
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
				'import_field13' => 'grid' 
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
				'import_field13' 
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
						'import_field13' 
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
			'field' => 'departmentid',
			'type' => 'import_field' 
		),
		'import_field1' => array(
			'field' => 'name',
			'type' => 'import_field' 
		),
		'import_field2' => array(
			'field' => 'imap_username',
			'type' => 'import_field' 
		),
		'import_field3' => array(
			'field' => 'email',
			'type' => 'import_field' 
		),
		'import_field4' => array(
			'field' => 'email_from_header',
			'type' => 'import_field' 
		),
		'import_field5' => array(
			'field' => 'host',
			'type' => 'import_field' 
		),
		'import_field6' => array(
			'field' => 'password',
			'type' => 'import_field' 
		),
		'import_field7' => array(
			'field' => 'encryption',
			'type' => 'import_field' 
		),
		'import_field8' => array(
			'field' => 'folder',
			'type' => 'import_field' 
		),
		'import_field9' => array(
			'field' => 'delete_after_import',
			'type' => 'import_field' 
		),
		'import_field10' => array(
			'field' => 'calendar_id',
			'type' => 'import_field' 
		),
		'import_field11' => array(
			'field' => 'hidefromclient',
			'type' => 'import_field' 
		),
		'import_field12' => array(
			'field' => 'manager_id',
			'type' => 'import_field' 
		),
		'import_field13' => array(
			'field' => 'parent_id',
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