<?php
global $runnerTableSettings;
$runnerTableSettings['mne_business_performance'] = array(
	'name' => 'mne_business_performance',
	'shortName' => 'mne_business_performance',
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
	'afterEditDetails' => 'mne_business_performance',
	'afterAddDetail' => 'mne_business_performance',
	'detailsBadgeColor' => '778899',
	'sql' => 'SELECT
	performance_id,
	report_period,
	metric_name,
	quarter_value,
	ytd_value,
	target_value,
	achievement,
	status_indicator,
	created_at,
	updated_at
FROM
	mne_business_performance',
	'keyFields' => array( 
		'performance_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'performance_id' => array(
			'name' => 'performance_id',
			'goodName' => 'performance_id',
			'strField' => 'performance_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'performance_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_performance' 
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
			'tableName' => 'mne_business_performance' 
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
			'tableName' => 'mne_business_performance' 
		),
		'quarter_value' => array(
			'name' => 'quarter_value',
			'goodName' => 'quarter_value',
			'strField' => 'quarter_value',
			'index' => 4,
			'type' => 14,
			'sqlExpression' => 'quarter_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_performance' 
		),
		'ytd_value' => array(
			'name' => 'ytd_value',
			'goodName' => 'ytd_value',
			'strField' => 'ytd_value',
			'index' => 5,
			'type' => 14,
			'sqlExpression' => 'ytd_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_performance' 
		),
		'target_value' => array(
			'name' => 'target_value',
			'goodName' => 'target_value',
			'strField' => 'target_value',
			'index' => 6,
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
			'tableName' => 'mne_business_performance' 
		),
		'achievement' => array(
			'name' => 'achievement',
			'goodName' => 'achievement',
			'strField' => 'achievement',
			'index' => 7,
			'type' => 14,
			'sqlExpression' => 'achievement',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_performance' 
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
			'tableName' => 'mne_business_performance' 
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
			'tableName' => 'mne_business_performance' 
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
			'tableName' => 'mne_business_performance' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	performance_id,
	report_period,
	metric_name,
	quarter_value,
	ytd_value,
	target_value,
	achievement,
	status_indicator,
	created_at,
	updated_at
FROM
	mne_business_performance',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'performance_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_performance',
					'name' => 'performance_id' 
				),
				'encrypted' => false,
				'columnName' => 'performance_id' 
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
					'table' => 'mne_business_performance',
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
					'table' => 'mne_business_performance',
					'name' => 'metric_name' 
				),
				'encrypted' => false,
				'columnName' => 'metric_name' 
			),
			array(
				'sql' => 'quarter_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_performance',
					'name' => 'quarter_value' 
				),
				'encrypted' => false,
				'columnName' => 'quarter_value' 
			),
			array(
				'sql' => 'ytd_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_performance',
					'name' => 'ytd_value' 
				),
				'encrypted' => false,
				'columnName' => 'ytd_value' 
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
					'table' => 'mne_business_performance',
					'name' => 'target_value' 
				),
				'encrypted' => false,
				'columnName' => 'target_value' 
			),
			array(
				'sql' => 'achievement',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_performance',
					'name' => 'achievement' 
				),
				'encrypted' => false,
				'columnName' => 'achievement' 
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
					'table' => 'mne_business_performance',
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
					'table' => 'mne_business_performance',
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
					'table' => 'mne_business_performance',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_business_performance',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_business_performance',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'performance_id',
						'report_period',
						'metric_name',
						'quarter_value',
						'ytd_value',
						'target_value',
						'achievement',
						'status_indicator',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_business_performance' 
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
		'fieldListSql' => 'performance_id,
	report_period,
	metric_name,
	quarter_value,
	ytd_value,
	target_value,
	achievement,
	status_indicator,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_business_performance',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_business_performance',
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
			'performance_id',
			'report_period',
			'metric_name',
			'quarter_value',
			'ytd_value',
			'target_value',
			'achievement',
			'status_indicator',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'performance_id',
			'report_period',
			'metric_name',
			'quarter_value',
			'ytd_value',
			'target_value',
			'achievement',
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
	$runnerTableLabels['mne_business_performance'] = array(
	'tableCaption' => 'Mne Business Performance',
	'fieldLabels' => array(
		'performance_id' => 'Performance Id',
		'report_period' => 'Report Period',
		'metric_name' => 'Metric Name',
		'quarter_value' => 'Quarter Value',
		'ytd_value' => 'Ytd Value',
		'target_value' => 'Target Value',
		'achievement' => 'Achievement',
		'status_indicator' => 'Status Indicator',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'performance_id' => '',
		'report_period' => '',
		'metric_name' => '',
		'quarter_value' => '',
		'ytd_value' => '',
		'target_value' => '',
		'achievement' => '',
		'status_indicator' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'performance_id' => '',
		'report_period' => '',
		'metric_name' => '',
		'quarter_value' => '',
		'ytd_value' => '',
		'target_value' => '',
		'achievement' => '',
		'status_indicator' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>