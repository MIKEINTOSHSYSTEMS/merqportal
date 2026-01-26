<?php
global $runnerTableSettings;
$runnerTableSettings['mne_currency_options'] = array(
	'name' => 'mne_currency_options',
	'shortName' => 'mne_currency_options',
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
		'masterlist' => array( 
			'masterlist' 
		),
		'masterprint' => array( 
			'masterprint' 
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
		'masterlist' => 'masterlist',
		'masterprint' => 'masterprint',
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
		'masterlist' => 'masterlist',
		'masterprint' => 'masterprint',
		'search' => 'search' 
	),
	'audit' => true,
	'afterEditDetails' => 'mne_currency_options',
	'afterAddDetail' => 'mne_currency_options',
	'detailsBadgeColor' => 'd2af80',
	'sql' => 'SELECT
	currency_id,
	currency_code,
	currency_name,
	symbol,
	exchange_rate,
	is_active
FROM
	mne_currency_options',
	'keyFields' => array( 
		'currency_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'currency_id' => array(
			'name' => 'currency_id',
			'goodName' => 'currency_id',
			'strField' => 'currency_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'currency_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_currency_options' 
		),
		'currency_code' => array(
			'name' => 'currency_code',
			'goodName' => 'currency_code',
			'strField' => 'currency_code',
			'index' => 2,
			'sqlExpression' => 'currency_code',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_currency_options' 
		),
		'currency_name' => array(
			'name' => 'currency_name',
			'goodName' => 'currency_name',
			'strField' => 'currency_name',
			'index' => 3,
			'sqlExpression' => 'currency_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_currency_options' 
		),
		'symbol' => array(
			'name' => 'symbol',
			'goodName' => 'symbol',
			'strField' => 'symbol',
			'index' => 4,
			'sqlExpression' => 'symbol',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_currency_options' 
		),
		'exchange_rate' => array(
			'name' => 'exchange_rate',
			'goodName' => 'exchange_rate',
			'strField' => 'exchange_rate',
			'index' => 5,
			'type' => 14,
			'sqlExpression' => 'exchange_rate',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_currency_options' 
		),
		'is_active' => array(
			'name' => 'is_active',
			'goodName' => 'is_active',
			'strField' => 'is_active',
			'index' => 6,
			'type' => 16,
			'sqlExpression' => 'is_active',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Checkbox' 
				) 
			),
			'tableName' => 'mne_currency_options' 
		) 
	),
	'detailsTables' => array( 
		'mne_business_opportunities',
		'mne_projects' 
	),
	'query' => array(
		'sql' => 'SELECT
	currency_id,
	currency_code,
	currency_name,
	symbol,
	exchange_rate,
	is_active
FROM
	mne_currency_options',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'currency_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_currency_options',
					'name' => 'currency_id' 
				),
				'encrypted' => false,
				'columnName' => 'currency_id' 
			),
			array(
				'sql' => 'currency_code',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_currency_options',
					'name' => 'currency_code' 
				),
				'encrypted' => false,
				'columnName' => 'currency_code' 
			),
			array(
				'sql' => 'currency_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_currency_options',
					'name' => 'currency_name' 
				),
				'encrypted' => false,
				'columnName' => 'currency_name' 
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
					'table' => 'mne_currency_options',
					'name' => 'symbol' 
				),
				'encrypted' => false,
				'columnName' => 'symbol' 
			),
			array(
				'sql' => 'exchange_rate',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_currency_options',
					'name' => 'exchange_rate' 
				),
				'encrypted' => false,
				'columnName' => 'exchange_rate' 
			),
			array(
				'sql' => 'is_active',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_currency_options',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_currency_options',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_currency_options',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'currency_id',
						'currency_code',
						'currency_name',
						'symbol',
						'exchange_rate',
						'is_active' 
					),
					'name' => 'mne_currency_options' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'currency_id,
	currency_code,
	currency_name,
	symbol,
	exchange_rate,
	is_active',
		'fromListSql' => 'FROM
	mne_currency_options',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_currency_options',
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
		'masterlist' => array( 
			'masterlist' 
		),
		'masterprint' => array( 
			'masterprint' 
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
		'masterlist' => 'masterlist',
		'masterprint' => 'masterprint',
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
		'masterlist' => 'masterlist',
		'masterprint' => 'masterprint',
		'search' => 'search' 
	),
	'searchSettings' => array(
		'caseSensitiveSearch' => false,
		'searchableFields' => array( 
			'currency_id',
			'currency_code',
			'currency_name',
			'symbol',
			'exchange_rate',
			'is_active' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'currency_id',
			'currency_code',
			'currency_name',
			'symbol',
			'exchange_rate',
			'is_active' 
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
	$runnerTableLabels['mne_currency_options'] = array(
	'tableCaption' => 'Mne Currency Options',
	'fieldLabels' => array(
		'currency_id' => 'Currency Id',
		'currency_code' => 'Currency Code',
		'currency_name' => 'Currency Name',
		'symbol' => 'Symbol',
		'exchange_rate' => 'Exchange Rate',
		'is_active' => 'Is Active' 
	),
	'fieldTooltips' => array(
		'currency_id' => '',
		'currency_code' => '',
		'currency_name' => '',
		'symbol' => '',
		'exchange_rate' => '',
		'is_active' => '' 
	),
	'fieldPlaceholders' => array(
		'currency_id' => '',
		'currency_code' => '',
		'currency_name' => '',
		'symbol' => '',
		'exchange_rate' => '',
		'is_active' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>