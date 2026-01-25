<?php
global $runnerTableSettings;
$runnerTableSettings['mne_project_deliverables'] = array(
	'name' => 'mne_project_deliverables',
	'shortName' => 'mne_project_deliverables',
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
		'gantt' => array( 
			'gantt' 
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
		'gantt' => 'gantt',
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
		'gantt' => 'gantt',
		'search' => 'search' 
	),
	'afterEditDetails' => 'mne_project_deliverables',
	'afterAddDetail' => 'mne_project_deliverables',
	'detailsBadgeColor' => 'ff9c00',
	'displayLoading' => true,
	'warnLeavingEdit' => true,
	'sql' => 'SELECT
	deliverable_id,
	project_id,
	deliverable_name,
	due_date,
	status_id,
	start_date,
	completed_date,
	quality_check,
	client_acceptance,
	owner,
	notes,
	created_at,
	updated_at,
	ganttProgress
FROM
	mne_project_deliverables',
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
			'tableName' => 'mne_project_deliverables' 
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
					'lookupDisplayField' => 'project_name' 
				) 
			),
			'tableName' => 'mne_project_deliverables' 
		),
		'deliverable_name' => array(
			'name' => 'deliverable_name',
			'goodName' => 'deliverable_name',
			'strField' => 'deliverable_name',
			'index' => 3,
			'sqlExpression' => 'deliverable_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'required' => true,
					'lookupMultiselect' => true,
					'lookupType' => 2,
					'lookupValues' => array( 
						'21',
						'22',
						'23',
						'24',
						'25',
						'26',
						'27',
						'28',
						'29',
						'30',
						'31' 
					),
					'lookupTable' => 'mne_deliverable_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'deliverable_id',
					'lookupDisplayField' => 'deliverable_name',
					'lookupAllowAdd' => true,
					'lookupAddPage' => 'add' 
				) 
			),
			'tableName' => 'mne_project_deliverables' 
		),
		'due_date' => array(
			'name' => 'due_date',
			'goodName' => 'due_date',
			'strField' => 'due_date',
			'index' => 4,
			'type' => 7,
			'sqlExpression' => 'due_date',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_project_deliverables' 
		),
		'status_id' => array(
			'name' => 'status_id',
			'goodName' => 'status_id',
			'strField' => 'status_id',
			'index' => 5,
			'type' => 3,
			'sqlExpression' => 'status_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_deliverable_status',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'status_id',
					'lookupDisplayField' => 'status_name' 
				) 
			),
			'tableName' => 'mne_project_deliverables' 
		),
		'completed_date' => array(
			'name' => 'completed_date',
			'goodName' => 'completed_date',
			'strField' => 'completed_date',
			'index' => 7,
			'type' => 7,
			'sqlExpression' => 'completed_date',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_project_deliverables' 
		),
		'quality_check' => array(
			'name' => 'quality_check',
			'goodName' => 'quality_check',
			'strField' => 'quality_check',
			'index' => 8,
			'sqlExpression' => 'quality_check',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_quality_status',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'quality_id',
					'lookupDisplayField' => 'quality_name' 
				) 
			),
			'tableName' => 'mne_project_deliverables' 
		),
		'client_acceptance' => array(
			'name' => 'client_acceptance',
			'goodName' => 'client_acceptance',
			'strField' => 'client_acceptance',
			'index' => 9,
			'sqlExpression' => 'client_acceptance',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_deliverables' 
		),
		'owner' => array(
			'name' => 'owner',
			'goodName' => 'owner',
			'strField' => 'owner',
			'index' => 10,
			'sqlExpression' => 'owner',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_deliverables' 
		),
		'notes' => array(
			'name' => 'notes',
			'goodName' => 'notes',
			'strField' => 'notes',
			'index' => 11,
			'type' => 201,
			'sqlExpression' => 'notes',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_deliverables' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 12,
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
			'tableName' => 'mne_project_deliverables' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 13,
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
			'tableName' => 'mne_project_deliverables' 
		),
		'start_date' => array(
			'name' => 'start_date',
			'goodName' => 'start_date',
			'strField' => 'start_date',
			'index' => 6,
			'type' => 7,
			'sqlExpression' => 'start_date',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_project_deliverables' 
		),
		'ganttProgress' => array(
			'name' => 'ganttProgress',
			'goodName' => 'ganttProgress',
			'strField' => 'ganttProgress',
			'index' => 14,
			'type' => 3,
			'sqlExpression' => 'ganttProgress',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Number',
					'textHTML5Input' => 'Number' 
				) 
			),
			'tableName' => 'mne_project_deliverables' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'mne_deliverable_status',
			'detailsKeys' => array( 
				'status_id' 
			),
			'masterKeys' => array( 
				'status_id' 
			) 
		),
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
			'table' => 'mne_deliverable_options',
			'detailsKeys' => array( 
				'deliverable_name' 
			),
			'masterKeys' => array( 
				'deliverable_id' 
			) 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	deliverable_id,
	project_id,
	deliverable_name,
	due_date,
	status_id,
	start_date,
	completed_date,
	quality_check,
	client_acceptance,
	owner,
	notes,
	created_at,
	updated_at,
	ganttProgress
