<?php
			$optionsArray = array(
	'details' => array(
		'mne_project_deliverables' => array(
			'displayPreview' => 1 
		) 
	),
	'master' => array(
		'mne_projects' => array(
			'preview' => false 
		),
		'mne_status_options' => array(
			'preview' => false 
		) 
	),
	'captcha' => array(
		'captcha' => false 
	),
	'fields' => array(
		'gridFields' => array( 
			'status_id',
			'created_at',
			'updated_at',
			'project_id',
			'milestone_name',
			'notes',
			'start_date',
			'planned_date',
			'variance_days',
			'actual_date',
			'ganttProgress' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'updateOnEditFields' => array( 
			'status_id',
			'created_at',
			'updated_at',
			'project_id',
			'milestone_name',
			'notes',
			'start_date',
			'planned_date',
			'variance_days',
			'actual_date' 
		),
		'fieldItems' => array(
			'status_id' => array( 
				'integrated_edit_field5' 
			),
			'created_at' => array( 
				'integrated_edit_field7' 
			),
			'updated_at' => array( 
				'integrated_edit_field8' 
			),
			'project_id' => array( 
				'integrated_edit_field' 
			),
			'milestone_name' => array( 
				'integrated_edit_field1' 
			),
			'notes' => array( 
				'integrated_edit_field6' 
			),
			'start_date' => array( 
				'integrated_edit_field9' 
			),
			'planned_date' => array( 
				'integrated_edit_field2' 
			),
			'variance_days' => array( 
				'integrated_edit_field4' 
			),
			'actual_date' => array( 
				'integrated_edit_field3' 
			),
			'ganttProgress' => array( 
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
					'gantt_add_child',
					'gantt_delete',
					'update_records',
					'edit_back_list',
					'edit_close',
					'prev',
					'next',
					'hamburger' 
				),
				'supertop' => array( 
					'expand_menu_button',
					'collapse_button',
					'loginform_login',
					'username_button' 
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
					'integrated_edit_field10',
					'integrated_edit_field5',
					'integrated_edit_field7',
					'integrated_edit_field8',
					'integrated_edit_field',
					'integrated_edit_field1',
					'integrated_edit_field6',
					'integrated_edit_field9',
					'integrated_edit_field2',
					'integrated_edit_field4',
					'integrated_edit_field3',
					'details_preview' 
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
				'gantt_add_child' => 'below-grid',
				'gantt_delete' => 'below-grid',
				'update_records' => 'below-grid',
				'edit_back_list' => 'below-grid',
				'edit_close' => 'below-grid',
				'prev' => 'below-grid',
				'next' => 'below-grid',
				'hamburger' => 'below-grid',
				'expand_menu_button' => 'supertop',
				'collapse_button' => 'supertop',
				'loginform_login' => 'supertop',
				'username_button' => 'supertop',
				'logo' => 'left',
				'expand_button' => 'left',
				'menu' => 'left',
				'edit_header' => 'top',
				'integrated_edit_field10' => 'grid',
				'integrated_edit_field5' => 'grid',
				'integrated_edit_field7' => 'grid',
				'integrated_edit_field8' => 'grid',
				'integrated_edit_field' => 'grid',
				'integrated_edit_field1' => 'grid',
				'integrated_edit_field6' => 'grid',
				'integrated_edit_field9' => 'grid',
				'integrated_edit_field2' => 'grid',
				'integrated_edit_field4' => 'grid',
				'integrated_edit_field3' => 'grid',
				'details_preview' => 'grid' 
			),
			'itemLocations' => array(
				'integrated_edit_field10' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field5' => array(
					'location' => 'grid',
					'cellId' => 'c5' 
				),
				'integrated_edit_field7' => array(
					'location' => 'grid',
					'cellId' => 'c6' 
				),
				'integrated_edit_field8' => array(
					'location' => 'grid',
					'cellId' => 'c7' 
				),
				'integrated_edit_field' => array(
					'location' => 'grid',
					'cellId' => 'c14' 
				),
				'integrated_edit_field1' => array(
					'location' => 'grid',
					'cellId' => 'c15' 
				),
				'integrated_edit_field6' => array(
					'location' => 'grid',
					'cellId' => 'c17' 
				),
				'integrated_edit_field9' => array(
					'location' => 'grid',
					'cellId' => 'c18' 
				),
				'integrated_edit_field2' => array(
					'location' => 'grid',
					'cellId' => 'c19' 
				),
				'integrated_edit_field4' => array(
					'location' => 'grid',
					'cellId' => 'c21' 
				),
				'integrated_edit_field3' => array(
					'location' => 'grid',
					'cellId' => 'c22' 
				),
				'details_preview' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
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
				'integrated_edit_field5',
				'integrated_edit_field7',
				'integrated_edit_field8',
				'integrated_edit_field',
				'integrated_edit_field1',
				'integrated_edit_field6',
				'integrated_edit_field9',
				'integrated_edit_field2',
				'integrated_edit_field4',
				'integrated_edit_field3',
				'integrated_edit_field10' 
			),
			'update_records' => array( 
				'update_records' 
			),
			'gantt_delete' => array( 
				'gantt_delete' 
			),
			'gantt_add_child' => array( 
				'gantt_add_child' 
			),
			'next' => array( 
				'next' 
			),
			'prev' => array( 
				'prev' 
			),
			'username_button' => array( 
				'username_button' 
			),
			'loginform_login' => array( 
				'loginform_login' 
			),
			'userinfo_link' => array( 
				'userinfo_link' 
			),
			'logout_link' => array( 
				'logout_link' 
			),
			'changepassword_link' => array( 
				'changepassword_link' 
			),
			'adminarea_link' => array( 
				'adminarea_link' 
			),
			'details_preview' => array( 
				'details_preview' 
			),
			'expand_button' => array( 
				'expand_button' 
			) 
		),
		'cellMaps' => array(
			'grid' => array(
				'cells' => array(
					'c14' => array(
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
					'c15' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field1' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c16' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c17' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field6' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c18' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field9' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c19' => array(
						'cols' => array( 
							2 
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
					'c20' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							2 
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
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field4' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c22' => array(
						'cols' => array( 
							2 
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
					'c3' => array(
						'cols' => array( 
							0 
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
					'c4' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c5' => array(
						'cols' => array( 
							0 
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
					'c6' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field7' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c7' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field8' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c8' => array(
						'cols' => array( 
							0,
							1,
							2 
						),
						'rows' => array( 
							5 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'details_preview' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					) 
				),
				'width' => 3,
				'height' => 6 
			) 
		) 
	),
	'loginForm' => array(
		'loginForm' => 0 
	),
	'page' => array(
		'verticalBar' => true,
		'labeledButtons' => array(
			'update_records' => array(
				'update_records' => array(
					'tag' => 'UPDATE_N_RECORDS',
					'type' => 2 
				) 
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
		'updateSelected' => true 
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
						'gantt_add_child',
						'gantt_delete',
						'update_records',
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
						'loginform_login',
						'username_button' 
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
							'cell' => 'c14' 
						),
						array(
							'cell' => 'c15' 
						),
						array(
							'cell' => 'c16' 
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
					'cells' => array( 
						array(
							'cell' => 'c3' 
						),
						array(
							'cell' => 'c4' 
						),
						array(
							'cell' => 'c' 
						) 
					),
					'section' => '' 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c5' 
						),
						array(
							'cell' => 'c6' 
						),
						array(
							'cell' => 'c7' 
						) 
					) 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c8',
							'colspan' => 3 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c3' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field10' 
					) 
				),
				'c' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c4' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c5' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field5' 
					) 
				),
				'c6' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field7' 
					) 
				),
				'c7' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field8' 
					) 
				),
				'c14' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field' 
					) 
				),
				'c15' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field1' 
					) 
				),
				'c16' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c17' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field6' 
					) 
				),
				'c18' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field9' 
					) 
				),
				'c19' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field2' 
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
						'integrated_edit_field4' 
					) 
				),
				'c22' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field3' 
					) 
				),
				'c8' => array(
					'model' => 'c3',
					'items' => array( 
						'details_preview' 
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
		'integrated_edit_field5' => array(
			'field' => 'status_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => true 
		),
		'integrated_edit_field7' => array(
			'field' => 'created_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => true 
		),
		'integrated_edit_field8' => array(
			'field' => 'updated_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => true 
		),
		'integrated_edit_field' => array(
			'field' => 'project_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => true 
		),
		'integrated_edit_field1' => array(
			'field' => 'milestone_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => true 
		),
		'integrated_edit_field6' => array(
			'field' => 'notes',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => true 
		),
		'integrated_edit_field9' => array(
			'field' => 'start_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => true 
		),
		'integrated_edit_field2' => array(
			'field' => 'planned_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'label' => array(
				'field' => 'planned_date',
				'table' => 'mne_project_timelines',
				'type' => 3 
			),
			'updateOnEdit' => true 
		),
		'integrated_edit_field4' => array(
			'field' => 'variance_days',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'updateOnEdit' => true 
		),
		'integrated_edit_field3' => array(
			'field' => 'actual_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'label' => array(
				'field' => 'actual_date',
				'table' => 'mne_project_timelines',
				'type' => 3 
			),
			'updateOnEdit' => true 
		),
		'update_records' => array(
			'type' => 'update_records' 
		),
		'gantt_delete' => array(
			'type' => 'gantt_delete' 
		),
		'gantt_add_child' => array(
			'type' => 'gantt_add_child' 
		),
		'integrated_edit_field10' => array(
			'field' => 'ganttProgress',
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
		'username_button' => array(
			'type' => 'username_button',
			'items' => array( 
				'userinfo_link',
				'logout_link',
				'adminarea_link',
				'changepassword_link' 
			) 
		),
		'loginform_login' => array(
			'type' => 'loginform_login',
			'popup' => false 
		),
		'userinfo_link' => array(
			'type' => 'userinfo_link' 
		),
		'logout_link' => array(
			'type' => 'logout_link' 
		),
		'changepassword_link' => array(
			'type' => 'changepassword_link' 
		),
		'adminarea_link' => array(
			'type' => 'adminarea_link' 
		),
		'details_preview' => array(
			'type' => 'details_preview',
			'table' => 14658,
			'items' => array( 
				 
			),
			'popup' => false 
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
		'English' => 'Modify task' 
	) 
);
		?>