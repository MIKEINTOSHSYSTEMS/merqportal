<?php
global $runnerTableSettings;
$runnerTableSettings['mne_business_opportunities'] = array(
	'name' => 'mne_business_opportunities',
	'shortName' => 'mne_business_opportunities',
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
	'afterEditDetails' => 'mne_business_opportunities',
	'afterAddDetail' => 'mne_business_opportunities',
	'detailsBadgeColor' => 'dc143c',
	'displayLoading' => true,
	'sql' => 'SELECT
	opportunity_id,
	opportunity_code,
	date_identified,
	opportunity_name,
	link_of_source,
	file_of_source,
	source_id,
	type_id,
	deadline,
	estimated_value,
	currency_id,
	sector_id,
	client_organization_name,
	client_type_id,
	go_nogo_decision,
	decision_date,
	decision_reason_id,
	proposal_lead_id,
	team_members,
	proposal_start_date,
	proposal_completed_date,
	days_to_develop,
	proposal_type,
	proposal_pages,
	partners_involved,
	proposal_status,
	submitted_date,
	submitted_to,
	reference_no,
	outcome,
	notification_date,
	contract_value,
	win_loss_reason_id,
	follow_up_actions,
	action_required,
	responsible_user_id,
	due_date,
	status_id,
	notes,
	created_by,
	created_at,
	updated_at,
	is_active
FROM
	mne_business_opportunities',
	'keyFields' => array( 
		'opportunity_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'opportunity_id' => array(
			'name' => 'opportunity_id',
			'goodName' => 'opportunity_id',
			'strField' => 'opportunity_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'opportunity_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'opportunity_code' => array(
			'name' => 'opportunity_code',
			'goodName' => 'opportunity_code',
			'strField' => 'opportunity_code',
			'index' => 2,
			'sqlExpression' => 'opportunity_code',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'date_identified' => array(
			'name' => 'date_identified',
			'goodName' => 'date_identified',
			'strField' => 'date_identified',
			'index' => 3,
			'type' => 7,
			'sqlExpression' => 'date_identified',
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
			'tableName' => 'mne_business_opportunities' 
		),
		'opportunity_name' => array(
			'name' => 'opportunity_name',
			'goodName' => 'opportunity_name',
			'strField' => 'opportunity_name',
			'index' => 4,
			'sqlExpression' => 'opportunity_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'source_id' => array(
			'name' => 'source_id',
			'goodName' => 'source_id',
			'strField' => 'source_id',
			'index' => 7,
			'type' => 3,
			'sqlExpression' => 'source_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_business_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_label',
					'lookupWhere' => 'option_type = "source"' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'type_id' => array(
			'name' => 'type_id',
			'goodName' => 'type_id',
			'strField' => 'type_id',
			'index' => 8,
			'type' => 3,
			'sqlExpression' => 'type_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_business_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_label',
					'lookupWhere' => 'option_type = \'type\'
  AND (parent_id <> 1 OR parent_id IS NULL)' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'deadline' => array(
			'name' => 'deadline',
			'goodName' => 'deadline',
			'strField' => 'deadline',
			'index' => 9,
			'type' => 7,
			'sqlExpression' => 'deadline',
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
			'tableName' => 'mne_business_opportunities' 
		),
		'estimated_value' => array(
			'name' => 'estimated_value',
			'goodName' => 'estimated_value',
			'strField' => 'estimated_value',
			'index' => 10,
			'type' => 14,
			'sqlExpression' => 'estimated_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Currency' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'currency_id' => array(
			'name' => 'currency_id',
			'goodName' => 'currency_id',
			'strField' => 'currency_id',
			'index' => 11,
			'type' => 3,
			'sqlExpression' => 'currency_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_currency_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'currency_id',
					'lookupDisplayField' => 'currency_code' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'sector_id' => array(
			'name' => 'sector_id',
			'goodName' => 'sector_id',
			'strField' => 'sector_id',
			'index' => 12,
			'type' => 3,
			'sqlExpression' => 'sector_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_sector_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'sector_id',
					'lookupDisplayField' => 'sector_name' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'client_type_id' => array(
			'name' => 'client_type_id',
			'goodName' => 'client_type_id',
			'strField' => 'client_type_id',
			'index' => 14,
			'type' => 3,
			'sqlExpression' => 'client_type_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_client_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'description',
					'lookupWhere' => 'option_type = "client_type"' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'go_nogo_decision' => array(
			'name' => 'go_nogo_decision',
			'goodName' => 'go_nogo_decision',
			'strField' => 'go_nogo_decision',
			'index' => 15,
			'type' => 129,
			'sqlExpression' => 'go_nogo_decision',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Go',
						'No-Go',
						'Conditional Go',
						'Pending More Info',
						'Requires Partner',
						'Budget Insufficient' 
					) 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'decision_date' => array(
			'name' => 'decision_date',
			'goodName' => 'decision_date',
			'strField' => 'decision_date',
			'index' => 16,
			'type' => 7,
			'sqlExpression' => 'decision_date',
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
			'tableName' => 'mne_business_opportunities' 
		),
		'decision_reason_id' => array(
			'name' => 'decision_reason_id',
			'goodName' => 'decision_reason_id',
			'strField' => 'decision_reason_id',
			'index' => 17,
			'type' => 3,
			'sqlExpression' => 'decision_reason_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_business_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_label',
					'lookupWhere' => 'option_type = "reason"' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'proposal_lead_id' => array(
			'name' => 'proposal_lead_id',
			'goodName' => 'proposal_lead_id',
			'strField' => 'proposal_lead_id',
			'index' => 18,
			'type' => 3,
			'sqlExpression' => 'proposal_lead_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_project_leads',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'lead_id',
					'lookupDisplayField' => 'lead_name' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'team_members' => array(
			'name' => 'team_members',
			'goodName' => 'team_members',
			'strField' => 'team_members',
			'index' => 19,
			'type' => 201,
			'sqlExpression' => 'team_members',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupMultiselect' => true,
					'lookupType' => 2,
					'lookupTable' => 'users',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'user_id',
					'lookupDisplayField' => 'full_name',
					'lookupOrderBy' => 'full_name',
					'lookupWhere' => 'user_id NOT IN (1, 2, 3)' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'proposal_start_date' => array(
			'name' => 'proposal_start_date',
			'goodName' => 'proposal_start_date',
			'strField' => 'proposal_start_date',
			'index' => 20,
			'type' => 7,
			'sqlExpression' => 'proposal_start_date',
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
			'tableName' => 'mne_business_opportunities' 
		),
		'proposal_completed_date' => array(
			'name' => 'proposal_completed_date',
			'goodName' => 'proposal_completed_date',
			'strField' => 'proposal_completed_date',
			'index' => 21,
			'type' => 7,
			'sqlExpression' => 'proposal_completed_date',
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
			'tableName' => 'mne_business_opportunities' 
		),
		'days_to_develop' => array(
			'name' => 'days_to_develop',
			'goodName' => 'days_to_develop',
			'strField' => 'days_to_develop',
			'index' => 22,
			'type' => 3,
			'sqlExpression' => 'days_to_develop',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'proposal_type' => array(
			'name' => 'proposal_type',
			'goodName' => 'proposal_type',
			'strField' => 'proposal_type',
			'index' => 23,
			'sqlExpression' => 'proposal_type',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'proposal_pages' => array(
			'name' => 'proposal_pages',
			'goodName' => 'proposal_pages',
			'strField' => 'proposal_pages',
			'index' => 24,
			'type' => 3,
			'sqlExpression' => 'proposal_pages',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'partners_involved' => array(
			'name' => 'partners_involved',
			'goodName' => 'partners_involved',
			'strField' => 'partners_involved',
			'index' => 25,
			'type' => 201,
			'sqlExpression' => 'partners_involved',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupMultiselect' => true,
					'lookupType' => 2,
					'lookupTable' => 'mne_partnerships',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'partnership_id',
					'lookupDisplayField' => 'partner_name',
					'lookupAllowAdd' => true,
					'lookupAllowEdit' => true,
					'lookupAddPage' => 'add',
					'lookupEditPage' => 'edit' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'proposal_status' => array(
			'name' => 'proposal_status',
			'goodName' => 'proposal_status',
			'strField' => 'proposal_status',
			'index' => 26,
			'sqlExpression' => 'proposal_status',
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
			'tableName' => 'mne_business_opportunities' 
		),
		'submitted_date' => array(
			'name' => 'submitted_date',
			'goodName' => 'submitted_date',
			'strField' => 'submitted_date',
			'index' => 27,
			'type' => 7,
			'sqlExpression' => 'submitted_date',
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
			'tableName' => 'mne_business_opportunities' 
		),
		'submitted_to' => array(
			'name' => 'submitted_to',
			'goodName' => 'submitted_to',
			'strField' => 'submitted_to',
			'index' => 28,
			'sqlExpression' => 'submitted_to',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'reference_no' => array(
			'name' => 'reference_no',
			'goodName' => 'reference_no',
			'strField' => 'reference_no',
			'index' => 29,
			'sqlExpression' => 'reference_no',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'outcome' => array(
			'name' => 'outcome',
			'goodName' => 'outcome',
			'strField' => 'outcome',
			'index' => 30,
			'type' => 129,
			'sqlExpression' => 'outcome',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Won',
						'Lost',
						'Pending' 
					) 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'notification_date' => array(
			'name' => 'notification_date',
			'goodName' => 'notification_date',
			'strField' => 'notification_date',
			'index' => 31,
			'type' => 7,
			'sqlExpression' => 'notification_date',
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
			'tableName' => 'mne_business_opportunities' 
		),
		'contract_value' => array(
			'name' => 'contract_value',
			'goodName' => 'contract_value',
			'strField' => 'contract_value',
			'index' => 32,
			'type' => 14,
			'sqlExpression' => 'contract_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'win_loss_reason_id' => array(
			'name' => 'win_loss_reason_id',
			'goodName' => 'win_loss_reason_id',
			'strField' => 'win_loss_reason_id',
			'index' => 33,
			'type' => 3,
			'sqlExpression' => 'win_loss_reason_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_business_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_label',
					'lookupWhere' => 'option_type = "win_loss_reason"' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'follow_up_actions' => array(
			'name' => 'follow_up_actions',
			'goodName' => 'follow_up_actions',
			'strField' => 'follow_up_actions',
			'index' => 34,
			'type' => 201,
			'sqlExpression' => 'follow_up_actions',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'action_required' => array(
			'name' => 'action_required',
			'goodName' => 'action_required',
			'strField' => 'action_required',
			'index' => 35,
			'type' => 201,
			'sqlExpression' => 'action_required',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'responsible_user_id' => array(
			'name' => 'responsible_user_id',
			'goodName' => 'responsible_user_id',
			'strField' => 'responsible_user_id',
			'index' => 36,
			'type' => 3,
			'sqlExpression' => 'responsible_user_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupMultiselect' => true,
					'lookupType' => 2,
					'lookupTable' => 'users',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'user_id',
					'lookupDisplayField' => 'full_name',
					'lookupOrderBy' => 'full_name' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'due_date' => array(
			'name' => 'due_date',
			'goodName' => 'due_date',
			'strField' => 'due_date',
			'index' => 37,
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
			'tableName' => 'mne_business_opportunities' 
		),
		'status_id' => array(
			'name' => 'status_id',
			'goodName' => 'status_id',
			'strField' => 'status_id',
			'index' => 38,
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
			'tableName' => 'mne_business_opportunities' 
		),
		'notes' => array(
			'name' => 'notes',
			'goodName' => 'notes',
			'strField' => 'notes',
			'index' => 39,
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
			'tableName' => 'mne_business_opportunities' 
		),
		'created_by' => array(
			'name' => 'created_by',
			'goodName' => 'created_by',
			'strField' => 'created_by',
			'index' => 40,
			'type' => 3,
			'sqlExpression' => 'created_by',
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
					'lookupDisplayField' => 'full_name' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 41,
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
			'tableName' => 'mne_business_opportunities' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 42,
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
			'tableName' => 'mne_business_opportunities' 
		),
		'is_active' => array(
			'name' => 'is_active',
			'goodName' => 'is_active',
			'strField' => 'is_active',
			'index' => 43,
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
			'tableName' => 'mne_business_opportunities' 
		),
		'client_organization_name' => array(
			'name' => 'client_organization_name',
			'goodName' => 'client_organization_name',
			'strField' => 'client_organization_name',
			'index' => 13,
			'sqlExpression' => 'client_organization_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'denyDuplicate' => true,
					'lookupType' => 2,
					'lookupTable' => 'tblclients',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'company',
					'lookupDisplayField' => 'company',
					'lookupAllowAdd' => true,
					'lookupAllowEdit' => true,
					'lookupControlType' => 2,
					'lookupFreeInput' => true,
					'lookupListPage' => 'list',
					'lookupAddPage' => 'add',
					'lookupEditPage' => 'edit' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'link_of_source' => array(
			'name' => 'link_of_source',
			'goodName' => 'link_of_source',
			'strField' => 'link_of_source',
			'index' => 5,
			'sqlExpression' => 'link_of_source',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Hyperlink',
					'linkNewWindow' => true 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'textHTML5Input' => 'URL' 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		),
		'file_of_source' => array(
			'name' => 'file_of_source',
			'goodName' => 'file_of_source',
			'strField' => 'file_of_source',
			'index' => 6,
			'sqlExpression' => 'file_of_source',
			'uploadFolder' => 'OppFiles',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Document Download',
					'imageShowThumbnail' => true,
					'fileShowSize' => true,
					'fileShowPdf' => true 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Document upload',
					'fileMaxNumber' => 2,
					'fileSizeLimit' => 4096,
					'fileTotalSizeLimit' => 8192,
					'fileTypes' => array( 
						'bmp',
						'jpg',
						'png',
						'gif',
						'txt',
						'rtf',
						'doc',
						'docx',
						'pdf' 
					) 
				) 
			),
			'tableName' => 'mne_business_opportunities' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'mne_business_options',
			'detailsKeys' => array( 
				'source_id' 
			),
			'masterKeys' => array( 
				'option_id' 
			) 
		),
		array(
			'table' => 'mne_client_options',
			'detailsKeys' => array( 
				'client_type_id' 
			),
			'masterKeys' => array( 
				'option_id' 
			) 
		),
		array(
			'table' => 'mne_currency_options',
			'detailsKeys' => array( 
				'currency_id' 
			),
			'masterKeys' => array( 
				'currency_id' 
			) 
		),
		array(
			'table' => 'mne_project_leads',
			'detailsKeys' => array( 
				'proposal_lead_id' 
			),
			'masterKeys' => array( 
				'lead_id' 
			) 
		),
		array(
			'table' => 'mne_sector_options',
			'detailsKeys' => array( 
				'sector_id' 
			),
			'masterKeys' => array( 
				'sector_id' 
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
		),
		array(
			'table' => 'users',
			'detailsKeys' => array( 
				'responsible_user_id' 
			),
			'masterKeys' => array( 
				'user_id' 
			) 
		) 
	),
	'detailsTables' => array( 
		'mne_projects' 
	),
	'query' => array(
		'sql' => 'SELECT
	opportunity_id,
	opportunity_code,
	date_identified,
	opportunity_name,
	link_of_source,
	file_of_source,
	source_id,
	type_id,
	deadline,
	estimated_value,
	currency_id,
	sector_id,
	client_organization_name,
	client_type_id,
	go_nogo_decision,
	decision_date,
	decision_reason_id,
	proposal_lead_id,
	team_members,
	proposal_start_date,
	proposal_completed_date,
	days_to_develop,
	proposal_type,
	proposal_pages,
	partners_involved,
	proposal_status,
	submitted_date,
	submitted_to,
	reference_no,
	outcome,
	notification_date,
	contract_value,
	win_loss_reason_id,
	follow_up_actions,
	action_required,
	responsible_user_id,
	due_date,
	status_id,
	notes,
	created_by,
	created_at,
	updated_at,
	is_active
FROM
	mne_business_opportunities',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'opportunity_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'opportunity_id' 
				),
				'encrypted' => false,
				'columnName' => 'opportunity_id' 
			),
			array(
				'sql' => 'opportunity_code',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'opportunity_code' 
				),
				'encrypted' => false,
				'columnName' => 'opportunity_code' 
			),
			array(
				'sql' => 'date_identified',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'date_identified' 
				),
				'encrypted' => false,
				'columnName' => 'date_identified' 
			),
			array(
				'sql' => 'opportunity_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'opportunity_name' 
				),
				'encrypted' => false,
				'columnName' => 'opportunity_name' 
			),
			array(
				'sql' => 'link_of_source',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'link_of_source' 
				),
				'encrypted' => false,
				'columnName' => 'link_of_source' 
			),
			array(
				'sql' => 'file_of_source',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'file_of_source' 
				),
				'encrypted' => false,
				'columnName' => 'file_of_source' 
			),
			array(
				'sql' => 'source_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'source_id' 
				),
				'encrypted' => false,
				'columnName' => 'source_id' 
			),
			array(
				'sql' => 'type_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'type_id' 
				),
				'encrypted' => false,
				'columnName' => 'type_id' 
			),
			array(
				'sql' => 'deadline',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'deadline' 
				),
				'encrypted' => false,
				'columnName' => 'deadline' 
			),
			array(
				'sql' => 'estimated_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'estimated_value' 
				),
				'encrypted' => false,
				'columnName' => 'estimated_value' 
			),
			array(
				'sql' => 'currency_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'currency_id' 
				),
				'encrypted' => false,
				'columnName' => 'currency_id' 
			),
			array(
				'sql' => 'sector_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'sector_id' 
				),
				'encrypted' => false,
				'columnName' => 'sector_id' 
			),
			array(
				'sql' => 'client_organization_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'client_organization_name' 
				),
				'encrypted' => false,
				'columnName' => 'client_organization_name' 
			),
			array(
				'sql' => 'client_type_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'client_type_id' 
				),
				'encrypted' => false,
				'columnName' => 'client_type_id' 
			),
			array(
				'sql' => 'go_nogo_decision',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'go_nogo_decision' 
				),
				'encrypted' => false,
				'columnName' => 'go_nogo_decision' 
			),
			array(
				'sql' => 'decision_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'decision_date' 
				),
				'encrypted' => false,
				'columnName' => 'decision_date' 
			),
			array(
				'sql' => 'decision_reason_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'decision_reason_id' 
				),
				'encrypted' => false,
				'columnName' => 'decision_reason_id' 
			),
			array(
				'sql' => 'proposal_lead_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'proposal_lead_id' 
				),
				'encrypted' => false,
				'columnName' => 'proposal_lead_id' 
			),
			array(
				'sql' => 'team_members',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'team_members' 
				),
				'encrypted' => false,
				'columnName' => 'team_members' 
			),
			array(
				'sql' => 'proposal_start_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'proposal_start_date' 
				),
				'encrypted' => false,
				'columnName' => 'proposal_start_date' 
			),
			array(
				'sql' => 'proposal_completed_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'proposal_completed_date' 
				),
				'encrypted' => false,
				'columnName' => 'proposal_completed_date' 
			),
			array(
				'sql' => 'days_to_develop',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'days_to_develop' 
				),
				'encrypted' => false,
				'columnName' => 'days_to_develop' 
			),
			array(
				'sql' => 'proposal_type',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'proposal_type' 
				),
				'encrypted' => false,
				'columnName' => 'proposal_type' 
			),
			array(
				'sql' => 'proposal_pages',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'proposal_pages' 
				),
				'encrypted' => false,
				'columnName' => 'proposal_pages' 
			),
			array(
				'sql' => 'partners_involved',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'partners_involved' 
				),
				'encrypted' => false,
				'columnName' => 'partners_involved' 
			),
			array(
				'sql' => 'proposal_status',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'proposal_status' 
				),
				'encrypted' => false,
				'columnName' => 'proposal_status' 
			),
			array(
				'sql' => 'submitted_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'submitted_date' 
				),
				'encrypted' => false,
				'columnName' => 'submitted_date' 
			),
			array(
				'sql' => 'submitted_to',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'submitted_to' 
				),
				'encrypted' => false,
				'columnName' => 'submitted_to' 
			),
			array(
				'sql' => 'reference_no',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'reference_no' 
				),
				'encrypted' => false,
				'columnName' => 'reference_no' 
			),
			array(
				'sql' => 'outcome',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'outcome' 
				),
				'encrypted' => false,
				'columnName' => 'outcome' 
			),
			array(
				'sql' => 'notification_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'notification_date' 
				),
				'encrypted' => false,
				'columnName' => 'notification_date' 
			),
			array(
				'sql' => 'contract_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'contract_value' 
				),
				'encrypted' => false,
				'columnName' => 'contract_value' 
			),
			array(
				'sql' => 'win_loss_reason_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'win_loss_reason_id' 
				),
				'encrypted' => false,
				'columnName' => 'win_loss_reason_id' 
			),
			array(
				'sql' => 'follow_up_actions',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'follow_up_actions' 
				),
				'encrypted' => false,
				'columnName' => 'follow_up_actions' 
			),
			array(
				'sql' => 'action_required',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'action_required' 
				),
				'encrypted' => false,
				'columnName' => 'action_required' 
			),
			array(
				'sql' => 'responsible_user_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'responsible_user_id' 
				),
				'encrypted' => false,
				'columnName' => 'responsible_user_id' 
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
					'table' => 'mne_business_opportunities',
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
					'table' => 'mne_business_opportunities',
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
					'table' => 'mne_business_opportunities',
					'name' => 'notes' 
				),
				'encrypted' => false,
				'columnName' => 'notes' 
			),
			array(
				'sql' => 'created_by',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_business_opportunities',
					'name' => 'created_by' 
				),
				'encrypted' => false,
				'columnName' => 'created_by' 
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
					'table' => 'mne_business_opportunities',
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
					'table' => 'mne_business_opportunities',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
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
					'table' => 'mne_business_opportunities',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_business_opportunities',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_business_opportunities',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'opportunity_id',
						'opportunity_code',
						'date_identified',
						'opportunity_name',
						'link_of_source',
						'file_of_source',
						'source_id',
						'type_id',
						'deadline',
						'estimated_value',
						'currency_id',
						'sector_id',
						'client_organization_name',
						'client_type_id',
						'go_nogo_decision',
						'decision_date',
						'decision_reason_id',
						'proposal_lead_id',
						'team_members',
						'proposal_start_date',
						'proposal_completed_date',
						'days_to_develop',
						'proposal_type',
						'proposal_pages',
						'partners_involved',
						'proposal_status',
						'submitted_date',
						'submitted_to',
						'reference_no',
						'outcome',
						'notification_date',
						'contract_value',
						'win_loss_reason_id',
						'follow_up_actions',
						'action_required',
						'responsible_user_id',
						'due_date',
						'status_id',
						'notes',
						'created_by',
						'created_at',
						'updated_at',
						'is_active' 
					),
					'name' => 'mne_business_opportunities' 
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
			),
			array(
				'fieldIndex' => 36,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 37,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 38,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 39,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 40,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 41,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 42,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'opportunity_id,
	opportunity_code,
	date_identified,
	opportunity_name,
	link_of_source,
	file_of_source,
	source_id,
	type_id,
	deadline,
	estimated_value,
	currency_id,
	sector_id,
	client_organization_name,
	client_type_id,
	go_nogo_decision,
	decision_date,
	decision_reason_id,
	proposal_lead_id,
	team_members,
	proposal_start_date,
	proposal_completed_date,
	days_to_develop,
	proposal_type,
	proposal_pages,
	partners_involved,
	proposal_status,
	submitted_date,
	submitted_to,
	reference_no,
	outcome,
	notification_date,
	contract_value,
	win_loss_reason_id,
	follow_up_actions,
	action_required,
	responsible_user_id,
	due_date,
	status_id,
	notes,
	created_by,
	created_at,
	updated_at,
	is_active',
		'fromListSql' => 'FROM
	mne_business_opportunities',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_business_opportunities',
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
			'opportunity_id',
			'opportunity_code',
			'date_identified',
			'opportunity_name',
			'source_id',
			'type_id',
			'deadline',
			'estimated_value',
			'currency_id',
			'sector_id',
			'client_type_id',
			'go_nogo_decision',
			'decision_date',
			'decision_reason_id',
			'proposal_lead_id',
			'team_members',
			'proposal_start_date',
			'proposal_completed_date',
			'days_to_develop',
			'proposal_type',
			'proposal_pages',
			'partners_involved',
			'proposal_status',
			'submitted_date',
			'submitted_to',
			'reference_no',
			'outcome',
			'notification_date',
			'contract_value',
			'win_loss_reason_id',
			'follow_up_actions',
			'action_required',
			'responsible_user_id',
			'due_date',
			'status_id',
			'notes',
			'created_by',
			'created_at',
			'updated_at',
			'is_active',
			'client_organization_name',
			'link_of_source',
			'file_of_source' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'opportunity_id',
			'opportunity_code',
			'date_identified',
			'opportunity_name',
			'source_id',
			'type_id',
			'deadline',
			'estimated_value',
			'currency_id',
			'sector_id',
			'client_type_id',
			'go_nogo_decision',
			'decision_date',
			'decision_reason_id',
			'proposal_lead_id',
			'team_members',
			'proposal_start_date',
			'proposal_completed_date',
			'days_to_develop',
			'proposal_type',
			'proposal_pages',
			'partners_involved',
			'proposal_status',
			'submitted_date',
			'submitted_to',
			'reference_no',
			'outcome',
			'notification_date',
			'contract_value',
			'win_loss_reason_id',
			'follow_up_actions',
			'action_required',
			'responsible_user_id',
			'due_date',
			'status_id',
			'notes',
			'created_by',
			'created_at',
			'updated_at',
			'is_active',
			'client_organization_name',
			'link_of_source',
			'file_of_source' 
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
	$runnerTableLabels['mne_business_opportunities'] = array(
	'tableCaption' => 'Business Opportunities',
	'fieldLabels' => array(
		'opportunity_id' => 'OppID',
		'opportunity_code' => 'OppCode',
		'date_identified' => 'Date Identified',
		'opportunity_name' => 'Opportunity Name',
		'source_id' => 'Source',
		'type_id' => 'Type',
		'deadline' => 'Deadline',
		'estimated_value' => 'Estimated Value',
		'currency_id' => 'Currency',
		'sector_id' => 'Sector',
		'client_type_id' => 'Client Type',
		'go_nogo_decision' => 'Go / No-Go Decision',
		'decision_date' => 'Decision Date',
		'decision_reason_id' => 'Decision Reason',
		'proposal_lead_id' => 'Proposal Lead',
		'team_members' => 'Team Members',
		'proposal_start_date' => 'Proposal Start Date',
		'proposal_completed_date' => 'Proposal Completed Date',
		'days_to_develop' => 'Days To Develop',
		'proposal_type' => 'Proposal Type',
		'proposal_pages' => 'Proposal Pages',
		'partners_involved' => 'Partners Involved',
		'proposal_status' => 'Proposal Status',
		'submitted_date' => 'Submitted Date',
		'submitted_to' => 'Submitted To',
		'reference_no' => 'Reference No',
		'outcome' => 'Outcome',
		'notification_date' => 'Notification Date',
		'contract_value' => 'Contract Value',
		'win_loss_reason_id' => 'Win Loss Reason',
		'follow_up_actions' => 'Follow Up Actions',
		'action_required' => 'Action Required',
		'responsible_user_id' => 'Responsible User(Members)',
		'due_date' => 'Due Date',
		'status_id' => 'Opportunity Current Status',
		'notes' => 'Notes',
		'created_by' => 'Created By',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At',
		'is_active' => 'Is Opportunity Active?',
		'client_organization_name' => 'Client Organization Name',
		'link_of_source' => 'Link Of Source',
		'file_of_source' => 'File Of Source' 
	),
	'fieldTooltips' => array(
		'opportunity_id' => '',
		'opportunity_code' => '',
		'date_identified' => '',
		'opportunity_name' => '',
		'source_id' => '',
		'type_id' => '',
		'deadline' => '',
		'estimated_value' => '',
		'currency_id' => '',
		'sector_id' => '',
		'client_type_id' => '',
		'go_nogo_decision' => '',
		'decision_date' => '',
		'decision_reason_id' => '',
		'proposal_lead_id' => '',
		'team_members' => '',
		'proposal_start_date' => '',
		'proposal_completed_date' => '',
		'days_to_develop' => '',
		'proposal_type' => '',
		'proposal_pages' => '',
		'partners_involved' => '',
		'proposal_status' => '',
		'submitted_date' => '',
		'submitted_to' => '',
		'reference_no' => '',
		'outcome' => '',
		'notification_date' => '',
		'contract_value' => '',
		'win_loss_reason_id' => '',
		'follow_up_actions' => '',
		'action_required' => '',
		'responsible_user_id' => '',
		'due_date' => '',
		'status_id' => '',
		'notes' => '',
		'created_by' => '',
		'created_at' => '',
		'updated_at' => '',
		'is_active' => '',
		'client_organization_name' => '',
		'link_of_source' => '',
		'file_of_source' => '' 
	),
	'fieldPlaceholders' => array(
		'opportunity_id' => '',
		'opportunity_code' => '',
		'date_identified' => '',
		'opportunity_name' => '',
		'source_id' => '',
		'type_id' => '',
		'deadline' => '',
		'estimated_value' => '',
		'currency_id' => '',
		'sector_id' => '',
		'client_type_id' => '',
		'go_nogo_decision' => '',
		'decision_date' => '',
		'decision_reason_id' => '',
		'proposal_lead_id' => '',
		'team_members' => '',
		'proposal_start_date' => '',
		'proposal_completed_date' => '',
		'days_to_develop' => '',
		'proposal_type' => '',
		'proposal_pages' => '',
		'partners_involved' => '',
		'proposal_status' => '',
		'submitted_date' => '',
		'submitted_to' => '',
		'reference_no' => '',
		'outcome' => '',
		'notification_date' => '',
		'contract_value' => '',
		'win_loss_reason_id' => '',
		'follow_up_actions' => '',
		'action_required' => '',
		'responsible_user_id' => '',
		'due_date' => '',
		'status_id' => '',
		'notes' => '',
		'created_by' => '',
		'created_at' => '',
		'updated_at' => '',
		'is_active' => '',
		'client_organization_name' => '',
		'link_of_source' => '',
		'file_of_source' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>