<?php
global $runnerTableSettings;
$runnerTableSettings['tblcurrency_rates'] = array(
	'name' => 'tblcurrency_rates',
	'shortName' => 'tblcurrency_rates',
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
	'afterEditDetails' => 'tblcurrency_rates',
	'afterAddDetail' => 'tblcurrency_rates',
	'detailsBadgeColor' => '1e90ff',
	'sql' => 'SELECT
	id,
	from_currency_id,
	from_currency_name,
	from_currency_rate,
	to_currency_id,
	to_currency_name,
	to_currency_rate,
	date_updated
FROM
	tblcurrency_rates
',
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
			'tableName' => 'tblcurrency_rates' 
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
			'tableName' => 'tblcurrency_rates' 
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
			'tableName' => 'tblcurrency_rates' 
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
			'tableName' => 'tblcurrency_rates' 
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
			'tableName' => 'tblcurrency_rates' 
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
			'tableName' => 'tblcurrency_rates' 
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
			'tableName' => 'tblcurrency_rates' 
		),
		'date_updated' => array(
			'name' => 'date_updated',
			'goodName' => 'date_updated',
			'strField' => 'date_updated',
			'index' => 8,
			'type' => 135,
			'sqlExpression' => 'date_updated',
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
			'tableName' => 'tblcurrency_rates' 
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
	date_updated
FROM
	tblcurrency_rates
',
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
					'table' => 'tblcurrency_rates',
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
					'table' => 'tblcurrency_rates',
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
					'table' => 'tblcurrency_rates',
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
					'table' => 'tblcurrency_rates',
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
					'table' => 'tblcurrency_rates',
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
					'table' => 'tblcurrency_rates',
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
					'table' => 'tblcurrency_rates',
					'name' => 'to_currency_rate' 
				),
				'encrypted' => false,
				'columnName' => 'to_currency_rate' 
			),
			array(
				'sql' => 'date_updated',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrency_rates',
					'name' => 'date_updated' 
				),
				'encrypted' => false,
				'columnName' => 'date_updated' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'tblcurrency_rates',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'tblcurrency_rates',
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
						'date_updated' 
					),
					'name' => 'tblcurrency_rates' 
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
	date_updated',
		'fromListSql' => 'FROM
	tblcurrency_rates',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'tblcurrency_rates',
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
			'date_updated' 
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
			'date_updated' 
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
	$runnerTableLabels['tblcurrency_rates'] = array(
	'tableCaption' => 'Tblcurrency Rates',
	'fieldLabels' => array(
		'id' => 'Id',
		'from_currency_id' => 'From Currency Id',
		'from_currency_name' => 'From Currency Name',
		'from_currency_rate' => 'From Currency Rate',
		'to_currency_id' => 'To Currency Id',
		'to_currency_name' => 'To Currency Name',
		'to_currency_rate' => 'To Currency Rate',
		'date_updated' => 'Date Updated' 
	),
	'fieldTooltips' => array(
		'id' => '',
		'from_currency_id' => '',
		'from_currency_name' => '',
		'from_currency_rate' => '',
		'to_currency_id' => '',
		'to_currency_name' => '',
		'to_currency_rate' => '',
		'date_updated' => '' 
	),
	'fieldPlaceholders' => array(
		'id' => '',
		'from_currency_id' => '',
		'from_currency_name' => '',
		'from_currency_rate' => '',
		'to_currency_id' => '',
		'to_currency_name' => '',
		'to_currency_rate' => '',
		'date_updated' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>