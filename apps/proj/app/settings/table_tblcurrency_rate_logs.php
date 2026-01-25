<?php
global $runnerTableSettings;
$runnerTableSettings['tblcurrency_rate_logs'] = array(
	'name' => 'tblcurrency_rate_logs',
	'shortName' => 'tblcurrency_rate_logs',
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
	'afterEditDetails' => 'tblcurrency_rate_logs',
	'afterAddDetail' => 'tblcurrency_rate_logs',
	'detailsBadgeColor' => 'cfae83',
	'sql' => 'SELECT
	id,
	from_currency_id,
	from_currency_name,
	from_currency_rate,
	to_currency_id,
	to_currency_name,
	to_currency_rate,
	`date`
FROM
	tblcurrency_rate_logs',
	'keyFields' => array( 
		'id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'id' => array(
			'name' => 'id',
			'goodName' => 'id',
			'strField' => 'id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrency_rate_logs' 
		),
		'from_currency_id' => array(
			'name' => 'from_currency_id',
			'goodName' => 'from_currency_id',
			'strField' => 'from_currency_id',
			'index' => 2,
			'type' => 3,
			'sqlExpression' => 'from_currency_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrency_rate_logs' 
		),
		'from_currency_name' => array(
			'name' => 'from_currency_name',
			'goodName' => 'from_currency_name',
			'strField' => 'from_currency_name',
			'index' => 3,
			'sqlExpression' => 'from_currency_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrency_rate_logs' 
		),
		'from_currency_rate' => array(
			'name' => 'from_currency_rate',
			'goodName' => 'from_currency_rate',
			'strField' => 'from_currency_rate',
			'index' => 4,
			'type' => 14,
			'sqlExpression' => 'from_currency_rate',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrency_rate_logs' 
		),
		'to_currency_id' => array(
			'name' => 'to_currency_id',
			'goodName' => 'to_currency_id',
			'strField' => 'to_currency_id',
			'index' => 5,
			'type' => 3,
			'sqlExpression' => 'to_currency_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrency_rate_logs' 
		),
		'to_currency_name' => array(
			'name' => 'to_currency_name',
			'goodName' => 'to_currency_name',
			'strField' => 'to_currency_name',
			'index' => 6,
			'sqlExpression' => 'to_currency_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrency_rate_logs' 
		),
		'to_currency_rate' => array(
			'name' => 'to_currency_rate',
			'goodName' => 'to_currency_rate',
			'strField' => 'to_currency_rate',
			'index' => 7,
			'type' => 14,
			'sqlExpression' => 'to_currency_rate',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrency_rate_logs' 
		),
		'date' => array(
			'name' => 'date',
			'goodName' => 'date',
			'strField' => 'date',
			'index' => 8,
			'type' => 7,
			'sqlExpression' => '`date`',
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
			'tableName' => 'tblcurrency_rate_logs' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	id,
	from_currency_id,
	from_currency_name,
	from_currency_rate,
	to_currency_id,
	to_currency_name,
	to_currency_rate,
	`date`
FROM
	tblcurrency_rate_logs',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrency_rate_logs',
					'name' => 'id' 
				),
				'encrypted' => false,
				'columnName' => 'id' 
			),
			array(
				'sql' => 'from_currency_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrency_rate_logs',
					'name' => 'from_currency_id' 
				),
				'encrypted' => false,
				'columnName' => 'from_currency_id' 
			),
			array(
				'sql' => 'from_currency_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrency_rate_logs',
					'name' => 'from_currency_name' 
				),
				'encrypted' => false,
				'columnName' => 'from_currency_name' 
			),
			array(
				'sql' => 'from_currency_rate',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrency_rate_logs',
					'name' => 'from_currency_rate' 
				),
				'encrypted' => false,
				'columnName' => 'from_currency_rate' 
			),
			array(
				'sql' => 'to_currency_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrency_rate_logs',
					'name' => 'to_currency_id' 
				),
				'encrypted' => false,
				'columnName' => 'to_currency_id' 
			),
			array(
				'sql' => 'to_currency_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrency_rate_logs',
					'name' => 'to_currency_name' 
				),
				'encrypted' => false,
				'columnName' => 'to_currency_name' 
			),
			array(
				'sql' => 'to_currency_rate',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrency_rate_logs',
					'name' => 'to_currency_rate' 
				),
				'encrypted' => false,
				'columnName' => 'to_currency_rate' 
			),
			array(
				'sql' => '`date`',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrency_rate_logs',
					'name' => 'date' 
				),
				'encrypted' => false,
				'columnName' => 'date' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'tblcurrency_rate_logs',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'tblcurrency_rate_logs',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'id',
						'from_currency_id',
						'from_currency_name',
						'from_currency_rate',
						'to_currency_id',
						'to_currency_name',
						'to_currency_rate',
						'date' 
					),
					'name' => 'tblcurrency_rate_logs' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'id,
	from_currency_id,
	from_currency_name,
	from_currency_rate,
	to_currency_id,
	to_currency_name,
	to_currency_rate,
	`date`',
		'fromListSql' => 'FROM
	tblcurrency_rate_logs',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'tblcurrency_rate_logs',
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
			'id',
			'from_currency_id',
			'from_currency_name',
			'from_currency_rate',
			'to_currency_id',
			'to_currency_name',
			'to_currency_rate',
			'date' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'id',
			'from_currency_id',
			'from_currency_name',
			'from_currency_rate',
			'to_currency_id',
			'to_currency_name',
			'to_currency_rate',
			'date' 
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
	$runnerTableLabels['tblcurrency_rate_logs'] = array(
	'tableCaption' => 'Tblcurrency Rate Logs',
	'fieldLabels' => array(
		'id' => 'Id',
		'from_currency_id' => 'From Currency Id',
		'from_currency_name' => 'From Currency Name',
		'from_currency_rate' => 'From Currency Rate',
		'to_currency_id' => 'To Currency Id',
		'to_currency_name' => 'To Currency Name',
		'to_currency_rate' => 'To Currency Rate',
		'date' => 'Date' 
	),
	'fieldTooltips' => array(
		'id' => '',
		'from_currency_id' => '',
		'from_currency_name' => '',
		'from_currency_rate' => '',
		'to_currency_id' => '',
		'to_currency_name' => '',
		'to_currency_rate' => '',
		'date' => '' 
	),
	'fieldPlaceholders' => array(
		'id' => '',
		'from_currency_id' => '',
		'from_currency_name' => '',
		'from_currency_rate' => '',
		'to_currency_id' => '',
		'to_currency_name' => '',
		'to_currency_rate' => '',
		'date' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>