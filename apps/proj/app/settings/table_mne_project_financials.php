<?php
global $runnerTableSettings;
$runnerTableSettings['mne_project_financials'] = array(
	'name' => 'mne_project_financials',
	'shortName' => 'mne_project_financials',
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
	'afterEditDetails' => 'mne_project_financials',
	'afterAddDetail' => 'mne_project_financials',
	'detailsBadgeColor' => 'd2691e',
	'displayLoading' => true,
	'warnLeavingEdit' => true,
	'sql' => 'SELECT
	financial_id,
	project_id,
	total_project_budget,
	amount_spent_to_date,
	remaining_budget,
	burn_rate,
	budget_category,
	allocated_amount,
	spent_amount,
	remaining_amount,
	percent_spent,
	comments,
	target_profit_margin,
	current_profit_margin,
	reporting_period,
	created_at,
	updated_at
FROM
	mne_project_financials',
	'keyFields' => array( 
		'financial_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'financial_id' => array(
			'name' => 'financial_id',
			'goodName' => 'financial_id',
			'strField' => 'financial_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'financial_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_financials' 
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
							'masterField' => 'total_project_budget',
							'lookupField' => 'total_value' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'total_project_budget' => array(
			'name' => 'total_project_budget',
			'goodName' => 'total_project_budget',
			'strField' => 'total_project_budget',
			'index' => 3,
			'type' => 14,
			'sqlExpression' => 'total_project_budget',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Currency' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Currency' 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'amount_spent_to_date' => array(
			'name' => 'amount_spent_to_date',
			'goodName' => 'amount_spent_to_date',
			'strField' => 'amount_spent_to_date',
			'index' => 4,
			'type' => 14,
			'sqlExpression' => 'amount_spent_to_date',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'remaining_budget' => array(
			'name' => 'remaining_budget',
			'goodName' => 'remaining_budget',
			'strField' => 'remaining_budget',
			'index' => 5,
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
			'tableName' => 'mne_project_financials' 
		),
		'burn_rate' => array(
			'name' => 'burn_rate',
			'goodName' => 'burn_rate',
			'strField' => 'burn_rate',
			'index' => 6,
			'type' => 14,
			'sqlExpression' => 'burn_rate',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'budget_category' => array(
			'name' => 'budget_category',
			'goodName' => 'budget_category',
			'strField' => 'budget_category',
			'index' => 7,
			'sqlExpression' => 'budget_category',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_budget_category',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'category_id',
					'lookupDisplayField' => 'category_name' 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'allocated_amount' => array(
			'name' => 'allocated_amount',
			'goodName' => 'allocated_amount',
			'strField' => 'allocated_amount',
			'index' => 8,
			'type' => 14,
			'sqlExpression' => 'allocated_amount',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Currency' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Currency' 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'spent_amount' => array(
			'name' => 'spent_amount',
			'goodName' => 'spent_amount',
			'strField' => 'spent_amount',
			'index' => 9,
			'type' => 14,
			'sqlExpression' => 'spent_amount',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Currency' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Currency' 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'remaining_amount' => array(
			'name' => 'remaining_amount',
			'goodName' => 'remaining_amount',
			'strField' => 'remaining_amount',
			'index' => 10,
			'type' => 14,
			'sqlExpression' => 'remaining_amount',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Currency' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Currency' 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'percent_spent' => array(
			'name' => 'percent_spent',
			'goodName' => 'percent_spent',
			'strField' => 'percent_spent',
			'index' => 11,
			'type' => 14,
			'sqlExpression' => 'percent_spent',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Percent' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Number',
					'textboxMaxLenth' => 3,
					'textHTML5Input' => 'Number' 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'comments' => array(
			'name' => 'comments',
			'goodName' => 'comments',
			'strField' => 'comments',
			'index' => 12,
			'type' => 201,
			'sqlExpression' => 'comments',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'target_profit_margin' => array(
			'name' => 'target_profit_margin',
			'goodName' => 'target_profit_margin',
			'strField' => 'target_profit_margin',
			'index' => 13,
			'type' => 14,
			'sqlExpression' => 'target_profit_margin',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Percent' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Number',
					'textHTML5Input' => 'Number' 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'current_profit_margin' => array(
			'name' => 'current_profit_margin',
			'goodName' => 'current_profit_margin',
			'strField' => 'current_profit_margin',
			'index' => 14,
			'type' => 14,
			'sqlExpression' => 'current_profit_margin',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Percent' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Number',
					'textHTML5Input' => 'Number' 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'reporting_period' => array(
			'name' => 'reporting_period',
			'goodName' => 'reporting_period',
			'strField' => 'reporting_period',
			'index' => 15,
			'sqlExpression' => 'reporting_period',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 16,
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
					'defaultValue' => 'date("Y-m-d H:i:s")',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_project_financials' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 17,
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
					'autoUpdateValue' => 'date("Y-m-d H:i:s")',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_project_financials' 
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
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	financial_id,
	project_id,
	total_project_budget,
	amount_spent_to_date,
	remaining_budget,
	burn_rate,
	budget_category,
	allocated_amount,
	spent_amount,
	remaining_amount,
	percent_spent,
	comments,
	target_profit_margin,
	current_profit_margin,
	reporting_period,
	created_at,
	updated_at
FROM
	mne_project_financials',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'financial_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'financial_id' 
				),
				'encrypted' => false,
				'columnName' => 'financial_id' 
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
					'table' => 'mne_project_financials',
					'name' => 'project_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_id' 
			),
			array(
				'sql' => 'total_project_budget',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'total_project_budget' 
				),
				'encrypted' => false,
				'columnName' => 'total_project_budget' 
			),
			array(
				'sql' => 'amount_spent_to_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'amount_spent_to_date' 
				),
				'encrypted' => false,
				'columnName' => 'amount_spent_to_date' 
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
					'table' => 'mne_project_financials',
					'name' => 'remaining_budget' 
				),
				'encrypted' => false,
				'columnName' => 'remaining_budget' 
			),
			array(
				'sql' => 'burn_rate',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'burn_rate' 
				),
				'encrypted' => false,
				'columnName' => 'burn_rate' 
			),
			array(
				'sql' => 'budget_category',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'budget_category' 
				),
				'encrypted' => false,
				'columnName' => 'budget_category' 
			),
			array(
				'sql' => 'allocated_amount',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'allocated_amount' 
				),
				'encrypted' => false,
				'columnName' => 'allocated_amount' 
			),
			array(
				'sql' => 'spent_amount',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'spent_amount' 
				),
				'encrypted' => false,
				'columnName' => 'spent_amount' 
			),
			array(
				'sql' => 'remaining_amount',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'remaining_amount' 
				),
				'encrypted' => false,
				'columnName' => 'remaining_amount' 
			),
			array(
				'sql' => 'percent_spent',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'percent_spent' 
				),
				'encrypted' => false,
				'columnName' => 'percent_spent' 
			),
			array(
				'sql' => 'comments',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'comments' 
				),
				'encrypted' => false,
				'columnName' => 'comments' 
			),
			array(
				'sql' => 'target_profit_margin',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'target_profit_margin' 
				),
				'encrypted' => false,
				'columnName' => 'target_profit_margin' 
			),
			array(
				'sql' => 'current_profit_margin',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'current_profit_margin' 
				),
				'encrypted' => false,
				'columnName' => 'current_profit_margin' 
			),
			array(
				'sql' => 'reporting_period',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_financials',
					'name' => 'reporting_period' 
				),
				'encrypted' => false,
				'columnName' => 'reporting_period' 
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
					'table' => 'mne_project_financials',
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
					'table' => 'mne_project_financials',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_project_financials',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_project_financials',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
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
					'name' => 'mne_project_financials' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'financial_id,
	project_id,
	total_project_budget,
	amount_spent_to_date,
	remaining_budget,
	burn_rate,
	budget_category,
	allocated_amount,
	spent_amount,
	remaining_amount,
	percent_spent,
	comments,
	target_profit_margin,
	current_profit_margin,
	reporting_period,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_project_financials',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_project_financials',
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
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
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
	$runnerTableLabels['mne_project_financials'] = array(
	'tableCaption' => 'Project Financials',
	'fieldLabels' => array(
		'financial_id' => 'Financial ID',
		'project_id' => 'Project ID',
		'total_project_budget' => 'Total Project Budget',
		'amount_spent_to_date' => 'Amount Spent To Date',
		'remaining_budget' => 'Remaining Budget',
		'burn_rate' => 'Burn Rate',
		'budget_category' => 'Budget Category',
		'allocated_amount' => 'Allocated Amount',
		'spent_amount' => 'Spent Amount',
		'remaining_amount' => 'Remaining Amount',
		'percent_spent' => 'Percent Spent',
		'comments' => 'Comments',
		'target_profit_margin' => 'Target Profit Margin',
		'current_profit_margin' => 'Current Profit Margin',
		'reporting_period' => 'Reporting Period',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'financial_id' => '',
		'project_id' => '',
		'total_project_budget' => '',
		'amount_spent_to_date' => '',
		'remaining_budget' => '',
		'burn_rate' => '',
		'budget_category' => '',
		'allocated_amount' => '',
		'spent_amount' => '',
		'remaining_amount' => '',
		'percent_spent' => '',
		'comments' => '',
		'target_profit_margin' => '',
		'current_profit_margin' => '',
		'reporting_period' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'financial_id' => '',
		'project_id' => '',
		'total_project_budget' => '',
		'amount_spent_to_date' => '',
		'remaining_budget' => '',
		'burn_rate' => '',
		'budget_category' => '',
		'allocated_amount' => '',
		'spent_amount' => '',
		'remaining_amount' => '',
		'percent_spent' => '',
		'comments' => '',
		'target_profit_margin' => '',
		'current_profit_margin' => '',
		'reporting_period' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>