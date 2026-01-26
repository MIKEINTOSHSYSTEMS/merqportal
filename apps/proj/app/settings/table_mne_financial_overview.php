<?php
global $runnerTableSettings;
$runnerTableSettings['mne_financial_overview'] = array(
	'name' => 'mne_financial_overview',
	'shortName' => 'mne_financial_overview',
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
	'audit' => true,
	'afterEditDetails' => 'mne_financial_overview',
	'afterAddDetail' => 'mne_financial_overview',
	'detailsBadgeColor' => '00c2c5',
	'sql' => 'SELECT
	financial_overview_id,
	report_period,
	metric_name,
	planned_amount,
	actual_amount,
	variance_amount,
	variance_percentage,
	status_indicator,
	created_at,
	updated_at
FROM
	mne_financial_overview',
	'keyFields' => array( 
		'financial_overview_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'financial_overview_id' => array(
			'name' => 'financial_overview_id',
			'goodName' => 'financial_overview_id',
			'strField' => 'financial_overview_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'financial_overview_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_financial_overview' 
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
			'tableName' => 'mne_financial_overview' 
		),
		'metric_name' => array(
			'name' => 'metric_name',
			'goodName' => 'metric_name',
			'strField' => 'metric_name',
			'index' => 3,
			'sqlExpression' => 'metric_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_financial_overview' 
		),
		'planned_amount' => array(
			'name' => 'planned_amount',
			'goodName' => 'planned_amount',
			'strField' => 'planned_amount',
			'index' => 4,
			'type' => 14,
			'sqlExpression' => 'planned_amount',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_financial_overview' 
		),
		'actual_amount' => array(
			'name' => 'actual_amount',
			'goodName' => 'actual_amount',
			'strField' => 'actual_amount',
			'index' => 5,
			'type' => 14,
			'sqlExpression' => 'actual_amount',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_financial_overview' 
		),
		'variance_amount' => array(
			'name' => 'variance_amount',
			'goodName' => 'variance_amount',
			'strField' => 'variance_amount',
			'index' => 6,
			'type' => 14,
			'sqlExpression' => 'variance_amount',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_financial_overview' 
		),
		'variance_percentage' => array(
			'name' => 'variance_percentage',
			'goodName' => 'variance_percentage',
			'strField' => 'variance_percentage',
			'index' => 7,
			'type' => 14,
			'sqlExpression' => 'variance_percentage',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_financial_overview' 
		),
		'status_indicator' => array(
			'name' => 'status_indicator',
			'goodName' => 'status_indicator',
			'strField' => 'status_indicator',
			'index' => 8,
			'sqlExpression' => 'status_indicator',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_financial_overview' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 9,
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
			'tableName' => 'mne_financial_overview' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 10,
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
			'tableName' => 'mne_financial_overview' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	financial_overview_id,
	report_period,
	metric_name,
	planned_amount,
	actual_amount,
	variance_amount,
	variance_percentage,
	status_indicator,
	created_at,
	updated_at
FROM
	mne_financial_overview',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'financial_overview_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_financial_overview',
					'name' => 'financial_overview_id' 
				),
				'encrypted' => false,
				'columnName' => 'financial_overview_id' 
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
					'table' => 'mne_financial_overview',
					'name' => 'report_period' 
				),
				'encrypted' => false,
				'columnName' => 'report_period' 
			),
			array(
				'sql' => 'metric_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_financial_overview',
					'name' => 'metric_name' 
				),
				'encrypted' => false,
				'columnName' => 'metric_name' 
			),
			array(
				'sql' => 'planned_amount',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_financial_overview',
					'name' => 'planned_amount' 
				),
				'encrypted' => false,
				'columnName' => 'planned_amount' 
			),
			array(
				'sql' => 'actual_amount',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_financial_overview',
					'name' => 'actual_amount' 
				),
				'encrypted' => false,
				'columnName' => 'actual_amount' 
			),
			array(
				'sql' => 'variance_amount',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_financial_overview',
					'name' => 'variance_amount' 
				),
				'encrypted' => false,
				'columnName' => 'variance_amount' 
			),
			array(
				'sql' => 'variance_percentage',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_financial_overview',
					'name' => 'variance_percentage' 
				),
				'encrypted' => false,
				'columnName' => 'variance_percentage' 
			),
			array(
				'sql' => 'status_indicator',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_financial_overview',
					'name' => 'status_indicator' 
				),
				'encrypted' => false,
				'columnName' => 'status_indicator' 
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
					'table' => 'mne_financial_overview',
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
					'table' => 'mne_financial_overview',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_financial_overview',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_financial_overview',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'financial_overview_id',
						'report_period',
						'metric_name',
						'planned_amount',
						'actual_amount',
						'variance_amount',
						'variance_percentage',
						'status_indicator',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_financial_overview' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'financial_overview_id,
	report_period,
	metric_name,
	planned_amount,
	actual_amount,
	variance_amount,
	variance_percentage,
	status_indicator,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_financial_overview',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_financial_overview',
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
			'financial_overview_id',
			'report_period',
			'metric_name',
			'planned_amount',
			'actual_amount',
			'variance_amount',
			'variance_percentage',
			'status_indicator',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'financial_overview_id',
			'report_period',
			'metric_name',
			'planned_amount',
			'actual_amount',
			'variance_amount',
			'variance_percentage',
			'status_indicator',
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
	$runnerTableLabels['mne_financial_overview'] = array(
	'tableCaption' => 'Mne Financial Overview',
	'fieldLabels' => array(
		'financial_overview_id' => 'Financial Overview Id',
		'report_period' => 'Report Period',
		'metric_name' => 'Metric Name',
		'planned_amount' => 'Planned Amount',
		'actual_amount' => 'Actual Amount',
		'variance_amount' => 'Variance Amount',
		'variance_percentage' => 'Variance Percentage',
		'status_indicator' => 'Status Indicator',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'financial_overview_id' => '',
		'report_period' => '',
		'metric_name' => '',
		'planned_amount' => '',
		'actual_amount' => '',
		'variance_amount' => '',
		'variance_percentage' => '',
		'status_indicator' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'financial_overview_id' => '',
		'report_period' => '',
		'metric_name' => '',
		'planned_amount' => '',
		'actual_amount' => '',
		'variance_amount' => '',
		'variance_percentage' => '',
		'status_indicator' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>