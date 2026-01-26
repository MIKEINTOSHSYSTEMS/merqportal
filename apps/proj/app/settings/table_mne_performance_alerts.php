<?php
global $runnerTableSettings;
$runnerTableSettings['mne_performance_alerts'] = array(
	'name' => 'mne_performance_alerts',
	'shortName' => 'mne_performance_alerts',
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
	'afterEditDetails' => 'mne_performance_alerts',
	'afterAddDetail' => 'mne_performance_alerts',
	'detailsBadgeColor' => '4682b4',
	'sql' => 'SELECT
	alert_id,
	project_id,
	issue_type,
	issue_description,
	severity,
	status,
	assigned_to,
	due_date,
	resolved_date,
	created_at,
	updated_at
FROM
	mne_performance_alerts',
	'keyFields' => array( 
		'alert_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'alert_id' => array(
			'name' => 'alert_id',
			'goodName' => 'alert_id',
			'strField' => 'alert_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'alert_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_performance_alerts' 
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
			'tableName' => 'mne_performance_alerts' 
		),
		'issue_type' => array(
			'name' => 'issue_type',
			'goodName' => 'issue_type',
			'strField' => 'issue_type',
			'index' => 3,
			'sqlExpression' => 'issue_type',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_performance_alerts' 
		),
		'issue_description' => array(
			'name' => 'issue_description',
			'goodName' => 'issue_description',
			'strField' => 'issue_description',
			'index' => 4,
			'type' => 201,
			'sqlExpression' => 'issue_description',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_performance_alerts' 
		),
		'severity' => array(
			'name' => 'severity',
			'goodName' => 'severity',
			'strField' => 'severity',
			'index' => 5,
			'type' => 129,
			'sqlExpression' => 'severity',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'High',
						'Medium',
						'Low' 
					) 
				) 
			),
			'tableName' => 'mne_performance_alerts' 
		),
		'status' => array(
			'name' => 'status',
			'goodName' => 'status',
			'strField' => 'status',
			'index' => 6,
			'type' => 129,
			'sqlExpression' => 'status',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Open',
						'In Progress',
						'Resolved',
						'Closed' 
					) 
				) 
			),
			'tableName' => 'mne_performance_alerts' 
		),
		'assigned_to' => array(
			'name' => 'assigned_to',
			'goodName' => 'assigned_to',
			'strField' => 'assigned_to',
			'index' => 7,
			'type' => 3,
			'sqlExpression' => 'assigned_to',
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
					'lookupDisplayField' => 'username' 
				) 
			),
			'tableName' => 'mne_performance_alerts' 
		),
		'due_date' => array(
			'name' => 'due_date',
			'goodName' => 'due_date',
			'strField' => 'due_date',
			'index' => 8,
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
			'tableName' => 'mne_performance_alerts' 
		),
		'resolved_date' => array(
			'name' => 'resolved_date',
			'goodName' => 'resolved_date',
			'strField' => 'resolved_date',
			'index' => 9,
			'type' => 7,
			'sqlExpression' => 'resolved_date',
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
			'tableName' => 'mne_performance_alerts' 
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
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_performance_alerts' 
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
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_performance_alerts' 
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
			'table' => 'users',
			'detailsKeys' => array( 
				'assigned_to' 
			),
			'masterKeys' => array( 
				'user_id' 
			) 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	alert_id,
	project_id,
	issue_type,
	issue_description,
	severity,
	status,
	assigned_to,
	due_date,
	resolved_date,
	created_at,
	updated_at
FROM
	mne_performance_alerts',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'alert_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_performance_alerts',
					'name' => 'alert_id' 
				),
				'encrypted' => false,
				'columnName' => 'alert_id' 
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
					'table' => 'mne_performance_alerts',
					'name' => 'project_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_id' 
			),
			array(
				'sql' => 'issue_type',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_performance_alerts',
					'name' => 'issue_type' 
				),
				'encrypted' => false,
				'columnName' => 'issue_type' 
			),
			array(
				'sql' => 'issue_description',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_performance_alerts',
					'name' => 'issue_description' 
				),
				'encrypted' => false,
				'columnName' => 'issue_description' 
			),
			array(
				'sql' => 'severity',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_performance_alerts',
					'name' => 'severity' 
				),
				'encrypted' => false,
				'columnName' => 'severity' 
			),
			array(
				'sql' => 'status',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_performance_alerts',
					'name' => 'status' 
				),
				'encrypted' => false,
				'columnName' => 'status' 
			),
			array(
				'sql' => 'assigned_to',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_performance_alerts',
					'name' => 'assigned_to' 
				),
				'encrypted' => false,
				'columnName' => 'assigned_to' 
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
					'table' => 'mne_performance_alerts',
					'name' => 'due_date' 
				),
				'encrypted' => false,
				'columnName' => 'due_date' 
			),
			array(
				'sql' => 'resolved_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_performance_alerts',
					'name' => 'resolved_date' 
				),
				'encrypted' => false,
				'columnName' => 'resolved_date' 
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
					'table' => 'mne_performance_alerts',
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
					'table' => 'mne_performance_alerts',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_performance_alerts',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_performance_alerts',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'alert_id',
						'project_id',
						'issue_type',
						'issue_description',
						'severity',
						'status',
						'assigned_to',
						'due_date',
						'resolved_date',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_performance_alerts' 
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
		'fieldListSql' => 'alert_id,
	project_id,
	issue_type,
	issue_description,
	severity,
	status,
	assigned_to,
	due_date,
	resolved_date,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_performance_alerts',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_performance_alerts',
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
			'alert_id',
			'project_id',
			'issue_type',
			'issue_description',
			'severity',
			'status',
			'assigned_to',
			'due_date',
			'resolved_date',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'alert_id',
			'project_id',
			'issue_type',
			'issue_description',
			'severity',
			'status',
			'assigned_to',
			'due_date',
			'resolved_date',
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
	$runnerTableLabels['mne_performance_alerts'] = array(
	'tableCaption' => 'Mne Performance Alerts',
	'fieldLabels' => array(
		'alert_id' => 'Alert Id',
		'project_id' => 'Project Id',
		'issue_type' => 'Issue Type',
		'issue_description' => 'Issue Description',
		'severity' => 'Severity',
		'status' => 'Status',
		'assigned_to' => 'Assigned To',
		'due_date' => 'Due Date',
		'resolved_date' => 'Resolved Date',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'alert_id' => '',
		'project_id' => '',
		'issue_type' => '',
		'issue_description' => '',
		'severity' => '',
		'status' => '',
		'assigned_to' => '',
		'due_date' => '',
		'resolved_date' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'alert_id' => '',
		'project_id' => '',
		'issue_type' => '',
		'issue_description' => '',
		'severity' => '',
		'status' => '',
		'assigned_to' => '',
		'due_date' => '',
		'resolved_date' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>