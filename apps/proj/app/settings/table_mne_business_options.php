<?php
global $runnerTableSettings;
$runnerTableSettings['mne_business_options'] = array(
	'name' => 'mne_business_options',
	'shortName' => 'mne_business_options',
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
	'afterEditDetails' => 'mne_business_options',
	'afterAddDetail' => 'mne_business_options',
	'detailsBadgeColor' => 'cd853f',
	'sql' => 'SELECT
	option_id,
	option_type,
	option_value,
	option_label,
	parent_id,
	is_active,
	sort_order
FROM
	mne_business_options',
	'keyFields' => array( 
		'option_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'option_id' => array(
			'name' => 'option_id',
			'goodName' => 'option_id',
			'strField' => 'option_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'option_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_options' 
		),
		'option_type' => array(
			'name' => 'option_type',
			'goodName' => 'option_type',
			'strField' => 'option_type',
			'index' => 2,
			'type' => 129,
			'sqlExpression' => 'option_type',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'source',
						'type',
						'decision',
						'reason',
						'win_loss_reason',
						'contract_types' 
					) 
				) 
			),
			'tableName' => 'mne_business_options' 
		),
		'option_value' => array(
			'name' => 'option_value',
			'goodName' => 'option_value',
			'strField' => 'option_value',
			'index' => 3,
			'sqlExpression' => 'option_value',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_options' 
		),
		'option_label' => array(
			'name' => 'option_label',
			'goodName' => 'option_label',
			'strField' => 'option_label',
			'index' => 4,
			'sqlExpression' => 'option_label',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_options' 
		),
		'parent_id' => array(
			'name' => 'parent_id',
			'goodName' => 'parent_id',
			'strField' => 'parent_id',
			'index' => 5,
			'type' => 3,
			'sqlExpression' => 'parent_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_options' 
		),
		'is_active' => array(
			'name' => 'is_active',
			'goodName' => 'is_active',
			'strField' => 'is_active',
			'index' => 6,
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
			'tableName' => 'mne_business_options' 
		),
		'sort_order' => array(
			'name' => 'sort_order',
			'goodName' => 'sort_order',
			'strField' => 'sort_order',
			'index' => 7,
			'type' => 3,
			'sqlExpression' => 'sort_order',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_options' 
		) 
	),
	'detailsTables' => array( 
		'mne_business_opportunities',
		'mne_projects' 
	),
	'query' => array(
		'sql' => 'SELECT
	option_id,
	option_type,
	option_value,
	option_label,
	parent_id,
	is_active,
	sort_order
FROM
	mne_business_options',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'option_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_options',
					'name' => 'option_id' 
				),
				'encrypted' => false,
				'columnName' => 'option_id' 
			),
			array(
				'sql' => 'option_type',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_options',
					'name' => 'option_type' 
				),
				'encrypted' => false,
				'columnName' => 'option_type' 
			),
			array(
				'sql' => 'option_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_options',
					'name' => 'option_value' 
				),
				'encrypted' => false,
				'columnName' => 'option_value' 
			),
			array(
				'sql' => 'option_label',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_options',
					'name' => 'option_label' 
				),
				'encrypted' => false,
				'columnName' => 'option_label' 
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
					'table' => 'mne_business_options',
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
					'table' => 'mne_business_options',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			),
			array(
				'sql' => 'sort_order',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_options',
					'name' => 'sort_order' 
				),
				'encrypted' => false,
				'columnName' => 'sort_order' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_business_options',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_business_options',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'option_id',
						'option_type',
						'option_value',
						'option_label',
						'parent_id',
						'is_active',
						'sort_order' 
					),
					'name' => 'mne_business_options' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'option_id,
	option_type,
	option_value,
	option_label,
	parent_id,
	is_active,
	sort_order',
		'fromListSql' => 'FROM
	mne_business_options',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_business_options',
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
			'option_id',
			'option_type',
			'option_value',
			'option_label',
			'parent_id',
			'is_active',
			'sort_order' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'option_id',
			'option_type',
			'option_value',
			'option_label',
			'parent_id',
			'is_active',
			'sort_order' 
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
	$runnerTableLabels['mne_business_options'] = array(
	'tableCaption' => 'Mne Business Options',
	'fieldLabels' => array(
		'option_id' => 'Option Id',
		'option_type' => 'Option Type',
		'option_value' => 'Option Value',
		'option_label' => 'Option Label',
		'parent_id' => 'Parent Id',
		'is_active' => 'Is Active',
		'sort_order' => 'Sort Order' 
	),
	'fieldTooltips' => array(
		'option_id' => '',
		'option_type' => '',
		'option_value' => '',
		'option_label' => '',
		'parent_id' => '',
		'is_active' => '',
		'sort_order' => '' 
	),
	'fieldPlaceholders' => array(
		'option_id' => '',
		'option_type' => '',
		'option_value' => '',
		'option_label' => '',
		'parent_id' => '',
		'is_active' => '',
		'sort_order' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>