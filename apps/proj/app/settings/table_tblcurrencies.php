<?php
global $runnerTableSettings;
$runnerTableSettings['tblcurrencies'] = array(
	'name' => 'tblcurrencies',
	'shortName' => 'tblcurrencies',
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
	'afterEditDetails' => 'tblcurrencies',
	'afterAddDetail' => 'tblcurrencies',
	'detailsBadgeColor' => '1e90ff',
	'sql' => 'SELECT
	id,
	symbol,
	name,
	decimal_separator,
	thousand_separator,
	placement,
	isdefault
FROM
	tblcurrencies',
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
			'tableName' => 'tblcurrencies' 
		),
		'symbol' => array(
			'name' => 'symbol',
			'goodName' => 'symbol',
			'strField' => 'symbol',
			'index' => 2,
			'sqlExpression' => 'symbol',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrencies' 
		),
		'name' => array(
			'name' => 'name',
			'goodName' => 'name',
			'strField' => 'name',
			'index' => 3,
			'sqlExpression' => 'name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrencies' 
		),
		'decimal_separator' => array(
			'name' => 'decimal_separator',
			'goodName' => 'decimal_separator',
			'strField' => 'decimal_separator',
			'index' => 4,
			'sqlExpression' => 'decimal_separator',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrencies' 
		),
		'thousand_separator' => array(
			'name' => 'thousand_separator',
			'goodName' => 'thousand_separator',
			'strField' => 'thousand_separator',
			'index' => 5,
			'sqlExpression' => 'thousand_separator',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrencies' 
		),
		'placement' => array(
			'name' => 'placement',
			'goodName' => 'placement',
			'strField' => 'placement',
			'index' => 6,
			'sqlExpression' => 'placement',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrencies' 
		),
		'isdefault' => array(
			'name' => 'isdefault',
			'goodName' => 'isdefault',
			'strField' => 'isdefault',
			'index' => 7,
			'type' => 16,
			'sqlExpression' => 'isdefault',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcurrencies' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	id,
	symbol,
	name,
	decimal_separator,
	thousand_separator,
	placement,
	isdefault
FROM
	tblcurrencies',
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
					'table' => 'tblcurrencies',
					'name' => 'id' 
				),
				'encrypted' => false,
				'columnName' => 'id' 
			),
			array(
				'sql' => 'symbol',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrencies',
					'name' => 'symbol' 
				),
				'encrypted' => false,
				'columnName' => 'symbol' 
			),
			array(
				'sql' => 'name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrencies',
					'name' => 'name' 
				),
				'encrypted' => false,
				'columnName' => 'name' 
			),
			array(
				'sql' => 'decimal_separator',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrencies',
					'name' => 'decimal_separator' 
				),
				'encrypted' => false,
				'columnName' => 'decimal_separator' 
			),
			array(
				'sql' => 'thousand_separator',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrencies',
					'name' => 'thousand_separator' 
				),
				'encrypted' => false,
				'columnName' => 'thousand_separator' 
			),
			array(
				'sql' => 'placement',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrencies',
					'name' => 'placement' 
				),
				'encrypted' => false,
				'columnName' => 'placement' 
			),
			array(
				'sql' => 'isdefault',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcurrencies',
					'name' => 'isdefault' 
				),
				'encrypted' => false,
				'columnName' => 'isdefault' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'tblcurrencies',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'tblcurrencies',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'id',
						'symbol',
						'name',
						'decimal_separator',
						'thousand_separator',
						'placement',
						'isdefault' 
					),
					'name' => 'tblcurrencies' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'id,
	symbol,
	name,
	decimal_separator,
	thousand_separator,
	placement,
	isdefault',
		'fromListSql' => 'FROM
	tblcurrencies',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'tblcurrencies',
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
			'symbol',
			'name',
			'decimal_separator',
			'thousand_separator',
			'placement',
			'isdefault' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'id',
			'symbol',
			'name',
			'decimal_separator',
			'thousand_separator',
			'placement',
			'isdefault' 
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
	$runnerTableLabels['tblcurrencies'] = array(
	'tableCaption' => 'Tblcurrencies',
	'fieldLabels' => array(
		'id' => 'Id',
		'symbol' => 'Symbol',
		'name' => 'Name',
		'decimal_separator' => 'Decimal Separator',
		'thousand_separator' => 'Thousand Separator',
		'placement' => 'Placement',
		'isdefault' => 'Isdefault' 
	),
	'fieldTooltips' => array(
		'id' => '',
		'symbol' => '',
		'name' => '',
		'decimal_separator' => '',
		'thousand_separator' => '',
		'placement' => '',
		'isdefault' => '' 
	),
	'fieldPlaceholders' => array(
		'id' => '',
		'symbol' => '',
		'name' => '',
		'decimal_separator' => '',
		'thousand_separator' => '',
		'placement' => '',
		'isdefault' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>