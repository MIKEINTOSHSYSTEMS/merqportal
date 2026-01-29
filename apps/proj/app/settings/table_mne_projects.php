<?php
global $runnerTableSettings;
$runnerTableSettings['mne_projects'] = array(
	'name' => 'mne_projects',
	'shortName' => 'mne_projects',
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
	'afterEditDetails' => 'mne_projects',
	'afterAddDetail' => 'mne_projects',
	'detailsBadgeColor' => '000',
	'displayLoading' => true,
	'warnLeavingEdit' => true,
	'sql' => 'SELECT
	project_id,
	project_code,
	agreement_reference_no,
	opportunity_id,
	project_name,
	project_shortname,
	client_id,
	client_name,
	start_date,
	end_date_original,
	date_extended,
	reason_for_extension,
	total_value,
	currency_id,
	profit_margins,
	contract_type_id,
	grantee_contracted_unit,
	major_project_type_id,
	specific_type_primary_id,
	specific_type_secondary_id,
	sector_id,
	technical_area_primary_id,
	technical_area_secondary_id,
	technical_area_others,
	current_status_id,
	project_description,
	project_manager_id,
	technical_lead_id,
	mel_lead_id,
	project_coordinator_id,
	project_members,
	created_by,
	updated_by,
	created_at,
	updated_at,
	is_active
FROM
	mne_projects
',
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
			'autoinc' => true,
			'sqlExpression' => 'project_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'project_code' => array(
			'name' => 'project_code',
			'goodName' => 'project_code',
			'strField' => 'project_code',
			'index' => 2,
			'sqlExpression' => 'project_code',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'defaultValue' => 'date("Y-m-d H:i:s")' 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'agreement_reference_no' => array(
			'name' => 'agreement_reference_no',
			'goodName' => 'agreement_reference_no',
			'strField' => 'agreement_reference_no',
			'index' => 3,
			'sqlExpression' => 'agreement_reference_no',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'project_name' => array(
			'name' => 'project_name',
			'goodName' => 'project_name',
			'strField' => 'project_name',
			'index' => 5,
			'sqlExpression' => 'project_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'client_id' => array(
			'name' => 'client_id',
			'goodName' => 'client_id',
			'strField' => 'client_id',
			'index' => 7,
			'type' => 3,
			'sqlExpression' => 'client_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'tblclients',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'userid',
					'lookupDisplayField' => 'company',
					'lookupAllowAdd' => true,
					'lookupAddPage' => 'add',
					'lookupAutofillFields' => array( 
						array(
							'masterField' => 'client_id',
							'lookupField' => 'userid' 
						),
						array(
							'masterField' => 'client_name',
							'lookupField' => 'company' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'client_name' => array(
			'name' => 'client_name',
			'goodName' => 'client_name',
			'strField' => 'client_name',
			'index' => 8,
			'sqlExpression' => 'client_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'tblclients',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'company',
					'lookupDisplayField' => 'company',
					'lookupAutofillFields' => array( 
						array(
							'masterField' => 'client_id',
							'lookupField' => 'userid' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'start_date' => array(
			'name' => 'start_date',
			'goodName' => 'start_date',
			'strField' => 'start_date',
			'index' => 9,
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
			'tableName' => 'mne_projects' 
		),
		'end_date_original' => array(
			'name' => 'end_date_original',
			'goodName' => 'end_date_original',
			'strField' => 'end_date_original',
			'index' => 10,
			'type' => 7,
			'sqlExpression' => 'end_date_original',
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
			'tableName' => 'mne_projects' 
		),
		'date_extended' => array(
			'name' => 'date_extended',
			'goodName' => 'date_extended',
			'strField' => 'date_extended',
			'index' => 11,
			'type' => 7,
			'sqlExpression' => 'date_extended',
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
			'tableName' => 'mne_projects' 
		),
		'reason_for_extension' => array(
			'name' => 'reason_for_extension',
			'goodName' => 'reason_for_extension',
			'strField' => 'reason_for_extension',
			'index' => 12,
			'type' => 201,
			'sqlExpression' => 'reason_for_extension',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'total_value' => array(
			'name' => 'total_value',
			'goodName' => 'total_value',
			'strField' => 'total_value',
			'index' => 13,
			'type' => 14,
			'sqlExpression' => 'total_value',
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
			'tableName' => 'mne_projects' 
		),
		'currency_id' => array(
			'name' => 'currency_id',
			'goodName' => 'currency_id',
			'strField' => 'currency_id',
			'index' => 14,
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
			'tableName' => 'mne_projects' 
		),
		'contract_type_id' => array(
			'name' => 'contract_type_id',
			'goodName' => 'contract_type_id',
			'strField' => 'contract_type_id',
			'index' => 16,
			'type' => 3,
			'sqlExpression' => 'contract_type_id',
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
					'lookupWhere' => 'parent_id = 1' 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'grantee_contracted_unit' => array(
			'name' => 'grantee_contracted_unit',
			'goodName' => 'grantee_contracted_unit',
			'strField' => 'grantee_contracted_unit',
			'index' => 17,
			'sqlExpression' => 'grantee_contracted_unit',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_grantee_contracted_unit',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'grantee_id',
					'lookupDisplayField' => 'grantee_name' 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'major_project_type_id' => array(
			'name' => 'major_project_type_id',
			'goodName' => 'major_project_type_id',
			'strField' => 'major_project_type_id',
			'index' => 18,
			'type' => 3,
			'sqlExpression' => 'major_project_type_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_project_category',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'cat_id',
					'lookupDisplayField' => 'category_name',
					'lookupAllowAdd' => true,
					'lookupAddPage' => 'add' 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'specific_type_primary_id' => array(
			'name' => 'specific_type_primary_id',
			'goodName' => 'specific_type_primary_id',
			'strField' => 'specific_type_primary_id',
			'index' => 19,
			'type' => 3,
			'sqlExpression' => 'specific_type_primary_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_project_type_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'type_id',
					'lookupDisplayField' => 'type_name',
					'lookupAllowAdd' => true,
					'lookupAddPage' => 'add',
					'lookupDependentFields' => array( 
						array(
							'masterField' => 'major_project_type_id',
							'lookupField' => 'type_category' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'specific_type_secondary_id' => array(
			'name' => 'specific_type_secondary_id',
			'goodName' => 'specific_type_secondary_id',
			'strField' => 'specific_type_secondary_id',
			'index' => 20,
			'type' => 3,
			'sqlExpression' => 'specific_type_secondary_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_project_type_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'type_id',
					'lookupDisplayField' => 'type_name',
					'lookupAllowAdd' => true,
					'lookupAddPage' => 'add',
					'lookupDependentFields' => array( 
						array(
							'masterField' => 'major_project_type_id',
							'lookupField' => 'type_category' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'sector_id' => array(
			'name' => 'sector_id',
			'goodName' => 'sector_id',
			'strField' => 'sector_id',
			'index' => 21,
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
					'lookupTable' => 'mne_sector_category',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'category_id',
					'lookupDisplayField' => 'category_name',
					'lookupAllowAdd' => true,
					'lookupAddPage' => 'add' 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'technical_area_primary_id' => array(
			'name' => 'technical_area_primary_id',
			'goodName' => 'technical_area_primary_id',
			'strField' => 'technical_area_primary_id',
			'index' => 22,
			'type' => 3,
			'sqlExpression' => 'technical_area_primary_id',
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
					'lookupDisplayField' => 'sector_name',
					'lookupAllowAdd' => true,
					'lookupAddPage' => 'add',
					'lookupDependent' => true,
					'lookupDependentFields' => array( 
						array(
							'masterField' => 'sector_id',
							'lookupField' => 'sector_category' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'technical_area_secondary_id' => array(
			'name' => 'technical_area_secondary_id',
			'goodName' => 'technical_area_secondary_id',
			'strField' => 'technical_area_secondary_id',
			'index' => 23,
			'type' => 3,
			'sqlExpression' => 'technical_area_secondary_id',
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
					'lookupDisplayField' => 'sector_name',
					'lookupAllowAdd' => true,
					'lookupAddPage' => 'add',
					'lookupDependentFields' => array( 
						array(
							'masterField' => 'sector_id',
							'lookupField' => 'sector_category' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'technical_area_others' => array(
			'name' => 'technical_area_others',
			'goodName' => 'technical_area_others',
			'strField' => 'technical_area_others',
			'index' => 24,
			'type' => 201,
			'sqlExpression' => 'technical_area_others',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'current_status_id' => array(
			'name' => 'current_status_id',
			'goodName' => 'current_status_id',
			'strField' => 'current_status_id',
			'index' => 25,
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
					'lookupDisplayField' => 'status_name',
					'lookupWhere' => 'status_category = "General"' 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'project_description' => array(
			'name' => 'project_description',
			'goodName' => 'project_description',
			'strField' => 'project_description',
			'index' => 26,
			'type' => 201,
			'sqlExpression' => 'project_description',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'project_manager_id' => array(
			'name' => 'project_manager_id',
			'goodName' => 'project_manager_id',
			'strField' => 'project_manager_id',
			'index' => 27,
			'type' => 3,
			'sqlExpression' => 'project_manager_id',
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
			'tableName' => 'mne_projects' 
		),
		'technical_lead_id' => array(
			'name' => 'technical_lead_id',
			'goodName' => 'technical_lead_id',
			'strField' => 'technical_lead_id',
			'index' => 28,
			'type' => 3,
			'sqlExpression' => 'technical_lead_id',
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
			'tableName' => 'mne_projects' 
		),
		'mel_lead_id' => array(
			'name' => 'mel_lead_id',
			'goodName' => 'mel_lead_id',
			'strField' => 'mel_lead_id',
			'index' => 29,
			'type' => 3,
			'sqlExpression' => 'mel_lead_id',
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
			'tableName' => 'mne_projects' 
		),
		'project_coordinator_id' => array(
			'name' => 'project_coordinator_id',
			'goodName' => 'project_coordinator_id',
			'strField' => 'project_coordinator_id',
			'index' => 30,
			'type' => 3,
			'sqlExpression' => 'project_coordinator_id',
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
			'tableName' => 'mne_projects' 
		),
		'created_by' => array(
			'name' => 'created_by',
			'goodName' => 'created_by',
			'strField' => 'created_by',
			'index' => 32,
			'sqlExpression' => 'created_by',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Readonly',
					'defaultValue' => '$_SESSION["UserID"]',
					'lookupType' => 2,
					'lookupTable' => 'users',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'user_id',
					'lookupDisplayField' => 'full_name',
					'lookupOrderBy' => 'full_name',
					'lookupWhere' => 'user_id NOT IN (1, 2, 3)' 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 34,
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
			'tableName' => 'mne_projects' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 35,
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
			'tableName' => 'mne_projects' 
		),
		'is_active' => array(
			'name' => 'is_active',
			'goodName' => 'is_active',
			'strField' => 'is_active',
			'index' => 36,
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
			'tableName' => 'mne_projects' 
		),
		'opportunity_id' => array(
			'name' => 'opportunity_id',
			'goodName' => 'opportunity_id',
			'strField' => 'opportunity_id',
			'index' => 4,
			'sqlExpression' => 'opportunity_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_business_opportunities',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'opportunity_id',
					'lookupDisplayField' => 'opportunity_name',
					'lookupAutofillEdit' => true,
					'lookupAutofillFields' => array( 
						array(
							'masterField' => 'project_name',
							'lookupField' => 'opportunity_name' 
						),
						array(
							'masterField' => 'client_name',
							'lookupField' => 'client_organization_name' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'project_shortname' => array(
			'name' => 'project_shortname',
			'goodName' => 'project_shortname',
			'strField' => 'project_shortname',
			'index' => 6,
			'sqlExpression' => 'project_shortname',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'profit_margins' => array(
			'name' => 'profit_margins',
			'goodName' => 'profit_margins',
			'strField' => 'profit_margins',
			'index' => 15,
			'sqlExpression' => 'profit_margins',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_projects' 
		),
		'project_members' => array(
			'name' => 'project_members',
			'goodName' => 'project_members',
			'strField' => 'project_members',
			'index' => 31,
			'sqlExpression' => 'project_members',
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
			'tableName' => 'mne_projects' 
		),
		'updated_by' => array(
			'name' => 'updated_by',
			'goodName' => 'updated_by',
			'strField' => 'updated_by',
			'index' => 33,
			'sqlExpression' => 'updated_by',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Readonly',
					'autoUpdateValue' => '$_SESSION["UserID"]' 
				) 
			),
			'tableName' => 'mne_projects' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'mne_business_options',
			'detailsKeys' => array( 
				'contract_type_id' 
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
				'technical_lead_id' 
			),
			'masterKeys' => array( 
				'lead_id' 
			) 
		),
		array(
			'table' => 'mne_project_type_options',
			'detailsKeys' => array( 
				'specific_type_secondary_id' 
			),
			'masterKeys' => array( 
				'type_id' 
			) 
		),
		array(
			'table' => 'mne_sector_options',
			'detailsKeys' => array( 
				'technical_area_secondary_id' 
			),
			'masterKeys' => array( 
				'sector_id' 
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
		),
		array(
			'table' => 'users',
			'detailsKeys' => array( 
				'created_by' 
			),
			'masterKeys' => array( 
				'username' 
			) 
		),
		array(
			'table' => 'mne_project_category',
			'detailsKeys' => array( 
				'major_project_type_id' 
			),
			'masterKeys' => array( 
				'cat_id' 
			) 
		),
		array(
			'table' => 'mne_business_opportunities',
			'detailsKeys' => array( 
				'opportunity_id' 
			),
			'masterKeys' => array( 
				'opportunity_id' 
			) 
		) 
	),
	'detailsTables' => array( 
		'mne_client_satisfaction',
		'mne_data_collection',
		'mne_extended_projects',
		'mne_performance_alerts',
		'mne_project_data_management',
		'mne_project_deliverables',
		'mne_project_details',
		'mne_project_financials',
		'mne_project_issues',
		'mne_project_risks',
		'mne_project_timelines',
		'mne_project_updates',
		'mne_year_projects' 
	),
	'query' => array(
		'sql' => 'SELECT
	project_id,
	project_code,
	agreement_reference_no,
	opportunity_id,
	project_name,
	project_shortname,
	client_id,
	client_name,
	start_date,
	end_date_original,
	date_extended,
	reason_for_extension,
	total_value,
	currency_id,
	profit_margins,
	contract_type_id,
	grantee_contracted_unit,
	major_project_type_id,
	specific_type_primary_id,
	specific_type_secondary_id,
	sector_id,
	technical_area_primary_id,
	technical_area_secondary_id,
	technical_area_others,
	current_status_id,
	project_description,
	project_manager_id,
	technical_lead_id,
	mel_lead_id,
	project_coordinator_id,
	project_members,
	created_by,
	updated_by,
	created_at,
	updated_at,
	is_active
FROM
	mne_projects
',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'project_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'project_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_id' 
			),
			array(
				'sql' => 'project_code',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'project_code' 
				),
				'encrypted' => false,
				'columnName' => 'project_code' 
			),
			array(
				'sql' => 'agreement_reference_no',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'agreement_reference_no' 
				),
				'encrypted' => false,
				'columnName' => 'agreement_reference_no' 
			),
			array(
				'sql' => 'opportunity_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'opportunity_id' 
				),
				'encrypted' => false,
				'columnName' => 'opportunity_id' 
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
					'table' => 'mne_projects',
					'name' => 'project_name' 
				),
				'encrypted' => false,
				'columnName' => 'project_name' 
			),
			array(
				'sql' => 'project_shortname',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'project_shortname' 
				),
				'encrypted' => false,
				'columnName' => 'project_shortname' 
			),
			array(
				'sql' => 'client_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'client_id' 
				),
				'encrypted' => false,
				'columnName' => 'client_id' 
			),
			array(
				'sql' => 'client_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'client_name' 
				),
				'encrypted' => false,
				'columnName' => 'client_name' 
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
					'table' => 'mne_projects',
					'name' => 'start_date' 
				),
				'encrypted' => false,
				'columnName' => 'start_date' 
			),
			array(
				'sql' => 'end_date_original',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'end_date_original' 
				),
				'encrypted' => false,
				'columnName' => 'end_date_original' 
			),
			array(
				'sql' => 'date_extended',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'date_extended' 
				),
				'encrypted' => false,
				'columnName' => 'date_extended' 
			),
			array(
				'sql' => 'reason_for_extension',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'reason_for_extension' 
				),
				'encrypted' => false,
				'columnName' => 'reason_for_extension' 
			),
			array(
				'sql' => 'total_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'total_value' 
				),
				'encrypted' => false,
				'columnName' => 'total_value' 
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
					'table' => 'mne_projects',
					'name' => 'currency_id' 
				),
				'encrypted' => false,
				'columnName' => 'currency_id' 
			),
			array(
				'sql' => 'profit_margins',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'profit_margins' 
				),
				'encrypted' => false,
				'columnName' => 'profit_margins' 
			),
			array(
				'sql' => 'contract_type_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'contract_type_id' 
				),
				'encrypted' => false,
				'columnName' => 'contract_type_id' 
			),
			array(
				'sql' => 'grantee_contracted_unit',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'grantee_contracted_unit' 
				),
				'encrypted' => false,
				'columnName' => 'grantee_contracted_unit' 
			),
			array(
				'sql' => 'major_project_type_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'major_project_type_id' 
				),
				'encrypted' => false,
				'columnName' => 'major_project_type_id' 
			),
			array(
				'sql' => 'specific_type_primary_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'specific_type_primary_id' 
				),
				'encrypted' => false,
				'columnName' => 'specific_type_primary_id' 
			),
			array(
				'sql' => 'specific_type_secondary_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'specific_type_secondary_id' 
				),
				'encrypted' => false,
				'columnName' => 'specific_type_secondary_id' 
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
					'table' => 'mne_projects',
					'name' => 'sector_id' 
				),
				'encrypted' => false,
				'columnName' => 'sector_id' 
			),
			array(
				'sql' => 'technical_area_primary_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'technical_area_primary_id' 
				),
				'encrypted' => false,
				'columnName' => 'technical_area_primary_id' 
			),
			array(
				'sql' => 'technical_area_secondary_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'technical_area_secondary_id' 
				),
				'encrypted' => false,
				'columnName' => 'technical_area_secondary_id' 
			),
			array(
				'sql' => 'technical_area_others',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'technical_area_others' 
				),
				'encrypted' => false,
				'columnName' => 'technical_area_others' 
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
					'table' => 'mne_projects',
					'name' => 'current_status_id' 
				),
				'encrypted' => false,
				'columnName' => 'current_status_id' 
			),
			array(
				'sql' => 'project_description',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'project_description' 
				),
				'encrypted' => false,
				'columnName' => 'project_description' 
			),
			array(
				'sql' => 'project_manager_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'project_manager_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_manager_id' 
			),
			array(
				'sql' => 'technical_lead_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'technical_lead_id' 
				),
				'encrypted' => false,
				'columnName' => 'technical_lead_id' 
			),
			array(
				'sql' => 'mel_lead_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'mel_lead_id' 
				),
				'encrypted' => false,
				'columnName' => 'mel_lead_id' 
			),
			array(
				'sql' => 'project_coordinator_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'project_coordinator_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_coordinator_id' 
			),
			array(
				'sql' => 'project_members',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'project_members' 
				),
				'encrypted' => false,
				'columnName' => 'project_members' 
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
					'table' => 'mne_projects',
					'name' => 'created_by' 
				),
				'encrypted' => false,
				'columnName' => 'created_by' 
			),
			array(
				'sql' => 'updated_by',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_projects',
					'name' => 'updated_by' 
				),
				'encrypted' => false,
				'columnName' => 'updated_by' 
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
					'table' => 'mne_projects',
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
					'table' => 'mne_projects',
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
					'table' => 'mne_projects',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_projects',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_projects',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'project_id',
						'project_code',
						'agreement_reference_no',
						'opportunity_id',
						'project_name',
						'project_shortname',
						'client_id',
						'client_name',
						'start_date',
						'end_date_original',
						'date_extended',
						'reason_for_extension',
						'total_value',
						'currency_id',
						'profit_margins',
						'contract_type_id',
						'grantee_contracted_unit',
						'major_project_type_id',
						'specific_type_primary_id',
						'specific_type_secondary_id',
						'sector_id',
						'technical_area_primary_id',
						'technical_area_secondary_id',
						'technical_area_others',
						'current_status_id',
						'project_description',
						'project_manager_id',
						'technical_lead_id',
						'mel_lead_id',
						'project_coordinator_id',
						'project_members',
						'created_by',
						'updated_by',
						'created_at',
						'updated_at',
						'is_active' 
					),
					'name' => 'mne_projects' 
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
		'fieldListSql' => 'project_id,
	project_code,
	agreement_reference_no,
	opportunity_id,
	project_name,
	project_shortname,
	client_id,
	client_name,
	start_date,
	end_date_original,
	date_extended,
	reason_for_extension,
	total_value,
	currency_id,
	profit_margins,
	contract_type_id,
	grantee_contracted_unit,
	major_project_type_id,
	specific_type_primary_id,
	specific_type_secondary_id,
	sector_id,
	technical_area_primary_id,
	technical_area_secondary_id,
	technical_area_others,
	current_status_id,
	project_description,
	project_manager_id,
	technical_lead_id,
	mel_lead_id,
	project_coordinator_id,
	project_members,
	created_by,
	updated_by,
	created_at,
	updated_at,
	is_active',
		'fromListSql' => 'FROM
	mne_projects',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_projects',
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
			'project_id',
			'project_code',
			'agreement_reference_no',
			'project_name',
			'client_id',
			'client_name',
			'start_date',
			'end_date_original',
			'date_extended',
			'reason_for_extension',
			'total_value',
			'currency_id',
			'contract_type_id',
			'grantee_contracted_unit',
			'major_project_type_id',
			'specific_type_primary_id',
			'specific_type_secondary_id',
			'sector_id',
			'technical_area_primary_id',
			'technical_area_secondary_id',
			'technical_area_others',
			'current_status_id',
			'project_description',
			'project_manager_id',
			'technical_lead_id',
			'mel_lead_id',
			'project_coordinator_id',
			'created_by',
			'created_at',
			'updated_at',
			'is_active',
			'opportunity_id',
			'project_shortname',
			'profit_margins',
			'project_members',
			'updated_by' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'project_id',
			'project_code',
			'agreement_reference_no',
			'project_name',
			'client_id',
			'client_name',
			'start_date',
			'end_date_original',
			'date_extended',
			'reason_for_extension',
			'total_value',
			'currency_id',
			'contract_type_id',
			'grantee_contracted_unit',
			'major_project_type_id',
			'specific_type_primary_id',
			'specific_type_secondary_id',
			'sector_id',
			'technical_area_primary_id',
			'technical_area_secondary_id',
			'technical_area_others',
			'current_status_id',
			'project_description',
			'project_manager_id',
			'technical_lead_id',
			'mel_lead_id',
			'project_coordinator_id',
			'created_by',
			'created_at',
			'updated_at',
			'is_active',
			'opportunity_id',
			'project_shortname',
			'profit_margins',
			'project_members',
			'updated_by' 
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
	$runnerTableLabels['mne_projects'] = array(
	'tableCaption' => 'MERQ Projects',
	'fieldLabels' => array(
		'project_id' => 'Project ID',
		'project_code' => 'Project Code',
		'agreement_reference_no' => 'Agreement Reference No',
		'project_name' => 'Project Name',
		'client_id' => 'Project Client ID',
		'client_name' => 'Client Name',
		'start_date' => 'Start Date',
		'end_date_original' => 'End Date Original',
		'date_extended' => 'Date Extended',
		'reason_for_extension' => 'Reason For Extension',
		'total_value' => 'Total Value',
		'currency_id' => 'Currency',
		'contract_type_id' => 'Contract Type',
		'grantee_contracted_unit' => 'Grantee Contracted Unit',
		'major_project_type_id' => 'Major Project Type',
		'specific_type_primary_id' => 'Specific Type Primary',
		'specific_type_secondary_id' => 'Specific Type Secondary',
		'sector_id' => 'Sector',
		'technical_area_primary_id' => 'Technical Area Primary',
		'technical_area_secondary_id' => 'Technical Area Secondary',
		'technical_area_others' => 'Technical Area (Others)',
		'current_status_id' => 'Current Status',
		'project_description' => 'Project Description',
		'project_manager_id' => 'Project Manager',
		'technical_lead_id' => 'Technical Lead',
		'mel_lead_id' => 'MEL Lead',
		'project_coordinator_id' => 'Project Coordinator ID',
		'created_by' => 'Created By',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At',
		'is_active' => 'Is Active',
		'opportunity_id' => 'From Opportunity',
		'project_shortname' => 'Project Short Name',
		'profit_margins' => 'Profit Margins(%)',
		'project_members' => 'Project Members',
		'updated_by' => 'Updated By' 
	),
	'fieldTooltips' => array(
		'project_id' => '',
		'project_code' => '',
		'agreement_reference_no' => '',
		'project_name' => '',
		'client_id' => '',
		'client_name' => '',
		'start_date' => '',
		'end_date_original' => '',
		'date_extended' => '',
		'reason_for_extension' => '',
		'total_value' => '',
		'currency_id' => '',
		'contract_type_id' => '',
		'grantee_contracted_unit' => '',
		'major_project_type_id' => '',
		'specific_type_primary_id' => '',
		'specific_type_secondary_id' => '',
		'sector_id' => '',
		'technical_area_primary_id' => '',
		'technical_area_secondary_id' => '',
		'technical_area_others' => '',
		'current_status_id' => '',
		'project_description' => '',
		'project_manager_id' => '',
		'technical_lead_id' => '',
		'mel_lead_id' => '',
		'project_coordinator_id' => '',
		'created_by' => '',
		'created_at' => '',
		'updated_at' => '',
		'is_active' => '',
		'opportunity_id' => '',
		'project_shortname' => '',
		'profit_margins' => '',
		'project_members' => '',
		'updated_by' => '' 
	),
	'fieldPlaceholders' => array(
		'project_id' => '',
		'project_code' => '',
		'agreement_reference_no' => '',
		'project_name' => '',
		'client_id' => '',
		'client_name' => '',
		'start_date' => '',
		'end_date_original' => '',
		'date_extended' => '',
		'reason_for_extension' => '',
		'total_value' => '',
		'currency_id' => '',
		'contract_type_id' => '',
		'grantee_contracted_unit' => '',
		'major_project_type_id' => '',
		'specific_type_primary_id' => '',
		'specific_type_secondary_id' => '',
		'sector_id' => '',
		'technical_area_primary_id' => '',
		'technical_area_secondary_id' => '',
		'technical_area_others' => '',
		'current_status_id' => '',
		'project_description' => '',
		'project_manager_id' => '',
		'technical_lead_id' => '',
		'mel_lead_id' => '',
		'project_coordinator_id' => '',
		'created_by' => '',
		'created_at' => '',
		'updated_at' => '',
		'is_active' => '',
		'opportunity_id' => '',
		'project_shortname' => '',
		'profit_margins' => '',
		'project_members' => '',
		'updated_by' => '' 
	),
	'pageTitles' => array(
		'list' => 'Extended Projects' 
	) 
);
}
?>