<?php
global $runnerTableSettings;
$runnerTableSettings['mne_project_deliverables_milestones'] = array(
	'name' => 'mne_project_deliverables_milestones',
	'type' => 6,
	'shortName' => 'mne_project_deliverables_milestones',
	'pagesByType' => array(
		'export' => array( 
			'export' 
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
		'export' => 'export',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'defaultPages' => array(
		'export' => 'export',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'afterEditDetails' => 'mne_project_deliverables_milestones',
	'afterAddDetail' => 'mne_project_deliverables_milestones',
	'detailsBadgeColor' => 'dc143c',
	'keyFields' => array( 
		'project_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'project_id' => array(
			'name' => 'project_id',
			'goodName' => 'project_id',
			'strField' => 'project_id',
			'index' => 1,
			'type' => 3,
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
			'tableName' => 'mne_project_deliverables_milestones' 
		),
		'deliverable_id' => array(
			'name' => 'deliverable_id',
			'goodName' => 'deliverable_id',
			'strField' => 'deliverable_id',
			'index' => 2,
			'type' => 3,
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_deliverables_milestones' 
		),
		'task_name' => array(
			'name' => 'task_name',
			'goodName' => 'task_name',
			'strField' => 'task_name',
			'index' => 3,
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_deliverable_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'deliverable_id',
					'lookupDisplayField' => 'deliverable_name' 
				) 
			),
			'tableName' => 'mne_project_deliverables_milestones' 
		),
		'start_date' => array(
			'name' => 'start_date',
			'goodName' => 'start_date',
			'strField' => 'start_date',
			'index' => 4,
			'type' => 7,
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
			'tableName' => 'mne_project_deliverables_milestones' 
		),
		'end_date' => array(
			'name' => 'end_date',
			'goodName' => 'end_date',
			'strField' => 'end_date',
			'index' => 5,
			'type' => 7,
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
			'tableName' => 'mne_project_deliverables_milestones' 
		),
		'progress' => array(
			'name' => 'progress',
			'goodName' => 'progress',
			'strField' => 'progress',
			'index' => 6,
			'type' => 3,
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_deliverables_milestones' 
		),
		'parent_id' => array(
			'name' => 'parent_id',
			'goodName' => 'parent_id',
			'strField' => 'parent_id',
			'index' => 7,
			'type' => 3,
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_deliverables_milestones' 
		),
		'category' => array(
			'name' => 'category',
			'goodName' => 'category',
			'strField' => 'category',
			'index' => 8,
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_deliverables_milestones' 
		),
		'milestone_start_date' => array(
			'name' => 'milestone_start_date',
			'goodName' => 'milestone_start_date',
			'strField' => 'milestone_start_date',
			'index' => 9,
			'type' => 7,
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
			'tableName' => 'mne_project_deliverables_milestones' 
		),
		'milestone_end_date' => array(
			'name' => 'milestone_end_date',
			'goodName' => 'milestone_end_date',
			'strField' => 'milestone_end_date',
			'index' => 10,
			'type' => 7,
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
			'tableName' => 'mne_project_deliverables_milestones' 
		) 
	),
	'originalTable' => '',
	'originalPagesByType' => array(
		'export' => array( 
			'export' 
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
		'export' => 'export',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'originalDefaultPages' => array(
		'export' => 'export',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'searchSettings' => array(
		'caseSensitiveSearch' => false,
		'searchableFields' => array( 
			'project_id',
			'deliverable_id',
			'task_name',
			'start_date',
			'end_date',
			'progress',
			'parent_id',
			'category',
			'milestone_start_date',
			'milestone_end_date' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'project_id',
			'deliverable_id',
			'task_name',
			'start_date',
			'end_date',
			'progress',
			'parent_id',
			'category',
			'milestone_start_date',
			'milestone_end_date' 
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
		'selectList' => array(
			'type' => 'selectList',
			'subtype' => 'sql',
			'enabled' => true,
			'sql' => 'SELECT 
    -- Project info (first column)
    d.project_id AS project_id,  -- Project ID for grouping

    -- Deliverable info (tasks)
    d.deliverable_id,
    d.deliverable_name AS task_name,
    d.start_date AS start_date,
    d.due_date AS end_date,
    d.ganttProgress AS progress,
    d.timeline_id AS parent_id,  -- links to milestone

    -- Milestone info (for grouping/color)
    t.milestone_name AS category,
    t.start_date AS milestone_start_date,
    t.planned_date AS milestone_end_date

FROM mne_project_deliverables d
LEFT JOIN mne_project_timelines t
    ON d.timeline_id = t.timeline_id

ORDER BY 
    d.project_id ASC,         -- Sort by project_id first
    d.deliverable_id ASC,     -- Then by deliverable ID
    d.timeline_id ASC,        -- Then by parent_id (milestone)
    d.deliverable_name ASC,   -- Then by task name
    d.start_date ASC;         -- Finally, by task start date',
			'payload' => array( 
				 
			),
			'payloadFormat' => 4 
		) 
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
	$runnerTableLabels['mne_project_deliverables_milestones'] = array(
	'tableCaption' => 'mne_project_deliverables_milestones',
	'fieldLabels' => array(
		'project_id' => 'Project',
		'deliverable_id' => 'Deliverable Id',
		'task_name' => 'Task Name',
		'start_date' => 'Start Date',
		'end_date' => 'End Date',
		'progress' => 'Progress',
		'parent_id' => 'Parent Id',
		'category' => 'Category',
		'milestone_start_date' => 'Milestone Start Date',
		'milestone_end_date' => 'Milestone End Date' 
	),
	'fieldTooltips' => array(
		'project_id' => '',
		'deliverable_id' => '',
		'task_name' => '',
		'start_date' => '',
		'end_date' => '',
		'progress' => '',
		'parent_id' => '',
		'category' => '',
		'milestone_start_date' => '',
		'milestone_end_date' => '' 
	),
	'fieldPlaceholders' => array(
		'project_id' => '',
		'deliverable_id' => '',
		'task_name' => '',
		'start_date' => '',
		'end_date' => '',
		'progress' => '',
		'parent_id' => '',
		'category' => '',
		'milestone_start_date' => '',
		'milestone_end_date' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>