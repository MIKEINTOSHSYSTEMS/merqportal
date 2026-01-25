<?php
global $runnerTableSettings;
$runnerTableSettings['mne_opportunity_metrics'] = array(
	'name' => 'mne_opportunity_metrics',
	'shortName' => 'mne_opportunity_metrics',
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
	'afterEditDetails' => 'mne_opportunity_metrics',
	'afterAddDetail' => 'mne_opportunity_metrics',
	'detailsBadgeColor' => 'e07878',
	'sql' => 'SELECT
	metric_id,
	calculation_period,
	metric_name,
	this_period_value,
	ytd_value,
	target_value,
	achievement,
	created_at,
	updated_at
FROM
	mne_opportunity_metrics',
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
			'tableName' => 'mne_opportunity_metrics' 
		),
		'calculation_period' => array(
			'name' => 'calculation_period',
			'goodName' => 'calculation_period',
			'strField' => 'calculation_period',
			'index' => 2,
			'sqlExpression' => 'calculation_period',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_opportunity_metrics' 
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
			'tableName' => 'mne_opportunity_metrics' 
		),
		'this_period_value' => array(
			'name' => 'this_period_value',
			'goodName' => 'this_period_value',
			'strField' => 'this_period_value',
			'index' => 4,
			'type' => 14,
			'sqlExpression' => 'this_period_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_opportunity_metrics' 
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
			'tableName' => 'mne_opportunity_metrics' 
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
			'tableName' => 'mne_opportunity_metrics' 
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
			'tableName' => 'mne_opportunity_metrics' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 8,
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
			'tableName' => 'mne_opportunity_metrics' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 9,
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
			'tableName' => 'mne_opportunity_metrics' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	metric_id,
	calculation_period,
	metric_name,
	this_period_value,
	ytd_value,
	target_value,
	achievement,
	created_at,
	updated_at
FROM
	mne_opportunity_metrics',
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
					'table' => 'mne_opportunity_metrics',
					'name' => 'metric_id' 
				),
				'encrypted' => false,
				'columnName' => 'metric_id' 
			),
			array(
				'sql' => 'calculation_period',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_opportunity_metrics',
					'name' => 'calculation_period' 
				),
				'encrypted' => false,
				'columnName' => 'calculation_period' 
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
					'table' => 'mne_opportunity_metrics',
					'name' => 'metric_name' 
				),
				'encrypted' => false,
				'columnName' => 'metric_name' 
			),
			array(
				'sql' => 'this_period_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_opportunity_metrics',
					'name' => 'this_period_value' 
				),
				'encrypted' => false,
				'columnName' => 'this_period_value' 
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
					'table' => 'mne_opportunity_metrics',
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
					'table' => 'mne_opportunity_metrics',
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
					'table' => 'mne_opportunity_metrics',
					'name' => 'achievement' 
				),
				'encrypted' => false,
				'columnName' => 'achievement' 
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
					'table' => 'mne_opportunity_metrics',
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
					'table' => 'mne_opportunity_metrics',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_opportunity_metrics',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_opportunity_metrics',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'metric_id',
						'calculation_period',
						'metric_name',
						'this_period_value',
						'ytd_value',
						'target_value',
						'achievement',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_opportunity_metrics' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'metric_id,
	calculation_period,
	metric_name,
	this_period_value,
	ytd_value,
	target_value,
	achievement,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_opportunity_metrics',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_opportunity_metrics',
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
			'calculation_period',
			'metric_name',
			'this_period_value',
			'ytd_value',
			'target_value',
			'achievement',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'metric_id',
			'calculation_period',
			'metric_name',
			'this_period_value',
			'ytd_value',
			'target_value',
			'achievement',
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
	$runnerTableLabels['mne_opportunity_metrics'] = array(
	'tableCaption' => 'Mne Opportunity Metrics',
	'fieldLabels' => array(
		'metric_id' => 'Metric Id',
		'calculation_period' => 'Calculation Period',
		'metric_name' => 'Metric Name',
		'this_period_value' => 'This Period Value',
		'ytd_value' => 'Ytd Value',
		'target_value' => 'Target Value',
		'achievement' => 'Achievement',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'metric_id' => '',
		'calculation_period' => '',
		'metric_name' => '',
		'this_period_value' => '',
		'ytd_value' => '',
		'target_value' => '',
		'achievement' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'metric_id' => '',
		'calculation_period' => '',
		'metric_name' => '',
		'this_period_value' => '',
		'ytd_value' => '',
		'target_value' => '',
		'achievement' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>