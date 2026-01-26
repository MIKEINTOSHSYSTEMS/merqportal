<?php
global $runnerTableSettings;
$runnerTableSettings['mne_audit_log'] = array(
	'name' => 'mne_audit_log',
	'shortName' => 'mne_audit_log',
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
	'afterEditDetails' => 'mne_audit_log',
	'afterAddDetail' => 'mne_audit_log',
	'detailsBadgeColor' => '7b68ee',
	'sql' => 'SELECT
	audit_id,
	user_id,
	`action`,
	table_name,
	record_id,
	old_values,
	new_values,
	ip_address,
	user_agent,
	created_at
FROM
	mne_audit_log',
	'keyFields' => array( 
		'audit_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'audit_id' => array(
			'name' => 'audit_id',
			'goodName' => 'audit_id',
			'strField' => 'audit_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'audit_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_audit_log' 
		),
		'user_id' => array(
			'name' => 'user_id',
			'goodName' => 'user_id',
			'strField' => 'user_id',
			'index' => 2,
			'type' => 3,
			'sqlExpression' => 'user_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'users',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'user_id',
					'lookupDisplayField' => 'username' 
				) 
			),
			'tableName' => 'mne_audit_log' 
		),
		'action' => array(
			'name' => 'action',
			'goodName' => 'action',
			'strField' => 'action',
			'index' => 3,
			'sqlExpression' => '`action`',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_audit_log' 
		),
		'table_name' => array(
			'name' => 'table_name',
			'goodName' => 'table_name',
			'strField' => 'table_name',
			'index' => 4,
			'sqlExpression' => 'table_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_audit_log' 
		),
		'record_id' => array(
			'name' => 'record_id',
			'goodName' => 'record_id',
			'strField' => 'record_id',
			'index' => 5,
			'type' => 3,
			'sqlExpression' => 'record_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_audit_log' 
		),
		'old_values' => array(
			'name' => 'old_values',
			'goodName' => 'old_values',
			'strField' => 'old_values',
			'index' => 6,
			'type' => 201,
			'sqlExpression' => 'old_values',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_audit_log' 
		),
		'new_values' => array(
			'name' => 'new_values',
			'goodName' => 'new_values',
			'strField' => 'new_values',
			'index' => 7,
			'type' => 201,
			'sqlExpression' => 'new_values',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_audit_log' 
		),
		'ip_address' => array(
			'name' => 'ip_address',
			'goodName' => 'ip_address',
			'strField' => 'ip_address',
			'index' => 8,
			'sqlExpression' => 'ip_address',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_audit_log' 
		),
		'user_agent' => array(
			'name' => 'user_agent',
			'goodName' => 'user_agent',
			'strField' => 'user_agent',
			'index' => 9,
			'type' => 201,
			'sqlExpression' => 'user_agent',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_audit_log' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 10,
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
			'tableName' => 'mne_audit_log' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'users',
			'detailsKeys' => array( 
				'user_id' 
			),
			'masterKeys' => array( 
				'user_id' 
			) 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	audit_id,
	user_id,
	`action`,
	table_name,
	record_id,
	old_values,
	new_values,
	ip_address,
	user_agent,
	created_at
FROM
	mne_audit_log',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'audit_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_audit_log',
					'name' => 'audit_id' 
				),
				'encrypted' => false,
				'columnName' => 'audit_id' 
			),
			array(
				'sql' => 'user_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_audit_log',
					'name' => 'user_id' 
				),
				'encrypted' => false,
				'columnName' => 'user_id' 
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
					'table' => 'mne_audit_log',
					'name' => 'action' 
				),
				'encrypted' => false,
				'columnName' => 'action' 
			),
			array(
				'sql' => 'table_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_audit_log',
					'name' => 'table_name' 
				),
				'encrypted' => false,
				'columnName' => 'table_name' 
			),
			array(
				'sql' => 'record_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_audit_log',
					'name' => 'record_id' 
				),
				'encrypted' => false,
				'columnName' => 'record_id' 
			),
			array(
				'sql' => 'old_values',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_audit_log',
					'name' => 'old_values' 
				),
				'encrypted' => false,
				'columnName' => 'old_values' 
			),
			array(
				'sql' => 'new_values',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_audit_log',
					'name' => 'new_values' 
				),
				'encrypted' => false,
				'columnName' => 'new_values' 
			),
			array(
				'sql' => 'ip_address',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_audit_log',
					'name' => 'ip_address' 
				),
				'encrypted' => false,
				'columnName' => 'ip_address' 
			),
			array(
				'sql' => 'user_agent',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_audit_log',
					'name' => 'user_agent' 
				),
				'encrypted' => false,
				'columnName' => 'user_agent' 
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
					'table' => 'mne_audit_log',
					'name' => 'created_at' 
				),
				'encrypted' => false,
				'columnName' => 'created_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_audit_log',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_audit_log',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'audit_id',
						'user_id',
						'action',
						'table_name',
						'record_id',
						'old_values',
						'new_values',
						'ip_address',
						'user_agent',
						'created_at' 
					),
					'name' => 'mne_audit_log' 
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
			),
			array(
				'fieldIndex' => 9,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'audit_id,
	user_id,
	`action`,
	table_name,
	record_id,
	old_values,
	new_values,
	ip_address,
	user_agent,
	created_at',
		'fromListSql' => 'FROM
	mne_audit_log',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_audit_log',
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
			'audit_id',
			'user_id',
			'action',
			'table_name',
			'record_id',
			'old_values',
			'new_values',
			'ip_address',
			'user_agent',
			'created_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'audit_id',
			'user_id',
			'action',
			'table_name',
			'record_id',
			'old_values',
			'new_values',
			'ip_address',
			'user_agent',
			'created_at' 
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
	$runnerTableLabels['mne_audit_log'] = array(
	'tableCaption' => 'Mne Audit Log',
	'fieldLabels' => array(
		'audit_id' => 'Audit Id',
		'user_id' => 'User Id',
		'action' => 'Action',
		'table_name' => 'Table Name',
		'record_id' => 'Record Id',
		'old_values' => 'Old Values',
		'new_values' => 'New Values',
		'ip_address' => 'Ip Address',
		'user_agent' => 'User Agent',
		'created_at' => 'Created At' 
	),
	'fieldTooltips' => array(
		'audit_id' => '',
		'user_id' => '',
		'action' => '',
		'table_name' => '',
		'record_id' => '',
		'old_values' => '',
		'new_values' => '',
		'ip_address' => '',
		'user_agent' => '',
		'created_at' => '' 
	),
	'fieldPlaceholders' => array(
		'audit_id' => '',
		'user_id' => '',
		'action' => '',
		'table_name' => '',
		'record_id' => '',
		'old_values' => '',
		'new_values' => '',
		'ip_address' => '',
		'user_agent' => '',
		'created_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>