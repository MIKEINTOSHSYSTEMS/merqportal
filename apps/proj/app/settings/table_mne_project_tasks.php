<?php
global $runnerTableSettings;
$runnerTableSettings['mne_project_tasks'] = array(
	'name' => 'mne_project_tasks',
	'shortName' => 'mne_project_tasks',
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
		'gantt' => 'gantt',
		'search' => 'search' 
	),
	'defaultPages' => array(
		'add' => 'add',
		'export' => 'export',
		'import' => 'import',
		'edit' => 'edit',
		'view' => 'view',
		'gantt' => 'gantt',
		'search' => 'search' 
	),
	'afterEditDetails' => 'mne_project_tasks',
	'afterAddDetail' => 'mne_project_tasks',
	'detailsBadgeColor' => 'cd5c5c',
	'hideEmptyFieldsOnView' => true,
	'orderInfo' => array( 
		array(
			'index' => 1,
			'dir' => 'ASC',
			'field' => 'ID' 
		) 
	),
	'sql' => 'SELECT
	mne_project_tasks.ID,
	mne_project_timelines.project_id,
	CASE
        WHEN mne_project_timelines.milestone_name IS NOT NULL THEN mne_project_timelines.milestone_name  -- Milestone name
        ELSE mne_project_deliverables.deliverable_name END AS ganttName,
	mne_project_tasks.ganttCategory,
	mne_project_tasks.ganttStartDate,
	mne_project_tasks.ganttEndDate,
	CASE
        WHEN mne_project_timelines.timeline_id IS NOT NULL THEN mne_project_timelines.timeline_id  -- Milestone parent ID
        ELSE NULL END AS ganttParent,
	mne_project_tasks.ganttProgress
FROM
	mne_project_tasks
	LEFT OUTER JOIN mne_project_timelines ON mne_project_timelines.timeline_id = mne_project_tasks.ganttParent
	LEFT OUTER JOIN mne_project_deliverables ON mne_project_deliverables.deliverable_id = mne_project_tasks.ID
ORDER BY
	mne_project_tasks.ID
