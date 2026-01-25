<?php
global $runnerTableSettings;
$runnerTableSettings['mne_extended_projects'] = array(
	'name' => 'mne_extended_projects',
	'shortName' => 'mne_extended_projects',
	'pagesByType' => array(
		'add' => array( 
			'add' 
		),
		'export' => array( 
			'export' 
		),
		'import' => array( 
			'import' 
		),
		'edit' => array( 
			'edit' 
		),
		'view' => array( 
			'view' 
		),
		'list' => array( 
			'list' 
		),
		'print' => array( 
			'print' 
		),
		'search' => array( 
			'search' 
		) 
	),
	'pageTypes' => array(
		'add' => 'add',
		'export' => 'export',
		'import' => 'import',
		'edit' => 'edit',
		'view' => 'view',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'defaultPages' => array(
		'add' => 'add',
		'export' => 'export',
		'import' => 'import',
		'edit' => 'edit',
		'view' => 'view',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'afterEditDetails' => 'mne_extended_projects',
	'afterAddDetail' => 'mne_extended_projects',
	'detailsBadgeColor' => '6b8e23',
	'sql' => 'SELECT
	extended_id,
	project_id,
	client,
	sector_id,
	budget_spent,
	remaining_budget,
	burn_rate_percentage,
	profit_margin_percentage,
	vat_collected,
	client_satisfaction_rating,
	next_milestone_date,
	percent_complete,
	on_time_status,
	on_budget_status,
	deliverables_met,
	total_deliverables,
	publications_count,
	datasets_count,
	certificates_received,
	q1_hours,
	q2_hours,
	q3_hours,
	q4_hours,
	total_hours,
	percent_allocation,
	last_updated,
	created_at,
	updated_at
FROM
	mne_extended_projects',
	'keyFields' => array( 
		'extended_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'extended_id' => array(
			'name' => 'extended_id',
			'goodName' => 'extended_id',
			'strField' => 'extended_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'extended_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'project_id' => array(
			'name' => 'project_id',
			'goodName' => 'project_id',
			'strField' => 'project_id',
			'index' => 2,
			'type' => 3,
			'sqlExpression' => 'project_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_projects',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'project_id',
					'lookupDisplayField' => 'project_code',
					'lookupAutofillEdit' => true,
					'lookupAutofillFields' => array( 
						array(
							'masterField' => 'client',
							'lookupField' => 'client_id' 
						),
						array(
							'masterField' => 'sector_id',
							'lookupField' => 'sector_id' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'client' => array(
			'name' => 'client',
			'goodName' => 'client',
			'strField' => 'client',
			'index' => 3,
			'sqlExpression' => 'client',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'sector_id' => array(
			'name' => 'sector_id',
			'goodName' => 'sector_id',
			'strField' => 'sector_id',
			'index' => 4,
			'type' => 3,
			'sqlExpression' => 'sector_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_sector_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'sector_id',
					'lookupDisplayField' => 'sector_name' 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'budget_spent' => array(
			'name' => 'budget_spent',
			'goodName' => 'budget_spent',
			'strField' => 'budget_spent',
			'index' => 5,
			'type' => 14,
			'sqlExpression' => 'budget_spent',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'remaining_budget' => array(
			'name' => 'remaining_budget',
			'goodName' => 'remaining_budget',
			'strField' => 'remaining_budget',
			'index' => 6,
			'type' => 14,
			'sqlExpression' => 'remaining_budget',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'burn_rate_percentage' => array(
			'name' => 'burn_rate_percentage',
			'goodName' => 'burn_rate_percentage',
			'strField' => 'burn_rate_percentage',
			'index' => 7,
			'type' => 14,
			'sqlExpression' => 'burn_rate_percentage',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'profit_margin_percentage' => array(
			'name' => 'profit_margin_percentage',
			'goodName' => 'profit_margin_percentage',
			'strField' => 'profit_margin_percentage',
			'index' => 8,
			'type' => 14,
			'sqlExpression' => 'profit_margin_percentage',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'vat_collected' => array(
			'name' => 'vat_collected',
			'goodName' => 'vat_collected',
			'strField' => 'vat_collected',
			'index' => 9,
			'type' => 14,
			'sqlExpression' => 'vat_collected',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'client_satisfaction_rating' => array(
			'name' => 'client_satisfaction_rating',
			'goodName' => 'client_satisfaction_rating',
			'strField' => 'client_satisfaction_rating',
			'index' => 10,
			'type' => 14,
			'sqlExpression' => 'client_satisfaction_rating',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'next_milestone_date' => array(
			'name' => 'next_milestone_date',
			'goodName' => 'next_milestone_date',
			'strField' => 'next_milestone_date',
			'index' => 11,
			'type' => 7,
			'sqlExpression' => 'next_milestone_date',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'percent_complete' => array(
			'name' => 'percent_complete',
			'goodName' => 'percent_complete',
			'strField' => 'percent_complete',
			'index' => 12,
			'type' => 14,
			'sqlExpression' => 'percent_complete',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'on_time_status' => array(
			'name' => 'on_time_status',
			'goodName' => 'on_time_status',
			'strField' => 'on_time_status',
			'index' => 13,
			'type' => 129,
			'sqlExpression' => 'on_time_status',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Yes',
						'No' 
					) 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'on_budget_status' => array(
			'name' => 'on_budget_status',
			'goodName' => 'on_budget_status',
			'strField' => 'on_budget_status',
			'index' => 14,
			'type' => 129,
			'sqlExpression' => 'on_budget_status',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Yes',
						'No' 
					) 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'deliverables_met' => array(
			'name' => 'deliverables_met',
			'goodName' => 'deliverables_met',
			'strField' => 'deliverables_met',
			'index' => 15,
			'type' => 3,
			'sqlExpression' => 'deliverables_met',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'total_deliverables' => array(
			'name' => 'total_deliverables',
			'goodName' => 'total_deliverables',
			'strField' => 'total_deliverables',
			'index' => 16,
			'type' => 3,
			'sqlExpression' => 'total_deliverables',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'publications_count' => array(
			'name' => 'publications_count',
			'goodName' => 'publications_count',
			'strField' => 'publications_count',
			'index' => 17,
			'type' => 3,
			'sqlExpression' => 'publications_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'datasets_count' => array(
			'name' => 'datasets_count',
			'goodName' => 'datasets_count',
			'strField' => 'datasets_count',
			'index' => 18,
			'type' => 3,
			'sqlExpression' => 'datasets_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'certificates_received' => array(
			'name' => 'certificates_received',
			'goodName' => 'certificates_received',
			'strField' => 'certificates_received',
			'index' => 19,
			'type' => 129,
			'sqlExpression' => 'certificates_received',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Yes',
						'No' 
					) 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'q1_hours' => array(
			'name' => 'q1_hours',
			'goodName' => 'q1_hours',
			'strField' => 'q1_hours',
			'index' => 20,
			'type' => 14,
			'sqlExpression' => 'q1_hours',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'q2_hours' => array(
			'name' => 'q2_hours',
			'goodName' => 'q2_hours',
			'strField' => 'q2_hours',
			'index' => 21,
			'type' => 14,
			'sqlExpression' => 'q2_hours',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'q3_hours' => array(
			'name' => 'q3_hours',
			'goodName' => 'q3_hours',
			'strField' => 'q3_hours',
			'index' => 22,
			'type' => 14,
			'sqlExpression' => 'q3_hours',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'q4_hours' => array(
			'name' => 'q4_hours',
			'goodName' => 'q4_hours',
			'strField' => 'q4_hours',
			'index' => 23,
			'type' => 14,
			'sqlExpression' => 'q4_hours',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'total_hours' => array(
			'name' => 'total_hours',
			'goodName' => 'total_hours',
			'strField' => 'total_hours',
			'index' => 24,
			'type' => 14,
			'sqlExpression' => 'total_hours',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'percent_allocation' => array(
			'name' => 'percent_allocation',
			'goodName' => 'percent_allocation',
			'strField' => 'percent_allocation',
			'index' => 25,
			'type' => 14,
			'sqlExpression' => 'percent_allocation',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'last_updated' => array(
			'name' => 'last_updated',
			'goodName' => 'last_updated',
			'strField' => 'last_updated',
			'index' => 26,
			'type' => 135,
			'sqlExpression' => 'last_updated',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 27,
			'type' => 135,
			'sqlExpression' => 'created_at',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 28,
			'type' => 135,
			'sqlExpression' => 'updated_at',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_extended_projects' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'mne_projects',
			'detailsKeys' => array( 
				'project_id' 
			),
			'masterKeys' => array( 
				'project_id' 
			) 
		),
		array(
			'table' => 'mne_sector_options',
			'detailsKeys' => array( 
				'sector_id' 
			),
			'masterKeys' => array( 
				'sector_id' 
			) 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	extended_id,
	project_id,
	client,
	sector_id,
	budget_spent,
	remaining_budget,
	burn_rate_percentage,
	profit_margin_percentage,
	vat_collected,
	client_satisfaction_rating,
	next_milestone_date,
	percent_complete,
	on_time_status,
	on_budget_status,
	deliverables_met,
	total_deliverables,
	publications_count,
	datasets_count,
	certificates_received,
	q1_hours,
	q2_hours,
	q3_hours,
	q4_hours,
	total_hours,
	percent_allocation,
	last_updated,
	created_at,
	updated_at
FROM
	mne_extended_projects',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'extended_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'extended_id' 
				),
				'encrypted' => false,
				'columnName' => 'extended_id' 
			),
			array(
				'sql' => 'project_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'project_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_id' 
			),
			array(
				'sql' => 'client',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'client' 
				),
				'encrypted' => false,
				'columnName' => 'client' 
			),
			array(
				'sql' => 'sector_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'sector_id' 
				),
				'encrypted' => false,
				'columnName' => 'sector_id' 
			),
			array(
				'sql' => 'budget_spent',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'budget_spent' 
				),
				'encrypted' => false,
				'columnName' => 'budget_spent' 
			),
			array(
				'sql' => 'remaining_budget',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'remaining_budget' 
				),
				'encrypted' => false,
				'columnName' => 'remaining_budget' 
			),
			array(
				'sql' => 'burn_rate_percentage',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'burn_rate_percentage' 
				),
				'encrypted' => false,
				'columnName' => 'burn_rate_percentage' 
			),
			array(
				'sql' => 'profit_margin_percentage',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'profit_margin_percentage' 
				),
				'encrypted' => false,
				'columnName' => 'profit_margin_percentage' 
			),
			array(
				'sql' => 'vat_collected',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'vat_collected' 
				),
				'encrypted' => false,
				'columnName' => 'vat_collected' 
			),
			array(
				'sql' => 'client_satisfaction_rating',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'client_satisfaction_rating' 
				),
				'encrypted' => false,
				'columnName' => 'client_satisfaction_rating' 
			),
			array(
				'sql' => 'next_milestone_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'next_milestone_date' 
				),
				'encrypted' => false,
				'columnName' => 'next_milestone_date' 
			),
			array(
				'sql' => 'percent_complete',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'percent_complete' 
				),
				'encrypted' => false,
				'columnName' => 'percent_complete' 
			),
			array(
				'sql' => 'on_time_status',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'on_time_status' 
				),
				'encrypted' => false,
				'columnName' => 'on_time_status' 
			),
			array(
				'sql' => 'on_budget_status',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'on_budget_status' 
				),
				'encrypted' => false,
				'columnName' => 'on_budget_status' 
			),
			array(
				'sql' => 'deliverables_met',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'deliverables_met' 
				),
				'encrypted' => false,
				'columnName' => 'deliverables_met' 
			),
			array(
				'sql' => 'total_deliverables',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'total_deliverables' 
				),
				'encrypted' => false,
				'columnName' => 'total_deliverables' 
			),
			array(
				'sql' => 'publications_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'publications_count' 
				),
				'encrypted' => false,
				'columnName' => 'publications_count' 
			),
			array(
				'sql' => 'datasets_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'datasets_count' 
				),
				'encrypted' => false,
				'columnName' => 'datasets_count' 
			),
			array(
				'sql' => 'certificates_received',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'certificates_received' 
				),
				'encrypted' => false,
				'columnName' => 'certificates_received' 
			),
			array(
				'sql' => 'q1_hours',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'q1_hours' 
				),
				'encrypted' => false,
				'columnName' => 'q1_hours' 
			),
			array(
				'sql' => 'q2_hours',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'q2_hours' 
				),
				'encrypted' => false,
				'columnName' => 'q2_hours' 
			),
			array(
				'sql' => 'q3_hours',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'q3_hours' 
				),
				'encrypted' => false,
				'columnName' => 'q3_hours' 
			),
			array(
				'sql' => 'q4_hours',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'q4_hours' 
				),
				'encrypted' => false,
				'columnName' => 'q4_hours' 
			),
			array(
				'sql' => 'total_hours',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'total_hours' 
				),
				'encrypted' => false,
				'columnName' => 'total_hours' 
			),
			array(
				'sql' => 'percent_allocation',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'percent_allocation' 
				),
				'encrypted' => false,
				'columnName' => 'percent_allocation' 
			),
			array(
				'sql' => 'last_updated',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'last_updated' 
				),
				'encrypted' => false,
				'columnName' => 'last_updated' 
			),
			array(
				'sql' => 'created_at',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'created_at' 
				),
				'encrypted' => false,
				'columnName' => 'created_at' 
			),
			array(
				'sql' => 'updated_at',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_extended_projects',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_extended_projects',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_extended_projects',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'extended_id',
						'project_id',
						'client',
						'sector_id',
						'budget_spent',
						'remaining_budget',
						'burn_rate_percentage',
						'profit_margin_percentage',
						'vat_collected',
						'client_satisfaction_rating',
						'next_milestone_date',
						'percent_complete',
						'on_time_status',
						'on_budget_status',
						'deliverables_met',
						'total_deliverables',
						'publications_count',
						'datasets_count',
						'certificates_received',
						'q1_hours',
						'q2_hours',
						'q3_hours',
						'q4_hours',
						'total_hours',
						'percent_allocation',
						'last_updated',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_extended_projects' 
				),
				'joinOn' => array(
					'sql' => '',
					'parsed' => false,
					'type' => 'LogicalExpression',
					'contained' => array( 
						 
					),
					'unionType' => 0,
					'column' => null 
				),
				'joinList' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'JoinOn',
					'field1' => array( 
						 
					),
					'field2' => array( 
						 
					) 
				),
				'link' => 0 
			) 
		),
		'where' => array(
			'sql' => '',
			'parsed' => false,
			'type' => 'LogicalExpression',
			'contained' => array( 
				 
			),
			'unionType' => 0,
			'column' => null 
		),
		'groupBy' => array( 
			 
		),
		'having' => array(
			'sql' => '',
			'parsed' => false,
			'type' => 'LogicalExpression',
			'contained' => array( 
				 
			),
			'unionType' => 0,
			'column' => null 
		),
		'orderBy' => array( 
			 
		),
		'colsIndex' => array( 
			array(
				'fieldIndex' => 0,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 1,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 2,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 3,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 4,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 5,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 6,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 7,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 8,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 9,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 10,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 11,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 12,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 13,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 14,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 15,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 16,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 17,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 18,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 19,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 20,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 21,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 22,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 23,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 24,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 25,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 26,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 27,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'extended_id,
	project_id,
	client,
	sector_id,
	budget_spent,
	remaining_budget,
	burn_rate_percentage,
	profit_margin_percentage,
	vat_collected,
	client_satisfaction_rating,
	next_milestone_date,
	percent_complete,
	on_time_status,
	on_budget_status,
	deliverables_met,
	total_deliverables,
	publications_count,
	datasets_count,
	certificates_received,
	q1_hours,
	q2_hours,
	q3_hours,
	q4_hours,
	total_hours,
	percent_allocation,
	last_updated,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_extended_projects',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_extended_projects',
	'originalPagesByType' => array(
		'add' => array( 
			'add' 
		),
		'export' => array( 
			'export' 
		),
		'import' => array( 
			'import' 
		),
		'edit' => array( 
			'edit' 
		),
		'view' => array( 
			'view' 
		),
		'list' => array( 
			'list' 
		),
		'print' => array( 
			'print' 
		),
		'search' => array( 
			'search' 
		) 
	),
	'originalPageTypes' => array(
		'add' => 'add',
		'export' => 'export',
		'import' => 'import',
		'edit' => 'edit',
		'view' => 'view',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'originalDefaultPages' => array(
		'add' => 'add',
		'export' => 'export',
		'import' => 'import',
		'edit' => 'edit',
		'view' => 'view',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'searchSettings' => array(
		'caseSensitiveSearch' => false,
		'searchableFields' => array( 
			'extended_id',
			'project_id',
			'client',
			'sector_id',
			'budget_spent',
			'remaining_budget',
			'burn_rate_percentage',
			'profit_margin_percentage',
			'vat_collected',
			'client_satisfaction_rating',
			'next_milestone_date',
			'percent_complete',
			'on_time_status',
			'on_budget_status',
			'deliverables_met',
			'total_deliverables',
			'publications_count',
			'datasets_count',
			'certificates_received',
			'q1_hours',
			'q2_hours',
			'q3_hours',
			'q4_hours',
			'total_hours',
			'percent_allocation',
			'last_updated',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'extended_id',
			'project_id',
			'client',
			'sector_id',
			'budget_spent',
			'remaining_budget',
			'burn_rate_percentage',
			'profit_margin_percentage',
			'vat_collected',
			'client_satisfaction_rating',
			'next_milestone_date',
			'percent_complete',
			'on_time_status',
			'on_budget_status',
			'deliverables_met',
			'total_deliverables',
			'publications_count',
			'datasets_count',
			'certificates_received',
			'q1_hours',
			'q2_hours',
			'q3_hours',
			'q4_hours',
			'total_hours',
			'percent_allocation',
			'last_updated',
			'created_at',
			'updated_at' 
		) 
	),
	'connId' => 'conn',
	'clickActions' => array(
		'row' => array(
			'action' => 'noaction' 
		),
		'fields' => array(
			 
		) 
	),
	'geoCoding' => array(
		'enabled' => false,
		'latField' => '',
		'lonField' => '',
		'addressFields' => array( 
			 
		) 
	),
	'whereTabs' => array( 
		 
	),
	'labels' => array(
		 
	),
	'chartSettings' => array(
		 
	),
	'dataSourceOperations' => array(
		 
	),
	'calendarSettings' => array(
		'categoryColors' => array( 
			 
		) 
	),
	'ganttSettings' => array(
		'categoryColors' => array( 
			 
		) 
	) 
);

global $runnerTableLabels;
if( mlang_getcurrentlang() === 'English' ) {
	$runnerTableLabels['mne_extended_projects'] = array(
	'tableCaption' => 'Mne Extended Projects',
	'fieldLabels' => array(
		'extended_id' => 'Extended Id',
		'project_id' => 'Project Id',
		'client' => 'Client',
		'sector_id' => 'Sector Id',
		'budget_spent' => 'Budget Spent',
		'remaining_budget' => 'Remaining Budget',
		'burn_rate_percentage' => 'Burn Rate Percentage',
		'profit_margin_percentage' => 'Profit Margin Percentage',
		'vat_collected' => 'Vat Collected',
		'client_satisfaction_rating' => 'Client Satisfaction Rating',
		'next_milestone_date' => 'Next Milestone Date',
		'percent_complete' => 'Percent Complete',
		'on_time_status' => 'On Time Status',
		'on_budget_status' => 'On Budget Status',
		'deliverables_met' => 'Deliverables Met',
		'total_deliverables' => 'Total Deliverables',
		'publications_count' => 'Publications Count',
		'datasets_count' => 'Datasets Count',
		'certificates_received' => 'Certificates Received',
		'q1_hours' => 'Q1 Hours',
		'q2_hours' => 'Q2 Hours',
		'q3_hours' => 'Q3 Hours',
		'q4_hours' => 'Q4 Hours',
		'total_hours' => 'Total Hours',
		'percent_allocation' => 'Percent Allocation',
		'last_updated' => 'Last Updated',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'extended_id' => '',
		'project_id' => '',
		'client' => '',
		'sector_id' => '',
		'budget_spent' => '',
		'remaining_budget' => '',
		'burn_rate_percentage' => '',
		'profit_margin_percentage' => '',
		'vat_collected' => '',
		'client_satisfaction_rating' => '',
		'next_milestone_date' => '',
		'percent_complete' => '',
		'on_time_status' => '',
		'on_budget_status' => '',
		'deliverables_met' => '',
		'total_deliverables' => '',
		'publications_count' => '',
		'datasets_count' => '',
		'certificates_received' => '',
		'q1_hours' => '',
		'q2_hours' => '',
		'q3_hours' => '',
		'q4_hours' => '',
		'total_hours' => '',
		'percent_allocation' => '',
		'last_updated' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'extended_id' => '',
		'project_id' => '',
		'client' => '',
		'sector_id' => '',
		'budget_spent' => '',
		'remaining_budget' => '',
		'burn_rate_percentage' => '',
		'profit_margin_percentage' => '',
		'vat_collected' => '',
		'client_satisfaction_rating' => '',
		'next_milestone_date' => '',
		'percent_complete' => '',
		'on_time_status' => '',
		'on_budget_status' => '',
		'deliverables_met' => '',
		'total_deliverables' => '',
		'publications_count' => '',
		'datasets_count' => '',
		'certificates_received' => '',
		'q1_hours' => '',
		'q2_hours' => '',
		'q3_hours' => '',
		'q4_hours' => '',
		'total_hours' => '',
		'percent_allocation' => '',
		'last_updated' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>