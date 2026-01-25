<?php
global $runnerTableSettings;
$runnerTableSettings['mne_project_type_options'] = array(
	'name' => 'mne_project_type_options',
	'shortName' => 'mne_project_type_options',
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
	'afterEditDetails' => 'mne_project_type_options',
	'afterAddDetail' => 'mne_project_type_options',
	'detailsBadgeColor' => '000',
	'sql' => 'SELECT
	type_id,
	type_name,
	type_category,
	description,
	is_active
FROM
	mne_project_type_options',
	'keyFields' => array( 
		'type_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'type_id' => array(
			'name' => 'type_id',
			'goodName' => 'type_id',
			'strField' => 'type_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'type_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_type_options' 
		),
		'type_name' => array(
			'name' => 'type_name',
			'goodName' => 'type_name',
			'strField' => 'type_name',
			'index' => 2,
			'sqlExpression' => 'type_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_type_options' 
		),
		'type_category' => array(
			'name' => 'type_category',
			'goodName' => 'type_category',
			'strField' => 'type_category',
			'index' => 3,
			'sqlExpression' => 'type_category',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_project_category',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'cat_id',
					'lookupDisplayField' => 'category_name' 
				) 
			),
			'tableName' => 'mne_project_type_options' 
		),
		'description' => array(
			'name' => 'description',
			'goodName' => 'description',
			'strField' => 'description',
			'index' => 4,
			'type' => 201,
			'sqlExpression' => 'description',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_type_options' 
		),
		'is_active' => array(
			'name' => 'is_active',
			'goodName' => 'is_active',
			'strField' => 'is_active',
			'index' => 5,
			'type' => 2,
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
			'tableName' => 'mne_project_type_options' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'mne_project_category',
			'detailsKeys' => array( 
				'type_category' 
			),
			'masterKeys' => array( 
				'cat_id' 
			) 
		) 
	),
	'detailsTables' => array( 
		'mne_projects' 
	),
	'query' => array(
		'sql' => 'SELECT
	type_id,
	type_name,
	type_category,
	description,
	is_active
FROM
	mne_project_type_options',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'type_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_type_options',
					'name' => 'type_id' 
				),
				'encrypted' => false,
				'columnName' => 'type_id' 
			),
			array(
				'sql' => 'type_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_type_options',
					'name' => 'type_name' 
				),
				'encrypted' => false,
				'columnName' => 'type_name' 
			),
			array(
				'sql' => 'type_category',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_type_options',
					'name' => 'type_category' 
				),
				'encrypted' => false,
				'columnName' => 'type_category' 
			),
			array(
				'sql' => 'description',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_type_options',
					'name' => 'description' 
				),
				'encrypted' => false,
				'columnName' => 'description' 
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
					'table' => 'mne_project_type_options',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_project_type_options',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_project_type_options',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'type_id',
						'type_name',
						'type_category',
						'description',
						'is_active' 
					),
					'name' => 'mne_project_type_options' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'type_id,
	type_name,
	type_category,
	description,
	is_active',
		'fromListSql' => 'FROM
	mne_project_type_options',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_project_type_options',
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
			'type_id',
			'type_name',
			'type_category',
			'description',
			'is_active' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'type_id',
			'type_name',
			'type_category',
			'description',
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
	$runnerTableLabels['mne_project_type_options'] = array(
	'tableCaption' => 'Mne Project Type Options',
	'fieldLabels' => array(
		'type_id' => 'Type Id',
		'type_name' => 'Type Name',
		'type_category' => 'Type Category',
		'description' => 'Description',
		'is_active' => 'Is Active' 
	),
	'fieldTooltips' => array(
		'type_id' => '',
		'type_name' => '',
		'type_category' => '',
		'description' => '',
		'is_active' => '' 
	),
	'fieldPlaceholders' => array(
		'type_id' => '',
		'type_name' => '',
		'type_category' => '',
		'description' => '',
		'is_active' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>