',
	'keyFields' => array( 
		'ID' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'ID' => array(
			'name' => 'ID',
			'goodName' => 'ID',
			'strField' => 'ID',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'mne_project_tasks.ID',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_tasks' 
		),
		'ganttName' => array(
			'name' => 'ganttName',
			'goodName' => 'ganttName',
			'strField' => 'ganttName',
			'index' => 3,
			'sqlExpression' => 'CASE
        WHEN mne_project_timelines.milestone_name IS NOT NULL THEN mne_project_timelines.milestone_name  -- Milestone name
        ELSE mne_project_deliverables.deliverable_name END',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => '' 
		),
		'ganttCategory' => array(
			'name' => 'ganttCategory',
			'goodName' => 'ganttCategory',
			'strField' => 'ganttCategory',
			'index' => 4,
			'sqlExpression' => 'mne_project_tasks.ganttCategory',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'important',
						'critical' 
					) 
				) 
			),
			'tableName' => 'mne_project_tasks' 
		),
		'ganttStartDate' => array(
			'name' => 'ganttStartDate',
			'goodName' => 'ganttStartDate',
			'strField' => 'ganttStartDate',
			'index' => 5,
			'type' => 7,
			'sqlExpression' => 'mne_project_tasks.ganttStartDate',
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
			'tableName' => 'mne_project_tasks' 
		),
		'ganttEndDate' => array(
			'name' => 'ganttEndDate',
			'goodName' => 'ganttEndDate',
			'strField' => 'ganttEndDate',
			'index' => 6,
			'type' => 7,
			'sqlExpression' => 'mne_project_tasks.ganttEndDate',
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
			'tableName' => 'mne_project_tasks' 
		),
		'ganttParent' => array(
			'name' => 'ganttParent',
			'goodName' => 'ganttParent',
			'strField' => 'ganttParent',
			'index' => 7,
			'type' => 3,
			'sqlExpression' => 'CASE
        WHEN mne_project_timelines.timeline_id IS NOT NULL THEN mne_project_timelines.timeline_id  -- Milestone parent ID
        ELSE NULL END',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_project_tasks',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'ID',
					'lookupDisplayField' => 'ganttName',
					'lookupOrderBy' => 'ganttName',
					'lookupWhere' => '`ID` <> :{ID}' 
				) 
			),
			'tableName' => '' 
		),
		'ganttProgress' => array(
			'name' => 'ganttProgress',
			'goodName' => 'ganttProgress',
			'strField' => 'ganttProgress',
			'index' => 8,
			'type' => 3,
			'sqlExpression' => 'mne_project_tasks.ganttProgress',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_tasks' 
		),
		'project_id' => array(
			'name' => 'project_id',
			'goodName' => 'project_id',
			'strField' => 'project_id',
			'index' => 2,
			'type' => 3,
			'sqlExpression' => 'mne_project_timelines.project_id',
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
			'tableName' => 'mne_project_timelines' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	mne_project_tasks.ID,
	mne_project_timelines.project_id,
	CASE
        WHEN mne_project_timelines.milestone_name IS NOT NULL THEN mne_project_timelines.milestone_name  -- Milestone name
        ELSE mne_project_deliverables.deliverable_name END AS ganttName,
	mne_project_tasks.ganttCategory,
	mne_project_tasks.ganttStartDate,
	mne_project_tasks.ganttEndDate,
	CASE
        WHEN mne_project_timelines.timeline_id IS NOT NULL THEN mne_project_timelines.timeline_id  -- Milestone parent ID
        ELSE NULL END AS ganttParent,
	mne_project_tasks.ganttProgress
FROM
	mne_project_tasks
	LEFT OUTER JOIN mne_project_timelines ON mne_project_timelines.timeline_id = mne_project_tasks.ganttParent
	LEFT OUTER JOIN mne_project_deliverables ON mne_project_deliverables.deliverable_id = mne_project_tasks.ID
ORDER BY
	mne_project_tasks.ID
',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'mne_project_tasks.ID',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_tasks',
					'name' => 'ID' 
				),
				'encrypted' => false,
				'columnName' => 'ID' 
			),
			array(
				'sql' => 'mne_project_timelines.project_id',
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
				'sql' => 'CASE
        WHEN mne_project_timelines.milestone_name IS NOT NULL THEN mne_project_timelines.milestone_name  -- Milestone name
        ELSE mne_project_deliverables.deliverable_name END',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => 'ganttName',
				'expression' => array(
					'sql' => 'CASE
        WHEN mne_project_timelines.milestone_name IS NOT NULL THEN mne_project_timelines.milestone_name  -- Milestone name
        ELSE mne_project_deliverables.deliverable_name END',
					'parsed' => true,
					'type' => 'NonParsedEntity' 
				),
				'encrypted' => false,
				'columnName' => 'ganttName' 
			),
			array(
				'sql' => 'mne_project_tasks.ganttCategory',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_tasks',
					'name' => 'ganttCategory' 
				),
				'encrypted' => false,
				'columnName' => 'ganttCategory' 
			),
			array(
				'sql' => 'mne_project_tasks.ganttStartDate',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_tasks',
					'name' => 'ganttStartDate' 
				),
				'encrypted' => false,
				'columnName' => 'ganttStartDate' 
			),
			array(
				'sql' => 'mne_project_tasks.ganttEndDate',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_tasks',
					'name' => 'ganttEndDate' 
				),
				'encrypted' => false,
				'columnName' => 'ganttEndDate' 
			),
			array(
				'sql' => 'CASE
        WHEN mne_project_timelines.timeline_id IS NOT NULL THEN mne_project_timelines.timeline_id  -- Milestone parent ID
        ELSE NULL END',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => 'ganttParent',
				'expression' => array(
					'sql' => 'CASE
        WHEN mne_project_timelines.timeline_id IS NOT NULL THEN mne_project_timelines.timeline_id  -- Milestone parent ID
        ELSE NULL END',
					'parsed' => true,
					'type' => 'NonParsedEntity' 
				),
				'encrypted' => false,
				'columnName' => 'ganttParent' 
			),
			array(
				'sql' => 'mne_project_tasks.ganttProgress',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_tasks',
					'name' => 'ganttProgress' 
				),
				'encrypted' => false,
				'columnName' => 'ganttProgress' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_project_tasks',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_project_tasks',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'ID',
						'ganttName',
						'ganttCategory',
						'ganttStartDate',
						'ganttEndDate',
						'ganttParent',
						'ganttProgress' 
					),
					'name' => 'mne_project_tasks' 
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
			),
			array(
				'sql' => 'LEFT OUTER JOIN mne_project_timelines ON mne_project_timelines.timeline_id = mne_project_tasks.ganttParent',
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
					'sql' => 'mne_project_timelines.timeline_id = mne_project_tasks.ganttParent',
					'parsed' => true,
					'type' => 'LogicalExpression',
					'contained' => array( 
						 
					),
					'unionType' => 0,
					'column' => array(
						'sql' => '',
						'parsed' => true,
						'type' => 'SQLField',
						'table' => 'mne_project_timelines',
						'name' => 'timeline_id' 
					),
					'case' => '= mne_project_tasks.ganttParent',
					'useAlias' => false 
				),
				'joinList' => array(
					'sql' => 'mne_project_timelines.timeline_id = mne_project_tasks.ganttParent',
					'parsed' => true,
					'type' => 'JoinOn',
					'field1' => array( 
						array(
							'sql' => '',
							'parsed' => true,
							'type' => 'SQLField',
							'table' => 'mne_project_timelines',
							'name' => 'timeline_id' 
						) 
					),
					'field2' => array( 
						array(
							'sql' => '',
							'parsed' => true,
							'type' => 'SQLField',
							'table' => 'mne_project_tasks',
							'name' => 'ganttParent' 
						) 
					) 
				),
				'link' => 3 
			),
			array(
				'sql' => 'LEFT OUTER JOIN mne_project_deliverables ON mne_project_deliverables.deliverable_id = mne_project_tasks.ID',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_project_deliverables',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'deliverable_id',
						'project_id',
						'timeline_id',
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
					'sql' => 'mne_project_deliverables.deliverable_id = mne_project_tasks.ID',
					'parsed' => true,
					'type' => 'LogicalExpression',
					'contained' => array( 
						 
					),
					'unionType' => 0,
					'column' => array(
						'sql' => '',
						'parsed' => true,
						'type' => 'SQLField',
						'table' => 'mne_project_deliverables',
						'name' => 'deliverable_id' 
					),
					'case' => '= mne_project_tasks.ID',
					'useAlias' => false 
				),
				'joinList' => array(
					'sql' => 'mne_project_deliverables.deliverable_id = mne_project_tasks.ID',
					'parsed' => true,
					'type' => 'JoinOn',
					'field1' => array( 
						array(
							'sql' => '',
							'parsed' => true,
							'type' => 'SQLField',
							'table' => 'mne_project_deliverables',
							'name' => 'deliverable_id' 
						) 
					),
					'field2' => array( 
						array(
							'sql' => '',
							'parsed' => true,
							'type' => 'SQLField',
							'table' => 'mne_project_tasks',
							'name' => 'ID' 
						) 
					) 
				),
				'link' => 3 
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
			array(
				'sql' => 'mne_project_tasks.ID',
				'parsed' => true,
				'type' => 'OrderByListItem',
				'column' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_tasks',
					'name' => 'ID' 
				),
				'asc' => true,
				'columnNumber' => 1 
			) 
		),
		'colsIndex' => array( 
			array(
				'fieldIndex' => 0,
				'orderByIndex' => 0,
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'mne_project_tasks.ID,
	mne_project_timelines.project_id,
	CASE
        WHEN mne_project_timelines.milestone_name IS NOT NULL THEN mne_project_timelines.milestone_name  -- Milestone name
        ELSE mne_project_deliverables.deliverable_name END AS ganttName,
	mne_project_tasks.ganttCategory,
	mne_project_tasks.ganttStartDate,
	mne_project_tasks.ganttEndDate,
	CASE
        WHEN mne_project_timelines.timeline_id IS NOT NULL THEN mne_project_timelines.timeline_id  -- Milestone parent ID
        ELSE NULL END AS ganttParent,
	mne_project_tasks.ganttProgress',
		'fromListSql' => 'FROM
	mne_project_tasks
	LEFT OUTER JOIN mne_project_timelines ON mne_project_timelines.timeline_id = mne_project_tasks.ganttParent
	LEFT OUTER JOIN mne_project_deliverables ON mne_project_deliverables.deliverable_id = mne_project_tasks.ID',
		'orderBySql' => 'ORDER BY
	mne_project_tasks.ID',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_project_tasks',
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
		'gantt' => 'gantt',
		'search' => 'search' 
	),
	'originalDefaultPages' => array(
		'add' => 'add',
		'export' => 'export',
		'import' => 'import',
		'edit' => 'edit',
		'view' => 'view',
		'gantt' => 'gantt',
		'search' => 'search' 
	),
	'searchSettings' => array(
		'caseSensitiveSearch' => false,
		'searchableFields' => array( 
			'ID',
			'ganttName',
			'ganttCategory',
			'ganttStartDate',
			'ganttEndDate',
			'ganttParent',
			'ganttProgress',
			'project_id' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'ID',
			'ganttName',
			'ganttCategory',
			'ganttStartDate',
			'ganttEndDate',
			'ganttParent',
			'ganttProgress',
			'project_id' 
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
				'value' => 'important',
				'color' => '8a2be2' 
			),
			array(
				'value' => 'critical',
				'color' => 'dc143c' 
			) 
		),
		'startDateField' => 'ganttStartDate',
		'endDateField' => 'ganttEndDate',
		'nameField' => 'ganttName',
		'progressField' => 'ganttProgress',
		'parentField' => 'ganttParent',
		'categoryField' => 'ganttCategory' 
	) 
);

