<?php
			$optionsArray = array(
	'pdf' => array(
		'pdfView' => false 
	),
	'master' => array(
		'mne_projects' => array(
			'preview' => false 
		),
		'mne_sector_options' => array(
			'preview' => false 
		) 
	),
	'fields' => array(
		'gridFields' => array( 
			'project_id',
			'burn_rate_percentage',
			'client_satisfaction_rating',
			'deliverables_met',
			'q1_hours',
			'sector_id',
			'remaining_budget',
			'vat_collected',
			'on_budget_status',
			'publications_count',
			'total_hours',
			'client',
			'budget_spent',
			'profit_margin_percentage',
			'on_time_status',
			'total_deliverables',
			'q2_hours',
			'created_at',
			'last_updated',
			'updated_at',
			'q3_hours',
			'q4_hours',
			'percent_allocation',
			'datasets_count',
			'certificates_received',
			'next_milestone_date',
			'percent_complete' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'project_id' => array( 
				'integrated_edit_field' 
			),
			'burn_rate_percentage' => array( 
				'integrated_edit_field5' 
			),
			'client_satisfaction_rating' => array( 
				'integrated_edit_field8' 
			),
			'deliverables_met' => array( 
				'integrated_edit_field13' 
			),
			'q1_hours' => array( 
				'integrated_edit_field18' 
			),
			'sector_id' => array( 
				'integrated_edit_field2' 
			),
			'remaining_budget' => array( 
				'integrated_edit_field4' 
			),
			'vat_collected' => array( 
				'integrated_edit_field7' 
			),
			'on_budget_status' => array( 
				'integrated_edit_field12' 
			),
			'publications_count' => array( 
				'integrated_edit_field15' 
			),
			'total_hours' => array( 
				'integrated_edit_field22' 
			),
			'client' => array( 
				'integrated_edit_field1' 
			),
			'budget_spent' => array( 
				'integrated_edit_field3' 
			),
			'profit_margin_percentage' => array( 
				'integrated_edit_field6' 
			),
			'on_time_status' => array( 
				'integrated_edit_field11' 
			),
			'total_deliverables' => array( 
				'integrated_edit_field14' 
			),
			'q2_hours' => array( 
				'integrated_edit_field19' 
			),
			'created_at' => array( 
				'integrated_edit_field25' 
			),
			'last_updated' => array( 
				'integrated_edit_field24' 
			),
			'updated_at' => array( 
				'integrated_edit_field26' 
			),
			'q3_hours' => array( 
				'integrated_edit_field20' 
			),
			'q4_hours' => array( 
				'integrated_edit_field21' 
			),
			'percent_allocation' => array( 
				'integrated_edit_field23' 
			),
			'datasets_count' => array( 
				'integrated_edit_field16' 
			),
			'certificates_received' => array( 
				'integrated_edit_field17' 
			),
			'next_milestone_date' => array( 
				'integrated_edit_field9' 
			),
			'percent_complete' => array( 
				'integrated_edit_field10' 
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
					'integrated_edit_field',
					'integrated_edit_field5',
					'integrated_edit_field8',
					'integrated_edit_field13',
					'integrated_edit_field18',
					'integrated_edit_field2',
					'integrated_edit_field4',
					'integrated_edit_field7',
					'integrated_edit_field12',
					'integrated_edit_field15',
					'integrated_edit_field22',
					'integrated_edit_field1',
					'integrated_edit_field3',
					'integrated_edit_field6',
					'integrated_edit_field11',
					'integrated_edit_field14',
					'integrated_edit_field19',
					'integrated_edit_field25',
					'integrated_edit_field24',
					'integrated_edit_field26',
					'integrated_edit_field20',
					'integrated_edit_field21',
					'integrated_edit_field16',
					'integrated_edit_field17',
					'integrated_edit_field9',
					'integrated_edit_field10',
					'integrated_edit_field23' 
				) 
			),
			'formXtTags' => array(
				'above-grid' => array( 
					 
				) 
			),
			'itemForms' => array(
				'view_back_list' => 'below-grid',
				'view_close' => 'below-grid',
				'hamburger' => 'below-grid',
				'expand_menu_button' => 'supertop',
				'collapse_button' => 'supertop',
				'loginform_login' => 'supertop',
				'username_button' => 'supertop',
				'logo' => 'left',
				'expand_button' => 'left',
				'menu' => 'left',
				'view_header' => 'top',
				'integrated_edit_field' => 'grid',
				'integrated_edit_field5' => 'grid',
				'integrated_edit_field8' => 'grid',
				'integrated_edit_field13' => 'grid',
				'integrated_edit_field18' => 'grid',
				'integrated_edit_field2' => 'grid',
				'integrated_edit_field4' => 'grid',
				'integrated_edit_field7' => 'grid',
				'integrated_edit_field12' => 'grid',
				'integrated_edit_field15' => 'grid',
				'integrated_edit_field22' => 'grid',
				'integrated_edit_field1' => 'grid',
				'integrated_edit_field3' => 'grid',
				'integrated_edit_field6' => 'grid',
				'integrated_edit_field11' => 'grid',
				'integrated_edit_field14' => 'grid',
				'integrated_edit_field19' => 'grid',
				'integrated_edit_field25' => 'grid',
				'integrated_edit_field24' => 'grid',
				'integrated_edit_field26' => 'grid',
				'integrated_edit_field20' => 'grid',
				'integrated_edit_field21' => 'grid',
				'integrated_edit_field16' => 'grid',
				'integrated_edit_field17' => 'grid',
				'integrated_edit_field9' => 'grid',
				'integrated_edit_field10' => 'grid',
				'integrated_edit_field23' => 'grid' 
			),
			'itemLocations' => array(
				'integrated_edit_field' => array(
					'location' => 'grid',
					'cellId' => 'c' 
				),
				'integrated_edit_field5' => array(
					'location' => 'grid',
					'cellId' => 'c4' 
				),
				'integrated_edit_field8' => array(
					'location' => 'grid',
					'cellId' => 'c7' 
				),
				'integrated_edit_field13' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_edit_field18' => array(
					'location' => 'grid',
					'cellId' => 'c10' 
				),
				'integrated_edit_field2' => array(
					'location' => 'grid',
					'cellId' => 'c11' 
				),
				'integrated_edit_field4' => array(
					'location' => 'grid',
					'cellId' => 'c12' 
				),
				'integrated_edit_field7' => array(
					'location' => 'grid',
					'cellId' => 'c13' 
				),
				'integrated_edit_field12' => array(
					'location' => 'grid',
					'cellId' => 'c15' 
				),
				'integrated_edit_field15' => array(
					'location' => 'grid',
					'cellId' => 'c16' 
				),
				'integrated_edit_field22' => array(
					'location' => 'grid',
					'cellId' => 'c18' 
				),
				'integrated_edit_field1' => array(
					'location' => 'grid',
					'cellId' => 'c20' 
				),
				'integrated_edit_field3' => array(
					'location' => 'grid',
					'cellId' => 'c21' 
				),
				'integrated_edit_field6' => array(
					'location' => 'grid',
					'cellId' => 'c22' 
				),
				'integrated_edit_field11' => array(
					'location' => 'grid',
					'cellId' => 'c24' 
				),
				'integrated_edit_field14' => array(
					'location' => 'grid',
					'cellId' => 'c25' 
				),
				'integrated_edit_field19' => array(
					'location' => 'grid',
					'cellId' => 'c27' 
				),
				'integrated_edit_field25' => array(
					'location' => 'grid',
					'cellId' => 'c29' 
				),
				'integrated_edit_field24' => array(
					'location' => 'grid',
					'cellId' => 'c30' 
				),
				'integrated_edit_field26' => array(
					'location' => 'grid',
					'cellId' => 'c31' 
				),
				'integrated_edit_field20' => array(
					'location' => 'grid',
					'cellId' => 'c35' 
				),
				'integrated_edit_field21' => array(
					'location' => 'grid',
					'cellId' => 'c36' 
				),
				'integrated_edit_field16' => array(
					'location' => 'grid',
					'cellId' => 'c38' 
				),
				'integrated_edit_field17' => array(
					'location' => 'grid',
					'cellId' => 'c39' 
				),
				'integrated_edit_field9' => array(
					'location' => 'grid',
					'cellId' => 'c41' 
				),
				'integrated_edit_field10' => array(
					'location' => 'grid',
					'cellId' => 'c42' 
				),
				'integrated_edit_field23' => array(
					'location' => 'grid',
					'cellId' => 'c43' 
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
				'integrated_edit_field',
				'integrated_edit_field5',
				'integrated_edit_field8',
				'integrated_edit_field13',
				'integrated_edit_field18',
				'integrated_edit_field2',
				'integrated_edit_field4',
				'integrated_edit_field7',
				'integrated_edit_field12',
				'integrated_edit_field15',
				'integrated_edit_field22',
				'integrated_edit_field1',
				'integrated_edit_field3',
				'integrated_edit_field6',
				'integrated_edit_field11',
				'integrated_edit_field14',
				'integrated_edit_field19',
				'integrated_edit_field25',
				'integrated_edit_field24',
				'integrated_edit_field26',
				'integrated_edit_field20',
				'integrated_edit_field21',
				'integrated_edit_field23',
				'integrated_edit_field16',
				'integrated_edit_field17',
				'integrated_edit_field9',
				'integrated_edit_field10' 
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
					'c20' => array(
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
					'c11' => array(
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
							'integrated_edit_field5' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c21' => array(
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
					'c12' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field4' 
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
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c22' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field6' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c13' => array(
						'cols' => array( 
							2 
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
					'c6' => array(
						'cols' => array( 
							0 
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
					'c23' => array(
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
					'c14' => array(
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
					'c7' => array(
						'cols' => array( 
							0 
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
					'c24' => array(
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
					'c15' => array(
						'cols' => array( 
							2 
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
					'c8' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							5 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field13' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c25' => array(
						'cols' => array( 
							1 
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
							'integrated_edit_field15' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c41' => array(
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
					'c42' => array(
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
					),
					'c43' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							6 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field23' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c38' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							7 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field16' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c39' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							7 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field17' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c40' => array(
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
					),
					'c9' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							8 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c26' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							8 
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
							2 
						),
						'rows' => array( 
							8 
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
							0 
						),
						'rows' => array( 
							9 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field18' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c27' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							9 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field19' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c18' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							9 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field22' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c35' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							10 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field20' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c36' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							10 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field21' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c37' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							10 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c32' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							11 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c33' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							11 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c34' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							11 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c29' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							12 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field25' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c30' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							12 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field24' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c31' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							12 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field26' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c3' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							13 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c28' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							13 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c19' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							13 
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
				'height' => 14 
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
		'nextPrev' => false 
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
							'cell' => 'c' 
						),
						array(
							'cell' => 'c20' 
						),
						array(
							'cell' => 'c11' 
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
							'cell' => 'c21' 
						),
						array(
							'cell' => 'c12' 
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
							'cell' => 'c22' 
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
							'cell' => 'c6' 
						),
						array(
							'cell' => 'c23' 
						),
						array(
							'cell' => 'c14' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c7' 
						),
						array(
							'cell' => 'c24' 
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
							'cell' => 'c8' 
						),
						array(
							'cell' => 'c25' 
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
							'cell' => 'c41' 
						),
						array(
							'cell' => 'c42' 
						),
						array(
							'cell' => 'c43' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c38' 
						),
						array(
							'cell' => 'c39' 
						),
						array(
							'cell' => 'c40' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c9' 
						),
						array(
							'cell' => 'c26' 
						),
						array(
							'cell' => 'c17' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c10' 
						),
						array(
							'cell' => 'c27' 
						),
						array(
							'cell' => 'c18' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c35' 
						),
						array(
							'cell' => 'c36' 
						),
						array(
							'cell' => 'c37' 
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
						),
						array(
							'cell' => 'c34' 
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
							'cell' => 'c31' 
						) 
					) 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c3' 
						),
						array(
							'cell' => 'c28' 
						),
						array(
							'cell' => 'c19' 
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
						'integrated_edit_field5' 
					) 
				),
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
						'integrated_edit_field8' 
					) 
				),
				'c8' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field13' 
					) 
				),
				'c9' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c10' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field18' 
					) 
				),
				'c11' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field2' 
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
						'integrated_edit_field7' 
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
						'integrated_edit_field12' 
					) 
				),
				'c16' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field15' 
					) 
				),
				'c17' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c18' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field22' 
					) 
				),
				'c19' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c20' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field1' 
					) 
				),
				'c21' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field3' 
					) 
				),
				'c22' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field6' 
					) 
				),
				'c23' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c24' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field11' 
					) 
				),
				'c25' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field14' 
					) 
				),
				'c26' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c27' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field19' 
					) 
				),
				'c28' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c29' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field25' 
					) 
				),
				'c30' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field24' 
					) 
				),
				'c31' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field26' 
					) 
				),
				'c32' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c33' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c34' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c35' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field20' 
					) 
				),
				'c36' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field21' 
					) 
				),
				'c37' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c38' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field16' 
					) 
				),
				'c39' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field17' 
					) 
				),
				'c40' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c41' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field9' 
					) 
				),
				'c42' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field10' 
					) 
				),
				'c43' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field23' 
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
		'integrated_edit_field' => array(
			'field' => 'project_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field5' => array(
			'field' => 'burn_rate_percentage',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field8' => array(
			'field' => 'client_satisfaction_rating',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field13' => array(
			'field' => 'deliverables_met',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field18' => array(
			'field' => 'q1_hours',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field2' => array(
			'field' => 'sector_id',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field4' => array(
			'field' => 'remaining_budget',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field7' => array(
			'field' => 'vat_collected',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field12' => array(
			'field' => 'on_budget_status',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field15' => array(
			'field' => 'publications_count',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field22' => array(
			'field' => 'total_hours',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field1' => array(
			'field' => 'client',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field3' => array(
			'field' => 'budget_spent',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field6' => array(
			'field' => 'profit_margin_percentage',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field11' => array(
			'field' => 'on_time_status',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field14' => array(
			'field' => 'total_deliverables',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field19' => array(
			'field' => 'q2_hours',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field25' => array(
			'field' => 'created_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field24' => array(
			'field' => 'last_updated',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field26' => array(
			'field' => 'updated_at',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field20' => array(
			'field' => 'q3_hours',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field21' => array(
			'field' => 'q4_hours',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field23' => array(
			'field' => 'percent_allocation',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field16' => array(
			'field' => 'datasets_count',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field17' => array(
			'field' => 'certificates_received',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field9' => array(
			'field' => 'next_milestone_date',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field10' => array(
			'field' => 'percent_complete',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
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