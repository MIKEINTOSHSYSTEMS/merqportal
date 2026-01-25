<?php
			$optionsArray = array(
	'master' => array(
		'mne_projects' => array(
			'preview' => false 
		) 
	),
	'captcha' => array(
		'captcha' => false 
	),
	'fields' => array(
		'gridFields' => array( 
			'project_id',
			'client',
			'contract_value',
			'end_date',
			'technical_lead',
			'project_coordinator',
			'last_updated',
			'updated_at',
			'start_date',
			'project_manager',
			'mel_lead',
			'created_at',
			'project_status',
			'percent_complete',
			'reporting_period' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'updateOnEditFields' => array( 
			 
		),
		'fieldItems' => array(
			'project_id' => array( 
				'integrated_edit_field' 
			),
			'client' => array( 
				'integrated_edit_field1' 
			),
			'contract_value' => array( 
				'integrated_edit_field2' 
			),
			'end_date' => array( 
				'integrated_edit_field6' 
			),
			'technical_lead' => array( 
				'integrated_edit_field5' 
			),
			'project_coordinator' => array( 
				'integrated_edit_field9' 
			),
			'last_updated' => array( 
				'integrated_edit_field12' 
			),
			'updated_at' => array( 
				'integrated_edit_field14' 
			),
			'start_date' => array( 
				'integrated_edit_field4' 
			),
			'project_manager' => array( 
				'integrated_edit_field3' 
			),
			'mel_lead' => array( 
				'integrated_edit_field7' 
			),
			'created_at' => array( 
				'integrated_edit_field13' 
			),
			'project_status' => array( 
				'integrated_edit_field11' 
			),
			'percent_complete' => array( 
				'integrated_edit_field8' 
			),
			'reporting_period' => array( 
				'integrated_edit_field10' 
			) 
		) 
	),
	'pageLinks' => array(
		'edit' => false,
		'add' => false,
		'view' => true,
		'print' => false 
	),
	'layoutHelper' => array(
		'formItems' => array(
			'formItems' => array(
				'above-grid' => array( 
					'edit_message' 
				),
				'below-grid' => array( 
					'edit_save',
					'edit_back_list',
					'edit_close',
					'prev',
					'next',
					'hamburger' 
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
					'edit_header' 
				),
				'grid' => array( 
					'integrated_edit_field',
					'integrated_edit_field1',
					'integrated_edit_field2',
					'integrated_edit_field6',
					'integrated_edit_field5',
					'integrated_edit_field9',
					'integrated_edit_field12',
					'integrated_edit_field14',
					'integrated_edit_field4',
					'integrated_edit_field3',
					'integrated_edit_field7',
					'integrated_edit_field13',
					'integrated_edit_field11',
					'integrated_edit_field8',
					'integrated_edit_field10' 
				) 
			),
			'formXtTags' => array(
				'above-grid' => array( 
					'message_block' 
				) 
			),
			'itemForms' => array(
				'edit_message' => 'above-grid',
				'edit_save' => 'below-grid',
				'edit_back_list' => 'below-grid',
				'edit_close' => 'below-grid',
				'prev' => 'below-grid',
				'next' => 'below-grid',
				'hamburger' => 'below-grid',
				'expand_menu_button' => 'supertop',
				'collapse_button' => 'supertop',
				'logo' => 'left',
				'expand_button' => 'left',
				'menu' => 'left',
				'edit_header' => 'top',
				'integrated_edit_field' => 'grid',
				'integrated_edit_field1' => 'grid',
				'integrated_edit_field2' => 'grid',
				'integrated_edit_field6' => 'grid',
				'integrated_edit_field5' => 'grid',
				'integrated_edit_field9' => 'grid',
				'integrated_edit_field12' => 'grid',
				'integrated_edit_field14' => 'grid',
				'integrated_edit_field4' => 'grid',
				'integrated_edit_field3' => 'grid',
				'integrated_edit_field7' => 'grid',
				'integrated_edit_field13' => 'grid',
				'integrated_edit_field11' => 'grid',
				'integrated_edit_field8' => 'grid',
				'integrated_edit_field10' => 'grid' 
			),
			'itemLocations' => array(
				'integrated_edit_field' => array(
					'location' => 'grid',
					'cellId' => 'c' 
				),
				'integrated_edit_field1' => array(
					'location' => 'grid',
					'cellId' => 'c4' 
				),
				'integrated_edit_field2' => array(
					'location' => 'grid',
					'cellId' => 'c5' 
				),
				'integrated_edit_field6' => array(
					'location' => 'grid',
					'cellId' => 'c7' 
				),
				'integrated_edit_field5' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field9' => array(
					'location' => 'grid',
					'cellId' => 'c9' 
				),
				'integrated_edit_field12' => array(
					'location' => 'grid',
					'cellId' => 'c10' 
				),
				'integrated_edit_field14' => array(
					'location' => 'grid',
					'cellId' => 'c11' 
				),
				'integrated_edit_field4' => array(
					'location' => 'grid',
					'cellId' => 'c12' 
				),
				'integrated_edit_field3' => array(
					'location' => 'grid',
					'cellId' => 'c13' 
				),
				'integrated_edit_field7' => array(
					'location' => 'grid',
					'cellId' => 'c14' 
				),
				'integrated_edit_field13' => array(
					'location' => 'grid',
					'cellId' => 'c16' 
				),
				'integrated_edit_field11' => array(
					'location' => 'grid',
					'cellId' => 'c17' 
				),
				'integrated_edit_field8' => array(
					'location' => 'grid',
					'cellId' => 'c18' 
				),
				'integrated_edit_field10' => array(
					'location' => 'grid',
					'cellId' => 'c19' 
				) 
			),
			'itemVisiblity' => array(
				'expand_menu_button' => 2,
				'expand_button' => 5 
			) 
		),
		'itemsByType' => array(
			'edit_header' => array( 
				'edit_header' 
			),
			'edit_message' => array( 
				'edit_message' 
			),
			'edit_save' => array( 
				'edit_save' 
			),
			'edit_back_list' => array( 
				'edit_back_list' 
			),
			'edit_close' => array( 
				'edit_close' 
			),
			'hamburger' => array( 
				'hamburger' 
			),
			'edit_reset' => array( 
				'edit_reset' 
			),
			'edit_view' => array( 
				'edit_view' 
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
			'integrated_edit_field' => array( 
				'integrated_edit_field',
				'integrated_edit_field1',
				'integrated_edit_field2',
				'integrated_edit_field6',
				'integrated_edit_field5',
				'integrated_edit_field9',
				'integrated_edit_field12',
				'integrated_edit_field14',
				'integrated_edit_field4',
				'integrated_edit_field3',
				'integrated_edit_field7',
				'integrated_edit_field13',
				'integrated_edit_field11',
				'integrated_edit_field8',
				'integrated_edit_field10' 
			),
			'next' => array( 
				'next' 
			),
			'prev' => array( 
				'prev' 
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
					'c12' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field4' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c7' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							0 
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
					'c13' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field3' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c8' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field5' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c5' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							2 
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
							1 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field7' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c9' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field9' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c17' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field11' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c18' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field8' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c19' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field10' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c20' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c21' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c22' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c6' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							5 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c15' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							5 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c10' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							5 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field12' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c3' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							6 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c16' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							6 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field13' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c11' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							6 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field14' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					) 
				),
				'width' => 3,
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
		'type' => 'edit',
		'breadcrumb' => false,
		'nextPrev' => true 
	),
	'events' => array(
		'maps' => array( 
			 
		),
		'mapsData' => array(
			 
		),
		'buttons' => array( 
			 
		) 
	),
	'edit' => array(
		'updateSelected' => false 
	) 
);
			$pageArray = array(
	'id' => 'edit',
	'type' => 'edit',
	'layoutId' => 'leftbar',
	'disabled' => false,
	'default' => 0,
	'forms' => array(
		'above-grid' => array(
			'modelId' => 'edit-above-grid',
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
						'edit_message' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'below-grid' => array(
			'modelId' => 'edit-below-grid',
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
						'edit_save',
						'edit_back_list',
						'edit_close' 
					) 
				),
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						'prev',
						'next',
						'hamburger' 
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
			'modelId' => 'edit-header',
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
						'edit_header' 
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
							'cell' => 'c12' 
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
							'cell' => 'c4' 
						),
						array(
							'cell' => 'c13' 
						),
						array(
							'cell' => 'c8' 
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
							'cell' => 'c14' 
						),
						array(
							'cell' => 'c9' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c17' 
						),
						array(
							'cell' => 'c18' 
						),
						array(
							'cell' => 'c19' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c20' 
						),
						array(
							'cell' => 'c21' 
						),
						array(
							'cell' => 'c22' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c6' 
						),
						array(
							'cell' => 'c15' 
						),
						array(
							'cell' => 'c10' 
						) 
					) 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c3' 
						),
						array(
							'cell' => 'c16' 
						),
						array(
							'cell' => 'c11' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c3' => array(
					'model' => 'c3',
					'items' => array( 
						 
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
						'integrated_edit_field1' 
					) 
				),
				'c5' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field2' 
					) 
				),
				'c6' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c7' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field6' 
					) 
				),
				'c8' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field5' 
					) 
				),
				'c9' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field9' 
					) 
				),
				'c10' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field12' 
					) 
				),
				'c11' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field14' 
					) 
				),
				'c12' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field4' 
					) 
				),
				'c13' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field3' 
					) 
				),
				'c14' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field7' 
					) 
				),
				'c15' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c16' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field13' 
					) 
				),
				'c17' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field11' 
					) 
				),
				'c18' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field8' 
					) 
				),
				'c19' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field10' 
					) 
				),
				'c20' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c21' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c22' => array(
					'model' => 'c3',
					'items' => array( 
						 
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
		'edit_header' => array(
			'type' => 'edit_header' 
		),
		'edit_message' => array(
			'type' => 'edit_message' 
		),
		'edit_save' => array(
			'type' => 'edit_save' 
		),
		'edit_back_list' => array(
			'type' => 'edit_back_list' 
		),
		'edit_close' => array(
			'type' => 'edit_close' 
		),
		'hamburger' => array(
			'type' => 'hamburger',
			'items' => array( 
				'edit_reset',
				'edit_view' 
			) 
		),
		'edit_reset' => array(
			'type' => 'edit_reset' 
		),
		'edit_view' => array(
			'type' => 'edit_view' 
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
		'integrated_edit_field' => array(
			'field' => 'project_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field1' => array(
			'field' => 'client',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field2' => array(
			'field' => 'contract_value',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field6' => array(
			'field' => 'end_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field5' => array(
			'field' => 'technical_lead',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field9' => array(
			'field' => 'project_coordinator',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field12' => array(
			'field' => 'last_updated',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field14' => array(
			'field' => 'updated_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field4' => array(
			'field' => 'start_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field3' => array(
			'field' => 'project_manager',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field7' => array(
			'field' => 'mel_lead',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field13' => array(
			'field' => 'created_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field11' => array(
			'field' => 'project_status',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field8' => array(
			'field' => 'percent_complete',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'integrated_edit_field10' => array(
			'field' => 'reporting_period',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => false 
		),
		'next' => array(
			'type' => 'next' 
		),
		'prev' => array(
			'type' => 'prev' 
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
		 
	) 
);
		?>