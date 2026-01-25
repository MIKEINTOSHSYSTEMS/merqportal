<?php
global $runnerTableSettings;
$runnerTableSettings['mne_project_data_management'] = array(
	'name' => 'mne_project_data_management',
	'shortName' => 'mne_project_data_management',
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
	'afterEditDetails' => 'mne_project_data_management',
	'afterAddDetail' => 'mne_project_data_management',
	'detailsBadgeColor' => '00c2c5',
	'displayLoading' => true,
	'warnLeavingEdit' => true,
	'sql' => 'SELECT
	data_id,
	project_id,
	data_activity,
	method_id,
	respondent_type,
	target_count,
	achieved_count,
	datasets_generated_target,
	datasets_generated_actual,
	datasets_status,
	datasets_location,
	data_dictionaries_target,
	data_dictionaries_actual,
	data_dictionaries_location,
	publications_target,
	publications_actual,
	publications_status,
	publications_reference,
	respondents_reached_target,
	respondents_reached_actual,
	respondents_breakdown,
	job_opportunities_target,
	job_opportunities_actual,
	job_opportunities_details,
	social_media_posts_planned,
	social_media_posts_done,
	social_media_platform,
	social_media_link,
	website_updates_planned,
	website_updates_done,
	website_link,
	events_planned,
	events_done,
	events_details,
	created_at,
	updated_at
FROM
	mne_project_data_management',
	'keyFields' => array( 
		'data_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'data_id' => array(
			'name' => 'data_id',
			'goodName' => 'data_id',
			'strField' => 'data_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'data_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
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
			'tableName' => 'mne_project_data_management' 
		),
		'data_activity' => array(
			'name' => 'data_activity',
			'goodName' => 'data_activity',
			'strField' => 'data_activity',
			'index' => 3,
			'sqlExpression' => 'data_activity',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'required' => true,
					'lookupType' => 2,
					'lookupTable' => 'mne_generic_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_name' 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'method_id' => array(
			'name' => 'method_id',
			'goodName' => 'method_id',
			'strField' => 'method_id',
			'index' => 4,
			'type' => 3,
			'sqlExpression' => 'method_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_data_methods',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'method_id',
					'lookupDisplayField' => 'method_name' 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'respondent_type' => array(
			'name' => 'respondent_type',
			'goodName' => 'respondent_type',
			'strField' => 'respondent_type',
			'index' => 5,
			'sqlExpression' => 'respondent_type',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'target_count' => array(
			'name' => 'target_count',
			'goodName' => 'target_count',
			'strField' => 'target_count',
			'index' => 6,
			'type' => 3,
			'sqlExpression' => 'target_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'achieved_count' => array(
			'name' => 'achieved_count',
			'goodName' => 'achieved_count',
			'strField' => 'achieved_count',
			'index' => 7,
			'type' => 3,
			'sqlExpression' => 'achieved_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'datasets_generated_target' => array(
			'name' => 'datasets_generated_target',
			'goodName' => 'datasets_generated_target',
			'strField' => 'datasets_generated_target',
			'index' => 8,
			'type' => 3,
			'sqlExpression' => 'datasets_generated_target',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'datasets_generated_actual' => array(
			'name' => 'datasets_generated_actual',
			'goodName' => 'datasets_generated_actual',
			'strField' => 'datasets_generated_actual',
			'index' => 9,
			'type' => 3,
			'sqlExpression' => 'datasets_generated_actual',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'datasets_status' => array(
			'name' => 'datasets_status',
			'goodName' => 'datasets_status',
			'strField' => 'datasets_status',
			'index' => 10,
			'sqlExpression' => 'datasets_status',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'datasets_location' => array(
			'name' => 'datasets_location',
			'goodName' => 'datasets_location',
			'strField' => 'datasets_location',
			'index' => 11,
			'type' => 201,
			'sqlExpression' => 'datasets_location',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'data_dictionaries_target' => array(
			'name' => 'data_dictionaries_target',
			'goodName' => 'data_dictionaries_target',
			'strField' => 'data_dictionaries_target',
			'index' => 12,
			'type' => 3,
			'sqlExpression' => 'data_dictionaries_target',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'data_dictionaries_actual' => array(
			'name' => 'data_dictionaries_actual',
			'goodName' => 'data_dictionaries_actual',
			'strField' => 'data_dictionaries_actual',
			'index' => 13,
			'type' => 3,
			'sqlExpression' => 'data_dictionaries_actual',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'data_dictionaries_location' => array(
			'name' => 'data_dictionaries_location',
			'goodName' => 'data_dictionaries_location',
			'strField' => 'data_dictionaries_location',
			'index' => 14,
			'type' => 201,
			'sqlExpression' => 'data_dictionaries_location',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'publications_target' => array(
			'name' => 'publications_target',
			'goodName' => 'publications_target',
			'strField' => 'publications_target',
			'index' => 15,
			'type' => 3,
			'sqlExpression' => 'publications_target',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'publications_actual' => array(
			'name' => 'publications_actual',
			'goodName' => 'publications_actual',
			'strField' => 'publications_actual',
			'index' => 16,
			'type' => 3,
			'sqlExpression' => 'publications_actual',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'publications_status' => array(
			'name' => 'publications_status',
			'goodName' => 'publications_status',
			'strField' => 'publications_status',
			'index' => 17,
			'sqlExpression' => 'publications_status',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'publications_reference' => array(
			'name' => 'publications_reference',
			'goodName' => 'publications_reference',
			'strField' => 'publications_reference',
			'index' => 18,
			'type' => 201,
			'sqlExpression' => 'publications_reference',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'respondents_reached_target' => array(
			'name' => 'respondents_reached_target',
			'goodName' => 'respondents_reached_target',
			'strField' => 'respondents_reached_target',
			'index' => 19,
			'type' => 3,
			'sqlExpression' => 'respondents_reached_target',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'respondents_reached_actual' => array(
			'name' => 'respondents_reached_actual',
			'goodName' => 'respondents_reached_actual',
			'strField' => 'respondents_reached_actual',
			'index' => 20,
			'type' => 3,
			'sqlExpression' => 'respondents_reached_actual',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'respondents_breakdown' => array(
			'name' => 'respondents_breakdown',
			'goodName' => 'respondents_breakdown',
			'strField' => 'respondents_breakdown',
			'index' => 21,
			'type' => 201,
			'sqlExpression' => 'respondents_breakdown',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'job_opportunities_target' => array(
			'name' => 'job_opportunities_target',
			'goodName' => 'job_opportunities_target',
			'strField' => 'job_opportunities_target',
			'index' => 22,
			'type' => 3,
			'sqlExpression' => 'job_opportunities_target',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'job_opportunities_actual' => array(
			'name' => 'job_opportunities_actual',
			'goodName' => 'job_opportunities_actual',
			'strField' => 'job_opportunities_actual',
			'index' => 23,
			'type' => 3,
			'sqlExpression' => 'job_opportunities_actual',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'job_opportunities_details' => array(
			'name' => 'job_opportunities_details',
			'goodName' => 'job_opportunities_details',
			'strField' => 'job_opportunities_details',
			'index' => 24,
			'type' => 201,
			'sqlExpression' => 'job_opportunities_details',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'social_media_posts_planned' => array(
			'name' => 'social_media_posts_planned',
			'goodName' => 'social_media_posts_planned',
			'strField' => 'social_media_posts_planned',
			'index' => 25,
			'type' => 3,
			'sqlExpression' => 'social_media_posts_planned',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'social_media_posts_done' => array(
			'name' => 'social_media_posts_done',
			'goodName' => 'social_media_posts_done',
			'strField' => 'social_media_posts_done',
			'index' => 26,
			'type' => 3,
			'sqlExpression' => 'social_media_posts_done',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'social_media_platform' => array(
			'name' => 'social_media_platform',
			'goodName' => 'social_media_platform',
			'strField' => 'social_media_platform',
			'index' => 27,
			'sqlExpression' => 'social_media_platform',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'social_media_link' => array(
			'name' => 'social_media_link',
			'goodName' => 'social_media_link',
			'strField' => 'social_media_link',
			'index' => 28,
			'type' => 201,
			'sqlExpression' => 'social_media_link',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'website_updates_planned' => array(
			'name' => 'website_updates_planned',
			'goodName' => 'website_updates_planned',
			'strField' => 'website_updates_planned',
			'index' => 29,
			'type' => 3,
			'sqlExpression' => 'website_updates_planned',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'website_updates_done' => array(
			'name' => 'website_updates_done',
			'goodName' => 'website_updates_done',
			'strField' => 'website_updates_done',
			'index' => 30,
			'type' => 3,
			'sqlExpression' => 'website_updates_done',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'website_link' => array(
			'name' => 'website_link',
			'goodName' => 'website_link',
			'strField' => 'website_link',
			'index' => 31,
			'type' => 201,
			'sqlExpression' => 'website_link',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'events_planned' => array(
			'name' => 'events_planned',
			'goodName' => 'events_planned',
			'strField' => 'events_planned',
			'index' => 32,
			'type' => 3,
			'sqlExpression' => 'events_planned',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'events_done' => array(
			'name' => 'events_done',
			'goodName' => 'events_done',
			'strField' => 'events_done',
			'index' => 33,
			'type' => 3,
			'sqlExpression' => 'events_done',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'events_details' => array(
			'name' => 'events_details',
			'goodName' => 'events_details',
			'strField' => 'events_details',
			'index' => 34,
			'type' => 201,
			'sqlExpression' => 'events_details',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_project_data_management' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 35,
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
			'tableName' => 'mne_project_data_management' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 36,
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
			'tableName' => 'mne_project_data_management' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'mne_data_methods',
			'detailsKeys' => array( 
				'method_id' 
			),
			'masterKeys' => array( 
				'method_id' 
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
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	data_id,
	project_id,
	data_activity,
	method_id,
	respondent_type,
	target_count,
	achieved_count,
	datasets_generated_target,
	datasets_generated_actual,
	datasets_status,
	datasets_location,
	data_dictionaries_target,
	data_dictionaries_actual,
	data_dictionaries_location,
	publications_target,
	publications_actual,
	publications_status,
	publications_reference,
	respondents_reached_target,
	respondents_reached_actual,
	respondents_breakdown,
	job_opportunities_target,
	job_opportunities_actual,
	job_opportunities_details,
	social_media_posts_planned,
	social_media_posts_done,
	social_media_platform,
	social_media_link,
	website_updates_planned,
	website_updates_done,
	website_link,
	events_planned,
	events_done,
	events_details,
	created_at,
	updated_at
FROM
	mne_project_data_management',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'data_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'data_id' 
				),
				'encrypted' => false,
				'columnName' => 'data_id' 
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
					'table' => 'mne_project_data_management',
					'name' => 'project_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_id' 
			),
			array(
				'sql' => 'data_activity',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'data_activity' 
				),
				'encrypted' => false,
				'columnName' => 'data_activity' 
			),
			array(
				'sql' => 'method_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'method_id' 
				),
				'encrypted' => false,
				'columnName' => 'method_id' 
			),
			array(
				'sql' => 'respondent_type',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'respondent_type' 
				),
				'encrypted' => false,
				'columnName' => 'respondent_type' 
			),
			array(
				'sql' => 'target_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'target_count' 
				),
				'encrypted' => false,
				'columnName' => 'target_count' 
			),
			array(
				'sql' => 'achieved_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'achieved_count' 
				),
				'encrypted' => false,
				'columnName' => 'achieved_count' 
			),
			array(
				'sql' => 'datasets_generated_target',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'datasets_generated_target' 
				),
				'encrypted' => false,
				'columnName' => 'datasets_generated_target' 
			),
			array(
				'sql' => 'datasets_generated_actual',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'datasets_generated_actual' 
				),
				'encrypted' => false,
				'columnName' => 'datasets_generated_actual' 
			),
			array(
				'sql' => 'datasets_status',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'datasets_status' 
				),
				'encrypted' => false,
				'columnName' => 'datasets_status' 
			),
			array(
				'sql' => 'datasets_location',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'datasets_location' 
				),
				'encrypted' => false,
				'columnName' => 'datasets_location' 
			),
			array(
				'sql' => 'data_dictionaries_target',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'data_dictionaries_target' 
				),
				'encrypted' => false,
				'columnName' => 'data_dictionaries_target' 
			),
			array(
				'sql' => 'data_dictionaries_actual',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'data_dictionaries_actual' 
				),
				'encrypted' => false,
				'columnName' => 'data_dictionaries_actual' 
			),
			array(
				'sql' => 'data_dictionaries_location',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'data_dictionaries_location' 
				),
				'encrypted' => false,
				'columnName' => 'data_dictionaries_location' 
			),
			array(
				'sql' => 'publications_target',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'publications_target' 
				),
				'encrypted' => false,
				'columnName' => 'publications_target' 
			),
			array(
				'sql' => 'publications_actual',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'publications_actual' 
				),
				'encrypted' => false,
				'columnName' => 'publications_actual' 
			),
			array(
				'sql' => 'publications_status',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'publications_status' 
				),
				'encrypted' => false,
				'columnName' => 'publications_status' 
			),
			array(
				'sql' => 'publications_reference',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'publications_reference' 
				),
				'encrypted' => false,
				'columnName' => 'publications_reference' 
			),
			array(
				'sql' => 'respondents_reached_target',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'respondents_reached_target' 
				),
				'encrypted' => false,
				'columnName' => 'respondents_reached_target' 
			),
			array(
				'sql' => 'respondents_reached_actual',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'respondents_reached_actual' 
				),
				'encrypted' => false,
				'columnName' => 'respondents_reached_actual' 
			),
			array(
				'sql' => 'respondents_breakdown',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'respondents_breakdown' 
				),
				'encrypted' => false,
				'columnName' => 'respondents_breakdown' 
			),
			array(
				'sql' => 'job_opportunities_target',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'job_opportunities_target' 
				),
				'encrypted' => false,
				'columnName' => 'job_opportunities_target' 
			),
			array(
				'sql' => 'job_opportunities_actual',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'job_opportunities_actual' 
				),
				'encrypted' => false,
				'columnName' => 'job_opportunities_actual' 
			),
			array(
				'sql' => 'job_opportunities_details',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'job_opportunities_details' 
				),
				'encrypted' => false,
				'columnName' => 'job_opportunities_details' 
			),
			array(
				'sql' => 'social_media_posts_planned',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'social_media_posts_planned' 
				),
				'encrypted' => false,
				'columnName' => 'social_media_posts_planned' 
			),
			array(
				'sql' => 'social_media_posts_done',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'social_media_posts_done' 
				),
				'encrypted' => false,
				'columnName' => 'social_media_posts_done' 
			),
			array(
				'sql' => 'social_media_platform',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'social_media_platform' 
				),
				'encrypted' => false,
				'columnName' => 'social_media_platform' 
			),
			array(
				'sql' => 'social_media_link',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'social_media_link' 
				),
				'encrypted' => false,
				'columnName' => 'social_media_link' 
			),
			array(
				'sql' => 'website_updates_planned',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'website_updates_planned' 
				),
				'encrypted' => false,
				'columnName' => 'website_updates_planned' 
			),
			array(
				'sql' => 'website_updates_done',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'website_updates_done' 
				),
				'encrypted' => false,
				'columnName' => 'website_updates_done' 
			),
			array(
				'sql' => 'website_link',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'website_link' 
				),
				'encrypted' => false,
				'columnName' => 'website_link' 
			),
			array(
				'sql' => 'events_planned',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'events_planned' 
				),
				'encrypted' => false,
				'columnName' => 'events_planned' 
			),
			array(
				'sql' => 'events_done',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'events_done' 
				),
				'encrypted' => false,
				'columnName' => 'events_done' 
			),
			array(
				'sql' => 'events_details',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_data_management',
					'name' => 'events_details' 
				),
				'encrypted' => false,
				'columnName' => 'events_details' 
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
					'table' => 'mne_project_data_management',
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
					'table' => 'mne_project_data_management',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_project_data_management',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_project_data_management',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'data_id',
						'project_id',
						'data_activity',
						'method_id',
						'respondent_type',
						'target_count',
						'achieved_count',
						'datasets_generated_target',
						'datasets_generated_actual',
						'datasets_status',
						'datasets_location',
						'data_dictionaries_target',
						'data_dictionaries_actual',
						'data_dictionaries_location',
						'publications_target',
						'publications_actual',
						'publications_status',
						'publications_reference',
						'respondents_reached_target',
						'respondents_reached_actual',
						'respondents_breakdown',
						'job_opportunities_target',
						'job_opportunities_actual',
						'job_opportunities_details',
						'social_media_posts_planned',
						'social_media_posts_done',
						'social_media_platform',
						'social_media_link',
						'website_updates_planned',
						'website_updates_done',
						'website_link',
						'events_planned',
						'events_done',
						'events_details',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_project_data_management' 
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
			),
			array(
				'fieldIndex' => 14,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 15,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 16,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 17,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 18,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 19,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 20,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 21,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 22,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 23,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 24,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 25,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 26,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 27,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 28,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 29,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 30,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 31,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 32,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 33,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 34,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 35,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'data_id,
	project_id,
	data_activity,
	method_id,
	respondent_type,
	target_count,
	achieved_count,
	datasets_generated_target,
	datasets_generated_actual,
	datasets_status,
	datasets_location,
	data_dictionaries_target,
	data_dictionaries_actual,
	data_dictionaries_location,
	publications_target,
	publications_actual,
	publications_status,
	publications_reference,
	respondents_reached_target,
	respondents_reached_actual,
	respondents_breakdown,
	job_opportunities_target,
	job_opportunities_actual,
	job_opportunities_details,
	social_media_posts_planned,
	social_media_posts_done,
	social_media_platform,
	social_media_link,
	website_updates_planned,
	website_updates_done,
	website_link,
	events_planned,
	events_done,
	events_details,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_project_data_management',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_project_data_management',
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
			'data_id',
			'project_id',
			'data_activity',
			'method_id',
			'respondent_type',
			'target_count',
			'achieved_count',
			'datasets_generated_target',
			'datasets_generated_actual',
			'datasets_status',
			'datasets_location',
			'data_dictionaries_target',
			'data_dictionaries_actual',
			'data_dictionaries_location',
			'publications_target',
			'publications_actual',
			'publications_status',
			'publications_reference',
			'respondents_reached_target',
			'respondents_reached_actual',
			'respondents_breakdown',
			'job_opportunities_target',
			'job_opportunities_actual',
			'job_opportunities_details',
			'social_media_posts_planned',
			'social_media_posts_done',
			'social_media_platform',
			'social_media_link',
			'website_updates_planned',
			'website_updates_done',
			'website_link',
			'events_planned',
			'events_done',
			'events_details',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'data_id',
			'project_id',
			'data_activity',
			'method_id',
			'respondent_type',
			'target_count',
			'achieved_count',
			'datasets_generated_target',
			'datasets_generated_actual',
			'datasets_status',
			'datasets_location',
			'data_dictionaries_target',
			'data_dictionaries_actual',
			'data_dictionaries_location',
			'publications_target',
			'publications_actual',
			'publications_status',
			'publications_reference',
			'respondents_reached_target',
			'respondents_reached_actual',
			'respondents_breakdown',
			'job_opportunities_target',
			'job_opportunities_actual',
			'job_opportunities_details',
			'social_media_posts_planned',
			'social_media_posts_done',
			'social_media_platform',
			'social_media_link',
			'website_updates_planned',
			'website_updates_done',
			'website_link',
			'events_planned',
			'events_done',
			'events_details',
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
	$runnerTableLabels['mne_project_data_management'] = array(
	'tableCaption' => 'Project Data Management',
	'fieldLabels' => array(
		'data_id' => 'Data ID',
		'project_id' => 'Project ID',
		'data_activity' => 'Data Activity',
		'method_id' => 'Method',
		'respondent_type' => 'Respondent Type',
		'target_count' => 'Target Count',
		'achieved_count' => 'Achieved Count',
		'datasets_generated_target' => 'Datasets Generated Target',
		'datasets_generated_actual' => 'Datasets Generated Actual',
		'datasets_status' => 'Datasets Status',
		'datasets_location' => 'Datasets Location',
		'data_dictionaries_target' => 'Data Dictionaries Target',
		'data_dictionaries_actual' => 'Data Dictionaries Actual',
		'data_dictionaries_location' => 'Data Dictionaries Location',
		'publications_target' => 'Publications Target',
		'publications_actual' => 'Publications Actual',
		'publications_status' => 'Publications Status',
		'publications_reference' => 'Publications Reference',
		'respondents_reached_target' => 'Respondents Reached Target',
		'respondents_reached_actual' => 'Respondents Reached Actual',
		'respondents_breakdown' => 'Respondents Breakdown',
		'job_opportunities_target' => 'Job Opportunities Target',
		'job_opportunities_actual' => 'Job Opportunities Actual',
		'job_opportunities_details' => 'Job Opportunities Details',
		'social_media_posts_planned' => 'Social Media Posts Planned',
		'social_media_posts_done' => 'Social Media Posts Done',
		'social_media_platform' => 'Social Media Platform',
		'social_media_link' => 'Social Media Link',
		'website_updates_planned' => 'Website Updates Planned',
		'website_updates_done' => 'Website Updates Done',
		'website_link' => 'Website Link',
		'events_planned' => 'Events Planned',
		'events_done' => 'Events Done',
		'events_details' => 'Events Details',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'data_id' => '',
		'project_id' => '',
		'data_activity' => '',
		'method_id' => '',
		'respondent_type' => '',
		'target_count' => '',
		'achieved_count' => '',
		'datasets_generated_target' => '',
		'datasets_generated_actual' => '',
		'datasets_status' => '',
		'datasets_location' => '',
		'data_dictionaries_target' => '',
		'data_dictionaries_actual' => '',
		'data_dictionaries_location' => '',
		'publications_target' => '',
		'publications_actual' => '',
		'publications_status' => '',
		'publications_reference' => '',
		'respondents_reached_target' => '',
		'respondents_reached_actual' => '',
		'respondents_breakdown' => '',
		'job_opportunities_target' => '',
		'job_opportunities_actual' => '',
		'job_opportunities_details' => '',
		'social_media_posts_planned' => '',
		'social_media_posts_done' => '',
		'social_media_platform' => '',
		'social_media_link' => '',
		'website_updates_planned' => '',
		'website_updates_done' => '',
		'website_link' => '',
		'events_planned' => '',
		'events_done' => '',
		'events_details' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'data_id' => '',
		'project_id' => '',
		'data_activity' => '',
		'method_id' => '',
		'respondent_type' => '',
		'target_count' => '',
		'achieved_count' => '',
		'datasets_generated_target' => '',
		'datasets_generated_actual' => '',
		'datasets_status' => '',
		'datasets_location' => '',
		'data_dictionaries_target' => '',
		'data_dictionaries_actual' => '',
		'data_dictionaries_location' => '',
		'publications_target' => '',
		'publications_actual' => '',
		'publications_status' => '',
		'publications_reference' => '',
		'respondents_reached_target' => '',
		'respondents_reached_actual' => '',
		'respondents_breakdown' => '',
		'job_opportunities_target' => '',
		'job_opportunities_actual' => '',
		'job_opportunities_details' => '',
		'social_media_posts_planned' => '',
		'social_media_posts_done' => '',
		'social_media_platform' => '',
		'social_media_link' => '',
		'website_updates_planned' => '',
		'website_updates_done' => '',
		'website_link' => '',
		'events_planned' => '',
		'events_done' => '',
		'events_details' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>