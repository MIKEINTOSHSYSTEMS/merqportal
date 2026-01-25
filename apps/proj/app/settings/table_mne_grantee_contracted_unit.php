<?php
global $runnerTableSettings;
$runnerTableSettings['mne_grantee_contracted_unit'] = array(
	'name' => 'mne_grantee_contracted_unit',
	'shortName' => 'mne_grantee_contracted_unit',
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
	'afterEditDetails' => 'mne_grantee_contracted_unit',
	'afterAddDetail' => 'mne_grantee_contracted_unit',
	'detailsBadgeColor' => 'daa520',
	'sql' => 'SELECT
	grantee_id,
	grantee_name,
	grantee_details,
	grantee_address,
	grantee_contact_person,
	is_active
FROM
	mne_grantee_contracted_unit',
	'keyFields' => array( 
		'grantee_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'grantee_id' => array(
			'name' => 'grantee_id',
			'goodName' => 'grantee_id',
			'strField' => 'grantee_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'grantee_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_grantee_contracted_unit' 
		),
		'grantee_name' => array(
			'name' => 'grantee_name',
			'goodName' => 'grantee_name',
			'strField' => 'grantee_name',
			'index' => 2,
			'sqlExpression' => 'grantee_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_grantee_contracted_unit' 
		),
		'grantee_details' => array(
			'name' => 'grantee_details',
			'goodName' => 'grantee_details',
			'strField' => 'grantee_details',
			'index' => 3,
			'sqlExpression' => 'grantee_details',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_grantee_contracted_unit' 
		),
		'grantee_address' => array(
			'name' => 'grantee_address',
			'goodName' => 'grantee_address',
			'strField' => 'grantee_address',
			'index' => 4,
			'sqlExpression' => 'grantee_address',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_grantee_contracted_unit' 
		),
		'grantee_contact_person' => array(
			'name' => 'grantee_contact_person',
			'goodName' => 'grantee_contact_person',
			'strField' => 'grantee_contact_person',
			'index' => 5,
			'sqlExpression' => 'grantee_contact_person',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_grantee_contracted_unit' 
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
			'tableName' => 'mne_grantee_contracted_unit' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	grantee_id,
	grantee_name,
	grantee_details,
	grantee_address,
	grantee_contact_person,
	is_active
FROM
	mne_grantee_contracted_unit',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'grantee_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_grantee_contracted_unit',
					'name' => 'grantee_id' 
				),
				'encrypted' => false,
				'columnName' => 'grantee_id' 
			),
			array(
				'sql' => 'grantee_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_grantee_contracted_unit',
					'name' => 'grantee_name' 
				),
				'encrypted' => false,
				'columnName' => 'grantee_name' 
			),
			array(
				'sql' => 'grantee_details',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_grantee_contracted_unit',
					'name' => 'grantee_details' 
				),
				'encrypted' => false,
				'columnName' => 'grantee_details' 
			),
			array(
				'sql' => 'grantee_address',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_grantee_contracted_unit',
					'name' => 'grantee_address' 
				),
				'encrypted' => false,
				'columnName' => 'grantee_address' 
			),
			array(
				'sql' => 'grantee_contact_person',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_grantee_contracted_unit',
					'name' => 'grantee_contact_person' 
				),
				'encrypted' => false,
				'columnName' => 'grantee_contact_person' 
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
					'table' => 'mne_grantee_contracted_unit',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_grantee_contracted_unit',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_grantee_contracted_unit',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'grantee_id',
						'grantee_name',
						'grantee_details',
						'grantee_address',
						'grantee_contact_person',
						'is_active' 
					),
					'name' => 'mne_grantee_contracted_unit' 
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
		'fieldListSql' => 'grantee_id,
	grantee_name,
	grantee_details,
	grantee_address,
	grantee_contact_person,
	is_active',
		'fromListSql' => 'FROM
	mne_grantee_contracted_unit',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_grantee_contracted_unit',
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
			'grantee_id',
			'grantee_name',
			'grantee_details',
			'grantee_address',
			'grantee_contact_person',
			'is_active' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'grantee_id',
			'grantee_name',
			'grantee_details',
			'grantee_address',
			'grantee_contact_person',
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
	$runnerTableLabels['mne_grantee_contracted_unit'] = array(
	'tableCaption' => 'Mne Grantee Contracted Unit',
	'fieldLabels' => array(
		'grantee_id' => 'Grantee Id',
		'grantee_name' => 'Grantee Name',
		'grantee_details' => 'Grantee Details',
		'grantee_address' => 'Grantee Address',
		'grantee_contact_person' => 'Grantee Contact Person',
		'is_active' => 'Is Active' 
	),
	'fieldTooltips' => array(
		'grantee_id' => '',
		'grantee_name' => '',
		'grantee_details' => '',
		'grantee_address' => '',
		'grantee_contact_person' => '',
		'is_active' => '' 
	),
	'fieldPlaceholders' => array(
		'grantee_id' => '',
		'grantee_name' => '',
		'grantee_details' => '',
		'grantee_address' => '',
		'grantee_contact_person' => '',
		'is_active' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>