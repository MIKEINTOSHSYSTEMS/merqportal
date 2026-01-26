<?php
			$optionsArray = array(
	'listSearch' => array(
		'alwaysOnPanelFields' => array( 
			'project_id',
			'deliverable_name',
			'due_date',
			'start_date' 
		),
		'searchPanel' => true,
		'fixedSearchPanel' => false,
		'simpleSearchOptions' => false,
		'searchSaving' => false 
	),
	'fields' => array(
		'gridFields' => array( 
			 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			'deliverable_id',
			'project_id',
			'deliverable_name',
			'start_date',
			'due_date',
			'ganttProgress',
			'completed_date',
			'status_id',
			'updated_at',
			'created_at',
			'notes',
			'owner',
			'client_acceptance',
			'quality_check' 
		),
		'filterFields' => array( 
			 
		),
		'fieldItems' => array(
			 
		) 
	),
	'layoutHelper' => array(
		'formItems' => array(
			'formItems' => array(
				'above-grid' => array( 
					'text',
					'add' 
				),
				'below-grid' => array( 
					 
				),
				'left' => array( 
					'logo',
					'expand_button',
					'search_panel',
					'menu' 
				),
				'supertop' => array( 
					'expand_menu_button',
					'collapse_button',
					'breadcrumb',
					'simple_search',
					'list_options',
					'loginform_login',
					'username_button' 
				),
				'grid' => array( 
					'gantt' 
				),
				'top' => array( 
					 
				) 
			),
			'formXtTags' => array(
				'below-grid' => array( 
					 
				),
				'top' => array( 
					 
				) 
			),
			'itemForms' => array(
				'text' => 'above-grid',
				'add' => 'above-grid',
				'logo' => 'left',
				'expand_button' => 'left',
				'search_panel' => 'left',
				'menu' => 'left',
				'expand_menu_button' => 'supertop',
				'collapse_button' => 'supertop',
				'breadcrumb' => 'supertop',
				'simple_search' => 'supertop',
				'list_options' => 'supertop',
				'loginform_login' => 'supertop',
				'username_button' => 'supertop',
				'gantt' => 'grid' 
			),
			'itemLocations' => array(
				 
			),
			'itemVisiblity' => array(
				'breadcrumb' => 5,
				'expand_menu_button' => 2,
				'expand_button' => 5 
			) 
		),
		'itemsByType' => array(
			'breadcrumb' => array( 
				'breadcrumb' 
			),
			'logo' => array( 
				'logo' 
			),
			'menu' => array( 
				'menu' 
			),
			'simple_search' => array( 
				'simple_search' 
			),
			'gantt' => array( 
				'gantt' 
			),
			'search_panel' => array( 
				'search_panel' 
			),
			'list_options' => array( 
				'list_options' 
			),
			'show_search_panel' => array( 
				'show_search_panel' 
			),
			'hide_search_panel' => array( 
				'hide_search_panel' 
			),
			'search_panel_field' => array( 
				'search_panel_field',
				'search_panel_field1',
				'search_panel_field2',
				'search_panel_field3',
				'search_panel_field4',
				'search_panel_field5',
				'search_panel_field6',
				'search_panel_field7',
				'search_panel_field8',
				'search_panel_field9',
				'search_panel_field10',
				'search_panel_field11',
				'search_panel_field12',
				'search_panel_field13' 
			),
			'expand_menu_button' => array( 
				'expand_menu_button' 
			),
			'collapse_button' => array( 
				'collapse_button' 
			),
			'add' => array( 
				'add' 
			),
			'export' => array( 
				'export' 
			),
			'-' => array( 
				'-',
				'-1' 
			),
			'import' => array( 
				'import' 
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
			'expand_button' => array( 
				'expand_button' 
			) 
		),
		'cellMaps' => array(
			 
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
	'id' => 'gantt',
	'type' => 'gantt',
	'layoutId' => 'leftbar',
	'disabled' => false,
	'default' => 1,
	'forms' => array(
		'above-grid' => array(
			'modelId' => 'calendar-above-grid',
			'grid' => array( 
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c6' 
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
							'cell' => 'c',
							'colspan' => 2 
						) 
					) 
				),
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
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c4' 
						),
						array(
							'cell' => 'c5' 
						) 
					) 
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
						 
					) 
				),
				'c' => array(
					'model' => 'c1',
					'items' => array( 
						'text' 
					) 
				),
				'c4' => array(
					'model' => 'c1',
					'items' => array( 
						 
					) 
				),
				'c5' => array(
					'model' => 'c2',
					'items' => array( 
						 
					) 
				),
				'c6' => array(
					'model' => 'c1',
					'items' => array( 
						'add' 
					) 
				),
				'c7' => array(
					'model' => 'c2',
					'items' => array( 
						 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'below-grid' => array(
			'modelId' => 'empty-above-grid',
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
						'search_panel',
						'menu' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'supertop' => array(
			'modelId' => 'leftbar-top',
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
						'collapse_button',
						'breadcrumb' 
					) 
				),
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						'simple_search',
						'list_options',
						'loginform_login',
						'username_button' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'grid' => array(
			'modelId' => 'gantt',
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
						'gantt' 
					),
					'align' => 'center' 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'top' => array(
			'modelId' => 'list-sidebar-top',
			'grid' => array( 
				 
			),
			'cells' => array(
				 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		) 
	),
	'items' => array(
		'breadcrumb' => array(
			'type' => 'breadcrumb' 
		),
		'logo' => array(
			'type' => 'logo' 
		),
		'menu' => array(
			'type' => 'menu' 
		),
		'simple_search' => array(
			'type' => 'simple_search' 
		),
		'gantt' => array(
			'type' => 'gantt',
			'mobileDisplay' => 'both' 
		),
		'search_panel' => array(
			'type' => 'search_panel',
			'items' => array( 
				'search_panel_field',
				'search_panel_field1',
				'search_panel_field2',
				'search_panel_field12',
				'search_panel_field3',
				'search_panel_field13',
				'search_panel_field5',
				'search_panel_field4',
				'search_panel_field11',
				'search_panel_field10',
				'search_panel_field9',
				'search_panel_field8',
				'search_panel_field7',
				'search_panel_field6' 
			),
			'_flexiblePanel' => true 
		),
		'list_options' => array(
			'type' => 'list_options',
			'items' => array( 
				'show_search_panel',
				'hide_search_panel',
				'-',
				'export',
				'-1',
				'import' 
			) 
		),
		'show_search_panel' => array(
			'type' => 'show_search_panel' 
		),
		'hide_search_panel' => array(
			'type' => 'hide_search_panel' 
		),
		'search_panel_field' => array(
			'field' => 'deliverable_id',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => false,
			'required' => false 
		),
		'search_panel_field1' => array(
			'field' => 'project_id',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => true,
			'required' => false 
		),
		'search_panel_field2' => array(
			'field' => 'deliverable_name',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => true,
			'required' => false 
		),
		'search_panel_field3' => array(
			'field' => 'due_date',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => true,
			'required' => false 
		),
		'search_panel_field4' => array(
			'field' => 'status_id',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => false,
			'required' => false 
		),
		'search_panel_field5' => array(
			'field' => 'completed_date',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => false,
			'required' => false 
		),
		'search_panel_field6' => array(
			'field' => 'quality_check',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => false,
			'required' => false 
		),
		'search_panel_field7' => array(
			'field' => 'client_acceptance',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => false,
			'required' => false 
		),
		'search_panel_field8' => array(
			'field' => 'owner',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => false,
			'required' => false 
		),
		'search_panel_field9' => array(
			'field' => 'notes',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => false,
			'required' => false 
		),
		'search_panel_field10' => array(
			'field' => 'created_at',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => false,
			'required' => false 
		),
		'search_panel_field11' => array(
			'field' => 'updated_at',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => false,
			'required' => false 
		),
		'search_panel_field12' => array(
			'field' => 'start_date',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => true,
			'required' => false 
		),
		'search_panel_field13' => array(
			'field' => 'ganttProgress',
			'type' => 'search_panel_field',
			'alwaysOnPanel' => false,
			'required' => false 
		),
		'expand_menu_button' => array(
			'type' => 'expand_menu_button' 
		),
		'collapse_button' => array(
			'type' => 'collapse_button' 
		),
		'add' => array(
			'type' => 'add',
			'icon' => array(
				'style' => 0 
			),
			'label' => array(
				'type' => 0,
				'text' => 'Add new deliverable' 
			) 
		),
		'export' => array(
			'type' => 'export' 
		),
		'-' => array(
			'type' => '-' 
		),
		'import' => array(
			'type' => 'import' 
		),
		'-1' => array(
			'type' => '-' 
		),
		'text' => array(
			'type' => 'text',
			'label' => array(
				'text' => '<br>',
				'type' => 0 
			),
			'editedByRte' => false 
		),
		'username_button' => array(
			'type' => 'username_button',
			'items' => array( 
				'userinfo_link',
				'logout_link',
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
		'expand_button' => array(
			'type' => 'expand_button' 
		) 
	),
	'dbProps' => array(
		 
	),
	'version' => 13,
	'pageWidth' => 'full',
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