FROM
	mne_project_deliverables',
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
					'table' => 'mne_project_deliverables',
					'name' => 'deliverable_id' 
				),
				'encrypted' => false,
				'columnName' => 'deliverable_id' 
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
					'table' => 'mne_project_deliverables',
					'name' => 'project_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_id' 
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
					'table' => 'mne_project_deliverables',
					'name' => 'deliverable_name' 
				),
				'encrypted' => false,
				'columnName' => 'deliverable_name' 
			),
			array(
				'sql' => 'due_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_deliverables',
					'name' => 'due_date' 
				),
				'encrypted' => false,
				'columnName' => 'due_date' 
			),
			array(
				'sql' => 'status_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_deliverables',
					'name' => 'status_id' 
				),
				'encrypted' => false,
				'columnName' => 'status_id' 
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
					'table' => 'mne_project_deliverables',
					'name' => 'start_date' 
				),
				'encrypted' => false,
				'columnName' => 'start_date' 
			),
			array(
				'sql' => 'completed_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_deliverables',
					'name' => 'completed_date' 
				),
				'encrypted' => false,
				'columnName' => 'completed_date' 
			),
			array(
				'sql' => 'quality_check',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_deliverables',
					'name' => 'quality_check' 
				),
				'encrypted' => false,
				'columnName' => 'quality_check' 
			),
			array(
				'sql' => 'client_acceptance',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_deliverables',
					'name' => 'client_acceptance' 
				),
				'encrypted' => false,
				'columnName' => 'client_acceptance' 
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
					'table' => 'mne_project_deliverables',
					'name' => 'owner' 
				),
				'encrypted' => false,
				'columnName' => 'owner' 
			),
			array(
				'sql' => 'notes',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_deliverables',
					'name' => 'notes' 
				),
				'encrypted' => false,
				'columnName' => 'notes' 
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
					'table' => 'mne_project_deliverables',
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
					'table' => 'mne_project_deliverables',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			),
			array(
				'sql' => 'ganttProgress',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_deliverables',
					'name' => 'ganttProgress' 
				),
				'encrypted' => false,
				'columnName' => 'ganttProgress' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_project_deliverables',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_project_deliverables',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'deliverable_id',
						'project_id',
						'deliverable_name',
						'due_date',
						'status_id',
						'start_date',
						'completed_date',
						'quality_check',
						'client_acceptance',
						'owner',
						'notes',
						'created_at',
						'updated_at',
						'ganttProgress' 
					),
					'name' => 'mne_project_deliverables' 
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
			),
			array(
				'fieldIndex' => 11,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 12,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 13,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'deliverable_id,
	project_id,
	deliverable_name,
	due_date,
	status_id,
	start_date,
	completed_date,
	quality_check,
	client_acceptance,
	owner,
	notes,
	created_at,
	updated_at,
	ganttProgress',
		'fromListSql' => 'FROM
	mne_project_deliverables',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_project_deliverables',
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
		'gantt' => array( 
			'gantt' 
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
		'gantt' => 'gantt',
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
		'gantt' => 'gantt',
		'search' => 'search' 
	),
	'searchSettings' => array(
		'caseSensitiveSearch' => false,
		'searchableFields' => array( 
			'deliverable_id',
			'project_id',
			'deliverable_name',
			'due_date',
			'status_id',
			'completed_date',
			'quality_check',
			'client_acceptance',
			'owner',
			'notes',
			'created_at',
			'updated_at',
			'start_date',
			'ganttProgress' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'deliverable_id',
			'project_id',
			'deliverable_name',
			'due_date',
			'status_id',
			'completed_date',
			'quality_check',
			'client_acceptance',
			'owner',
			'notes',
			'created_at',
			'updated_at',
			'start_date',
			'ganttProgress' 
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
			array(
				'value' => '21',
				'color' => 'dc143c' 
			),
			array(
				'value' => '22',
				'color' => '7b68ee' 
			),
			array(
				'value' => '23',
				'color' => 'edca00' 
			),
			array(
				'value' => '24',
				'color' => '00c2c5' 
			),
			array(
				'value' => '25',
				'color' => 'd2691e' 
			),
			array(
				'value' => '26',
				'color' => '9acd32' 
			),
			array(
				'value' => '27',
				'color' => '1e90ff' 
			),
			array(
				'value' => '28',
				'color' => 'e8926f' 
			),
			array(
				'value' => '29',
				'color' => '4682b4' 
			),
			array(
				'value' => '30',
				'color' => '008b8b' 
			),
			array(
				'value' => '31',
				'color' => '6da5c8' 
			) 
		),
		'progressField' => 'ganttProgress',
		'parentField' => '',
		'categoryField' => 'deliverable_name',
		'startDateField' => 'start_date',
		'endDateField' => 'due_date',
		'nameField' => 'deliverable_name' 
	) 
);