global $runnerTableLabels;
if( mlang_getcurrentlang() === 'English' ) {
	$runnerTableLabels['mne_project_tasks'] = array(
	'tableCaption' => 'Mne Project Tasks',
	'fieldLabels' => array(
		'ID' => 'ID',
		'ganttName' => 'Title',
		'ganttCategory' => 'Category',
		'ganttStartDate' => 'Start date',
		'ganttEndDate' => 'End date',
		'ganttParent' => 'Parent task',
		'ganttProgress' => 'Progress (1-100)',
		'project_id' => 'Project Id' 
	),
	'fieldTooltips' => array(
		'ID' => '',
		'ganttName' => '',
		'ganttCategory' => '',
		'ganttStartDate' => '',
		'ganttEndDate' => '',
		'ganttParent' => '',
		'ganttProgress' => '',
		'project_id' => '' 
	),
	'fieldPlaceholders' => array(
		'ID' => '',
		'ganttName' => '',
		'ganttCategory' => '',
		'ganttStartDate' => '',
		'ganttEndDate' => '',
		'ganttParent' => '',
		'ganttProgress' => '',
		'project_id' => '' 
	),
	'pageTitles' => array(
		'add' => 'New task',
		'edit' => 'Modify task',
		'view' => 'Task' 
	) 
);
}
?>