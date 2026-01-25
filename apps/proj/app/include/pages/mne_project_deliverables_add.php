<?php
			$optionsArray = array(
	'master' => array(
		'mne_deliverable_status' => array(
			'preview' => false 
		),
		'mne_projects' => array(
			'preview' => false 
		),
		'mne_deliverable_options' => array(
			'preview' => false 
		) 
	),
	'captcha' => array(
		'captcha' => false 
	),
	'fields' => array(
		'gridFields' => array( 
			'project_id',
			'deliverable_name',
			'due_date',
			'status_id',
			'completed_date',
			'quality_check',
			'client_acceptance',
			'owner',
			'notes',
			'created_at',
			'updated_at',
			'start_date',
			'ganttProgress' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'project_id' => array( 
				'integrated_edit_field' 
			),
			'deliverable_name' => array( 
				'integrated_edit_field1' 
			),
			'due_date' => array( 
				'integrated_edit_field2' 
			),
			'status_id' => array( 
				'integrated_edit_field3' 
			),
			'completed_date' => array( 
				'integrated_edit_field4' 
			),
			'quality_check' => array( 
				'integrated_edit_field5' 
			),
			'client_acceptance' => array( 
				'integrated_edit_field6' 
			),
			'owner' => array( 
				'integrated_edit_field7' 
			),
			'notes' => array( 
				'integrated_edit_field8' 
			),
			'created_at' => array( 
				'integrated_edit_field9' 
			),
			'updated_at' => array( 
				'integrated_edit_field10' 
			),
			'start_date' => array( 
				'integrated_edit_field11' 
			),
			'ganttProgress' => array( 
				'integrated_edit_field12' 
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
				'above-grid' => array( 
					'add_message' 
				),
				'below-grid' => array( 
					'add_save',
					'add_reset',
					'add_back_list',
					'add_cancel' 
				),
				'supertop' => array( 
					'expand_menu_button',
					'collapse_button' 
				),
				'left' => array( 
					'logo',
					'expand_button',
					'menu' 
				),
				'top' => array( 
					'add_header' 
				),
				'grid' => array( 
					'integrated_edit_field8',
					'integrated_edit_field',
					'integrated_edit_field9',
					'integrated_edit_field1',
					'integrated_edit_field12',
					'integrated_edit_field2',
					'integrated_edit_field6',
					'integrated_edit_field10',
					'integrated_edit_field5',
					'integrated_edit_field7',
					'integrated_edit_field4',
					'integrated_edit_field3',
					'integrated_edit_field11' 
				) 
			),
			'formXtTags' => array(
				'above-grid' => array( 
					'message_block' 
				) 
			),
			'itemForms' => array(
				'add_message' => 'above-grid',
				'add_save' => 'below-grid',
				'add_reset' => 'below-grid',
				'add_back_list' => 'below-grid',
				'add_cancel' => 'below-grid',
				'expand_menu_button' => 'supertop',
				'collapse_button' => 'supertop',
				'logo' => 'left',
				'expand_button' => 'left',
				'menu' => 'left',
				'add_header' => 'top',
				'integrated_edit_field8' => 'grid',
				'integrated_edit_field' => 'grid',
				'integrated_edit_field9' => 'grid',
				'integrated_edit_field1' => 'grid',
				'integrated_edit_field12' => 'grid',
				'integrated_edit_field2' => 'grid',
				'integrated_edit_field6' => 'grid',
				'integrated_edit_field10' => 'grid',
				'integrated_edit_field5' => 'grid',
				'integrated_edit_field7' => 'grid',
				'integrated_edit_field4' => 'grid',
				'integrated_edit_field3' => 'grid',
				'integrated_edit_field11' => 'grid' 
			),
			'itemLocations' => array(
				'integrated_edit_field8' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field' => array(
					'location' => 'grid',
					'cellId' => 'c' 
				),
				'integrated_edit_field9' => array(
					'location' => 'grid',
					'cellId' => 'c4' 
				),
				'integrated_edit_field1' => array(
					'location' => 'grid',
					'cellId' => 'c5' 
				),
				'integrated_edit_field12' => array(
					'location' => 'grid',
					'cellId' => 'c6' 
				),
				'integrated_edit_field2' => array(
					'location' => 'grid',
					'cellId' => 'c7' 
				),
				'integrated_edit_field6' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field10' => array(
					'location' => 'grid',
					'cellId' => 'c9' 
				),
				'integrated_edit_field5' => array(
					'location' => 'grid',
					'cellId' => 'c11' 
				),
				'integrated_edit_field7' => array(
					'location' => 'grid',
					'cellId' => 'c12' 
				),
				'integrated_edit_field4' => array(
					'location' => 'grid',
					'cellId' => 'c13' 
				),
				'integrated_edit_field3' => array(
					'location' => 'grid',
					'cellId' => 'c14' 
				),
				'integrated_edit_field11' => array(
					'location' => 'grid',
					'cellId' => 'c15' 
				) 
			),
			'itemVisiblity' => array(
				'expand_menu_button' => 2,
				'expand_button' => 5 
			) 
		),
		'itemsByType' => array(
			'add_header' => array( 
				'add_header' 
			),
			'add_message' => array( 
				'add_message' 
			),
			'add_save' => array( 
				'add_save' 
			),
			'add_reset' => array( 
				'add_reset' 
			),
			'add_back_list' => array( 
				'add_back_list' 
			),
			'add_cancel' => array( 
				'add_cancel' 
			),
			'integrated_edit_field' => array( 
				'integrated_edit_field',
				'integrated_edit_field1',
				'integrated_edit_field2',
				'integrated_edit_field3',
				'integrated_edit_field4',
				'integrated_edit_field5',
				'integrated_edit_field6',
				'integrated_edit_field7',
				'integrated_edit_field8',
				'integrated_edit_field9',
				'integrated_edit_field10',
				'integrated_edit_field11',
				'integrated_edit_field12' 
			),
			'logo' => array( 
				'logo' 
			),
			'menu' => array( 
				'menu' 
			),
			'expand_menu_button' => array( 
				'expand_menu_button' 
			),
			'collapse_button' => array( 
				'collapse_button' 
			),
			'expand_button' => array( 
				'expand_button' 
			) 
		),
		'cellMaps' => array(
			'grid' => array(
				'cells' => array(
					'c' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c6' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field12' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c5' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field1' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c7' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field2' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c14' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field3' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c15' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field11' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c12' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field7' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c13' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field4' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c3' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							4,
							5 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field8' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c11' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field5' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c8' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							5 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field6' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c4' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							6 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field9' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c9' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							6 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field10' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					) 
				),
				'width' => 2,
				'height' => 7 
			) 
		) 
	),
	'page' => array(
		'verticalBar' => true,
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
			array(
				'id' => 'main',
				'horizontal' => false 
			) 
		),
		'calcTotalsFor' => 1,
		'hasCharts' => false 
	),
	'misc' => array(
		'type' => 'add',
		'breadcrumb' => false 
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
	'id' => 'add',
	'type' => 'add',
	'layoutId' => 'leftbar',
	'disabled' => false,
	'default' => 0,
	'forms' => array(
		'above-grid' => array(
			'modelId' => 'add-above-grid',
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
						'add_message' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'below-grid' => array(
			'modelId' => 'add-below-grid',
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
						'add_save',
						'add_reset',
						'add_back_list',
						'add_cancel' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'supertop' => array(
			'modelId' => 'leftbar-top-edit',
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
						'expand_menu_button',
						'collapse_button' 
					) 
				),
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'left' => array(
			'modelId' => 'leftbar-menu',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c0' 
						) 
					),
					'section' => '' 
				),
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
				'c0' => array(
					'model' => 'c0',
					'items' => array( 
						'logo',
						'expand_button' 
					) 
				),
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'menu' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'top' => array(
			'modelId' => 'add-header',
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
						'add_header' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'grid' => array(
			'modelId' => 'simple-edit',
			'grid' => array( 
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c' 
						),
						array(
							'cell' => 'c6' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c5' 
						),
						array(
							'cell' => 'c7' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c14' 
						),
						array(
							'cell' => 'c15' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c12' 
						),
						array(
							'cell' => 'c13' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c3',
							'rowspan' => 2 
						),
						array(
							'cell' => 'c11' 
						) 
					) 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c8' 
						) 
					),
					'section' => '' 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c4' 
						),
						array(
							'cell' => 'c9' 
						) 
					) 
				) 
			),
			'cells' => array(
				'c3' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field8' 
					) 
				),
				'c' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field' 
					) 
				),
				'c4' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field9' 
					) 
				),
				'c5' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field1' 
					) 
				),
				'c6' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field12' 
					) 
				),
				'c7' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field2' 
					) 
				),
				'c8' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field6' 
					) 
				),
				'c9' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field10' 
					) 
				),
				'c11' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field5' 
					) 
				),
				'c12' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field7' 
					) 
				),
				'c13' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field4' 
					) 
				),
				'c14' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field3' 
					) 
				),
				'c15' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field11' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'columnCount' => 1,
			'inlineLabels' => false,
			'separateLabels' => false 
		) 
	),
	'items' => array(
		'add_header' => array(
			'type' => 'add_header' 
		),
		'add_message' => array(
			'type' => 'add_message' 
		),
		'add_save' => array(
			'type' => 'add_save' 
		),
		'add_reset' => array(
			'type' => 'add_reset' 
		),
		'add_back_list' => array(
			'type' => 'add_back_list' 
		),
		'add_cancel' => array(
			'type' => 'add_cancel' 
		),
		'integrated_edit_field' => array(
			'field' => 'project_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field1' => array(
			'field' => 'deliverable_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field2' => array(
			'field' => 'due_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field3' => array(
			'field' => 'status_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field4' => array(
			'field' => 'completed_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field5' => array(
			'field' => 'quality_check',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field6' => array(
			'field' => 'client_acceptance',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field7' => array(
			'field' => 'owner',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field8' => array(
			'field' => 'notes',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field9' => array(
			'field' => 'created_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field10' => array(
			'field' => 'updated_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'logo' => array(
			'type' => 'logo' 
		),
		'menu' => array(
			'type' => 'menu' 
		),
		'expand_menu_button' => array(
			'type' => 'expand_menu_button' 
		),
		'collapse_button' => array(
			'type' => 'collapse_button' 
		),
		'integrated_edit_field11' => array(
			'field' => 'start_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field12' => array(
			'field' => 'ganttProgress',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'expand_button' => array(
			'type' => 'expand_button' 
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
		'English' => 'New task' 
	) 
);
		?>