<?php
global $runnerTableSettings;
$runnerTableSettings['mne_year_projects'] = array(
	'name' => 'mne_year_projects',
	'shortName' => 'mne_year_projects',
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
	'afterEditDetails' => 'mne_year_projects',
	'afterAddDetail' => 'mne_year_projects',
	'detailsBadgeColor' => 'edca00',
	'displayLoading' => true,
	'sql' => 'SELECT
	year_project_id,
	project_id,
	project_name,
	client,
	start_date,
	end_date,
	current_status_id,
	remark,
	`year`,
	created_at,
	updated_at
FROM
	mne_year_projects',
	'keyFields' => array( 
		'year_project_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'year_project_id' => array(
			'name' => 'year_project_id',
			'goodName' => 'year_project_id',
			'strField' => 'year_project_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'year_project_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_year_projects' 
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
					'lookupDisplayField' => 'project_name',
					'lookupAutofillEdit' => true,
					'lookupAutofillFields' => array( 
						array(
							'masterField' => 'project_name',
							'lookupField' => 'project_name' 
						),
						array(
							'masterField' => 'client',
							'lookupField' => 'client_name' 
						),
						array(
							'masterField' => 'start_date',
							'lookupField' => 'start_date' 
						),
						array(
							'masterField' => 'end_date',
							'lookupField' => 'end_date_original' 
						),
						array(
							'masterField' => 'current_status_id',
							'lookupField' => 'current_status_id' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_year_projects' 
		),
		'project_name' => array(
			'name' => 'project_name',
			'goodName' => 'project_name',
			'strField' => 'project_name',
			'index' => 3,
			'sqlExpression' => 'project_name',
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
					'lookupLinkField' => 'project_code',
					'lookupDisplayField' => 'project_name',
					'lookupDependent' => true,
					'lookupDependentFields' => array( 
						array(
							'masterField' => 'project_id',
							'lookupField' => 'project_id' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_year_projects' 
		),
		'client' => array(
			'name' => 'client',
			'goodName' => 'client',
			'strField' => 'client',
			'index' => 4,
			'sqlExpression' => 'client',
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
					'lookupLinkField' => 'client_name',
					'lookupDisplayField' => 'client_name',
					'lookupDependent' => true,
					'lookupDependentFields' => array( 
						array(
							'masterField' => 'project_name',
							'lookupField' => 'project_code' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_year_projects' 
		),
		'start_date' => array(
			'name' => 'start_date',
			'goodName' => 'start_date',
			'strField' => 'start_date',
			'index' => 5,
			'type' => 7,
			'sqlExpression' => 'start_date',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_projects',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'start_date',
					'lookupDisplayField' => 'start_date',
					'lookupDependent' => true,
					'lookupDependentFields' => array( 
						array(
							'masterField' => 'project_id',
							'lookupField' => 'project_id' 
						) 
					),
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_year_projects' 
		),
		'end_date' => array(
			'name' => 'end_date',
			'goodName' => 'end_date',
			'strField' => 'end_date',
			'index' => 6,
			'type' => 7,
			'sqlExpression' => 'end_date',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_projects',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'end_date_original',
					'lookupDisplayField' => 'end_date_original',
					'lookupDependent' => true,
					'lookupDependentFields' => array( 
						array(
							'masterField' => 'project_id',
							'lookupField' => 'project_id' 
						) 
					),
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_year_projects' 
		),
		'current_status_id' => array(
			'name' => 'current_status_id',
			'goodName' => 'current_status_id',
			'strField' => 'current_status_id',
			'index' => 7,
			'type' => 3,
			'sqlExpression' => 'current_status_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_status_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'status_id',
					'lookupDisplayField' => 'status_name' 
				) 
			),
			'tableName' => 'mne_year_projects' 
		),
		'remark' => array(
			'name' => 'remark',
			'goodName' => 'remark',
			'strField' => 'remark',
			'index' => 8,
			'type' => 201,
			'sqlExpression' => 'remark',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_year_projects' 
		),
		'year' => array(
			'name' => 'year',
			'goodName' => 'year',
			'strField' => 'year',
			'index' => 9,
			'type' => 3,
			'sqlExpression' => '`year`',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Number',
					'textboxMaxLenth' => 4 
				) 
			),
			'tableName' => 'mne_year_projects' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 10,
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
			'tableName' => 'mne_year_projects' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 11,
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
			'tableName' => 'mne_year_projects' 
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
			'table' => 'mne_status_options',
			'detailsKeys' => array( 
				'current_status_id' 
			),
			'masterKeys' => array( 
				'status_id' 
			) 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	year_project_id,
	project_id,
	project_name,
	client,
	start_date,
	end_date,
	current_status_id,
	remark,
	`year`,
	created_at,
	updated_at
FROM
	mne_year_projects',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'year_project_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_year_projects',
					'name' => 'year_project_id' 
				),
				'encrypted' => false,
				'columnName' => 'year_project_id' 
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
					'table' => 'mne_year_projects',
					'name' => 'project_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_id' 
			),
			array(
				'sql' => 'project_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_year_projects',
					'name' => 'project_name' 
				),
				'encrypted' => false,
				'columnName' => 'project_name' 
			),
			array(
				'sql' => 'client',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_year_projects',
					'name' => 'client' 
				),
				'encrypted' => false,
				'columnName' => 'client' 
			),
			array(
				'sql' => 'start_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_year_projects',
					'name' => 'start_date' 
				),
				'encrypted' => false,
				'columnName' => 'start_date' 
			),
			array(
				'sql' => 'end_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_year_projects',
					'name' => 'end_date' 
				),
				'encrypted' => false,
				'columnName' => 'end_date' 
			),
			array(
				'sql' => 'current_status_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_year_projects',
					'name' => 'current_status_id' 
				),
				'encrypted' => false,
				'columnName' => 'current_status_id' 
			),
			array(
				'sql' => 'remark',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_year_projects',
					'name' => 'remark' 
				),
				'encrypted' => false,
				'columnName' => 'remark' 
			),
			array(
				'sql' => '`year`',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_year_projects',
					'name' => 'year' 
				),
				'encrypted' => false,
				'columnName' => 'year' 
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
					'table' => 'mne_year_projects',
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
					'table' => 'mne_year_projects',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_year_projects',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_year_projects',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'year_project_id',
						'project_id',
						'project_name',
						'client',
						'start_date',
						'end_date',
						'current_status_id',
						'remark',
						'year',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_year_projects' 
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
			),
			array(
				'fieldIndex' => 10,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'year_project_id,
	project_id,
	project_name,
	client,
	start_date,
	end_date,
	current_status_id,
	remark,
	`year`,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_year_projects',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_year_projects',
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
			'year_project_id',
			'project_id',
			'project_name',
			'client',
			'start_date',
			'end_date',
			'current_status_id',
			'remark',
			'year',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'year_project_id',
			'project_id',
			'project_name',
			'client',
			'start_date',
			'end_date',
			'current_status_id',
			'remark',
			'year',
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
	$runnerTableLabels['mne_year_projects'] = array(
	'tableCaption' => 'Mne Year Projects',
	'fieldLabels' => array(
		'year_project_id' => 'Year Project Id',
		'project_id' => 'Project Id',
		'project_name' => 'Project Name',
		'client' => 'Client',
		'start_date' => 'Start Date',
		'end_date' => 'End Date',
		'current_status_id' => 'Current Status',
		'remark' => 'Remark',
		'year' => 'Year',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'year_project_id' => '',
		'project_id' => '',
		'project_name' => '',
		'client' => '',
		'start_date' => '',
		'end_date' => '',
		'current_status_id' => '',
		'remark' => '',
		'year' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'year_project_id' => '',
		'project_id' => '',
		'project_name' => '',
		'client' => '',
		'start_date' => '',
		'end_date' => '',
		'current_status_id' => '',
		'remark' => '',
		'year' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>