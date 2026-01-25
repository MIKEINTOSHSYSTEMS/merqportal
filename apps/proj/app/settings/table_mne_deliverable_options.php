<?php
global $runnerTableSettings;
$runnerTableSettings['mne_deliverable_options'] = array(
	'name' => 'mne_deliverable_options',
	'shortName' => 'mne_deliverable_options',
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
	'afterEditDetails' => 'mne_deliverable_options',
	'afterAddDetail' => 'mne_deliverable_options',
	'detailsBadgeColor' => '6493ea',
	'sql' => 'SELECT
	deliverable_id,
	deliverable_name,
	deliverable_description,
	is_active
FROM
	mne_deliverable_options',
	'keyFields' => array( 
		'deliverable_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'deliverable_id' => array(
			'name' => 'deliverable_id',
			'goodName' => 'deliverable_id',
			'strField' => 'deliverable_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'deliverable_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_deliverable_options' 
		),
		'deliverable_name' => array(
			'name' => 'deliverable_name',
			'goodName' => 'deliverable_name',
			'strField' => 'deliverable_name',
			'index' => 2,
			'sqlExpression' => 'deliverable_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_deliverable_options' 
		),
		'deliverable_description' => array(
			'name' => 'deliverable_description',
			'goodName' => 'deliverable_description',
			'strField' => 'deliverable_description',
			'index' => 3,
			'type' => 201,
			'sqlExpression' => 'deliverable_description',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_deliverable_options' 
		),
		'is_active' => array(
			'name' => 'is_active',
			'goodName' => 'is_active',
			'strField' => 'is_active',
			'index' => 4,
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
			'tableName' => 'mne_deliverable_options' 
		) 
	),
	'detailsTables' => array( 
		'mne_project_deliverables' 
	),
	'query' => array(
		'sql' => 'SELECT
	deliverable_id,
	deliverable_name,
	deliverable_description,
	is_active
FROM
	mne_deliverable_options',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'deliverable_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_deliverable_options',
					'name' => 'deliverable_id' 
				),
				'encrypted' => false,
				'columnName' => 'deliverable_id' 
			),
			array(
				'sql' => 'deliverable_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_deliverable_options',
					'name' => 'deliverable_name' 
				),
				'encrypted' => false,
				'columnName' => 'deliverable_name' 
			),
			array(
				'sql' => 'deliverable_description',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_deliverable_options',
					'name' => 'deliverable_description' 
				),
				'encrypted' => false,
				'columnName' => 'deliverable_description' 
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
					'table' => 'mne_deliverable_options',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_deliverable_options',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_deliverable_options',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'deliverable_id',
						'deliverable_name',
						'deliverable_description',
						'is_active' 
					),
					'name' => 'mne_deliverable_options' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'deliverable_id,
	deliverable_name,
	deliverable_description,
	is_active',
		'fromListSql' => 'FROM
	mne_deliverable_options',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_deliverable_options',
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
			'deliverable_id',
			'deliverable_name',
			'deliverable_description',
			'is_active' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'deliverable_id',
			'deliverable_name',
			'deliverable_description',
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
	$runnerTableLabels['mne_deliverable_options'] = array(
	'tableCaption' => 'Mne Deliverable Options',
	'fieldLabels' => array(
		'deliverable_id' => 'Deliverable Id',
		'deliverable_name' => 'Deliverable Name',
		'deliverable_description' => 'Deliverable Description',
		'is_active' => 'Is Active' 
	),
	'fieldTooltips' => array(
		'deliverable_id' => '',
		'deliverable_name' => '',
		'deliverable_description' => '',
		'is_active' => '' 
	),
	'fieldPlaceholders' => array(
		'deliverable_id' => '',
		'deliverable_name' => '',
		'deliverable_description' => '',
		'is_active' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>