<?php
global $runnerTableSettings;
$runnerTableSettings['mne_executive_dashboard'] = array(
	'name' => 'mne_executive_dashboard',
	'shortName' => 'mne_executive_dashboard',
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
	'afterEditDetails' => 'mne_executive_dashboard',
	'afterAddDetail' => 'mne_executive_dashboard',
	'detailsBadgeColor' => '8fbc8b',
	'sql' => 'SELECT
	dashboard_id,
	report_date,
	key_metric,
	target_value,
	actual_value,
	`variance`,
	status_indicator,
	trend,
	last_period_value,
	created_at,
	updated_at
FROM
	mne_executive_dashboard',
	'keyFields' => array( 
		'dashboard_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'dashboard_id' => array(
			'name' => 'dashboard_id',
			'goodName' => 'dashboard_id',
			'strField' => 'dashboard_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'dashboard_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_executive_dashboard' 
		),
		'report_date' => array(
			'name' => 'report_date',
			'goodName' => 'report_date',
			'strField' => 'report_date',
			'index' => 2,
			'type' => 7,
			'sqlExpression' => 'report_date',
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
			'tableName' => 'mne_executive_dashboard' 
		),
		'key_metric' => array(
			'name' => 'key_metric',
			'goodName' => 'key_metric',
			'strField' => 'key_metric',
			'index' => 3,
			'sqlExpression' => 'key_metric',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_executive_dashboard' 
		),
		'target_value' => array(
			'name' => 'target_value',
			'goodName' => 'target_value',
			'strField' => 'target_value',
			'index' => 4,
			'type' => 14,
			'sqlExpression' => 'target_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_executive_dashboard' 
		),
		'actual_value' => array(
			'name' => 'actual_value',
			'goodName' => 'actual_value',
			'strField' => 'actual_value',
			'index' => 5,
			'type' => 14,
			'sqlExpression' => 'actual_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_executive_dashboard' 
		),
		'variance' => array(
			'name' => 'variance',
			'goodName' => 'variance',
			'strField' => 'variance',
			'index' => 6,
			'type' => 14,
			'sqlExpression' => '`variance`',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_executive_dashboard' 
		),
		'status_indicator' => array(
			'name' => 'status_indicator',
			'goodName' => 'status_indicator',
			'strField' => 'status_indicator',
			'index' => 7,
			'sqlExpression' => 'status_indicator',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_executive_dashboard' 
		),
		'trend' => array(
			'name' => 'trend',
			'goodName' => 'trend',
			'strField' => 'trend',
			'index' => 8,
			'type' => 129,
			'sqlExpression' => 'trend',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'▲',
						'▼',
						'→' 
					) 
				) 
			),
			'tableName' => 'mne_executive_dashboard' 
		),
		'last_period_value' => array(
			'name' => 'last_period_value',
			'goodName' => 'last_period_value',
			'strField' => 'last_period_value',
			'index' => 9,
			'type' => 14,
			'sqlExpression' => 'last_period_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_executive_dashboard' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 10,
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
			'tableName' => 'mne_executive_dashboard' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 11,
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
			'tableName' => 'mne_executive_dashboard' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	dashboard_id,
	report_date,
	key_metric,
	target_value,
	actual_value,
	`variance`,
	status_indicator,
	trend,
	last_period_value,
	created_at,
	updated_at
FROM
	mne_executive_dashboard',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'dashboard_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_executive_dashboard',
					'name' => 'dashboard_id' 
				),
				'encrypted' => false,
				'columnName' => 'dashboard_id' 
			),
			array(
				'sql' => 'report_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_executive_dashboard',
					'name' => 'report_date' 
				),
				'encrypted' => false,
				'columnName' => 'report_date' 
			),
			array(
				'sql' => 'key_metric',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_executive_dashboard',
					'name' => 'key_metric' 
				),
				'encrypted' => false,
				'columnName' => 'key_metric' 
			),
			array(
				'sql' => 'target_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_executive_dashboard',
					'name' => 'target_value' 
				),
				'encrypted' => false,
				'columnName' => 'target_value' 
			),
			array(
				'sql' => 'actual_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_executive_dashboard',
					'name' => 'actual_value' 
				),
				'encrypted' => false,
				'columnName' => 'actual_value' 
			),
			array(
				'sql' => '`variance`',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_executive_dashboard',
					'name' => 'variance' 
				),
				'encrypted' => false,
				'columnName' => 'variance' 
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
					'table' => 'mne_executive_dashboard',
					'name' => 'status_indicator' 
				),
				'encrypted' => false,
				'columnName' => 'status_indicator' 
			),
			array(
				'sql' => 'trend',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_executive_dashboard',
					'name' => 'trend' 
				),
				'encrypted' => false,
				'columnName' => 'trend' 
			),
			array(
				'sql' => 'last_period_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_executive_dashboard',
					'name' => 'last_period_value' 
				),
				'encrypted' => false,
				'columnName' => 'last_period_value' 
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
					'table' => 'mne_executive_dashboard',
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
					'table' => 'mne_executive_dashboard',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_executive_dashboard',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_executive_dashboard',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'dashboard_id',
						'report_date',
						'key_metric',
						'target_value',
						'actual_value',
						'variance',
						'status_indicator',
						'trend',
						'last_period_value',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_executive_dashboard' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'dashboard_id,
	report_date,
	key_metric,
	target_value,
	actual_value,
	`variance`,
	status_indicator,
	trend,
	last_period_value,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_executive_dashboard',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_executive_dashboard',
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
			'dashboard_id',
			'report_date',
			'key_metric',
			'target_value',
			'actual_value',
			'variance',
			'status_indicator',
			'trend',
			'last_period_value',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'dashboard_id',
			'report_date',
			'key_metric',
			'target_value',
			'actual_value',
			'variance',
			'status_indicator',
			'trend',
			'last_period_value',
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
	$runnerTableLabels['mne_executive_dashboard'] = array(
	'tableCaption' => 'Mne Executive Dashboard',
	'fieldLabels' => array(
		'dashboard_id' => 'Dashboard Id',
		'report_date' => 'Report Date',
		'key_metric' => 'Key Metric',
		'target_value' => 'Target Value',
		'actual_value' => 'Actual Value',
		'variance' => 'Variance',
		'status_indicator' => 'Status Indicator',
		'trend' => 'Trend',
		'last_period_value' => 'Last Period Value',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'dashboard_id' => '',
		'report_date' => '',
		'key_metric' => '',
		'target_value' => '',
		'actual_value' => '',
		'variance' => '',
		'status_indicator' => '',
		'trend' => '',
		'last_period_value' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'dashboard_id' => '',
		'report_date' => '',
		'key_metric' => '',
		'target_value' => '',
		'actual_value' => '',
		'variance' => '',
		'status_indicator' => '',
		'trend' => '',
		'last_period_value' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>