global $runnerTableLabels;
if( mlang_getcurrentlang() === 'English' ) {
	$runnerTableLabels['mne_project_deliverables'] = array(
	'tableCaption' => 'Project Deliverables',
	'fieldLabels' => array(
		'deliverable_id' => 'Deliverable ID',
		'project_id' => 'Project ID',
		'deliverable_name' => 'Deliverable',
		'due_date' => 'Due Date',
		'status_id' => 'Status',
		'completed_date' => 'Completed Date',
		'quality_check' => 'Quality Check',
		'client_acceptance' => 'Client Acceptance',
		'owner' => 'Owner',
		'notes' => 'Notes',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At',
		'start_date' => 'Start Date',
		'ganttProgress' => 'Current Progress(%)' 
	),
	'fieldTooltips' => array(
		'deliverable_id' => '',
		'project_id' => '',
		'deliverable_name' => '',
		'due_date' => '',
		'status_id' => '',
		'completed_date' => '',
		'quality_check' => '',
		'client_acceptance' => '',
		'owner' => '',
		'notes' => '',
		'created_at' => '',
		'updated_at' => '',
		'start_date' => '',
		'ganttProgress' => '' 
	),
	'fieldPlaceholders' => array(
		'deliverable_id' => '',
		'project_id' => '',
		'deliverable_name' => '',
		'due_date' => '',
		'status_id' => '',
		'completed_date' => '',
		'quality_check' => '',
		'client_acceptance' => '',
		'owner' => '',
		'notes' => '',
		'created_at' => '',
		'updated_at' => '',
		'start_date' => '',
		'ganttProgress' => '' 
	),
	'pageTitles' => array(
		'add' => 'New task',
		'edit' => 'Modify task',
		'view' => 'Task' 
	) 
);
}
?>