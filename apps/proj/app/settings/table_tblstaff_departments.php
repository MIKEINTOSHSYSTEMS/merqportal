<?php
global $runnerTableSettings;
$runnerTableSettings['tblstaff_departments'] = array(
	'name' => 'tblstaff_departments',
	'shortName' => 'tblstaff_departments',
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
	'afterEditDetails' => 'tblstaff_departments',
	'afterAddDetail' => 'tblstaff_departments',
	'detailsBadgeColor' => 'cd853f',
	'sql' => 'SELECT
	staffdepartmentid,
	staffid,
	departmentid
FROM
	tblstaff_departments',
	'keyFields' => array( 
		'staffdepartmentid' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'staffdepartmentid' => array(
			'name' => 'staffdepartmentid',
			'goodName' => 'staffdepartmentid',
			'strField' => 'staffdepartmentid',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'staffdepartmentid',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblstaff_departments' 
		),
		'staffid' => array(
			'name' => 'staffid',
			'goodName' => 'staffid',
			'strField' => 'staffid',
			'index' => 2,
			'type' => 3,
			'sqlExpression' => 'staffid',
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
			'tableName' => 'tblstaff_departments' 
		),
		'departmentid' => array(
			'name' => 'departmentid',
			'goodName' => 'departmentid',
			'strField' => 'departmentid',
			'index' => 3,
			'type' => 3,
			'sqlExpression' => 'departmentid',
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
			'tableName' => 'tblstaff_departments' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	staffdepartmentid,
	staffid,
	departmentid
FROM
	tblstaff_departments',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'staffdepartmentid',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblstaff_departments',
					'name' => 'staffdepartmentid' 
				),
				'encrypted' => false,
				'columnName' => 'staffdepartmentid' 
			),
			array(
				'sql' => 'staffid',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblstaff_departments',
					'name' => 'staffid' 
				),
				'encrypted' => false,
				'columnName' => 'staffid' 
			),
			array(
				'sql' => 'departmentid',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblstaff_departments',
					'name' => 'departmentid' 
				),
				'encrypted' => false,
				'columnName' => 'departmentid' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'tblstaff_departments',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'tblstaff_departments',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'staffdepartmentid',
						'staffid',
						'departmentid' 
					),
					'name' => 'tblstaff_departments' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'staffdepartmentid,
	staffid,
	departmentid',
		'fromListSql' => 'FROM
	tblstaff_departments',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'tblstaff_departments',
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
			'staffdepartmentid',
			'staffid',
			'departmentid' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'staffdepartmentid',
			'staffid',
			'departmentid' 
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
	$runnerTableLabels['tblstaff_departments'] = array(
	'tableCaption' => 'Tblstaff Departments',
	'fieldLabels' => array(
		'staffdepartmentid' => 'SD_ID',
		'staffid' => 'Staff',
		'departmentid' => 'Department' 
	),
	'fieldTooltips' => array(
		'staffdepartmentid' => '',
		'staffid' => '',
		'departmentid' => '' 
	),
	'fieldPlaceholders' => array(
		'staffdepartmentid' => '',
		'staffid' => '',
		'departmentid' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>