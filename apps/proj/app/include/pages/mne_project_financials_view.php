<?php
			$optionsArray = array(
	'pdf' => array(
		'pdfView' => false 
	),
	'master' => array(
		'mne_projects' => array(
			'preview' => false 
		) 
	),
	'fields' => array(
		'gridFields' => array( 
			'updated_at',
			'created_at',
			'project_id',
			'reporting_period',
			'amount_spent_to_date',
			'total_project_budget',
			'budget_category',
			'allocated_amount',
			'remaining_budget',
			'spent_amount',
			'remaining_amount',
			'burn_rate',
			'percent_spent',
			'comments',
			'current_profit_margin',
			'target_profit_margin' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'updated_at' => array( 
				'integrated_edit_field15' 
			),
			'created_at' => array( 
				'integrated_edit_field14' 
			),
			'project_id' => array( 
				'integrated_edit_field' 
			),
			'reporting_period' => array( 
				'integrated_edit_field13' 
			),
			'amount_spent_to_date' => array( 
				'integrated_edit_field2' 
			),
			'total_project_budget' => array( 
				'integrated_edit_field1' 
			),
			'budget_category' => array( 
				'integrated_edit_field5' 
			),
			'allocated_amount' => array( 
				'integrated_edit_field6' 
			),
			'remaining_budget' => array( 
				'integrated_edit_field3' 
			),
			'spent_amount' => array( 
				'integrated_edit_field7' 
			),
			'remaining_amount' => array( 
				'integrated_edit_field8' 
			),
			'burn_rate' => array( 
				'integrated_edit_field4' 
			),
			'percent_spent' => array( 
				'integrated_edit_field9' 
			),
			'comments' => array( 
				'integrated_edit_field10' 
			),
			'current_profit_margin' => array( 
				'integrated_edit_field12' 
			),
			'target_profit_margin' => array( 
				'integrated_edit_field11' 
			) 
		) 
	),
	'pageLinks' => array(
		'edit' => true,
		'add' => false,
		'view' => false,
		'print' => false 
	),
	'layoutHelper' => array(
		'formItems' => array(
			'formItems' => array(
				'above-grid' => array( 
					 
				),
				'below-grid' => array( 
					'view_back_list',
					'view_close',
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
					'view_header' 
				),
				'grid' => array( 
					'integrated_edit_field15',
					'integrated_edit_field14',
					'integrated_edit_field',
					'integrated_edit_field13',
					'integrated_edit_field2',
					'integrated_edit_field1',
					'integrated_edit_field5',
					'integrated_edit_field6',
					'integrated_edit_field3',
					'integrated_edit_field7',
					'integrated_edit_field8',
					'integrated_edit_field4',
					'integrated_edit_field9',
					'integrated_edit_field10',
					'integrated_edit_field12',
					'integrated_edit_field11' 
				) 
			),
			'formXtTags' => array(
				'above-grid' => array( 
					 
				) 
			),
			'itemForms' => array(
				'view_back_list' => 'below-grid',
				'view_close' => 'below-grid',
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
				'view_header' => 'top',
				'integrated_edit_field15' => 'grid',
				'integrated_edit_field14' => 'grid',
				'integrated_edit_field' => 'grid',
				'integrated_edit_field13' => 'grid',
				'integrated_edit_field2' => 'grid',
				'integrated_edit_field1' => 'grid',
				'integrated_edit_field5' => 'grid',
				'integrated_edit_field6' => 'grid',
				'integrated_edit_field3' => 'grid',
				'integrated_edit_field7' => 'grid',
				'integrated_edit_field8' => 'grid',
				'integrated_edit_field4' => 'grid',
				'integrated_edit_field9' => 'grid',
				'integrated_edit_field10' => 'grid',
				'integrated_edit_field12' => 'grid',
				'integrated_edit_field11' => 'grid' 
			),
			'itemLocations' => array(
				'integrated_edit_field15' => array(
					'location' => 'grid',
					'cellId' => 'c13' 
				),
				'integrated_edit_field14' => array(
					'location' => 'grid',
					'cellId' => 'c16' 
				),
				'integrated_edit_field' => array(
					'location' => 'grid',
					'cellId' => 'c20' 
				),
				'integrated_edit_field13' => array(
					'location' => 'grid',
					'cellId' => 'c21' 
				),
				'integrated_edit_field2' => array(
					'location' => 'grid',
					'cellId' => 'c22' 
				),
				'integrated_edit_field1' => array(
					'location' => 'grid',
					'cellId' => 'c23' 
				),
				'integrated_edit_field5' => array(
					'location' => 'grid',
					'cellId' => 'c24' 
				),
				'integrated_edit_field6' => array(
					'location' => 'grid',
					'cellId' => 'c25' 
				),
				'integrated_edit_field3' => array(
					'location' => 'grid',
					'cellId' => 'c26' 
				),
				'integrated_edit_field7' => array(
					'location' => 'grid',
					'cellId' => 'c27' 
				),
				'integrated_edit_field8' => array(
					'location' => 'grid',
					'cellId' => 'c28' 
				),
				'integrated_edit_field4' => array(
					'location' => 'grid',
					'cellId' => 'c29' 
				),
				'integrated_edit_field9' => array(
					'location' => 'grid',
					'cellId' => 'c30' 
				),
				'integrated_edit_field10' => array(
					'location' => 'grid',
					'cellId' => 'c31' 
				),
				'integrated_edit_field12' => array(
					'location' => 'grid',
					'cellId' => 'c32' 
				),
				'integrated_edit_field11' => array(
					'location' => 'grid',
					'cellId' => 'c33' 
				) 
			),
			'itemVisiblity' => array(
				'expand_menu_button' => 2,
				'expand_button' => 5 
			) 
		),
		'itemsByType' => array(
			'view_header' => array( 
				'view_header' 
			),
			'view_back_list' => array( 
				'view_back_list' 
			),
			'view_close' => array( 
				'view_close' 
			),
			'hamburger' => array( 
				'hamburger' 
			),
			'view_edit' => array( 
				'view_edit' 
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
				'integrated_edit_field15',
				'integrated_edit_field14',
				'integrated_edit_field',
				'integrated_edit_field13',
				'integrated_edit_field2',
				'integrated_edit_field1',
				'integrated_edit_field5',
				'integrated_edit_field6',
				'integrated_edit_field3',
				'integrated_edit_field7',
				'integrated_edit_field8',
				'integrated_edit_field4',
				'integrated_edit_field9',
				'integrated_edit_field10',
				'integrated_edit_field12',
				'integrated_edit_field11' 
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
			'expand_button' => array( 
				'expand_button' 
			) 
		),
		'cellMaps' => array(
			'grid' => array(
				'cells' => array(
					'c20' => array(
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
					'c21' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field13' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c22' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field2' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c23' => array(
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
					'c24' => array(
						'cols' => array( 
							1 
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
					'c25' => array(
						'cols' => array( 
							2 
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
					'c26' => array(
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
					'c27' => array(
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
					'c28' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field8' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c29' => array(
						'cols' => array( 
							0 
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
					'c30' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field9' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c31' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							3,
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field10' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c32' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field12' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c33' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field11' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c14' => array(
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
					'c16' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							5 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field14' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c11' => array(
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
					'c12' => array(
						'cols' => array( 
							1 
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
					'c13' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							6 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field15' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c5' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							7 
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
							1 
						),
						'rows' => array( 
							7 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c7' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							7 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					) 
				),
				'width' => 3,
				'height' => 8 
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
		'type' => 'view',
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
	) 
);
			$pageArray = array(
	'id' => 'view',
	'type' => 'view',
	'layoutId' => 'leftbar',
	'disabled' => false,
	'default' => 0,
	'forms' => array(
		'above-grid' => array(
			'modelId' => 'view-above-grid',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1',
							'colspan' => 2 
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
		'below-grid' => array(
			'modelId' => 'view-below-grid',
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
						'view_back_list',
						'view_close' 
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
			'modelId' => 'view-header',
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
						'view_header' 
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
							'cell' => 'c23' 
						),
						array(
							'cell' => 'c24' 
						),
						array(
							'cell' => 'c25' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c26' 
						),
						array(
							'cell' => 'c27' 
						),
						array(
							'cell' => 'c28' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c29' 
						),
						array(
							'cell' => 'c30' 
						),
						array(
							'cell' => 'c31',
							'rowspan' => 2 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c32' 
						),
						array(
							'cell' => 'c33' 
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
							'cell' => 'c11' 
						),
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
							'cell' => 'c5' 
						),
						array(
							'cell' => 'c6' 
						),
						array(
							'cell' => 'c7' 
						) 
					) 
				) 
			),
			'cells' => array(
				'c5' => array(
					'model' => 'c3',
					'items' => array( 
						 
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
						 
					) 
				),
				'c11' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c12' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c13' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field15' 
					) 
				),
				'c14' => array(
					'model' => 'c3',
					'items' => array( 
						 
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
						'integrated_edit_field14' 
					) 
				),
				'c20' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field' 
					) 
				),
				'c21' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field13' 
					) 
				),
				'c22' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field2' 
					) 
				),
				'c23' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field1' 
					) 
				),
				'c24' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field5' 
					) 
				),
				'c25' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field6' 
					) 
				),
				'c26' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field3' 
					) 
				),
				'c27' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field7' 
					) 
				),
				'c28' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field8' 
					) 
				),
				'c29' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field4' 
					) 
				),
				'c30' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field9' 
					) 
				),
				'c31' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field10' 
					) 
				),
				'c32' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field12' 
					) 
				),
				'c33' => array(
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
		'view_header' => array(
			'type' => 'view_header' 
		),
		'view_back_list' => array(
			'type' => 'view_back_list' 
		),
		'view_close' => array(
			'type' => 'view_close' 
		),
		'hamburger' => array(
			'type' => 'hamburger',
			'items' => array( 
				'view_edit' 
			) 
		),
		'view_edit' => array(
			'type' => 'view_edit' 
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
		'integrated_edit_field15' => array(
			'field' => 'updated_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field14' => array(
			'field' => 'created_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field' => array(
			'field' => 'project_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field13' => array(
			'field' => 'reporting_period',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field2' => array(
			'field' => 'amount_spent_to_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field1' => array(
			'field' => 'total_project_budget',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field5' => array(
			'field' => 'budget_category',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field6' => array(
			'field' => 'allocated_amount',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field3' => array(
			'field' => 'remaining_budget',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field7' => array(
			'field' => 'spent_amount',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field8' => array(
			'field' => 'remaining_amount',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field4' => array(
			'field' => 'burn_rate',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field9' => array(
			'field' => 'percent_spent',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field10' => array(
			'field' => 'comments',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field12' => array(
			'field' => 'current_profit_margin',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field11' => array(
			'field' => 'target_profit_margin',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
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