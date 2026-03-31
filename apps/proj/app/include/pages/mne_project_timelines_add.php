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
			'timeline_id',
			'project_id',
			'milestone_name',
			'start_date',
			'planned_date',
			'actual_date',
			'variance_days',
			'status_id',
			'notes',
			'created_at',
			'updated_at',
			'ganttProgress' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'timeline_id' => array( 
				'integrated_edit_field' 
			),
			'project_id' => array( 
				'integrated_edit_field1' 
			),
			'milestone_name' => array( 
				'integrated_edit_field2' 
			),
			'start_date' => array( 
				'integrated_edit_field3' 
			),
			'planned_date' => array( 
				'integrated_edit_field4' 
			),
			'actual_date' => array( 
				'integrated_edit_field5' 
			),
			'variance_days' => array( 
				'integrated_edit_field6' 
			),
			'status_id' => array( 
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
			'ganttProgress' => array( 
				'integrated_edit_field11' 
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
					'add_message',
					'text' 
				),
				'below-grid' => array( 
					'add_save',
					'add_reset',
					'add_back_list',
					'add_cancel' 
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
					'add_header' 
				),
				'grid' => array( 
					'details_preview',
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
					'integrated_edit_field11' 
				) 
			),
			'formXtTags' => array(
				 
			),
			'itemForms' => array(
				'add_message' => 'above-grid',
				'text' => 'above-grid',
				'add_save' => 'below-grid',
				'add_reset' => 'below-grid',
				'add_back_list' => 'below-grid',
				'add_cancel' => 'below-grid',
				'expand_menu_button' => 'supertop',
				'collapse_button' => 'supertop',
				'loginform_login' => 'supertop',
				'username_button' => 'supertop',
				'logo' => 'left',
				'expand_button' => 'left',
				'menu' => 'left',
				'add_header' => 'top',
				'details_preview' => 'grid',
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
				'integrated_edit_field11' => 'grid' 
			),
			'itemLocations' => array(
				'details_preview' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field1' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field2' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field3' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field4' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field5' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field6' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field7' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field8' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field9' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field10' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field11' => array(
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
			'text' => array( 
				'text' 
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
				'integrated_edit_field11' 
			),
			'expand_button' => array( 
				'expand_button' 
			) 
		),
		'cellMaps' => array(
			'grid' => array(
				'cells' => array(
					'c8' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'details_preview',
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
							'integrated_edit_field11' 
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
	'loginForm' => array(
		'loginForm' => 0 
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
				),
				array(
					'cells' => array( 
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
						'add_message' 
					) 
				),
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						'text' 
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
							'cell' => 'c8',
							'colspan' => 1 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c8' => array(
					'model' => 'c3',
					'items' => array( 
						'details_preview',
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
		'text' => array(
			'type' => 'text',
			'label' => array(
				'text' => 'Milestone Completion Dates',
				'type' => 0 
			),
			'editedByRte' => false 
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
		'integrated_edit_field' => array(
			'field' => 'timeline_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field1' => array(
			'field' => 'project_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field2' => array(
			'field' => 'milestone_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field3' => array(
			'field' => 'start_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field4' => array(
			'field' => 'planned_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field5' => array(
			'field' => 'actual_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field6' => array(
			'field' => 'variance_days',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field7' => array(
			'field' => 'status_id',
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
		'integrated_edit_field11' => array(
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