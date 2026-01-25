<?php
			$optionsArray = array(
	'details' => array(
		'mne_audit_log' => array(
			'displayPreview' => 2,
			'previewPageId' => '' 
		),
		'mne_business_opportunities' => array(
			'displayPreview' => 2,
			'previewPageId' => '' 
		),
		'mne_partnerships' => array(
			'displayPreview' => 2,
			'previewPageId' => '' 
		),
		'mne_performance_alerts' => array(
			'displayPreview' => 2,
			'previewPageId' => '' 
		),
		'mne_project_leads' => array(
			'displayPreview' => 2,
			'previewPageId' => '' 
		),
		'mne_project_updates' => array(
			'displayPreview' => 2,
			'previewPageId' => '' 
		),
		'mne_projects' => array(
			'displayPreview' => 2,
			'previewPageId' => '' 
		) 
	),
	'captcha' => array(
		'captcha' => false 
	),
	'fields' => array(
		'gridFields' => array( 
			'username',
			'email',
			'password_hash',
			'full_name',
			'google_id',
			'first_name',
			'last_name',
			'middle_name',
			'phone',
			'alternate_phone',
			'role',
			'job_position',
			'join_date',
			'leave_balance',
			'last_leave_increment',
			'role_id',
			'is_active',
			'created_at',
			'updated_at',
			'last_login',
			'employee_id',
			'position_id',
			'department_id',
			'hire_date',
			'is_admin',
			'reset_token',
			'reset_date',
			'is_doctor',
			'supervisor_id' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'username' => array( 
				'integrated_edit_field' 
			),
			'email' => array( 
				'integrated_edit_field1' 
			),
			'password_hash' => array( 
				'integrated_edit_field2' 
			),
			'full_name' => array( 
				'integrated_edit_field3' 
			),
			'google_id' => array( 
				'integrated_edit_field4' 
			),
			'first_name' => array( 
				'integrated_edit_field5' 
			),
			'last_name' => array( 
				'integrated_edit_field6' 
			),
			'middle_name' => array( 
				'integrated_edit_field7' 
			),
			'phone' => array( 
				'integrated_edit_field8' 
			),
			'alternate_phone' => array( 
				'integrated_edit_field9' 
			),
			'role' => array( 
				'integrated_edit_field10' 
			),
			'job_position' => array( 
				'integrated_edit_field11' 
			),
			'join_date' => array( 
				'integrated_edit_field12' 
			),
			'leave_balance' => array( 
				'integrated_edit_field13' 
			),
			'last_leave_increment' => array( 
				'integrated_edit_field14' 
			),
			'role_id' => array( 
				'integrated_edit_field15' 
			),
			'is_active' => array( 
				'integrated_edit_field16' 
			),
			'created_at' => array( 
				'integrated_edit_field17' 
			),
			'updated_at' => array( 
				'integrated_edit_field18' 
			),
			'last_login' => array( 
				'integrated_edit_field19' 
			),
			'employee_id' => array( 
				'integrated_edit_field20' 
			),
			'position_id' => array( 
				'integrated_edit_field21' 
			),
			'department_id' => array( 
				'integrated_edit_field22' 
			),
			'hire_date' => array( 
				'integrated_edit_field23' 
			),
			'is_admin' => array( 
				'integrated_edit_field24' 
			),
			'reset_token' => array( 
				'integrated_edit_field25' 
			),
			'reset_date' => array( 
				'integrated_edit_field26' 
			),
			'is_doctor' => array( 
				'integrated_edit_field27' 
			),
			'supervisor_id' => array( 
				'integrated_edit_field28' 
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
					'integrated_edit_field12',
					'integrated_edit_field13',
					'integrated_edit_field14',
					'integrated_edit_field15',
					'integrated_edit_field16',
					'integrated_edit_field17',
					'integrated_edit_field18',
					'integrated_edit_field19',
					'integrated_edit_field20',
					'integrated_edit_field21',
					'integrated_edit_field22',
					'integrated_edit_field23',
					'integrated_edit_field24',
					'integrated_edit_field25',
					'integrated_edit_field26',
					'integrated_edit_field27',
					'integrated_edit_field28' 
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
				'integrated_edit_field' => 'grid',
				'integrated_edit_field1' => 'grid',
				'integrated_edit_field2' => 'grid',
				'integrated_edit_field3' => 'grid',
				'integrated_edit_field4' => 'grid',
				'integrated_edit_field5' => 'grid',
				'integrated_edit_field6' => 'grid',
				'integrated_edit_field7' => 'grid',
				'integrated_edit_field8' => 'grid',
				'integrated_edit_field9' => 'grid',
				'integrated_edit_field10' => 'grid',
				'integrated_edit_field11' => 'grid',
				'integrated_edit_field12' => 'grid',
				'integrated_edit_field13' => 'grid',
				'integrated_edit_field14' => 'grid',
				'integrated_edit_field15' => 'grid',
				'integrated_edit_field16' => 'grid',
				'integrated_edit_field17' => 'grid',
				'integrated_edit_field18' => 'grid',
				'integrated_edit_field19' => 'grid',
				'integrated_edit_field20' => 'grid',
				'integrated_edit_field21' => 'grid',
				'integrated_edit_field22' => 'grid',
				'integrated_edit_field23' => 'grid',
				'integrated_edit_field24' => 'grid',
				'integrated_edit_field25' => 'grid',
				'integrated_edit_field26' => 'grid',
				'integrated_edit_field27' => 'grid',
				'integrated_edit_field28' => 'grid' 
			),
			'itemLocations' => array(
				'integrated_edit_field' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field1' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field2' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field3' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field4' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field5' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field6' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field7' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field8' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field9' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field10' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field11' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field12' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field13' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field14' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field15' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field16' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field17' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field18' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field19' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field20' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field21' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field22' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field23' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field24' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field25' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field26' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field27' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
				),
				'integrated_edit_field28' => array(
					'location' => 'grid',
					'cellId' => 'c3' 
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
				'integrated_edit_field12',
				'integrated_edit_field13',
				'integrated_edit_field14',
				'integrated_edit_field15',
				'integrated_edit_field16',
				'integrated_edit_field17',
				'integrated_edit_field18',
				'integrated_edit_field19',
				'integrated_edit_field20',
				'integrated_edit_field21',
				'integrated_edit_field22',
				'integrated_edit_field23',
				'integrated_edit_field24',
				'integrated_edit_field25',
				'integrated_edit_field26',
				'integrated_edit_field27',
				'integrated_edit_field28' 
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
					'c3' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
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
							'integrated_edit_field12',
							'integrated_edit_field13',
							'integrated_edit_field14',
							'integrated_edit_field15',
							'integrated_edit_field16',
							'integrated_edit_field17',
							'integrated_edit_field18',
							'integrated_edit_field19',
							'integrated_edit_field20',
							'integrated_edit_field21',
							'integrated_edit_field22',
							'integrated_edit_field23',
							'integrated_edit_field24',
							'integrated_edit_field25',
							'integrated_edit_field26',
							'integrated_edit_field27',
							'integrated_edit_field28' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					) 
				),
				'width' => 1,
				'height' => 1 
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
					'cells' => array( 
						array(
							'cell' => 'c3' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c3' => array(
					'model' => 'c3',
					'items' => array( 
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
						'integrated_edit_field12',
						'integrated_edit_field13',
						'integrated_edit_field14',
						'integrated_edit_field15',
						'integrated_edit_field16',
						'integrated_edit_field17',
						'integrated_edit_field18',
						'integrated_edit_field19',
						'integrated_edit_field20',
						'integrated_edit_field21',
						'integrated_edit_field22',
						'integrated_edit_field23',
						'integrated_edit_field24',
						'integrated_edit_field25',
						'integrated_edit_field26',
						'integrated_edit_field27',
						'integrated_edit_field28' 
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
			'field' => 'username',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field1' => array(
			'field' => 'email',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field2' => array(
			'field' => 'password_hash',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field3' => array(
			'field' => 'full_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field4' => array(
			'field' => 'google_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field5' => array(
			'field' => 'first_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field6' => array(
			'field' => 'last_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field7' => array(
			'field' => 'middle_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field8' => array(
			'field' => 'phone',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field9' => array(
			'field' => 'alternate_phone',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field10' => array(
			'field' => 'role',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field11' => array(
			'field' => 'job_position',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field12' => array(
			'field' => 'join_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field13' => array(
			'field' => 'leave_balance',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field14' => array(
			'field' => 'last_leave_increment',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field15' => array(
			'field' => 'role_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field16' => array(
			'field' => 'is_active',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field17' => array(
			'field' => 'created_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field18' => array(
			'field' => 'updated_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field19' => array(
			'field' => 'last_login',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field20' => array(
			'field' => 'employee_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field21' => array(
			'field' => 'position_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field22' => array(
			'field' => 'department_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field23' => array(
			'field' => 'hire_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field24' => array(
			'field' => 'is_admin',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field25' => array(
			'field' => 'reset_token',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field26' => array(
			'field' => 'reset_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field27' => array(
			'field' => 'is_doctor',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field28' => array(
			'field' => 'supervisor_id',
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