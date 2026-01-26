<?php
global $runnerTableSettings;
$runnerTableSettings['mne_win_loss_analysis'] = array(
	'name' => 'mne_win_loss_analysis',
	'shortName' => 'mne_win_loss_analysis',
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
	'afterEditDetails' => 'mne_win_loss_analysis',
	'afterAddDetail' => 'mne_win_loss_analysis',
	'detailsBadgeColor' => '6493ea',
	'sql' => 'SELECT
	analysis_id,
	report_period,
	outcome,
	`count`,
	percentage,
	primary_reason,
	value_amount,
	created_at,
	updated_at
FROM
	mne_win_loss_analysis',
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
			'tableName' => 'mne_win_loss_analysis' 
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
			'tableName' => 'mne_win_loss_analysis' 
		),
		'outcome' => array(
			'name' => 'outcome',
			'goodName' => 'outcome',
			'strField' => 'outcome',
			'index' => 3,
			'type' => 129,
			'sqlExpression' => 'outcome',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Won',
						'Lost',
						'Pending' 
					) 
				) 
			),
			'tableName' => 'mne_win_loss_analysis' 
		),
		'count' => array(
			'name' => 'count',
			'goodName' => 'count',
			'strField' => 'count',
			'index' => 4,
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
			'tableName' => 'mne_win_loss_analysis' 
		),
		'percentage' => array(
			'name' => 'percentage',
			'goodName' => 'percentage',
			'strField' => 'percentage',
			'index' => 5,
			'type' => 14,
			'sqlExpression' => 'percentage',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_win_loss_analysis' 
		),
		'primary_reason' => array(
			'name' => 'primary_reason',
			'goodName' => 'primary_reason',
			'strField' => 'primary_reason',
			'index' => 6,
			'sqlExpression' => 'primary_reason',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_win_loss_analysis' 
		),
		'value_amount' => array(
			'name' => 'value_amount',
			'goodName' => 'value_amount',
			'strField' => 'value_amount',
			'index' => 7,
			'type' => 14,
			'sqlExpression' => 'value_amount',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_win_loss_analysis' 
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
			'tableName' => 'mne_win_loss_analysis' 
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
			'tableName' => 'mne_win_loss_analysis' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	analysis_id,
	report_period,
	outcome,
	`count`,
	percentage,
	primary_reason,
	value_amount,
	created_at,
	updated_at
FROM
	mne_win_loss_analysis',
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
					'table' => 'mne_win_loss_analysis',
					'name' => 'analysis_id' 
				),
				'encrypted' => false,
				'columnName' => 'analysis_id' 
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
					'table' => 'mne_win_loss_analysis',
					'name' => 'report_period' 
				),
				'encrypted' => false,
				'columnName' => 'report_period' 
			),
			array(
				'sql' => 'outcome',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_win_loss_analysis',
					'name' => 'outcome' 
				),
				'encrypted' => false,
				'columnName' => 'outcome' 
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
					'table' => 'mne_win_loss_analysis',
					'name' => 'count' 
				),
				'encrypted' => false,
				'columnName' => 'count' 
			),
			array(
				'sql' => 'percentage',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_win_loss_analysis',
					'name' => 'percentage' 
				),
				'encrypted' => false,
				'columnName' => 'percentage' 
			),
			array(
				'sql' => 'primary_reason',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_win_loss_analysis',
					'name' => 'primary_reason' 
				),
				'encrypted' => false,
				'columnName' => 'primary_reason' 
			),
			array(
				'sql' => 'value_amount',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_win_loss_analysis',
					'name' => 'value_amount' 
				),
				'encrypted' => false,
				'columnName' => 'value_amount' 
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
					'table' => 'mne_win_loss_analysis',
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
					'table' => 'mne_win_loss_analysis',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_win_loss_analysis',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_win_loss_analysis',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'analysis_id',
						'report_period',
						'outcome',
						'count',
						'percentage',
						'primary_reason',
						'value_amount',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_win_loss_analysis' 
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
	report_period,
	outcome,
	`count`,
	percentage,
	primary_reason,
	value_amount,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_win_loss_analysis',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_win_loss_analysis',
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
			'report_period',
			'outcome',
			'count',
			'percentage',
			'primary_reason',
			'value_amount',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'analysis_id',
			'report_period',
			'outcome',
			'count',
			'percentage',
			'primary_reason',
			'value_amount',
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
	$runnerTableLabels['mne_win_loss_analysis'] = array(
	'tableCaption' => 'Mne Win Loss Analysis',
	'fieldLabels' => array(
		'analysis_id' => 'Analysis Id',
		'report_period' => 'Report Period',
		'outcome' => 'Outcome',
		'count' => 'Count',
		'percentage' => 'Percentage',
		'primary_reason' => 'Primary Reason',
		'value_amount' => 'Value Amount',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'analysis_id' => '',
		'report_period' => '',
		'outcome' => '',
		'count' => '',
		'percentage' => '',
		'primary_reason' => '',
		'value_amount' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'analysis_id' => '',
		'report_period' => '',
		'outcome' => '',
		'count' => '',
		'percentage' => '',
		'primary_reason' => '',
		'value_amount' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>