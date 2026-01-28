<?php
global $runnerTableSettings;
$runnerTableSettings['mne_analysis_by_source'] = array(
	'name' => 'mne_analysis_by_source',
	'shortName' => 'mne_analysis_by_source',
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
	'afterEditDetails' => 'mne_analysis_by_source',
	'afterAddDetail' => 'mne_analysis_by_source',
	'detailsBadgeColor' => 'e67349',
	'displayLoading' => true,
	'sql' => 'SELECT
	analysis_id,
	source_type,
	`count`,
	won_count,
	win_rate,
	total_value,
	report_period,
	created_at,
	updated_at
FROM
	mne_analysis_by_source',
	'keyFields' => array( 
		'analysis_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'analysis_id' => array(
			'name' => 'analysis_id',
			'goodName' => 'analysis_id',
			'strField' => 'analysis_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'analysis_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_analysis_by_source' 
		),
		'source_type' => array(
			'name' => 'source_type',
			'goodName' => 'source_type',
			'strField' => 'source_type',
			'index' => 2,
			'sqlExpression' => 'source_type',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_analysis_by_source' 
		),
		'count' => array(
			'name' => 'count',
			'goodName' => 'count',
			'strField' => 'count',
			'index' => 3,
			'type' => 3,
			'sqlExpression' => '`count`',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_analysis_by_source' 
		),
		'won_count' => array(
			'name' => 'won_count',
			'goodName' => 'won_count',
			'strField' => 'won_count',
			'index' => 4,
			'type' => 3,
			'sqlExpression' => 'won_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_analysis_by_source' 
		),
		'win_rate' => array(
			'name' => 'win_rate',
			'goodName' => 'win_rate',
			'strField' => 'win_rate',
			'index' => 5,
			'type' => 14,
			'sqlExpression' => 'win_rate',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_analysis_by_source' 
		),
		'total_value' => array(
			'name' => 'total_value',
			'goodName' => 'total_value',
			'strField' => 'total_value',
			'index' => 6,
			'type' => 14,
			'sqlExpression' => 'total_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_analysis_by_source' 
		),
		'report_period' => array(
			'name' => 'report_period',
			'goodName' => 'report_period',
			'strField' => 'report_period',
			'index' => 7,
			'sqlExpression' => 'report_period',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_analysis_by_source' 
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
			'tableName' => 'mne_analysis_by_source' 
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
			'tableName' => 'mne_analysis_by_source' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	analysis_id,
	source_type,
	`count`,
	won_count,
	win_rate,
	total_value,
	report_period,
	created_at,
	updated_at
FROM
	mne_analysis_by_source',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'analysis_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_analysis_by_source',
					'name' => 'analysis_id' 
				),
				'encrypted' => false,
				'columnName' => 'analysis_id' 
			),
			array(
				'sql' => 'source_type',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_analysis_by_source',
					'name' => 'source_type' 
				),
				'encrypted' => false,
				'columnName' => 'source_type' 
			),
			array(
				'sql' => '`count`',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_analysis_by_source',
					'name' => 'count' 
				),
				'encrypted' => false,
				'columnName' => 'count' 
			),
			array(
				'sql' => 'won_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_analysis_by_source',
					'name' => 'won_count' 
				),
				'encrypted' => false,
				'columnName' => 'won_count' 
			),
			array(
				'sql' => 'win_rate',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_analysis_by_source',
					'name' => 'win_rate' 
				),
				'encrypted' => false,
				'columnName' => 'win_rate' 
			),
			array(
				'sql' => 'total_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_analysis_by_source',
					'name' => 'total_value' 
				),
				'encrypted' => false,
				'columnName' => 'total_value' 
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
					'table' => 'mne_analysis_by_source',
					'name' => 'report_period' 
				),
				'encrypted' => false,
				'columnName' => 'report_period' 
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
					'table' => 'mne_analysis_by_source',
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
					'table' => 'mne_analysis_by_source',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_analysis_by_source',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_analysis_by_source',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'analysis_id',
						'source_type',
						'count',
						'won_count',
						'win_rate',
						'total_value',
						'report_period',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_analysis_by_source' 
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
		'fieldListSql' => 'analysis_id,
	source_type,
	`count`,
	won_count,
	win_rate,
	total_value,
	report_period,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_analysis_by_source',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_analysis_by_source',
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
			'analysis_id',
			'source_type',
			'count',
			'won_count',
			'win_rate',
			'total_value',
			'report_period',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'analysis_id',
			'source_type',
			'count',
			'won_count',
			'win_rate',
			'total_value',
			'report_period',
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
	$runnerTableLabels['mne_analysis_by_source'] = array(
	'tableCaption' => 'Mne Analysis By Source',
	'fieldLabels' => array(
		'analysis_id' => 'Analysis Id',
		'source_type' => 'Source Type',
		'count' => 'Count',
		'won_count' => 'Won Count',
		'win_rate' => 'Win Rate',
		'total_value' => 'Total Value',
		'report_period' => 'Report Period',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'analysis_id' => '',
		'source_type' => '',
		'count' => '',
		'won_count' => '',
		'win_rate' => '',
		'total_value' => '',
		'report_period' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'analysis_id' => '',
		'source_type' => '',
		'count' => '',
		'won_count' => '',
		'win_rate' => '',
		'total_value' => '',
		'report_period' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>