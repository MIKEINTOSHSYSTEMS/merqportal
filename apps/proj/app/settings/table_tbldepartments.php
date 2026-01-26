<?php
global $runnerTableSettings;
$runnerTableSettings['tbldepartments'] = array(
	'name' => 'tbldepartments',
	'shortName' => 'tbldepartments',
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
	'afterEditDetails' => 'tbldepartments',
	'afterAddDetail' => 'tbldepartments',
	'detailsBadgeColor' => 'e67349',
	'sql' => 'SELECT
	departmentid,
	name,
	imap_username,
	email,
	email_from_header,
	`host`,
	password,
	encryption,
	folder,
	delete_after_import,
	calendar_id,
	hidefromclient,
	manager_id,
	parent_id
FROM
	tbldepartments',
	'keyFields' => array( 
		'departmentid' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'departmentid' => array(
			'name' => 'departmentid',
			'goodName' => 'departmentid',
			'strField' => 'departmentid',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'departmentid',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'name' => array(
			'name' => 'name',
			'goodName' => 'name',
			'strField' => 'name',
			'index' => 2,
			'sqlExpression' => 'name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'imap_username' => array(
			'name' => 'imap_username',
			'goodName' => 'imap_username',
			'strField' => 'imap_username',
			'index' => 3,
			'sqlExpression' => 'imap_username',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'email' => array(
			'name' => 'email',
			'goodName' => 'email',
			'strField' => 'email',
			'index' => 4,
			'sqlExpression' => 'email',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'email_from_header' => array(
			'name' => 'email_from_header',
			'goodName' => 'email_from_header',
			'strField' => 'email_from_header',
			'index' => 5,
			'type' => 16,
			'sqlExpression' => 'email_from_header',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'host' => array(
			'name' => 'host',
			'goodName' => 'host',
			'strField' => 'host',
			'index' => 6,
			'sqlExpression' => '`host`',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'password' => array(
			'name' => 'password',
			'goodName' => 'password',
			'strField' => 'password',
			'index' => 7,
			'type' => 201,
			'sqlExpression' => 'password',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'encryption' => array(
			'name' => 'encryption',
			'goodName' => 'encryption',
			'strField' => 'encryption',
			'index' => 8,
			'sqlExpression' => 'encryption',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'folder' => array(
			'name' => 'folder',
			'goodName' => 'folder',
			'strField' => 'folder',
			'index' => 9,
			'sqlExpression' => 'folder',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'delete_after_import' => array(
			'name' => 'delete_after_import',
			'goodName' => 'delete_after_import',
			'strField' => 'delete_after_import',
			'index' => 10,
			'type' => 3,
			'sqlExpression' => 'delete_after_import',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'calendar_id' => array(
			'name' => 'calendar_id',
			'goodName' => 'calendar_id',
			'strField' => 'calendar_id',
			'index' => 11,
			'type' => 201,
			'sqlExpression' => 'calendar_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'hidefromclient' => array(
			'name' => 'hidefromclient',
			'goodName' => 'hidefromclient',
			'strField' => 'hidefromclient',
			'index' => 12,
			'type' => 16,
			'sqlExpression' => 'hidefromclient',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'manager_id' => array(
			'name' => 'manager_id',
			'goodName' => 'manager_id',
			'strField' => 'manager_id',
			'index' => 13,
			'type' => 3,
			'sqlExpression' => 'manager_id',
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
					'lookupLinkField' => 'employee_id',
					'lookupDisplayField' => 'full_name' 
				) 
			),
			'tableName' => 'tbldepartments' 
		),
		'parent_id' => array(
			'name' => 'parent_id',
			'goodName' => 'parent_id',
			'strField' => 'parent_id',
			'index' => 14,
			'type' => 3,
			'sqlExpression' => 'parent_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'tbldepartments',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'departmentid',
					'lookupDisplayField' => 'name' 
				) 
			),
			'tableName' => 'tbldepartments' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	departmentid,
	name,
	imap_username,
	email,
	email_from_header,
	`host`,
	password,
	encryption,
	folder,
	delete_after_import,
	calendar_id,
	hidefromclient,
	manager_id,
	parent_id
FROM
	tbldepartments',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'departmentid',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'departmentid' 
				),
				'encrypted' => false,
				'columnName' => 'departmentid' 
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
					'table' => 'tbldepartments',
					'name' => 'name' 
				),
				'encrypted' => false,
				'columnName' => 'name' 
			),
			array(
				'sql' => 'imap_username',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'imap_username' 
				),
				'encrypted' => false,
				'columnName' => 'imap_username' 
			),
			array(
				'sql' => 'email',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'email' 
				),
				'encrypted' => false,
				'columnName' => 'email' 
			),
			array(
				'sql' => 'email_from_header',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'email_from_header' 
				),
				'encrypted' => false,
				'columnName' => 'email_from_header' 
			),
			array(
				'sql' => '`host`',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'host' 
				),
				'encrypted' => false,
				'columnName' => 'host' 
			),
			array(
				'sql' => 'password',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'password' 
				),
				'encrypted' => false,
				'columnName' => 'password' 
			),
			array(
				'sql' => 'encryption',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'encryption' 
				),
				'encrypted' => false,
				'columnName' => 'encryption' 
			),
			array(
				'sql' => 'folder',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'folder' 
				),
				'encrypted' => false,
				'columnName' => 'folder' 
			),
			array(
				'sql' => 'delete_after_import',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'delete_after_import' 
				),
				'encrypted' => false,
				'columnName' => 'delete_after_import' 
			),
			array(
				'sql' => 'calendar_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'calendar_id' 
				),
				'encrypted' => false,
				'columnName' => 'calendar_id' 
			),
			array(
				'sql' => 'hidefromclient',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'hidefromclient' 
				),
				'encrypted' => false,
				'columnName' => 'hidefromclient' 
			),
			array(
				'sql' => 'manager_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'manager_id' 
				),
				'encrypted' => false,
				'columnName' => 'manager_id' 
			),
			array(
				'sql' => 'parent_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tbldepartments',
					'name' => 'parent_id' 
				),
				'encrypted' => false,
				'columnName' => 'parent_id' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'tbldepartments',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'tbldepartments',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'departmentid',
						'name',
						'imap_username',
						'email',
						'email_from_header',
						'host',
						'password',
						'encryption',
						'folder',
						'delete_after_import',
						'calendar_id',
						'hidefromclient',
						'manager_id',
						'parent_id' 
					),
					'name' => 'tbldepartments' 
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
			),
			array(
				'fieldIndex' => 10,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 11,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 12,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 13,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'departmentid,
	name,
	imap_username,
	email,
	email_from_header,
	`host`,
	password,
	encryption,
	folder,
	delete_after_import,
	calendar_id,
	hidefromclient,
	manager_id,
	parent_id',
		'fromListSql' => 'FROM
	tbldepartments',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'tbldepartments',
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
			'departmentid',
			'name',
			'imap_username',
			'email',
			'email_from_header',
			'host',
			'password',
			'encryption',
			'folder',
			'delete_after_import',
			'calendar_id',
			'hidefromclient',
			'manager_id',
			'parent_id' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'departmentid',
			'name',
			'imap_username',
			'email',
			'email_from_header',
			'host',
			'password',
			'encryption',
			'folder',
			'delete_after_import',
			'calendar_id',
			'hidefromclient',
			'manager_id',
			'parent_id' 
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
	$runnerTableLabels['tbldepartments'] = array(
	'tableCaption' => 'Tbldepartments',
	'fieldLabels' => array(
		'departmentid' => 'Departmentid',
		'name' => 'Name',
		'imap_username' => 'Imap Username',
		'email' => 'Email',
		'email_from_header' => 'Email From Header',
		'host' => 'Host',
		'password' => 'Password',
		'encryption' => 'Encryption',
		'folder' => 'Folder',
		'delete_after_import' => 'Delete After Import',
		'calendar_id' => 'Calendar Id',
		'hidefromclient' => 'Hidefromclient',
		'manager_id' => 'Manager Id',
		'parent_id' => 'Parent Id' 
	),
	'fieldTooltips' => array(
		'departmentid' => '',
		'name' => '',
		'imap_username' => '',
		'email' => '',
		'email_from_header' => '',
		'host' => '',
		'password' => '',
		'encryption' => '',
		'folder' => '',
		'delete_after_import' => '',
		'calendar_id' => '',
		'hidefromclient' => '',
		'manager_id' => '',
		'parent_id' => '' 
	),
	'fieldPlaceholders' => array(
		'departmentid' => '',
		'name' => '',
		'imap_username' => '',
		'email' => '',
		'email_from_header' => '',
		'host' => '',
		'password' => '',
		'encryption' => '',
		'folder' => '',
		'delete_after_import' => '',
		'calendar_id' => '',
		'hidefromclient' => '',
		'manager_id' => '',
		'parent_id' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>