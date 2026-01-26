<?php
global $runnerTableSettings;
$runnerTableSettings['merq__locking'] = array(
	'name' => 'merq__locking',
	'shortName' => 'merq__locking',
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
	'afterEditDetails' => 'merq__locking',
	'afterAddDetail' => 'merq__locking',
	'detailsBadgeColor' => 'dc143c',
	'sql' => 'SELECT
	id,
	`table`,
	startdatetime,
	confirmdatetime,
	`keys`,
	sessionid,
	userid,
	`action`
FROM
	merq__locking',
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
			'tableName' => 'merq__locking' 
		),
		'table' => array(
			'name' => 'table',
			'goodName' => 'table',
			'strField' => 'table',
			'index' => 2,
			'sqlExpression' => '`table`',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'merq__locking' 
		),
		'startdatetime' => array(
			'name' => 'startdatetime',
			'goodName' => 'startdatetime',
			'strField' => 'startdatetime',
			'index' => 3,
			'type' => 135,
			'sqlExpression' => 'startdatetime',
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
			'tableName' => 'merq__locking' 
		),
		'confirmdatetime' => array(
			'name' => 'confirmdatetime',
			'goodName' => 'confirmdatetime',
			'strField' => 'confirmdatetime',
			'index' => 4,
			'type' => 135,
			'sqlExpression' => 'confirmdatetime',
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
			'tableName' => 'merq__locking' 
		),
		'keys' => array(
			'name' => 'keys',
			'goodName' => 'keys',
			'strField' => 'keys',
			'index' => 5,
			'sqlExpression' => '`keys`',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'merq__locking' 
		),
		'sessionid' => array(
			'name' => 'sessionid',
			'goodName' => 'sessionid',
			'strField' => 'sessionid',
			'index' => 6,
			'sqlExpression' => 'sessionid',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'merq__locking' 
		),
		'userid' => array(
			'name' => 'userid',
			'goodName' => 'userid',
			'strField' => 'userid',
			'index' => 7,
			'sqlExpression' => 'userid',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'merq__locking' 
		),
		'action' => array(
			'name' => 'action',
			'goodName' => 'action',
			'strField' => 'action',
			'index' => 8,
			'type' => 3,
			'sqlExpression' => '`action`',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'merq__locking' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	id,
	`table`,
	startdatetime,
	confirmdatetime,
	`keys`,
	sessionid,
	userid,
	`action`
FROM
	merq__locking',
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
					'table' => 'merq__locking',
					'name' => 'id' 
				),
				'encrypted' => false,
				'columnName' => 'id' 
			),
			array(
				'sql' => '`table`',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'merq__locking',
					'name' => 'table' 
				),
				'encrypted' => false,
				'columnName' => 'table' 
			),
			array(
				'sql' => 'startdatetime',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'merq__locking',
					'name' => 'startdatetime' 
				),
				'encrypted' => false,
				'columnName' => 'startdatetime' 
			),
			array(
				'sql' => 'confirmdatetime',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'merq__locking',
					'name' => 'confirmdatetime' 
				),
				'encrypted' => false,
				'columnName' => 'confirmdatetime' 
			),
			array(
				'sql' => '`keys`',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'merq__locking',
					'name' => 'keys' 
				),
				'encrypted' => false,
				'columnName' => 'keys' 
			),
			array(
				'sql' => 'sessionid',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'merq__locking',
					'name' => 'sessionid' 
				),
				'encrypted' => false,
				'columnName' => 'sessionid' 
			),
			array(
				'sql' => 'userid',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'merq__locking',
					'name' => 'userid' 
				),
				'encrypted' => false,
				'columnName' => 'userid' 
			),
			array(
				'sql' => '`action`',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'merq__locking',
					'name' => 'action' 
				),
				'encrypted' => false,
				'columnName' => 'action' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'merq__locking',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'merq__locking',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'id',
						'table',
						'startdatetime',
						'confirmdatetime',
						'keys',
						'sessionid',
						'userid',
						'action' 
					),
					'name' => 'merq__locking' 
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
	`table`,
	startdatetime,
	confirmdatetime,
	`keys`,
	sessionid,
	userid,
	`action`',
		'fromListSql' => 'FROM
	merq__locking',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'merq__locking',
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
			'table',
			'startdatetime',
			'confirmdatetime',
			'keys',
			'sessionid',
			'userid',
			'action' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'id',
			'table',
			'startdatetime',
			'confirmdatetime',
			'keys',
			'sessionid',
			'userid',
			'action' 
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
	$runnerTableLabels['merq__locking'] = array(
	'tableCaption' => 'Merq Locking',
	'fieldLabels' => array(
		'id' => 'Id',
		'table' => 'Table',
		'startdatetime' => 'Startdatetime',
		'confirmdatetime' => 'Confirmdatetime',
		'keys' => 'Keys',
		'sessionid' => 'Sessionid',
		'userid' => 'Userid',
		'action' => 'Action' 
	),
	'fieldTooltips' => array(
		'id' => '',
		'table' => '',
		'startdatetime' => '',
		'confirmdatetime' => '',
		'keys' => '',
		'sessionid' => '',
		'userid' => '',
		'action' => '' 
	),
	'fieldPlaceholders' => array(
		'id' => '',
		'table' => '',
		'startdatetime' => '',
		'confirmdatetime' => '',
		'keys' => '',
		'sessionid' => '',
		'userid' => '',
		'action' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>