<?php
global $runnerTableSettings;
$runnerTableSettings['mne_project_leads'] = array(
	'name' => 'mne_project_leads',
	'shortName' => 'mne_project_leads',
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
	'afterEditDetails' => 'mne_project_leads',
	'afterAddDetail' => 'mne_project_leads',
	'detailsBadgeColor' => '4169e1',
	'displayLoading' => true,
	'warnLeavingEdit' => true,
	'sql' => 'SELECT
	lead_id,
	user_id,
	lead_name,
	email,
	phone,
	`role`,
	is_active
FROM
	mne_project_leads',
	'keyFields' => array( 
		'lead_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'lead_id' => array(
			'name' => 'lead_id',
			'goodName' => 'lead_id',
			'strField' => 'lead_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'lead_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_leads' 
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
					'lookupDisplayField' => 'full_name',
					'lookupAutofillEdit' => true,
					'lookupAutofillFields' => array( 
						array(
							'masterField' => 'email',
							'lookupField' => 'email' 
						),
						array(
							'masterField' => 'phone',
							'lookupField' => 'phone' 
						),
						array(
							'masterField' => 'lead_name',
							'lookupField' => 'full_name' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_project_leads' 
		),
		'lead_name' => array(
			'name' => 'lead_name',
			'goodName' => 'lead_name',
			'strField' => 'lead_name',
			'index' => 3,
			'sqlExpression' => 'lead_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_leads' 
		),
		'email' => array(
			'name' => 'email',
			'goodName' => 'email',
			'strField' => 'email',
			'index' => 4,
			'sqlExpression' => 'email',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Email Hyperlink' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Email',
					'textHTML5Input' => 'Email' 
				) 
			),
			'tableName' => 'mne_project_leads' 
		),
		'phone' => array(
			'name' => 'phone',
			'goodName' => 'phone',
			'strField' => 'phone',
			'index' => 5,
			'sqlExpression' => 'phone',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Phone Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Telephone',
					'pluginInitString' => '$this->settings["required"] = false;                    // Wether is mandatory
$this->settings["tooltip"] = "Click here to enter telephone"; // Information tooltip
$this->settings["initialCountry"] = "et";               // Country default
$this->settings["preferredCountries"] = "et";           // Preferred Country
' 
				) 
			),
			'tableName' => 'mne_project_leads' 
		),
		'role' => array(
			'name' => 'role',
			'goodName' => 'role',
			'strField' => 'role',
			'index' => 6,
			'sqlExpression' => '`role`',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_leads' 
		),
		'is_active' => array(
			'name' => 'is_active',
			'goodName' => 'is_active',
			'strField' => 'is_active',
			'index' => 7,
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
			'tableName' => 'mne_project_leads' 
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
	'detailsTables' => array( 
		'mne_business_opportunities',
		'mne_projects' 
	),
	'query' => array(
		'sql' => 'SELECT
	lead_id,
	user_id,
	lead_name,
	email,
	phone,
	`role`,
	is_active
FROM
	mne_project_leads',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'lead_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_leads',
					'name' => 'lead_id' 
				),
				'encrypted' => false,
				'columnName' => 'lead_id' 
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
					'table' => 'mne_project_leads',
					'name' => 'user_id' 
				),
				'encrypted' => false,
				'columnName' => 'user_id' 
			),
			array(
				'sql' => 'lead_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_leads',
					'name' => 'lead_name' 
				),
				'encrypted' => false,
				'columnName' => 'lead_name' 
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
					'table' => 'mne_project_leads',
					'name' => 'email' 
				),
				'encrypted' => false,
				'columnName' => 'email' 
			),
			array(
				'sql' => 'phone',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_leads',
					'name' => 'phone' 
				),
				'encrypted' => false,
				'columnName' => 'phone' 
			),
			array(
				'sql' => '`role`',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_leads',
					'name' => 'role' 
				),
				'encrypted' => false,
				'columnName' => 'role' 
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
					'table' => 'mne_project_leads',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_project_leads',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_project_leads',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'lead_id',
						'user_id',
						'lead_name',
						'email',
						'phone',
						'role',
						'is_active' 
					),
					'name' => 'mne_project_leads' 
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
		'fieldListSql' => 'lead_id,
	user_id,
	lead_name,
	email,
	phone,
	`role`,
	is_active',
		'fromListSql' => 'FROM
	mne_project_leads',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_project_leads',
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
			'lead_id',
			'user_id',
			'lead_name',
			'email',
			'phone',
			'role',
			'is_active' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'lead_id',
			'user_id',
			'lead_name',
			'email',
			'phone',
			'role',
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
	$runnerTableLabels['mne_project_leads'] = array(
	'tableCaption' => 'Mne Project Leads',
	'fieldLabels' => array(
		'lead_id' => 'Lead Id',
		'user_id' => 'User Id',
		'lead_name' => 'Lead Name',
		'email' => 'Email',
		'phone' => 'Phone',
		'role' => 'Role (in the Project)',
		'is_active' => 'Is Active' 
	),
	'fieldTooltips' => array(
		'lead_id' => '',
		'user_id' => '',
		'lead_name' => '',
		'email' => '',
		'phone' => '',
		'role' => '',
		'is_active' => '' 
	),
	'fieldPlaceholders' => array(
		'lead_id' => '',
		'user_id' => '',
		'lead_name' => '',
		'email' => '',
		'phone' => '',
		'role' => '',
		'is_active' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>