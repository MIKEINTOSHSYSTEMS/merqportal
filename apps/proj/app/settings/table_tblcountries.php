<?php
global $runnerTableSettings;
$runnerTableSettings['tblcountries'] = array(
	'name' => 'tblcountries',
	'shortName' => 'tblcountries',
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
	'afterEditDetails' => 'tblcountries',
	'afterAddDetail' => 'tblcountries',
	'detailsBadgeColor' => '5f9ea0',
	'sql' => 'SELECT
	country_id,
	iso2,
	short_name,
	long_name,
	iso3,
	numcode,
	un_member,
	calling_code,
	cctld
FROM
	tblcountries
',
	'keyFields' => array( 
		'country_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'country_id' => array(
			'name' => 'country_id',
			'goodName' => 'country_id',
			'strField' => 'country_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'country_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcountries' 
		),
		'iso2' => array(
			'name' => 'iso2',
			'goodName' => 'iso2',
			'strField' => 'iso2',
			'index' => 2,
			'type' => 129,
			'sqlExpression' => 'iso2',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcountries' 
		),
		'short_name' => array(
			'name' => 'short_name',
			'goodName' => 'short_name',
			'strField' => 'short_name',
			'index' => 3,
			'sqlExpression' => 'short_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcountries' 
		),
		'long_name' => array(
			'name' => 'long_name',
			'goodName' => 'long_name',
			'strField' => 'long_name',
			'index' => 4,
			'sqlExpression' => 'long_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcountries' 
		),
		'iso3' => array(
			'name' => 'iso3',
			'goodName' => 'iso3',
			'strField' => 'iso3',
			'index' => 5,
			'type' => 129,
			'sqlExpression' => 'iso3',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcountries' 
		),
		'numcode' => array(
			'name' => 'numcode',
			'goodName' => 'numcode',
			'strField' => 'numcode',
			'index' => 6,
			'sqlExpression' => 'numcode',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcountries' 
		),
		'un_member' => array(
			'name' => 'un_member',
			'goodName' => 'un_member',
			'strField' => 'un_member',
			'index' => 7,
			'sqlExpression' => 'un_member',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcountries' 
		),
		'calling_code' => array(
			'name' => 'calling_code',
			'goodName' => 'calling_code',
			'strField' => 'calling_code',
			'index' => 8,
			'sqlExpression' => 'calling_code',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcountries' 
		),
		'cctld' => array(
			'name' => 'cctld',
			'goodName' => 'cctld',
			'strField' => 'cctld',
			'index' => 9,
			'sqlExpression' => 'cctld',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblcountries' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	country_id,
	iso2,
	short_name,
	long_name,
	iso3,
	numcode,
	un_member,
	calling_code,
	cctld
FROM
	tblcountries
',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'country_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcountries',
					'name' => 'country_id' 
				),
				'encrypted' => false,
				'columnName' => 'country_id' 
			),
			array(
				'sql' => 'iso2',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcountries',
					'name' => 'iso2' 
				),
				'encrypted' => false,
				'columnName' => 'iso2' 
			),
			array(
				'sql' => 'short_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcountries',
					'name' => 'short_name' 
				),
				'encrypted' => false,
				'columnName' => 'short_name' 
			),
			array(
				'sql' => 'long_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcountries',
					'name' => 'long_name' 
				),
				'encrypted' => false,
				'columnName' => 'long_name' 
			),
			array(
				'sql' => 'iso3',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcountries',
					'name' => 'iso3' 
				),
				'encrypted' => false,
				'columnName' => 'iso3' 
			),
			array(
				'sql' => 'numcode',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcountries',
					'name' => 'numcode' 
				),
				'encrypted' => false,
				'columnName' => 'numcode' 
			),
			array(
				'sql' => 'un_member',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcountries',
					'name' => 'un_member' 
				),
				'encrypted' => false,
				'columnName' => 'un_member' 
			),
			array(
				'sql' => 'calling_code',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcountries',
					'name' => 'calling_code' 
				),
				'encrypted' => false,
				'columnName' => 'calling_code' 
			),
			array(
				'sql' => 'cctld',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblcountries',
					'name' => 'cctld' 
				),
				'encrypted' => false,
				'columnName' => 'cctld' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'tblcountries',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'tblcountries',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'country_id',
						'iso2',
						'short_name',
						'long_name',
						'iso3',
						'numcode',
						'un_member',
						'calling_code',
						'cctld' 
					),
					'name' => 'tblcountries' 
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
		'fieldListSql' => 'country_id,
	iso2,
	short_name,
	long_name,
	iso3,
	numcode,
	un_member,
	calling_code,
	cctld',
		'fromListSql' => 'FROM
	tblcountries',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'tblcountries',
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
			'country_id',
			'iso2',
			'short_name',
			'long_name',
			'iso3',
			'numcode',
			'un_member',
			'calling_code',
			'cctld' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'country_id',
			'iso2',
			'short_name',
			'long_name',
			'iso3',
			'numcode',
			'un_member',
			'calling_code',
			'cctld' 
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
	$runnerTableLabels['tblcountries'] = array(
	'tableCaption' => 'Tblcountries',
	'fieldLabels' => array(
		'country_id' => 'Country Id',
		'iso2' => 'Iso2',
		'short_name' => 'Short Name',
		'long_name' => 'Long Name',
		'iso3' => 'Iso3',
		'numcode' => 'Numcode',
		'un_member' => 'Un Member',
		'calling_code' => 'Calling Code',
		'cctld' => 'Cctld' 
	),
	'fieldTooltips' => array(
		'country_id' => '',
		'iso2' => '',
		'short_name' => '',
		'long_name' => '',
		'iso3' => '',
		'numcode' => '',
		'un_member' => '',
		'calling_code' => '',
		'cctld' => '' 
	),
	'fieldPlaceholders' => array(
		'country_id' => '',
		'iso2' => '',
		'short_name' => '',
		'long_name' => '',
		'iso3' => '',
		'numcode' => '',
		'un_member' => '',
		'calling_code' => '',
		'cctld' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>