<?php
global $runnerTableSettings;
$runnerTableSettings['mne_performance_ratings'] = array(
	'name' => 'mne_performance_ratings',
	'shortName' => 'mne_performance_ratings',
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
	'afterEditDetails' => 'mne_performance_ratings',
	'afterAddDetail' => 'mne_performance_ratings',
	'detailsBadgeColor' => '8fbc8b',
	'sql' => 'SELECT
	rating_id,
	rating_name,
	numeric_value,
	description,
	is_active
FROM
	mne_performance_ratings',
	'keyFields' => array( 
		'rating_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'rating_id' => array(
			'name' => 'rating_id',
			'goodName' => 'rating_id',
			'strField' => 'rating_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'rating_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_performance_ratings' 
		),
		'rating_name' => array(
			'name' => 'rating_name',
			'goodName' => 'rating_name',
			'strField' => 'rating_name',
			'index' => 2,
			'sqlExpression' => 'rating_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_performance_ratings' 
		),
		'numeric_value' => array(
			'name' => 'numeric_value',
			'goodName' => 'numeric_value',
			'strField' => 'numeric_value',
			'index' => 3,
			'type' => 14,
			'sqlExpression' => 'numeric_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_performance_ratings' 
		),
		'description' => array(
			'name' => 'description',
			'goodName' => 'description',
			'strField' => 'description',
			'index' => 4,
			'sqlExpression' => 'description',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_performance_ratings' 
		),
		'is_active' => array(
			'name' => 'is_active',
			'goodName' => 'is_active',
			'strField' => 'is_active',
			'index' => 5,
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
			'tableName' => 'mne_performance_ratings' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	rating_id,
	rating_name,
	numeric_value,
	description,
	is_active
FROM
	mne_performance_ratings',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'rating_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_performance_ratings',
					'name' => 'rating_id' 
				),
				'encrypted' => false,
				'columnName' => 'rating_id' 
			),
			array(
				'sql' => 'rating_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_performance_ratings',
					'name' => 'rating_name' 
				),
				'encrypted' => false,
				'columnName' => 'rating_name' 
			),
			array(
				'sql' => 'numeric_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_performance_ratings',
					'name' => 'numeric_value' 
				),
				'encrypted' => false,
				'columnName' => 'numeric_value' 
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
					'table' => 'mne_performance_ratings',
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
					'table' => 'mne_performance_ratings',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_performance_ratings',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_performance_ratings',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'rating_id',
						'rating_name',
						'numeric_value',
						'description',
						'is_active' 
					),
					'name' => 'mne_performance_ratings' 
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
		'fieldListSql' => 'rating_id,
	rating_name,
	numeric_value,
	description,
	is_active',
		'fromListSql' => 'FROM
	mne_performance_ratings',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_performance_ratings',
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
			'rating_id',
			'rating_name',
			'numeric_value',
			'description',
			'is_active' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'rating_id',
			'rating_name',
			'numeric_value',
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
	$runnerTableLabels['mne_performance_ratings'] = array(
	'tableCaption' => 'Mne Performance Ratings',
	'fieldLabels' => array(
		'rating_id' => 'Rating Id',
		'rating_name' => 'Rating Name',
		'numeric_value' => 'Numeric Value',
		'description' => 'Description',
		'is_active' => 'Is Active' 
	),
	'fieldTooltips' => array(
		'rating_id' => '',
		'rating_name' => '',
		'numeric_value' => '',
		'description' => '',
		'is_active' => '' 
	),
	'fieldPlaceholders' => array(
		'rating_id' => '',
		'rating_name' => '',
		'numeric_value' => '',
		'description' => '',
		'is_active' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>