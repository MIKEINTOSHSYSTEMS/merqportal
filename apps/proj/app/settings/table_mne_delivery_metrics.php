<?php
global $runnerTableSettings;
$runnerTableSettings['mne_delivery_metrics'] = array(
	'name' => 'mne_delivery_metrics',
	'shortName' => 'mne_delivery_metrics',
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
	'afterEditDetails' => 'mne_delivery_metrics',
	'afterAddDetail' => 'mne_delivery_metrics',
	'detailsBadgeColor' => '00c2c5',
	'sql' => 'SELECT
	metric_id,
	report_period,
	metric_name,
	q1_value,
	q2_value,
	q3_value,
	q4_value,
	ytd_average,
	created_at,
	updated_at
FROM
	mne_delivery_metrics',
	'keyFields' => array( 
		'metric_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'metric_id' => array(
			'name' => 'metric_id',
			'goodName' => 'metric_id',
			'strField' => 'metric_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'metric_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_delivery_metrics' 
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
			'tableName' => 'mne_delivery_metrics' 
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
			'tableName' => 'mne_delivery_metrics' 
		),
		'q1_value' => array(
			'name' => 'q1_value',
			'goodName' => 'q1_value',
			'strField' => 'q1_value',
			'index' => 4,
			'type' => 14,
			'sqlExpression' => 'q1_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_delivery_metrics' 
		),
		'q2_value' => array(
			'name' => 'q2_value',
			'goodName' => 'q2_value',
			'strField' => 'q2_value',
			'index' => 5,
			'type' => 14,
			'sqlExpression' => 'q2_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_delivery_metrics' 
		),
		'q3_value' => array(
			'name' => 'q3_value',
			'goodName' => 'q3_value',
			'strField' => 'q3_value',
			'index' => 6,
			'type' => 14,
			'sqlExpression' => 'q3_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_delivery_metrics' 
		),
		'q4_value' => array(
			'name' => 'q4_value',
			'goodName' => 'q4_value',
			'strField' => 'q4_value',
			'index' => 7,
			'type' => 14,
			'sqlExpression' => 'q4_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_delivery_metrics' 
		),
		'ytd_average' => array(
			'name' => 'ytd_average',
			'goodName' => 'ytd_average',
			'strField' => 'ytd_average',
			'index' => 8,
			'type' => 14,
			'sqlExpression' => 'ytd_average',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_delivery_metrics' 
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
			'tableName' => 'mne_delivery_metrics' 
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
			'tableName' => 'mne_delivery_metrics' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	metric_id,
	report_period,
	metric_name,
	q1_value,
	q2_value,
	q3_value,
	q4_value,
	ytd_average,
	created_at,
	updated_at
FROM
	mne_delivery_metrics',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'metric_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_delivery_metrics',
					'name' => 'metric_id' 
				),
				'encrypted' => false,
				'columnName' => 'metric_id' 
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
					'table' => 'mne_delivery_metrics',
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
					'table' => 'mne_delivery_metrics',
					'name' => 'metric_name' 
				),
				'encrypted' => false,
				'columnName' => 'metric_name' 
			),
			array(
				'sql' => 'q1_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_delivery_metrics',
					'name' => 'q1_value' 
				),
				'encrypted' => false,
				'columnName' => 'q1_value' 
			),
			array(
				'sql' => 'q2_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_delivery_metrics',
					'name' => 'q2_value' 
				),
				'encrypted' => false,
				'columnName' => 'q2_value' 
			),
			array(
				'sql' => 'q3_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_delivery_metrics',
					'name' => 'q3_value' 
				),
				'encrypted' => false,
				'columnName' => 'q3_value' 
			),
			array(
				'sql' => 'q4_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_delivery_metrics',
					'name' => 'q4_value' 
				),
				'encrypted' => false,
				'columnName' => 'q4_value' 
			),
			array(
				'sql' => 'ytd_average',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_delivery_metrics',
					'name' => 'ytd_average' 
				),
				'encrypted' => false,
				'columnName' => 'ytd_average' 
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
					'table' => 'mne_delivery_metrics',
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
					'table' => 'mne_delivery_metrics',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_delivery_metrics',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_delivery_metrics',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'metric_id',
						'report_period',
						'metric_name',
						'q1_value',
						'q2_value',
						'q3_value',
						'q4_value',
						'ytd_average',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_delivery_metrics' 
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
		'fieldListSql' => 'metric_id,
	report_period,
	metric_name,
	q1_value,
	q2_value,
	q3_value,
	q4_value,
	ytd_average,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_delivery_metrics',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_delivery_metrics',
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
			'metric_id',
			'report_period',
			'metric_name',
			'q1_value',
			'q2_value',
			'q3_value',
			'q4_value',
			'ytd_average',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'metric_id',
			'report_period',
			'metric_name',
			'q1_value',
			'q2_value',
			'q3_value',
			'q4_value',
			'ytd_average',
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
	$runnerTableLabels['mne_delivery_metrics'] = array(
	'tableCaption' => 'Mne Delivery Metrics',
	'fieldLabels' => array(
		'metric_id' => 'Metric Id',
		'report_period' => 'Report Period',
		'metric_name' => 'Metric Name',
		'q1_value' => 'Q1 Value',
		'q2_value' => 'Q2 Value',
		'q3_value' => 'Q3 Value',
		'q4_value' => 'Q4 Value',
		'ytd_average' => 'Ytd Average',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'metric_id' => '',
		'report_period' => '',
		'metric_name' => '',
		'q1_value' => '',
		'q2_value' => '',
		'q3_value' => '',
		'q4_value' => '',
		'ytd_average' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'metric_id' => '',
		'report_period' => '',
		'metric_name' => '',
		'q1_value' => '',
		'q2_value' => '',
		'q3_value' => '',
		'q4_value' => '',
		'ytd_average' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>