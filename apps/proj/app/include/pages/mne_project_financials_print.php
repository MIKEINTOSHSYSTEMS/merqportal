<?php
			$optionsArray = array(
	'pdf' => array(
		'pdfView' => false 
	),
	'master' => array(
		'mne_projects' => array(
			'preview' => true 
		) 
	),
	'totals' => array(
		'financial_id' => array(
			'totalsType' => '' 
		),
		'project_id' => array(
			'totalsType' => '' 
		),
		'total_project_budget' => array(
			'totalsType' => '' 
		),
		'amount_spent_to_date' => array(
			'totalsType' => '' 
		),
		'remaining_budget' => array(
			'totalsType' => '' 
		),
		'burn_rate' => array(
			'totalsType' => '' 
		),
		'budget_category' => array(
			'totalsType' => '' 
		),
		'allocated_amount' => array(
			'totalsType' => '' 
		),
		'spent_amount' => array(
			'totalsType' => '' 
		),
		'remaining_amount' => array(
			'totalsType' => '' 
		),
		'percent_spent' => array(
			'totalsType' => '' 
		),
		'comments' => array(
			'totalsType' => '' 
		),
		'target_profit_margin' => array(
			'totalsType' => '' 
		),
		'current_profit_margin' => array(
			'totalsType' => '' 
		),
		'reporting_period' => array(
			'totalsType' => '' 
		),
		'created_at' => array(
			'totalsType' => '' 
		),
		'updated_at' => array(
			'totalsType' => '' 
		) 
	),
	'fields' => array(
		'gridFields' => array( 
			'financial_id',
			'project_id',
			'total_project_budget',
			'amount_spent_to_date',
			'remaining_budget',
			'burn_rate',
			'budget_category',
			'allocated_amount',
			'spent_amount',
			'remaining_amount',
			'percent_spent',
			'comments',
			'target_profit_margin',
			'current_profit_margin',
			'reporting_period',
			'created_at',
			'updated_at' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'financial_id' => array( 
				'simple_grid_field',
				'simple_grid_field17' 
			),
			'project_id' => array( 
				'simple_grid_field1',
				'simple_grid_field18' 
			),
			'total_project_budget' => array( 
				'simple_grid_field2',
				'simple_grid_field19' 
			),
			'amount_spent_to_date' => array( 
				'simple_grid_field3',
				'simple_grid_field20' 
			),
			'remaining_budget' => array( 
				'simple_grid_field4',
				'simple_grid_field21' 
			),
			'burn_rate' => array( 
				'simple_grid_field5',
				'simple_grid_field22' 
			),
			'budget_category' => array( 
				'simple_grid_field6',
				'simple_grid_field23' 
			),
			'allocated_amount' => array( 
				'simple_grid_field7',
				'simple_grid_field24' 
			),
			'spent_amount' => array( 
				'simple_grid_field8',
				'simple_grid_field25' 
			),
			'remaining_amount' => array( 
				'simple_grid_field9',
				'simple_grid_field26' 
			),
			'percent_spent' => array( 
				'simple_grid_field10',
				'simple_grid_field27' 
			),
			'comments' => array( 
				'simple_grid_field11',
				'simple_grid_field28' 
			),
			'target_profit_margin' => array( 
				'simple_grid_field12',
				'simple_grid_field29' 
			),
			'current_profit_margin' => array( 
				'simple_grid_field13',
				'simple_grid_field30' 
			),
			'reporting_period' => array( 
				'simple_grid_field14',
				'simple_grid_field31' 
			),
			'created_at' => array( 
				'simple_grid_field15',
				'simple_grid_field32' 
			),
			'updated_at' => array( 
				'simple_grid_field16',
				'simple_grid_field33' 
			) 
		),
		'hideEmptyFields' => array( 
			 
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
					'print_pages',
					'grid_inline_cancel',
					'inline_add' 
				),
				'below-grid' => array( 
					 
				),
				'top' => array( 
					'print_header',
					'print_subheader',
					'master_info' 
				),
				'grid' => array( 
					'simple_grid_field17',
					'simple_grid_field',
					'simple_grid_field18',
					'simple_grid_field1',
					'simple_grid_field19',
					'simple_grid_field2',
					'simple_grid_field20',
					'simple_grid_field3',
					'simple_grid_field21',
					'simple_grid_field4',
					'simple_grid_field22',
					'simple_grid_field5',
					'simple_grid_field23',
					'simple_grid_field6',
					'simple_grid_field24',
					'simple_grid_field7',
					'simple_grid_field25',
					'simple_grid_field8',
					'simple_grid_field26',
					'simple_grid_field9',
					'simple_grid_field27',
					'simple_grid_field10',
					'simple_grid_field28',
					'simple_grid_field11',
					'simple_grid_field29',
					'simple_grid_field12',
					'simple_grid_field30',
					'simple_grid_field13',
					'simple_grid_field31',
					'simple_grid_field14',
					'simple_grid_field32',
					'simple_grid_field15',
					'simple_grid_field33',
					'simple_grid_field16' 
				) 
			),
			'formXtTags' => array(
				'above-grid' => array( 
					'print_pages',
					'inline_cancel',
					'inlineadd_link' 
				),
				'below-grid' => array( 
					 
				) 
			),
			'itemForms' => array(
				'print_pages' => 'above-grid',
				'grid_inline_cancel' => 'above-grid',
				'inline_add' => 'above-grid',
				'print_header' => 'top',
				'print_subheader' => 'top',
				'master_info' => 'top',
				'simple_grid_field17' => 'grid',
				'simple_grid_field' => 'grid',
				'simple_grid_field18' => 'grid',
				'simple_grid_field1' => 'grid',
				'simple_grid_field19' => 'grid',
				'simple_grid_field2' => 'grid',
				'simple_grid_field20' => 'grid',
				'simple_grid_field3' => 'grid',
				'simple_grid_field21' => 'grid',
				'simple_grid_field4' => 'grid',
				'simple_grid_field22' => 'grid',
				'simple_grid_field5' => 'grid',
				'simple_grid_field23' => 'grid',
				'simple_grid_field6' => 'grid',
				'simple_grid_field24' => 'grid',
				'simple_grid_field7' => 'grid',
				'simple_grid_field25' => 'grid',
				'simple_grid_field8' => 'grid',
				'simple_grid_field26' => 'grid',
				'simple_grid_field9' => 'grid',
				'simple_grid_field27' => 'grid',
				'simple_grid_field10' => 'grid',
				'simple_grid_field28' => 'grid',
				'simple_grid_field11' => 'grid',
				'simple_grid_field29' => 'grid',
				'simple_grid_field12' => 'grid',
				'simple_grid_field30' => 'grid',
				'simple_grid_field13' => 'grid',
				'simple_grid_field31' => 'grid',
				'simple_grid_field14' => 'grid',
				'simple_grid_field32' => 'grid',
				'simple_grid_field15' => 'grid',
				'simple_grid_field33' => 'grid',
				'simple_grid_field16' => 'grid' 
			),
			'itemLocations' => array(
				'simple_grid_field17' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field' 
				),
				'simple_grid_field' => array(
					'location' => 'grid',
					'cellId' => 'cell_field' 
				),
				'simple_grid_field18' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field1' 
				),
				'simple_grid_field1' => array(
					'location' => 'grid',
					'cellId' => 'cell_field1' 
				),
				'simple_grid_field19' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field2' 
				),
				'simple_grid_field2' => array(
					'location' => 'grid',
					'cellId' => 'cell_field2' 
				),
				'simple_grid_field20' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field3' 
				),
				'simple_grid_field3' => array(
					'location' => 'grid',
					'cellId' => 'cell_field3' 
				),
				'simple_grid_field21' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field4' 
				),
				'simple_grid_field4' => array(
					'location' => 'grid',
					'cellId' => 'cell_field4' 
				),
				'simple_grid_field22' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field5' 
				),
				'simple_grid_field5' => array(
					'location' => 'grid',
					'cellId' => 'cell_field5' 
				),
				'simple_grid_field23' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field6' 
				),
				'simple_grid_field6' => array(
					'location' => 'grid',
					'cellId' => 'cell_field6' 
				),
				'simple_grid_field24' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field7' 
				),
				'simple_grid_field7' => array(
					'location' => 'grid',
					'cellId' => 'cell_field7' 
				),
				'simple_grid_field25' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field8' 
				),
				'simple_grid_field8' => array(
					'location' => 'grid',
					'cellId' => 'cell_field8' 
				),
				'simple_grid_field26' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field9' 
				),
				'simple_grid_field9' => array(
					'location' => 'grid',
					'cellId' => 'cell_field9' 
				),
				'simple_grid_field27' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field10' 
				),
				'simple_grid_field10' => array(
					'location' => 'grid',
					'cellId' => 'cell_field10' 
				),
				'simple_grid_field28' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field11' 
				),
				'simple_grid_field11' => array(
					'location' => 'grid',
					'cellId' => 'cell_field11' 
				),
				'simple_grid_field29' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field12' 
				),
				'simple_grid_field12' => array(
					'location' => 'grid',
					'cellId' => 'cell_field12' 
				),
				'simple_grid_field30' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field13' 
				),
				'simple_grid_field13' => array(
					'location' => 'grid',
					'cellId' => 'cell_field13' 
				),
				'simple_grid_field31' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field14' 
				),
				'simple_grid_field14' => array(
					'location' => 'grid',
					'cellId' => 'cell_field14' 
				),
				'simple_grid_field32' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field15' 
				),
				'simple_grid_field15' => array(
					'location' => 'grid',
					'cellId' => 'cell_field15' 
				),
				'simple_grid_field33' => array(
					'location' => 'grid',
					'cellId' => 'headcell_field16' 
				),
				'simple_grid_field16' => array(
					'location' => 'grid',
					'cellId' => 'cell_field16' 
				) 
			),
			'itemVisiblity' => array(
				 
			) 
		),
		'itemsByType' => array(
			'print_header' => array( 
				'print_header' 
			),
			'print_subheader' => array( 
				'print_subheader' 
			),
			'print_pages' => array( 
				'print_pages' 
			),
			'master_info' => array( 
				'master_info' 
			),
			'grid_field' => array( 
				'simple_grid_field',
				'simple_grid_field1',
				'simple_grid_field2',
				'simple_grid_field3',
				'simple_grid_field4',
				'simple_grid_field5',
				'simple_grid_field6',
				'simple_grid_field7',
				'simple_grid_field8',
				'simple_grid_field9',
				'simple_grid_field10',
				'simple_grid_field11',
				'simple_grid_field12',
				'simple_grid_field13',
				'simple_grid_field14',
				'simple_grid_field15',
				'simple_grid_field16' 
			),
			'grid_field_label' => array( 
				'simple_grid_field17',
				'simple_grid_field18',
				'simple_grid_field19',
				'simple_grid_field20',
				'simple_grid_field21',
				'simple_grid_field22',
				'simple_grid_field23',
				'simple_grid_field24',
				'simple_grid_field25',
				'simple_grid_field26',
				'simple_grid_field27',
				'simple_grid_field28',
				'simple_grid_field29',
				'simple_grid_field30',
				'simple_grid_field31',
				'simple_grid_field32',
				'simple_grid_field33' 
			),
			'inline_add' => array( 
				'inline_add' 
			),
			'grid_inline_cancel' => array( 
				'grid_inline_cancel' 
			) 
		),
		'cellMaps' => array(
			'grid' => array(
				'cells' => array(
					'headcell_field' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'financial_id_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field17' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field1' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'project_id_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field18' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field2' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'total_project_budget_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field19' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field3' => array(
						'cols' => array( 
							3 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'amount_spent_to_date_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field20' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field4' => array(
						'cols' => array( 
							4 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'remaining_budget_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field21' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field5' => array(
						'cols' => array( 
							5 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'burn_rate_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field22' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field6' => array(
						'cols' => array( 
							6 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'budget_category_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field23' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field7' => array(
						'cols' => array( 
							7 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'allocated_amount_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field24' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field8' => array(
						'cols' => array( 
							8 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'spent_amount_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field25' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field9' => array(
						'cols' => array( 
							9 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'remaining_amount_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field26' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field10' => array(
						'cols' => array( 
							10 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'percent_spent_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field27' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field11' => array(
						'cols' => array( 
							11 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'comments_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field28' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field12' => array(
						'cols' => array( 
							12 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'target_profit_margin_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field29' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field13' => array(
						'cols' => array( 
							13 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'current_profit_margin_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field30' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field14' => array(
						'cols' => array( 
							14 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'reporting_period_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field31' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field15' => array(
						'cols' => array( 
							15 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'created_at_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field32' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'headcell_field16' => array(
						'cols' => array( 
							16 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							'updated_at_fieldheadercolumn' 
						),
						'items' => array( 
							'simple_grid_field33' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'financial_id_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field1' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'project_id_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field1' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field2' => array(
						'cols' => array( 
							2 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'total_project_budget_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field2' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field3' => array(
						'cols' => array( 
							3 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'amount_spent_to_date_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field3' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field4' => array(
						'cols' => array( 
							4 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'remaining_budget_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field4' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field5' => array(
						'cols' => array( 
							5 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'burn_rate_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field5' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field6' => array(
						'cols' => array( 
							6 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'budget_category_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field6' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field7' => array(
						'cols' => array( 
							7 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'allocated_amount_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field7' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field8' => array(
						'cols' => array( 
							8 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'spent_amount_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field8' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field9' => array(
						'cols' => array( 
							9 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'remaining_amount_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field9' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field10' => array(
						'cols' => array( 
							10 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'percent_spent_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field10' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field11' => array(
						'cols' => array( 
							11 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'comments_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field11' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field12' => array(
						'cols' => array( 
							12 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'target_profit_margin_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field12' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field13' => array(
						'cols' => array( 
							13 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'current_profit_margin_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field13' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field14' => array(
						'cols' => array( 
							14 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'reporting_period_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field14' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field15' => array(
						'cols' => array( 
							15 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'created_at_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field15' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'cell_field16' => array(
						'cols' => array( 
							16 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							'updated_at_fieldcolumn' 
						),
						'items' => array( 
							'simple_grid_field16' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'footcell_field' => array(
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
					'footcell_field1' => array(
						'cols' => array( 
							1 
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
					'footcell_field2' => array(
						'cols' => array( 
							2 
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
					'footcell_field3' => array(
						'cols' => array( 
							3 
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
					'footcell_field4' => array(
						'cols' => array( 
							4 
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
					'footcell_field5' => array(
						'cols' => array( 
							5 
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
					'footcell_field6' => array(
						'cols' => array( 
							6 
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
					'footcell_field7' => array(
						'cols' => array( 
							7 
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
					'footcell_field8' => array(
						'cols' => array( 
							8 
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
					'footcell_field9' => array(
						'cols' => array( 
							9 
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
					'footcell_field10' => array(
						'cols' => array( 
							10 
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
					'footcell_field11' => array(
						'cols' => array( 
							11 
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
					'footcell_field12' => array(
						'cols' => array( 
							12 
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
					'footcell_field13' => array(
						'cols' => array( 
							13 
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
					'footcell_field14' => array(
						'cols' => array( 
							14 
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
					'footcell_field15' => array(
						'cols' => array( 
							15 
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
					'footcell_field16' => array(
						'cols' => array( 
							16 
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
					) 
				),
				'width' => 17,
				'height' => 3 
			) 
		) 
	),
	'page' => array(
		'verticalBar' => false,
		'labeledButtons' => array(
			'update_records' => array(
				 
			),
			'print_pages' => array(
				'print_pages' => array(
					'tag' => 'PRINT_PAGES',
					'type' => 2 
				) 
			),
			'register_activate_message' => array(
				 
			),
			'details_found' => array(
				 
			) 
		),
		'gridType' => 0,
		'recsPerRow' => 1,
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
	'misc' => array(
		'type' => 'print',
		'breadcrumb' => false 
	),
	'events' => array(
		'maps' => array( 
			 
		),
		'mapsData' => array(
			 
		),
		'buttons' => array( 
			 
		) 
	),
	'dataGrid' => array(
		'groupFields' => array( 
			 
		) 
	) 
);
			$pageArray = array(
	'id' => 'print',
	'type' => 'print',
	'layoutId' => 'basic',
	'disabled' => false,
	'default' => 0,
	'forms' => array(
		'above-grid' => array(
			'modelId' => 'print-above-grid',
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
						'print_pages',
						'grid_inline_cancel',
						'inline_add' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'below-grid' => array(
			'modelId' => 'print-below-grid',
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
			'modelId' => 'print-header',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c2' 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c4' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						'print_header',
						'print_subheader' 
					) 
				),
				'c4' => array(
					'model' => 'c4',
					'items' => array( 
						'master_info' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'grid' => array(
			'modelId' => 'horizontal-grid',
			'grid' => array( 
				array(
					'section' => 'head',
					'cells' => array( 
						array(
							'cell' => 'headcell_field' 
						),
						array(
							'cell' => 'headcell_field1' 
						),
						array(
							'cell' => 'headcell_field2' 
						),
						array(
							'cell' => 'headcell_field3' 
						),
						array(
							'cell' => 'headcell_field4' 
						),
						array(
							'cell' => 'headcell_field5' 
						),
						array(
							'cell' => 'headcell_field6' 
						),
						array(
							'cell' => 'headcell_field7' 
						),
						array(
							'cell' => 'headcell_field8' 
						),
						array(
							'cell' => 'headcell_field9' 
						),
						array(
							'cell' => 'headcell_field10' 
						),
						array(
							'cell' => 'headcell_field11' 
						),
						array(
							'cell' => 'headcell_field12' 
						),
						array(
							'cell' => 'headcell_field13' 
						),
						array(
							'cell' => 'headcell_field14' 
						),
						array(
							'cell' => 'headcell_field15' 
						),
						array(
							'cell' => 'headcell_field16' 
						) 
					) 
				),
				array(
					'section' => 'body',
					'cells' => array( 
						array(
							'cell' => 'cell_field' 
						),
						array(
							'cell' => 'cell_field1' 
						),
						array(
							'cell' => 'cell_field2' 
						),
						array(
							'cell' => 'cell_field3' 
						),
						array(
							'cell' => 'cell_field4' 
						),
						array(
							'cell' => 'cell_field5' 
						),
						array(
							'cell' => 'cell_field6' 
						),
						array(
							'cell' => 'cell_field7' 
						),
						array(
							'cell' => 'cell_field8' 
						),
						array(
							'cell' => 'cell_field9' 
						),
						array(
							'cell' => 'cell_field10' 
						),
						array(
							'cell' => 'cell_field11' 
						),
						array(
							'cell' => 'cell_field12' 
						),
						array(
							'cell' => 'cell_field13' 
						),
						array(
							'cell' => 'cell_field14' 
						),
						array(
							'cell' => 'cell_field15' 
						),
						array(
							'cell' => 'cell_field16' 
						) 
					) 
				),
				array(
					'section' => 'foot',
					'cells' => array( 
						array(
							'cell' => 'footcell_field' 
						),
						array(
							'cell' => 'footcell_field1' 
						),
						array(
							'cell' => 'footcell_field2' 
						),
						array(
							'cell' => 'footcell_field3' 
						),
						array(
							'cell' => 'footcell_field4' 
						),
						array(
							'cell' => 'footcell_field5' 
						),
						array(
							'cell' => 'footcell_field6' 
						),
						array(
							'cell' => 'footcell_field7' 
						),
						array(
							'cell' => 'footcell_field8' 
						),
						array(
							'cell' => 'footcell_field9' 
						),
						array(
							'cell' => 'footcell_field10' 
						),
						array(
							'cell' => 'footcell_field11' 
						),
						array(
							'cell' => 'footcell_field12' 
						),
						array(
							'cell' => 'footcell_field13' 
						),
						array(
							'cell' => 'footcell_field14' 
						),
						array(
							'cell' => 'footcell_field15' 
						),
						array(
							'cell' => 'footcell_field16' 
						) 
					) 
				) 
			),
			'cells' => array(
				'headcell_field' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field17' 
					),
					'field' => 'financial_id',
					'columnName' => 'field' 
				),
				'cell_field' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field' 
					),
					'field' => 'financial_id',
					'columnName' => 'field' 
				),
				'footcell_field' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field1' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field18' 
					),
					'field' => 'project_id',
					'columnName' => 'field' 
				),
				'cell_field1' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field1' 
					),
					'field' => 'project_id',
					'columnName' => 'field' 
				),
				'footcell_field1' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field2' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field19' 
					),
					'field' => 'total_project_budget',
					'columnName' => 'field' 
				),
				'cell_field2' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field2' 
					),
					'field' => 'total_project_budget',
					'columnName' => 'field' 
				),
				'footcell_field2' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field3' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field20' 
					),
					'field' => 'amount_spent_to_date',
					'columnName' => 'field' 
				),
				'cell_field3' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field3' 
					),
					'field' => 'amount_spent_to_date',
					'columnName' => 'field' 
				),
				'footcell_field3' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field4' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field21' 
					),
					'field' => 'remaining_budget',
					'columnName' => 'field' 
				),
				'cell_field4' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field4' 
					),
					'field' => 'remaining_budget',
					'columnName' => 'field' 
				),
				'footcell_field4' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field5' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field22' 
					),
					'field' => 'burn_rate',
					'columnName' => 'field' 
				),
				'cell_field5' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field5' 
					),
					'field' => 'burn_rate',
					'columnName' => 'field' 
				),
				'footcell_field5' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field6' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field23' 
					),
					'field' => 'budget_category',
					'columnName' => 'field' 
				),
				'cell_field6' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field6' 
					),
					'field' => 'budget_category',
					'columnName' => 'field' 
				),
				'footcell_field6' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field7' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field24' 
					),
					'field' => 'allocated_amount',
					'columnName' => 'field' 
				),
				'cell_field7' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field7' 
					),
					'field' => 'allocated_amount',
					'columnName' => 'field' 
				),
				'footcell_field7' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field8' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field25' 
					),
					'field' => 'spent_amount',
					'columnName' => 'field' 
				),
				'cell_field8' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field8' 
					),
					'field' => 'spent_amount',
					'columnName' => 'field' 
				),
				'footcell_field8' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field9' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field26' 
					),
					'field' => 'remaining_amount',
					'columnName' => 'field' 
				),
				'cell_field9' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field9' 
					),
					'field' => 'remaining_amount',
					'columnName' => 'field' 
				),
				'footcell_field9' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field10' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field27' 
					),
					'field' => 'percent_spent',
					'columnName' => 'field' 
				),
				'cell_field10' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field10' 
					),
					'field' => 'percent_spent',
					'columnName' => 'field' 
				),
				'footcell_field10' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field11' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field28' 
					),
					'field' => 'comments',
					'columnName' => 'field' 
				),
				'cell_field11' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field11' 
					),
					'field' => 'comments',
					'columnName' => 'field' 
				),
				'footcell_field11' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field12' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field29' 
					),
					'field' => 'target_profit_margin',
					'columnName' => 'field' 
				),
				'cell_field12' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field12' 
					),
					'field' => 'target_profit_margin',
					'columnName' => 'field' 
				),
				'footcell_field12' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field13' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field30' 
					),
					'field' => 'current_profit_margin',
					'columnName' => 'field' 
				),
				'cell_field13' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field13' 
					),
					'field' => 'current_profit_margin',
					'columnName' => 'field' 
				),
				'footcell_field13' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field14' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field31' 
					),
					'field' => 'reporting_period',
					'columnName' => 'field' 
				),
				'cell_field14' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field14' 
					),
					'field' => 'reporting_period',
					'columnName' => 'field' 
				),
				'footcell_field14' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field15' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field32' 
					),
					'field' => 'created_at',
					'columnName' => 'field' 
				),
				'cell_field15' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field15' 
					),
					'field' => 'created_at',
					'columnName' => 'field' 
				),
				'footcell_field15' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				),
				'headcell_field16' => array(
					'model' => 'headcell_field',
					'items' => array( 
						'simple_grid_field33' 
					),
					'field' => 'updated_at',
					'columnName' => 'field' 
				),
				'cell_field16' => array(
					'model' => 'cell_field',
					'items' => array( 
						'simple_grid_field16' 
					),
					'field' => 'updated_at',
					'columnName' => 'field' 
				),
				'footcell_field16' => array(
					'model' => 'footcell_field',
					'items' => array( 
						 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		) 
	),
	'items' => array(
		'print_header' => array(
			'type' => 'print_header' 
		),
		'print_subheader' => array(
			'type' => 'print_subheader' 
		),
		'print_pages' => array(
			'type' => 'print_pages' 
		),
		'master_info' => array(
			'type' => 'master_info',
			'tables' => array(
				'15086' => 'true' 
			) 
		),
		'simple_grid_field' => array(
			'field' => 'financial_id',
			'type' => 'grid_field' 
		),
		'simple_grid_field17' => array(
			'type' => 'grid_field_label',
			'field' => 'financial_id' 
		),
		'simple_grid_field1' => array(
			'field' => 'project_id',
			'type' => 'grid_field' 
		),
		'simple_grid_field18' => array(
			'type' => 'grid_field_label',
			'field' => 'project_id' 
		),
		'simple_grid_field2' => array(
			'field' => 'total_project_budget',
			'type' => 'grid_field' 
		),
		'simple_grid_field19' => array(
			'type' => 'grid_field_label',
			'field' => 'total_project_budget' 
		),
		'simple_grid_field3' => array(
			'field' => 'amount_spent_to_date',
			'type' => 'grid_field' 
		),
		'simple_grid_field20' => array(
			'type' => 'grid_field_label',
			'field' => 'amount_spent_to_date' 
		),
		'simple_grid_field4' => array(
			'field' => 'remaining_budget',
			'type' => 'grid_field' 
		),
		'simple_grid_field21' => array(
			'type' => 'grid_field_label',
			'field' => 'remaining_budget' 
		),
		'simple_grid_field5' => array(
			'field' => 'burn_rate',
			'type' => 'grid_field' 
		),
		'simple_grid_field22' => array(
			'type' => 'grid_field_label',
			'field' => 'burn_rate' 
		),
		'simple_grid_field6' => array(
			'field' => 'budget_category',
			'type' => 'grid_field' 
		),
		'simple_grid_field23' => array(
			'type' => 'grid_field_label',
			'field' => 'budget_category' 
		),
		'simple_grid_field7' => array(
			'field' => 'allocated_amount',
			'type' => 'grid_field' 
		),
		'simple_grid_field24' => array(
			'type' => 'grid_field_label',
			'field' => 'allocated_amount' 
		),
		'simple_grid_field8' => array(
			'field' => 'spent_amount',
			'type' => 'grid_field' 
		),
		'simple_grid_field25' => array(
			'type' => 'grid_field_label',
			'field' => 'spent_amount' 
		),
		'simple_grid_field9' => array(
			'field' => 'remaining_amount',
			'type' => 'grid_field' 
		),
		'simple_grid_field26' => array(
			'type' => 'grid_field_label',
			'field' => 'remaining_amount' 
		),
		'simple_grid_field10' => array(
			'field' => 'percent_spent',
			'type' => 'grid_field' 
		),
		'simple_grid_field27' => array(
			'type' => 'grid_field_label',
			'field' => 'percent_spent' 
		),
		'simple_grid_field11' => array(
			'field' => 'comments',
			'type' => 'grid_field' 
		),
		'simple_grid_field28' => array(
			'type' => 'grid_field_label',
			'field' => 'comments' 
		),
		'simple_grid_field12' => array(
			'field' => 'target_profit_margin',
			'type' => 'grid_field' 
		),
		'simple_grid_field29' => array(
			'type' => 'grid_field_label',
			'field' => 'target_profit_margin' 
		),
		'simple_grid_field13' => array(
			'field' => 'current_profit_margin',
			'type' => 'grid_field' 
		),
		'simple_grid_field30' => array(
			'type' => 'grid_field_label',
			'field' => 'current_profit_margin' 
		),
		'simple_grid_field14' => array(
			'field' => 'reporting_period',
			'type' => 'grid_field' 
		),
		'simple_grid_field31' => array(
			'type' => 'grid_field_label',
			'field' => 'reporting_period' 
		),
		'simple_grid_field15' => array(
			'field' => 'created_at',
			'type' => 'grid_field' 
		),
		'simple_grid_field32' => array(
			'type' => 'grid_field_label',
			'field' => 'created_at' 
		),
		'simple_grid_field16' => array(
			'field' => 'updated_at',
			'type' => 'grid_field' 
		),
		'simple_grid_field33' => array(
			'type' => 'grid_field_label',
			'field' => 'updated_at' 
		),
		'inline_add' => array(
			'type' => 'inline_add',
			'detailsOnly' => true 
		),
		'grid_inline_cancel' => array(
			'type' => 'grid_inline_cancel' 
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