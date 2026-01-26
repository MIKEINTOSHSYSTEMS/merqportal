<?php
global $runnerTableSettings;
$runnerTableSettings['mne_project_timelines'] = array(
	'name' => 'mne_project_timelines',
	'shortName' => 'mne_project_timelines',
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
	'audit' => true,
	'afterEditDetails' => 'mne_project_timelines',
	'afterAddDetail' => 'mne_project_timelines',
	'detailsBadgeColor' => '6b8e23',
	'displayLoading' => true,
	'sql' => 'SELECT
	timeline_id,
	project_id,
	milestone_name,
	start_date,
	planned_date,
	actual_date,
	variance_days,
	status_id,
	notes,
	created_at,
	updated_at,
	ganttProgress
FROM
	mne_project_timelines
',
	'keyFields' => array( 
		'timeline_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'timeline_id' => array(
			'name' => 'timeline_id',
			'goodName' => 'timeline_id',
			'strField' => 'timeline_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'timeline_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_timelines' 
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
			'tableName' => 'mne_project_timelines' 
		),
		'milestone_name' => array(
			'name' => 'milestone_name',
			'goodName' => 'milestone_name',
			'strField' => 'milestone_name',
			'index' => 3,
			'sqlExpression' => 'milestone_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'lookupValues' => array( 
						'Project Start',
						'Milestone 1',
						'Milestone 2',
						'Mid-term Review',
						'Final Review',
						'Project End' 
					) 
				) 
			),
			'tableName' => 'mne_project_timelines' 
		),
		'planned_date' => array(
			'name' => 'planned_date',
			'goodName' => 'planned_date',
			'strField' => 'planned_date',
			'index' => 5,
			'type' => 7,
			'sqlExpression' => 'planned_date',
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
			'tableName' => 'mne_project_timelines' 
		),
		'actual_date' => array(
			'name' => 'actual_date',
			'goodName' => 'actual_date',
			'strField' => 'actual_date',
			'index' => 6,
			'type' => 7,
			'sqlExpression' => 'actual_date',
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
			'tableName' => 'mne_project_timelines' 
		),
		'variance_days' => array(
			'name' => 'variance_days',
			'goodName' => 'variance_days',
			'strField' => 'variance_days',
			'index' => 7,
			'type' => 3,
			'sqlExpression' => 'variance_days',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_timelines' 
		),
		'status_id' => array(
			'name' => 'status_id',
			'goodName' => 'status_id',
			'strField' => 'status_id',
			'index' => 8,
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
					'lookupTable' => 'mne_status_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'status_id',
					'lookupDisplayField' => 'status_name' 
				) 
			),
			'tableName' => 'mne_project_timelines' 
		),
		'notes' => array(
			'name' => 'notes',
			'goodName' => 'notes',
			'strField' => 'notes',
			'index' => 9,
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
			'tableName' => 'mne_project_timelines' 
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
			'tableName' => 'mne_project_timelines' 
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
			'tableName' => 'mne_project_timelines' 
		),
		'start_date' => array(
			'name' => 'start_date',
			'goodName' => 'start_date',
			'strField' => 'start_date',
			'index' => 4,
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
			'tableName' => 'mne_project_timelines' 
		),
		'ganttProgress' => array(
			'name' => 'ganttProgress',
			'goodName' => 'ganttProgress',
			'strField' => 'ganttProgress',
			'index' => 12,
			'type' => 3,
			'sqlExpression' => 'ganttProgress',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => '' 
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
				'status_id' 
			),
			'masterKeys' => array( 
				'status_id' 
			) 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	timeline_id,
	project_id,
	milestone_name,
	start_date,
	planned_date,
	actual_date,
	variance_days,
	status_id,
	notes,
	created_at,
	updated_at,
	ganttProgress
FROM
	mne_project_timelines
