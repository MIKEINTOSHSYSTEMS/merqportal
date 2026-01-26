<?php
global $runnerTableSettings;
$runnerTableSettings['mne_knowledge_outputs'] = array(
	'name' => 'mne_knowledge_outputs',
	'shortName' => 'mne_knowledge_outputs',
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
	'afterEditDetails' => 'mne_knowledge_outputs',
	'afterAddDetail' => 'mne_knowledge_outputs',
	'detailsBadgeColor' => 'b22222',
	'sql' => 'SELECT
	output_id,
	output_type,
	target_count,
	actual_count,
	achievement_percentage,
	cumulative_count,
	report_period,
	created_at,
	updated_at
FROM
	mne_knowledge_outputs',
	'keyFields' => array( 
		'output_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'output_id' => array(
			'name' => 'output_id',
			'goodName' => 'output_id',
			'strField' => 'output_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'output_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_knowledge_outputs' 
		),
		'output_type' => array(
			'name' => 'output_type',
			'goodName' => 'output_type',
			'strField' => 'output_type',
			'index' => 2,
			'sqlExpression' => 'output_type',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_knowledge_outputs' 
		),
		'target_count' => array(
			'name' => 'target_count',
			'goodName' => 'target_count',
			'strField' => 'target_count',
			'index' => 3,
			'type' => 3,
			'sqlExpression' => 'target_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_knowledge_outputs' 
		),
		'actual_count' => array(
			'name' => 'actual_count',
			'goodName' => 'actual_count',
			'strField' => 'actual_count',
			'index' => 4,
			'type' => 3,
			'sqlExpression' => 'actual_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_knowledge_outputs' 
		),
		'achievement_percentage' => array(
			'name' => 'achievement_percentage',
			'goodName' => 'achievement_percentage',
			'strField' => 'achievement_percentage',
			'index' => 5,
			'type' => 14,
			'sqlExpression' => 'achievement_percentage',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_knowledge_outputs' 
		),
		'cumulative_count' => array(
			'name' => 'cumulative_count',
			'goodName' => 'cumulative_count',
			'strField' => 'cumulative_count',
			'index' => 6,
			'type' => 3,
			'sqlExpression' => 'cumulative_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_knowledge_outputs' 
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
			'tableName' => 'mne_knowledge_outputs' 
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
			'tableName' => 'mne_knowledge_outputs' 
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
			'tableName' => 'mne_knowledge_outputs' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	output_id,
	output_type,
	target_count,
	actual_count,
	achievement_percentage,
	cumulative_count,
	report_period,
	created_at,
	updated_at
FROM
	mne_knowledge_outputs',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'output_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_knowledge_outputs',
					'name' => 'output_id' 
				),
				'encrypted' => false,
				'columnName' => 'output_id' 
			),
			array(
				'sql' => 'output_type',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_knowledge_outputs',
					'name' => 'output_type' 
				),
				'encrypted' => false,
				'columnName' => 'output_type' 
			),
			array(
				'sql' => 'target_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_knowledge_outputs',
					'name' => 'target_count' 
				),
				'encrypted' => false,
				'columnName' => 'target_count' 
			),
			array(
				'sql' => 'actual_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_knowledge_outputs',
					'name' => 'actual_count' 
				),
				'encrypted' => false,
				'columnName' => 'actual_count' 
			),
			array(
				'sql' => 'achievement_percentage',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_knowledge_outputs',
					'name' => 'achievement_percentage' 
				),
				'encrypted' => false,
				'columnName' => 'achievement_percentage' 
			),
			array(
				'sql' => 'cumulative_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_knowledge_outputs',
					'name' => 'cumulative_count' 
				),
				'encrypted' => false,
				'columnName' => 'cumulative_count' 
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
					'table' => 'mne_knowledge_outputs',
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
					'table' => 'mne_knowledge_outputs',
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
					'table' => 'mne_knowledge_outputs',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_knowledge_outputs',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_knowledge_outputs',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'output_id',
						'output_type',
						'target_count',
						'actual_count',
						'achievement_percentage',
						'cumulative_count',
						'report_period',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_knowledge_outputs' 
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
		'fieldListSql' => 'output_id,
	output_type,
	target_count,
	actual_count,
	achievement_percentage,
	cumulative_count,
	report_period,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_knowledge_outputs',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_knowledge_outputs',
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
			'output_id',
			'output_type',
			'target_count',
			'actual_count',
			'achievement_percentage',
			'cumulative_count',
			'report_period',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'output_id',
			'output_type',
			'target_count',
			'actual_count',
			'achievement_percentage',
			'cumulative_count',
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
	$runnerTableLabels['mne_knowledge_outputs'] = array(
	'tableCaption' => 'Mne Knowledge Outputs',
	'fieldLabels' => array(
		'output_id' => 'Output Id',
		'output_type' => 'Output Type',
		'target_count' => 'Target Count',
		'actual_count' => 'Actual Count',
		'achievement_percentage' => 'Achievement Percentage',
		'cumulative_count' => 'Cumulative Count',
		'report_period' => 'Report Period',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'output_id' => '',
		'output_type' => '',
		'target_count' => '',
		'actual_count' => '',
		'achievement_percentage' => '',
		'cumulative_count' => '',
		'report_period' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'output_id' => '',
		'output_type' => '',
		'target_count' => '',
		'actual_count' => '',
		'achievement_percentage' => '',
		'cumulative_count' => '',
		'report_period' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>