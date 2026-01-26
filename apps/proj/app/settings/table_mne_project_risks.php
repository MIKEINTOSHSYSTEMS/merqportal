<?php
global $runnerTableSettings;
$runnerTableSettings['mne_project_risks'] = array(
	'name' => 'mne_project_risks',
	'shortName' => 'mne_project_risks',
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
	'audit' => true,
	'afterEditDetails' => 'mne_project_risks',
	'afterAddDetail' => 'mne_project_risks',
	'detailsBadgeColor' => 'd2af80',
	'displayLoading' => true,
	'sql' => 'SELECT
	risk_id,
	project_id,
	risk_description,
	probability_id,
	impact_id,
	risk_level,
	mitigation_actions,
	owner,
	created_at,
	updated_at
FROM
	mne_project_risks',
	'keyFields' => array( 
		'risk_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'risk_id' => array(
			'name' => 'risk_id',
			'goodName' => 'risk_id',
			'strField' => 'risk_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'risk_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_risks' 
		),
		'project_id' => array(
			'name' => 'project_id',
			'goodName' => 'project_id',
			'strField' => 'project_id',
			'index' => 2,
			'type' => 3,
			'sqlExpression' => 'project_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_projects',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'project_id',
					'lookupDisplayField' => 'project_code' 
				) 
			),
			'tableName' => 'mne_project_risks' 
		),
		'risk_description' => array(
			'name' => 'risk_description',
			'goodName' => 'risk_description',
			'strField' => 'risk_description',
			'index' => 3,
			'type' => 201,
			'sqlExpression' => 'risk_description',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_risks' 
		),
		'probability_id' => array(
			'name' => 'probability_id',
			'goodName' => 'probability_id',
			'strField' => 'probability_id',
			'index' => 4,
			'type' => 3,
			'sqlExpression' => 'probability_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_risk_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_name',
					'lookupWhere' => 'option_type = "probability"' 
				) 
			),
			'tableName' => 'mne_project_risks' 
		),
		'impact_id' => array(
			'name' => 'impact_id',
			'goodName' => 'impact_id',
			'strField' => 'impact_id',
			'index' => 5,
			'type' => 3,
			'sqlExpression' => 'impact_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_risk_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_name',
					'lookupWhere' => 'option_type = "impact"' 
				) 
			),
			'tableName' => 'mne_project_risks' 
		),
		'risk_level' => array(
			'name' => 'risk_level',
			'goodName' => 'risk_level',
			'strField' => 'risk_level',
			'index' => 6,
			'sqlExpression' => 'risk_level',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_risk_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_name',
					'lookupWhere' => 'option_type = "severity"' 
				) 
			),
			'tableName' => 'mne_project_risks' 
		),
		'mitigation_actions' => array(
			'name' => 'mitigation_actions',
			'goodName' => 'mitigation_actions',
			'strField' => 'mitigation_actions',
			'index' => 7,
			'type' => 201,
			'sqlExpression' => 'mitigation_actions',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_risks' 
		),
		'owner' => array(
			'name' => 'owner',
			'goodName' => 'owner',
			'strField' => 'owner',
			'index' => 8,
			'sqlExpression' => 'owner',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_risks' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 9,
			'type' => 135,
			'sqlExpression' => 'created_at',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'defaultValue' => 'date("Y-m-d H:i:s")',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_project_risks' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 10,
			'type' => 135,
			'sqlExpression' => 'updated_at',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'autoUpdateValue' => 'date("Y-m-d H:i:s")',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_project_risks' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'mne_projects',
			'detailsKeys' => array( 
				'project_id' 
			),
			'masterKeys' => array( 
				'project_id' 
			) 
		),
		array(
			'table' => 'mne_risk_options',
			'detailsKeys' => array( 
				'probability_id' 
			),
			'masterKeys' => array( 
				'option_id' 
			) 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	risk_id,
	project_id,
	risk_description,
	probability_id,
	impact_id,
	risk_level,
	mitigation_actions,
	owner,
	created_at,
	updated_at
FROM
	mne_project_risks',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'risk_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_risks',
					'name' => 'risk_id' 
				),
				'encrypted' => false,
				'columnName' => 'risk_id' 
			),
			array(
				'sql' => 'project_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_risks',
					'name' => 'project_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_id' 
			),
			array(
				'sql' => 'risk_description',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_risks',
					'name' => 'risk_description' 
				),
				'encrypted' => false,
				'columnName' => 'risk_description' 
			),
			array(
				'sql' => 'probability_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_risks',
					'name' => 'probability_id' 
				),
				'encrypted' => false,
				'columnName' => 'probability_id' 
			),
			array(
				'sql' => 'impact_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_risks',
					'name' => 'impact_id' 
				),
				'encrypted' => false,
				'columnName' => 'impact_id' 
			),
			array(
				'sql' => 'risk_level',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_risks',
					'name' => 'risk_level' 
				),
				'encrypted' => false,
				'columnName' => 'risk_level' 
			),
			array(
				'sql' => 'mitigation_actions',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_risks',
					'name' => 'mitigation_actions' 
				),
				'encrypted' => false,
				'columnName' => 'mitigation_actions' 
			),
			array(
				'sql' => 'owner',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_risks',
					'name' => 'owner' 
				),
				'encrypted' => false,
				'columnName' => 'owner' 
			),
			array(
				'sql' => 'created_at',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_risks',
					'name' => 'created_at' 
				),
				'encrypted' => false,
				'columnName' => 'created_at' 
			),
			array(
				'sql' => 'updated_at',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_risks',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_project_risks',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_project_risks',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'risk_id',
						'project_id',
						'risk_description',
						'probability_id',
						'impact_id',
						'risk_level',
						'mitigation_actions',
						'owner',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_project_risks' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'risk_id,
	project_id,
	risk_description,
	probability_id,
	impact_id,
	risk_level,
	mitigation_actions,
	owner,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_project_risks',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_project_risks',
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
			'risk_id',
			'project_id',
			'risk_description',
			'probability_id',
			'impact_id',
			'risk_level',
			'mitigation_actions',
			'owner',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'risk_id',
			'project_id',
			'risk_description',
			'probability_id',
			'impact_id',
			'risk_level',
			'mitigation_actions',
			'owner',
			'created_at',
			'updated_at' 
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
	$runnerTableLabels['mne_project_risks'] = array(
	'tableCaption' => 'Project Risks',
	'fieldLabels' => array(
		'risk_id' => 'Risk Id',
		'project_id' => 'Project Id',
		'risk_description' => 'Risk Description',
		'probability_id' => 'Probability Id',
		'impact_id' => 'Impact Id',
		'risk_level' => 'Risk Level',
		'mitigation_actions' => 'Mitigation Actions',
		'owner' => 'Owner',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'risk_id' => '',
		'project_id' => '',
		'risk_description' => '',
		'probability_id' => '',
		'impact_id' => '',
		'risk_level' => '',
		'mitigation_actions' => '',
		'owner' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'risk_id' => '',
		'project_id' => '',
		'risk_description' => '',
		'probability_id' => '',
		'impact_id' => '',
		'risk_level' => '',
		'mitigation_actions' => '',
		'owner' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>