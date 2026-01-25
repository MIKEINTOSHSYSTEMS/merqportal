<?php
global $runnerTableSettings;
$runnerTableSettings['mne_budget_performance'] = array(
	'name' => 'mne_budget_performance',
	'shortName' => 'mne_budget_performance',
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
	'afterEditDetails' => 'mne_budget_performance',
	'afterAddDetail' => 'mne_budget_performance',
	'detailsBadgeColor' => '8fbc8b',
	'sql' => 'SELECT
	budget_perf_id,
	report_period,
	category,
	number_of_projects,
	percentage_of_portfolio,
	created_at,
	updated_at
FROM
	mne_budget_performance',
	'keyFields' => array( 
		'budget_perf_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'budget_perf_id' => array(
			'name' => 'budget_perf_id',
			'goodName' => 'budget_perf_id',
			'strField' => 'budget_perf_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'budget_perf_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_budget_performance' 
		),
		'report_period' => array(
			'name' => 'report_period',
			'goodName' => 'report_period',
			'strField' => 'report_period',
			'index' => 2,
			'sqlExpression' => 'report_period',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_budget_performance' 
		),
		'category' => array(
			'name' => 'category',
			'goodName' => 'category',
			'strField' => 'category',
			'index' => 3,
			'sqlExpression' => 'category',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_budget_performance' 
		),
		'number_of_projects' => array(
			'name' => 'number_of_projects',
			'goodName' => 'number_of_projects',
			'strField' => 'number_of_projects',
			'index' => 4,
			'type' => 3,
			'sqlExpression' => 'number_of_projects',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_budget_performance' 
		),
		'percentage_of_portfolio' => array(
			'name' => 'percentage_of_portfolio',
			'goodName' => 'percentage_of_portfolio',
			'strField' => 'percentage_of_portfolio',
			'index' => 5,
			'type' => 14,
			'sqlExpression' => 'percentage_of_portfolio',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_budget_performance' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 6,
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
			'tableName' => 'mne_budget_performance' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 7,
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
			'tableName' => 'mne_budget_performance' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	budget_perf_id,
	report_period,
	category,
	number_of_projects,
	percentage_of_portfolio,
	created_at,
	updated_at
FROM
	mne_budget_performance',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'budget_perf_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_budget_performance',
					'name' => 'budget_perf_id' 
				),
				'encrypted' => false,
				'columnName' => 'budget_perf_id' 
			),
			array(
				'sql' => 'report_period',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_budget_performance',
					'name' => 'report_period' 
				),
				'encrypted' => false,
				'columnName' => 'report_period' 
			),
			array(
				'sql' => 'category',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_budget_performance',
					'name' => 'category' 
				),
				'encrypted' => false,
				'columnName' => 'category' 
			),
			array(
				'sql' => 'number_of_projects',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_budget_performance',
					'name' => 'number_of_projects' 
				),
				'encrypted' => false,
				'columnName' => 'number_of_projects' 
			),
			array(
				'sql' => 'percentage_of_portfolio',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_budget_performance',
					'name' => 'percentage_of_portfolio' 
				),
				'encrypted' => false,
				'columnName' => 'percentage_of_portfolio' 
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
					'table' => 'mne_budget_performance',
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
					'table' => 'mne_budget_performance',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_budget_performance',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_budget_performance',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'budget_perf_id',
						'report_period',
						'category',
						'number_of_projects',
						'percentage_of_portfolio',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_budget_performance' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'budget_perf_id,
	report_period,
	category,
	number_of_projects,
	percentage_of_portfolio,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_budget_performance',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_budget_performance',
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
			'budget_perf_id',
			'report_period',
			'category',
			'number_of_projects',
			'percentage_of_portfolio',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'budget_perf_id',
			'report_period',
			'category',
			'number_of_projects',
			'percentage_of_portfolio',
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
	$runnerTableLabels['mne_budget_performance'] = array(
	'tableCaption' => 'Mne Budget Performance',
	'fieldLabels' => array(
		'budget_perf_id' => 'Budget Perf Id',
		'report_period' => 'Report Period',
		'category' => 'Category',
		'number_of_projects' => 'Number Of Projects',
		'percentage_of_portfolio' => 'Percentage Of Portfolio',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'budget_perf_id' => '',
		'report_period' => '',
		'category' => '',
		'number_of_projects' => '',
		'percentage_of_portfolio' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'budget_perf_id' => '',
		'report_period' => '',
		'category' => '',
		'number_of_projects' => '',
		'percentage_of_portfolio' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>