',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'timeline_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_timelines',
					'name' => 'timeline_id' 
				),
				'encrypted' => false,
				'columnName' => 'timeline_id' 
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
					'table' => 'mne_project_timelines',
					'name' => 'project_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_id' 
			),
			array(
				'sql' => 'milestone_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_timelines',
					'name' => 'milestone_name' 
				),
				'encrypted' => false,
				'columnName' => 'milestone_name' 
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
					'table' => 'mne_project_timelines',
					'name' => 'start_date' 
				),
				'encrypted' => false,
				'columnName' => 'start_date' 
			),
			array(
				'sql' => 'planned_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_timelines',
					'name' => 'planned_date' 
				),
				'encrypted' => false,
				'columnName' => 'planned_date' 
			),
			array(
				'sql' => 'actual_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_timelines',
					'name' => 'actual_date' 
				),
				'encrypted' => false,
				'columnName' => 'actual_date' 
			),
			array(
				'sql' => 'variance_days',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_timelines',
					'name' => 'variance_days' 
				),
				'encrypted' => false,
				'columnName' => 'variance_days' 
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
					'table' => 'mne_project_timelines',
					'name' => 'status_id' 
				),
				'encrypted' => false,
				'columnName' => 'status_id' 
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
					'table' => 'mne_project_timelines',
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
					'table' => 'mne_project_timelines',
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
					'table' => 'mne_project_timelines',
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
					'table' => 'mne_project_timelines',
					'name' => 'ganttProgress' 
				),
				'encrypted' => false,
				'columnName' => 'ganttProgress' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_project_timelines',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_project_timelines',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'timeline_id',
						'project_id',
						'milestone_name',
						'start_date',
						'planned_date',
						'actual_date',
						'variance_days',
						'status_id',
						'notes',
						'created_at',
						'updated_at',
						'ganttProgress' 
					),
					'name' => 'mne_project_timelines' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'timeline_id,
	project_id,
	milestone_name,
	start_date,
	planned_date,
	actual_date,
	variance_days,
	status_id,
	notes,
	created_at,
	updated_at,
	ganttProgress',
		'fromListSql' => 'FROM
	mne_project_timelines',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_project_timelines',
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
			'timeline_id',
			'project_id',
			'milestone_name',
			'planned_date',
			'actual_date',
			'variance_days',
			'status_id',
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
			'timeline_id',
			'project_id',
			'milestone_name',
			'planned_date',
			'actual_date',
			'variance_days',
			'status_id',
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
				'value' => 'Project Start',
				'color' => '6b8e23' 
			),
			array(
				'value' => 'Milestone 1',
				'color' => '00c2c5' 
			),
			array(
				'value' => 'Milestone 2',
				'color' => 'e67349' 
			),
			array(
				'value' => 'Mid-term Review',
				'color' => 'edca00' 
			),
			array(
				'value' => 'Final Review',
				'color' => '1e90ff' 
			),
			array(
				'value' => 'Project End',
				'color' => 'dc143c' 
			) 
		),
		'progressField' => 'ganttProgress',
		'parentField' => '',
		'categoryField' => 'milestone_name',
		'startDateField' => 'start_date',
		'endDateField' => 'planned_date',
		'nameField' => 'milestone_name' 
	) 
);

global $runnerTableLabels;
if( mlang_getcurrentlang() === 'English' ) {
	$runnerTableLabels['mne_project_timelines'] = array(
	'tableCaption' => 'Milestone / Timelines',
	'fieldLabels' => array(
		'timeline_id' => 'Timeline Id',
		'project_id' => 'Project ID',
		'milestone_name' => 'Milestone Name',
		'planned_date' => 'Planned Completion Date',
		'actual_date' => 'Actual Completion Date',
		'variance_days' => 'Variance Days',
		'status_id' => 'Status',
		'notes' => 'Notes',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At',
		'start_date' => 'Start Date',
		'ganttProgress' => 'Progress (1-100%)' 
	),
	'fieldTooltips' => array(
		'timeline_id' => '',
		'project_id' => '',
		'milestone_name' => '',
		'planned_date' => '',
		'actual_date' => '',
		'variance_days' => '',
		'status_id' => '',
		'notes' => '',
		'created_at' => '',
		'updated_at' => '',
		'start_date' => '',
		'ganttProgress' => '' 
	),
	'fieldPlaceholders' => array(
		'timeline_id' => '',
		'project_id' => '',
		'milestone_name' => '',
		'planned_date' => '',
		'actual_date' => '',
		'variance_days' => '',
		'status_id' => '',
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