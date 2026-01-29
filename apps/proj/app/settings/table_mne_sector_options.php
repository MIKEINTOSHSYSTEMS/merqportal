<?php
global $runnerTableSettings;
$runnerTableSettings['mne_sector_options'] = array(
	'name' => 'mne_sector_options',
	'shortName' => 'mne_sector_options',
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
	'afterEditDetails' => 'mne_sector_options',
	'afterAddDetail' => 'mne_sector_options',
	'detailsBadgeColor' => '757bff',
	'sql' => 'SELECT
	sector_id,
	sector_name,
	sector_category,
	parent_id,
	is_active
FROM
	mne_sector_options',
	'keyFields' => array( 
		'sector_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'sector_id' => array(
			'name' => 'sector_id',
			'goodName' => 'sector_id',
			'strField' => 'sector_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'sector_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_sector_options' 
		),
		'sector_name' => array(
			'name' => 'sector_name',
			'goodName' => 'sector_name',
			'strField' => 'sector_name',
			'index' => 2,
			'sqlExpression' => 'sector_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_sector_options' 
		),
		'sector_category' => array(
			'name' => 'sector_category',
			'goodName' => 'sector_category',
			'strField' => 'sector_category',
			'index' => 3,
			'sqlExpression' => 'sector_category',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_sector_category',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'category_id',
					'lookupDisplayField' => 'category_name' 
				) 
			),
			'tableName' => 'mne_sector_options' 
		),
		'parent_id' => array(
			'name' => 'parent_id',
			'goodName' => 'parent_id',
			'strField' => 'parent_id',
			'index' => 4,
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
					'lookupTable' => 'mne_sector_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'sector_id',
					'lookupDisplayField' => 'sector_name' 
				) 
			),
			'tableName' => 'mne_sector_options' 
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
			'tableName' => 'mne_sector_options' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'mne_sector_category',
			'detailsKeys' => array( 
				'sector_category' 
			),
			'masterKeys' => array( 
				'category_id' 
			) 
		) 
	),
	'detailsTables' => array( 
		'mne_business_opportunities',
		'mne_extended_projects',
		'mne_projects' 
	),
	'query' => array(
		'sql' => 'SELECT
	sector_id,
	sector_name,
	sector_category,
	parent_id,
	is_active
FROM
	mne_sector_options',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'sector_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_sector_options',
					'name' => 'sector_id' 
				),
				'encrypted' => false,
				'columnName' => 'sector_id' 
			),
			array(
				'sql' => 'sector_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_sector_options',
					'name' => 'sector_name' 
				),
				'encrypted' => false,
				'columnName' => 'sector_name' 
			),
			array(
				'sql' => 'sector_category',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_sector_options',
					'name' => 'sector_category' 
				),
				'encrypted' => false,
				'columnName' => 'sector_category' 
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
					'table' => 'mne_sector_options',
					'name' => 'parent_id' 
				),
				'encrypted' => false,
				'columnName' => 'parent_id' 
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
					'table' => 'mne_sector_options',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_sector_options',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_sector_options',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'sector_id',
						'sector_name',
						'sector_category',
						'parent_id',
						'is_active' 
					),
					'name' => 'mne_sector_options' 
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
		'fieldListSql' => 'sector_id,
	sector_name,
	sector_category,
	parent_id,
	is_active',
		'fromListSql' => 'FROM
	mne_sector_options',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_sector_options',
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
			'sector_id',
			'sector_name',
			'sector_category',
			'parent_id',
			'is_active' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'sector_id',
			'sector_name',
			'sector_category',
			'parent_id',
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
	$runnerTableLabels['mne_sector_options'] = array(
	'tableCaption' => 'Mne Sector Options',
	'fieldLabels' => array(
		'sector_id' => 'Sector Id',
		'sector_name' => 'Sector Name',
		'sector_category' => 'Sector Category',
		'parent_id' => 'Parent',
		'is_active' => 'Is Active' 
	),
	'fieldTooltips' => array(
		'sector_id' => '',
		'sector_name' => '',
		'sector_category' => '',
		'parent_id' => '',
		'is_active' => '' 
	),
	'fieldPlaceholders' => array(
		'sector_id' => '',
		'sector_name' => '',
		'sector_category' => '',
		'parent_id' => '',
		'is_active' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>