<?php
global $runnerTableSettings;
$runnerTableSettings['tblhr_job_position'] = array(
	'name' => 'tblhr_job_position',
	'shortName' => 'tblhr_job_position',
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
	'afterEditDetails' => 'tblhr_job_position',
	'afterAddDetail' => 'tblhr_job_position',
	'detailsBadgeColor' => 'dc143c',
	'sql' => 'SELECT
	position_id,
	position_name,
	job_position_description,
	job_p_id,
	position_code,
	department_id
FROM
	tblhr_job_position
',
	'keyFields' => array( 
		'position_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'position_id' => array(
			'name' => 'position_id',
			'goodName' => 'position_id',
			'strField' => 'position_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'position_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblhr_job_position' 
		),
		'position_name' => array(
			'name' => 'position_name',
			'goodName' => 'position_name',
			'strField' => 'position_name',
			'index' => 2,
			'sqlExpression' => 'position_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblhr_job_position' 
		),
		'job_position_description' => array(
			'name' => 'job_position_description',
			'goodName' => 'job_position_description',
			'strField' => 'job_position_description',
			'index' => 3,
			'type' => 201,
			'sqlExpression' => 'job_position_description',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'tblhr_job_position' 
		),
		'job_p_id' => array(
			'name' => 'job_p_id',
			'goodName' => 'job_p_id',
			'strField' => 'job_p_id',
			'index' => 4,
			'type' => 3,
			'sqlExpression' => 'job_p_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblhr_job_position' 
		),
		'position_code' => array(
			'name' => 'position_code',
			'goodName' => 'position_code',
			'strField' => 'position_code',
			'index' => 5,
			'sqlExpression' => 'position_code',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblhr_job_position' 
		),
		'department_id' => array(
			'name' => 'department_id',
			'goodName' => 'department_id',
			'strField' => 'department_id',
			'index' => 6,
			'type' => 201,
			'sqlExpression' => 'department_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupMultiselect' => true,
					'lookupType' => 2,
					'lookupTable' => 'tbldepartments',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'departmentid',
					'lookupDisplayField' => 'name' 
				) 
			),
			'tableName' => 'tblhr_job_position' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	position_id,
	position_name,
	job_position_description,
	job_p_id,
	position_code,
	department_id
FROM
	tblhr_job_position
',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'position_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblhr_job_position',
					'name' => 'position_id' 
				),
				'encrypted' => false,
				'columnName' => 'position_id' 
			),
			array(
				'sql' => 'position_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblhr_job_position',
					'name' => 'position_name' 
				),
				'encrypted' => false,
				'columnName' => 'position_name' 
			),
			array(
				'sql' => 'job_position_description',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblhr_job_position',
					'name' => 'job_position_description' 
				),
				'encrypted' => false,
				'columnName' => 'job_position_description' 
			),
			array(
				'sql' => 'job_p_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblhr_job_position',
					'name' => 'job_p_id' 
				),
				'encrypted' => false,
				'columnName' => 'job_p_id' 
			),
			array(
				'sql' => 'position_code',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblhr_job_position',
					'name' => 'position_code' 
				),
				'encrypted' => false,
				'columnName' => 'position_code' 
			),
			array(
				'sql' => 'department_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblhr_job_position',
					'name' => 'department_id' 
				),
				'encrypted' => false,
				'columnName' => 'department_id' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'tblhr_job_position',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'tblhr_job_position',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'position_id',
						'position_name',
						'job_position_description',
						'job_p_id',
						'position_code',
						'department_id' 
					),
					'name' => 'tblhr_job_position' 
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
		'fieldListSql' => 'position_id,
	position_name,
	job_position_description,
	job_p_id,
	position_code,
	department_id',
		'fromListSql' => 'FROM
	tblhr_job_position',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'tblhr_job_position',
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
			'position_id',
			'position_name',
			'job_position_description',
			'job_p_id',
			'position_code',
			'department_id' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'position_id',
			'position_name',
			'job_position_description',
			'job_p_id',
			'position_code',
			'department_id' 
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
	$runnerTableLabels['tblhr_job_position'] = array(
	'tableCaption' => 'Tblhr Job Position',
	'fieldLabels' => array(
		'position_id' => 'Position Id',
		'position_name' => 'Position Name',
		'job_position_description' => 'Job Position Description',
		'job_p_id' => 'Job P Id',
		'position_code' => 'Position Code',
		'department_id' => 'Department Id' 
	),
	'fieldTooltips' => array(
		'position_id' => '',
		'position_name' => '',
		'job_position_description' => '',
		'job_p_id' => '',
		'position_code' => '',
		'department_id' => '' 
	),
	'fieldPlaceholders' => array(
		'position_id' => '',
		'position_name' => '',
		'job_position_description' => '',
		'job_p_id' => '',
		'position_code' => '',
		'department_id' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>