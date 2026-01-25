<?php
global $runnerTableSettings;
$runnerTableSettings['mne_data_collection'] = array(
	'name' => 'mne_data_collection',
	'shortName' => 'mne_data_collection',
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
			'list',
			'list1' 
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
		'list1' => 'list',
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
	'afterEditDetails' => 'mne_data_collection',
	'afterAddDetail' => 'mne_data_collection',
	'detailsBadgeColor' => 'bc8f8f',
	'displayLoading' => true,
	'warnLeavingEdit' => true,
	'sql' => 'SELECT
	collection_id,
	project_id,
	project_name,
	client,
	start_date,
	end_date,
	number_of_days,
	number_of_rounds,
	number_separate_activities,
	data_collection_activity,
	ownership,
	data_access,
	method,
	doc_review,
	data_collectors_count,
	supervisors_count,
	field_guides_count,
	site_coordinators_count,
	others_count,
	household_survey_count,
	facility_assessment_count,
	oca_count,
	mapping_count,
	profiling_count,
	quant_others_count,
	kii_idi_count,
	fgd_count,
	workshops_count,
	observation_count,
	qual_others_count,
	reviews_count,
	hh_women_count,
	hh_men_count,
	hh_youth_count,
	hh_others_count,
	fac_hospital_count,
	fac_hc_count,
	fac_hp_count,
	oca_target_count,
	mapping_orgs_count,
	mapping_structures_count,
	mapping_others_count,
	profiling_target_count,
	quant_other_target_count,
	kii_target_count,
	fgd_session_count,
	fgd_participant_count,
	workshop_session_count,
	workshop_participant_count,
	observation_session_count,
	qual_other_target_count,
	technical_assistance_targets,
	technical_assistance_rounds,
	training_sessions,
	training_participants,
	datasets_count,
	datasets_with_description,
	languages_count,
	audio_records_count,
	summary_notes_count,
	code_reports_count,
	created_at,
	updated_at
FROM
	mne_data_collection',
	'keyFields' => array( 
		'collection_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'collection_id' => array(
			'name' => 'collection_id',
			'goodName' => 'collection_id',
			'strField' => 'collection_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'collection_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
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
					'lookupDisplayField' => 'project_code',
					'lookupAutofillEdit' => true,
					'lookupAutofillFields' => array( 
						array(
							'masterField' => 'project_name',
							'lookupField' => 'project_name' 
						),
						array(
							'masterField' => 'client',
							'lookupField' => 'client_name' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_data_collection' 
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
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
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
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
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
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_data_collection' 
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
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'number_of_days' => array(
			'name' => 'number_of_days',
			'goodName' => 'number_of_days',
			'strField' => 'number_of_days',
			'index' => 7,
			'type' => 3,
			'sqlExpression' => 'number_of_days',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Number' 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'number_of_rounds' => array(
			'name' => 'number_of_rounds',
			'goodName' => 'number_of_rounds',
			'strField' => 'number_of_rounds',
			'index' => 8,
			'type' => 3,
			'sqlExpression' => 'number_of_rounds',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Number' 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'number_separate_activities' => array(
			'name' => 'number_separate_activities',
			'goodName' => 'number_separate_activities',
			'strField' => 'number_separate_activities',
			'index' => 9,
			'type' => 3,
			'sqlExpression' => 'number_separate_activities',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Number' 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'data_collection_activity' => array(
			'name' => 'data_collection_activity',
			'goodName' => 'data_collection_activity',
			'strField' => 'data_collection_activity',
			'index' => 10,
			'sqlExpression' => 'data_collection_activity',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_generic_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_name' 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'data_collectors_count' => array(
			'name' => 'data_collectors_count',
			'goodName' => 'data_collectors_count',
			'strField' => 'data_collectors_count',
			'index' => 15,
			'type' => 3,
			'sqlExpression' => 'data_collectors_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'supervisors_count' => array(
			'name' => 'supervisors_count',
			'goodName' => 'supervisors_count',
			'strField' => 'supervisors_count',
			'index' => 16,
			'type' => 3,
			'sqlExpression' => 'supervisors_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'field_guides_count' => array(
			'name' => 'field_guides_count',
			'goodName' => 'field_guides_count',
			'strField' => 'field_guides_count',
			'index' => 17,
			'type' => 3,
			'sqlExpression' => 'field_guides_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'site_coordinators_count' => array(
			'name' => 'site_coordinators_count',
			'goodName' => 'site_coordinators_count',
			'strField' => 'site_coordinators_count',
			'index' => 18,
			'type' => 3,
			'sqlExpression' => 'site_coordinators_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'others_count' => array(
			'name' => 'others_count',
			'goodName' => 'others_count',
			'strField' => 'others_count',
			'index' => 19,
			'type' => 3,
			'sqlExpression' => 'others_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'household_survey_count' => array(
			'name' => 'household_survey_count',
			'goodName' => 'household_survey_count',
			'strField' => 'household_survey_count',
			'index' => 20,
			'type' => 3,
			'sqlExpression' => 'household_survey_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'facility_assessment_count' => array(
			'name' => 'facility_assessment_count',
			'goodName' => 'facility_assessment_count',
			'strField' => 'facility_assessment_count',
			'index' => 21,
			'type' => 3,
			'sqlExpression' => 'facility_assessment_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'oca_count' => array(
			'name' => 'oca_count',
			'goodName' => 'oca_count',
			'strField' => 'oca_count',
			'index' => 22,
			'type' => 3,
			'sqlExpression' => 'oca_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'mapping_count' => array(
			'name' => 'mapping_count',
			'goodName' => 'mapping_count',
			'strField' => 'mapping_count',
			'index' => 23,
			'type' => 3,
			'sqlExpression' => 'mapping_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'profiling_count' => array(
			'name' => 'profiling_count',
			'goodName' => 'profiling_count',
			'strField' => 'profiling_count',
			'index' => 24,
			'type' => 3,
			'sqlExpression' => 'profiling_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'quant_others_count' => array(
			'name' => 'quant_others_count',
			'goodName' => 'quant_others_count',
			'strField' => 'quant_others_count',
			'index' => 25,
			'type' => 3,
			'sqlExpression' => 'quant_others_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'kii_idi_count' => array(
			'name' => 'kii_idi_count',
			'goodName' => 'kii_idi_count',
			'strField' => 'kii_idi_count',
			'index' => 26,
			'type' => 3,
			'sqlExpression' => 'kii_idi_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'fgd_count' => array(
			'name' => 'fgd_count',
			'goodName' => 'fgd_count',
			'strField' => 'fgd_count',
			'index' => 27,
			'type' => 3,
			'sqlExpression' => 'fgd_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'workshops_count' => array(
			'name' => 'workshops_count',
			'goodName' => 'workshops_count',
			'strField' => 'workshops_count',
			'index' => 28,
			'type' => 3,
			'sqlExpression' => 'workshops_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'observation_count' => array(
			'name' => 'observation_count',
			'goodName' => 'observation_count',
			'strField' => 'observation_count',
			'index' => 29,
			'type' => 3,
			'sqlExpression' => 'observation_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'qual_others_count' => array(
			'name' => 'qual_others_count',
			'goodName' => 'qual_others_count',
			'strField' => 'qual_others_count',
			'index' => 30,
			'type' => 3,
			'sqlExpression' => 'qual_others_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'reviews_count' => array(
			'name' => 'reviews_count',
			'goodName' => 'reviews_count',
			'strField' => 'reviews_count',
			'index' => 31,
			'type' => 3,
			'sqlExpression' => 'reviews_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'hh_women_count' => array(
			'name' => 'hh_women_count',
			'goodName' => 'hh_women_count',
			'strField' => 'hh_women_count',
			'index' => 32,
			'type' => 3,
			'sqlExpression' => 'hh_women_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'hh_men_count' => array(
			'name' => 'hh_men_count',
			'goodName' => 'hh_men_count',
			'strField' => 'hh_men_count',
			'index' => 33,
			'type' => 3,
			'sqlExpression' => 'hh_men_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'hh_youth_count' => array(
			'name' => 'hh_youth_count',
			'goodName' => 'hh_youth_count',
			'strField' => 'hh_youth_count',
			'index' => 34,
			'type' => 3,
			'sqlExpression' => 'hh_youth_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'hh_others_count' => array(
			'name' => 'hh_others_count',
			'goodName' => 'hh_others_count',
			'strField' => 'hh_others_count',
			'index' => 35,
			'type' => 3,
			'sqlExpression' => 'hh_others_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'fac_hospital_count' => array(
			'name' => 'fac_hospital_count',
			'goodName' => 'fac_hospital_count',
			'strField' => 'fac_hospital_count',
			'index' => 36,
			'type' => 3,
			'sqlExpression' => 'fac_hospital_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'fac_hc_count' => array(
			'name' => 'fac_hc_count',
			'goodName' => 'fac_hc_count',
			'strField' => 'fac_hc_count',
			'index' => 37,
			'type' => 3,
			'sqlExpression' => 'fac_hc_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'fac_hp_count' => array(
			'name' => 'fac_hp_count',
			'goodName' => 'fac_hp_count',
			'strField' => 'fac_hp_count',
			'index' => 38,
			'type' => 3,
			'sqlExpression' => 'fac_hp_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'oca_target_count' => array(
			'name' => 'oca_target_count',
			'goodName' => 'oca_target_count',
			'strField' => 'oca_target_count',
			'index' => 39,
			'type' => 3,
			'sqlExpression' => 'oca_target_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'mapping_orgs_count' => array(
			'name' => 'mapping_orgs_count',
			'goodName' => 'mapping_orgs_count',
			'strField' => 'mapping_orgs_count',
			'index' => 40,
			'type' => 3,
			'sqlExpression' => 'mapping_orgs_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'mapping_structures_count' => array(
			'name' => 'mapping_structures_count',
			'goodName' => 'mapping_structures_count',
			'strField' => 'mapping_structures_count',
			'index' => 41,
			'type' => 3,
			'sqlExpression' => 'mapping_structures_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'mapping_others_count' => array(
			'name' => 'mapping_others_count',
			'goodName' => 'mapping_others_count',
			'strField' => 'mapping_others_count',
			'index' => 42,
			'type' => 3,
			'sqlExpression' => 'mapping_others_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'profiling_target_count' => array(
			'name' => 'profiling_target_count',
			'goodName' => 'profiling_target_count',
			'strField' => 'profiling_target_count',
			'index' => 43,
			'type' => 3,
			'sqlExpression' => 'profiling_target_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'quant_other_target_count' => array(
			'name' => 'quant_other_target_count',
			'goodName' => 'quant_other_target_count',
			'strField' => 'quant_other_target_count',
			'index' => 44,
			'type' => 3,
			'sqlExpression' => 'quant_other_target_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'kii_target_count' => array(
			'name' => 'kii_target_count',
			'goodName' => 'kii_target_count',
			'strField' => 'kii_target_count',
			'index' => 45,
			'type' => 3,
			'sqlExpression' => 'kii_target_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'fgd_session_count' => array(
			'name' => 'fgd_session_count',
			'goodName' => 'fgd_session_count',
			'strField' => 'fgd_session_count',
			'index' => 46,
			'type' => 3,
			'sqlExpression' => 'fgd_session_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'fgd_participant_count' => array(
			'name' => 'fgd_participant_count',
			'goodName' => 'fgd_participant_count',
			'strField' => 'fgd_participant_count',
			'index' => 47,
			'type' => 3,
			'sqlExpression' => 'fgd_participant_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'workshop_session_count' => array(
			'name' => 'workshop_session_count',
			'goodName' => 'workshop_session_count',
			'strField' => 'workshop_session_count',
			'index' => 48,
			'type' => 3,
			'sqlExpression' => 'workshop_session_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'workshop_participant_count' => array(
			'name' => 'workshop_participant_count',
			'goodName' => 'workshop_participant_count',
			'strField' => 'workshop_participant_count',
			'index' => 49,
			'type' => 3,
			'sqlExpression' => 'workshop_participant_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'observation_session_count' => array(
			'name' => 'observation_session_count',
			'goodName' => 'observation_session_count',
			'strField' => 'observation_session_count',
			'index' => 50,
			'type' => 3,
			'sqlExpression' => 'observation_session_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'qual_other_target_count' => array(
			'name' => 'qual_other_target_count',
			'goodName' => 'qual_other_target_count',
			'strField' => 'qual_other_target_count',
			'index' => 51,
			'type' => 3,
			'sqlExpression' => 'qual_other_target_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'technical_assistance_targets' => array(
			'name' => 'technical_assistance_targets',
			'goodName' => 'technical_assistance_targets',
			'strField' => 'technical_assistance_targets',
			'index' => 52,
			'type' => 3,
			'sqlExpression' => 'technical_assistance_targets',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'technical_assistance_rounds' => array(
			'name' => 'technical_assistance_rounds',
			'goodName' => 'technical_assistance_rounds',
			'strField' => 'technical_assistance_rounds',
			'index' => 53,
			'type' => 3,
			'sqlExpression' => 'technical_assistance_rounds',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'training_sessions' => array(
			'name' => 'training_sessions',
			'goodName' => 'training_sessions',
			'strField' => 'training_sessions',
			'index' => 54,
			'type' => 3,
			'sqlExpression' => 'training_sessions',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'training_participants' => array(
			'name' => 'training_participants',
			'goodName' => 'training_participants',
			'strField' => 'training_participants',
			'index' => 55,
			'type' => 3,
			'sqlExpression' => 'training_participants',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'datasets_count' => array(
			'name' => 'datasets_count',
			'goodName' => 'datasets_count',
			'strField' => 'datasets_count',
			'index' => 56,
			'type' => 3,
			'sqlExpression' => 'datasets_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'datasets_with_description' => array(
			'name' => 'datasets_with_description',
			'goodName' => 'datasets_with_description',
			'strField' => 'datasets_with_description',
			'index' => 57,
			'type' => 3,
			'sqlExpression' => 'datasets_with_description',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'languages_count' => array(
			'name' => 'languages_count',
			'goodName' => 'languages_count',
			'strField' => 'languages_count',
			'index' => 58,
			'type' => 3,
			'sqlExpression' => 'languages_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'audio_records_count' => array(
			'name' => 'audio_records_count',
			'goodName' => 'audio_records_count',
			'strField' => 'audio_records_count',
			'index' => 59,
			'type' => 3,
			'sqlExpression' => 'audio_records_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'summary_notes_count' => array(
			'name' => 'summary_notes_count',
			'goodName' => 'summary_notes_count',
			'strField' => 'summary_notes_count',
			'index' => 60,
			'type' => 3,
			'sqlExpression' => 'summary_notes_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'code_reports_count' => array(
			'name' => 'code_reports_count',
			'goodName' => 'code_reports_count',
			'strField' => 'code_reports_count',
			'index' => 61,
			'type' => 3,
			'sqlExpression' => 'code_reports_count',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 62,
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
			'tableName' => 'mne_data_collection' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 63,
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
			'tableName' => 'mne_data_collection' 
		),
		'ownership' => array(
			'name' => 'ownership',
			'goodName' => 'ownership',
			'strField' => 'ownership',
			'index' => 11,
			'sqlExpression' => 'ownership',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_generic_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_name' 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'data_access' => array(
			'name' => 'data_access',
			'goodName' => 'data_access',
			'strField' => 'data_access',
			'index' => 12,
			'sqlExpression' => 'data_access',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Requestable',
						'Confidential',
						'NA' 
					),
					'lookupTable' => 'mne_generic_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_name' 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'method' => array(
			'name' => 'method',
			'goodName' => 'method',
			'strField' => 'method',
			'index' => 13,
			'sqlExpression' => 'method',
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
					'lookupLinkField' => 'method_type',
					'lookupDisplayField' => 'method_name' 
				) 
			),
			'tableName' => 'mne_data_collection' 
		),
		'doc_review' => array(
			'name' => 'doc_review',
			'goodName' => 'doc_review',
			'strField' => 'doc_review',
			'index' => 14,
			'sqlExpression' => 'doc_review',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_generic_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'option_id',
					'lookupDisplayField' => 'option_name' 
				) 
			),
			'tableName' => 'mne_data_collection' 
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
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	collection_id,
	project_id,
	project_name,
	client,
	start_date,
	end_date,
	number_of_days,
	number_of_rounds,
	number_separate_activities,
	data_collection_activity,
	ownership,
	data_access,
	method,
	doc_review,
	data_collectors_count,
	supervisors_count,
	field_guides_count,
	site_coordinators_count,
	others_count,
	household_survey_count,
	facility_assessment_count,
	oca_count,
	mapping_count,
	profiling_count,
	quant_others_count,
	kii_idi_count,
	fgd_count,
	workshops_count,
	observation_count,
	qual_others_count,
	reviews_count,
	hh_women_count,
	hh_men_count,
	hh_youth_count,
	hh_others_count,
	fac_hospital_count,
	fac_hc_count,
	fac_hp_count,
	oca_target_count,
	mapping_orgs_count,
	mapping_structures_count,
	mapping_others_count,
	profiling_target_count,
	quant_other_target_count,
	kii_target_count,
	fgd_session_count,
	fgd_participant_count,
	workshop_session_count,
	workshop_participant_count,
	observation_session_count,
	qual_other_target_count,
	technical_assistance_targets,
	technical_assistance_rounds,
	training_sessions,
	training_participants,
	datasets_count,
	datasets_with_description,
	languages_count,
	audio_records_count,
	summary_notes_count,
	code_reports_count,
	created_at,
	updated_at
FROM
	mne_data_collection',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'collection_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'collection_id' 
				),
				'encrypted' => false,
				'columnName' => 'collection_id' 
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
					'table' => 'mne_data_collection',
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
					'table' => 'mne_data_collection',
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
					'table' => 'mne_data_collection',
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
					'table' => 'mne_data_collection',
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
					'table' => 'mne_data_collection',
					'name' => 'end_date' 
				),
				'encrypted' => false,
				'columnName' => 'end_date' 
			),
			array(
				'sql' => 'number_of_days',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'number_of_days' 
				),
				'encrypted' => false,
				'columnName' => 'number_of_days' 
			),
			array(
				'sql' => 'number_of_rounds',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'number_of_rounds' 
				),
				'encrypted' => false,
				'columnName' => 'number_of_rounds' 
			),
			array(
				'sql' => 'number_separate_activities',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'number_separate_activities' 
				),
				'encrypted' => false,
				'columnName' => 'number_separate_activities' 
			),
			array(
				'sql' => 'data_collection_activity',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'data_collection_activity' 
				),
				'encrypted' => false,
				'columnName' => 'data_collection_activity' 
			),
			array(
				'sql' => 'ownership',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'ownership' 
				),
				'encrypted' => false,
				'columnName' => 'ownership' 
			),
			array(
				'sql' => 'data_access',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'data_access' 
				),
				'encrypted' => false,
				'columnName' => 'data_access' 
			),
			array(
				'sql' => 'method',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'method' 
				),
				'encrypted' => false,
				'columnName' => 'method' 
			),
			array(
				'sql' => 'doc_review',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'doc_review' 
				),
				'encrypted' => false,
				'columnName' => 'doc_review' 
			),
			array(
				'sql' => 'data_collectors_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'data_collectors_count' 
				),
				'encrypted' => false,
				'columnName' => 'data_collectors_count' 
			),
			array(
				'sql' => 'supervisors_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'supervisors_count' 
				),
				'encrypted' => false,
				'columnName' => 'supervisors_count' 
			),
			array(
				'sql' => 'field_guides_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'field_guides_count' 
				),
				'encrypted' => false,
				'columnName' => 'field_guides_count' 
			),
			array(
				'sql' => 'site_coordinators_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'site_coordinators_count' 
				),
				'encrypted' => false,
				'columnName' => 'site_coordinators_count' 
			),
			array(
				'sql' => 'others_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'others_count' 
				),
				'encrypted' => false,
				'columnName' => 'others_count' 
			),
			array(
				'sql' => 'household_survey_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'household_survey_count' 
				),
				'encrypted' => false,
				'columnName' => 'household_survey_count' 
			),
			array(
				'sql' => 'facility_assessment_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'facility_assessment_count' 
				),
				'encrypted' => false,
				'columnName' => 'facility_assessment_count' 
			),
			array(
				'sql' => 'oca_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'oca_count' 
				),
				'encrypted' => false,
				'columnName' => 'oca_count' 
			),
			array(
				'sql' => 'mapping_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'mapping_count' 
				),
				'encrypted' => false,
				'columnName' => 'mapping_count' 
			),
			array(
				'sql' => 'profiling_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'profiling_count' 
				),
				'encrypted' => false,
				'columnName' => 'profiling_count' 
			),
			array(
				'sql' => 'quant_others_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'quant_others_count' 
				),
				'encrypted' => false,
				'columnName' => 'quant_others_count' 
			),
			array(
				'sql' => 'kii_idi_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'kii_idi_count' 
				),
				'encrypted' => false,
				'columnName' => 'kii_idi_count' 
			),
			array(
				'sql' => 'fgd_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'fgd_count' 
				),
				'encrypted' => false,
				'columnName' => 'fgd_count' 
			),
			array(
				'sql' => 'workshops_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'workshops_count' 
				),
				'encrypted' => false,
				'columnName' => 'workshops_count' 
			),
			array(
				'sql' => 'observation_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'observation_count' 
				),
				'encrypted' => false,
				'columnName' => 'observation_count' 
			),
			array(
				'sql' => 'qual_others_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'qual_others_count' 
				),
				'encrypted' => false,
				'columnName' => 'qual_others_count' 
			),
			array(
				'sql' => 'reviews_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'reviews_count' 
				),
				'encrypted' => false,
				'columnName' => 'reviews_count' 
			),
			array(
				'sql' => 'hh_women_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'hh_women_count' 
				),
				'encrypted' => false,
				'columnName' => 'hh_women_count' 
			),
			array(
				'sql' => 'hh_men_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'hh_men_count' 
				),
				'encrypted' => false,
				'columnName' => 'hh_men_count' 
			),
			array(
				'sql' => 'hh_youth_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'hh_youth_count' 
				),
				'encrypted' => false,
				'columnName' => 'hh_youth_count' 
			),
			array(
				'sql' => 'hh_others_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'hh_others_count' 
				),
				'encrypted' => false,
				'columnName' => 'hh_others_count' 
			),
			array(
				'sql' => 'fac_hospital_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'fac_hospital_count' 
				),
				'encrypted' => false,
				'columnName' => 'fac_hospital_count' 
			),
			array(
				'sql' => 'fac_hc_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'fac_hc_count' 
				),
				'encrypted' => false,
				'columnName' => 'fac_hc_count' 
			),
			array(
				'sql' => 'fac_hp_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'fac_hp_count' 
				),
				'encrypted' => false,
				'columnName' => 'fac_hp_count' 
			),
			array(
				'sql' => 'oca_target_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'oca_target_count' 
				),
				'encrypted' => false,
				'columnName' => 'oca_target_count' 
			),
			array(
				'sql' => 'mapping_orgs_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'mapping_orgs_count' 
				),
				'encrypted' => false,
				'columnName' => 'mapping_orgs_count' 
			),
			array(
				'sql' => 'mapping_structures_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'mapping_structures_count' 
				),
				'encrypted' => false,
				'columnName' => 'mapping_structures_count' 
			),
			array(
				'sql' => 'mapping_others_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'mapping_others_count' 
				),
				'encrypted' => false,
				'columnName' => 'mapping_others_count' 
			),
			array(
				'sql' => 'profiling_target_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'profiling_target_count' 
				),
				'encrypted' => false,
				'columnName' => 'profiling_target_count' 
			),
			array(
				'sql' => 'quant_other_target_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'quant_other_target_count' 
				),
				'encrypted' => false,
				'columnName' => 'quant_other_target_count' 
			),
			array(
				'sql' => 'kii_target_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'kii_target_count' 
				),
				'encrypted' => false,
				'columnName' => 'kii_target_count' 
			),
			array(
				'sql' => 'fgd_session_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'fgd_session_count' 
				),
				'encrypted' => false,
				'columnName' => 'fgd_session_count' 
			),
			array(
				'sql' => 'fgd_participant_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'fgd_participant_count' 
				),
				'encrypted' => false,
				'columnName' => 'fgd_participant_count' 
			),
			array(
				'sql' => 'workshop_session_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'workshop_session_count' 
				),
				'encrypted' => false,
				'columnName' => 'workshop_session_count' 
			),
			array(
				'sql' => 'workshop_participant_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'workshop_participant_count' 
				),
				'encrypted' => false,
				'columnName' => 'workshop_participant_count' 
			),
			array(
				'sql' => 'observation_session_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'observation_session_count' 
				),
				'encrypted' => false,
				'columnName' => 'observation_session_count' 
			),
			array(
				'sql' => 'qual_other_target_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'qual_other_target_count' 
				),
				'encrypted' => false,
				'columnName' => 'qual_other_target_count' 
			),
			array(
				'sql' => 'technical_assistance_targets',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'technical_assistance_targets' 
				),
				'encrypted' => false,
				'columnName' => 'technical_assistance_targets' 
			),
			array(
				'sql' => 'technical_assistance_rounds',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'technical_assistance_rounds' 
				),
				'encrypted' => false,
				'columnName' => 'technical_assistance_rounds' 
			),
			array(
				'sql' => 'training_sessions',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'training_sessions' 
				),
				'encrypted' => false,
				'columnName' => 'training_sessions' 
			),
			array(
				'sql' => 'training_participants',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'training_participants' 
				),
				'encrypted' => false,
				'columnName' => 'training_participants' 
			),
			array(
				'sql' => 'datasets_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'datasets_count' 
				),
				'encrypted' => false,
				'columnName' => 'datasets_count' 
			),
			array(
				'sql' => 'datasets_with_description',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'datasets_with_description' 
				),
				'encrypted' => false,
				'columnName' => 'datasets_with_description' 
			),
			array(
				'sql' => 'languages_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'languages_count' 
				),
				'encrypted' => false,
				'columnName' => 'languages_count' 
			),
			array(
				'sql' => 'audio_records_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'audio_records_count' 
				),
				'encrypted' => false,
				'columnName' => 'audio_records_count' 
			),
			array(
				'sql' => 'summary_notes_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'summary_notes_count' 
				),
				'encrypted' => false,
				'columnName' => 'summary_notes_count' 
			),
			array(
				'sql' => 'code_reports_count',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_data_collection',
					'name' => 'code_reports_count' 
				),
				'encrypted' => false,
				'columnName' => 'code_reports_count' 
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
					'table' => 'mne_data_collection',
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
					'table' => 'mne_data_collection',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_data_collection',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_data_collection',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'collection_id',
						'project_id',
						'project_name',
						'client',
						'start_date',
						'end_date',
						'number_of_days',
						'number_of_rounds',
						'number_separate_activities',
						'data_collection_activity',
						'ownership',
						'data_access',
						'method',
						'doc_review',
						'data_collectors_count',
						'supervisors_count',
						'field_guides_count',
						'site_coordinators_count',
						'others_count',
						'household_survey_count',
						'facility_assessment_count',
						'oca_count',
						'mapping_count',
						'profiling_count',
						'quant_others_count',
						'kii_idi_count',
						'fgd_count',
						'workshops_count',
						'observation_count',
						'qual_others_count',
						'reviews_count',
						'hh_women_count',
						'hh_men_count',
						'hh_youth_count',
						'hh_others_count',
						'fac_hospital_count',
						'fac_hc_count',
						'fac_hp_count',
						'oca_target_count',
						'mapping_orgs_count',
						'mapping_structures_count',
						'mapping_others_count',
						'profiling_target_count',
						'quant_other_target_count',
						'kii_target_count',
						'fgd_session_count',
						'fgd_participant_count',
						'workshop_session_count',
						'workshop_participant_count',
						'observation_session_count',
						'qual_other_target_count',
						'technical_assistance_targets',
						'technical_assistance_rounds',
						'training_sessions',
						'training_participants',
						'datasets_count',
						'datasets_with_description',
						'languages_count',
						'audio_records_count',
						'summary_notes_count',
						'code_reports_count',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_data_collection' 
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
			),
			array(
				'fieldIndex' => 43,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 44,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 45,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 46,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 47,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 48,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 49,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 50,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 51,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 52,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 53,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 54,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 55,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 56,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 57,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 58,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 59,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 60,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 61,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 62,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'collection_id,
	project_id,
	project_name,
	client,
	start_date,
	end_date,
	number_of_days,
	number_of_rounds,
	number_separate_activities,
	data_collection_activity,
	ownership,
	data_access,
	method,
	doc_review,
	data_collectors_count,
	supervisors_count,
	field_guides_count,
	site_coordinators_count,
	others_count,
	household_survey_count,
	facility_assessment_count,
	oca_count,
	mapping_count,
	profiling_count,
	quant_others_count,
	kii_idi_count,
	fgd_count,
	workshops_count,
	observation_count,
	qual_others_count,
	reviews_count,
	hh_women_count,
	hh_men_count,
	hh_youth_count,
	hh_others_count,
	fac_hospital_count,
	fac_hc_count,
	fac_hp_count,
	oca_target_count,
	mapping_orgs_count,
	mapping_structures_count,
	mapping_others_count,
	profiling_target_count,
	quant_other_target_count,
	kii_target_count,
	fgd_session_count,
	fgd_participant_count,
	workshop_session_count,
	workshop_participant_count,
	observation_session_count,
	qual_other_target_count,
	technical_assistance_targets,
	technical_assistance_rounds,
	training_sessions,
	training_participants,
	datasets_count,
	datasets_with_description,
	languages_count,
	audio_records_count,
	summary_notes_count,
	code_reports_count,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_data_collection',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_data_collection',
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
			'list',
			'list1' 
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
		'list1' => 'list',
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
			'collection_id',
			'project_id',
			'project_name',
			'client',
			'start_date',
			'end_date',
			'number_of_days',
			'number_of_rounds',
			'number_separate_activities',
			'data_collection_activity',
			'data_collectors_count',
			'supervisors_count',
			'field_guides_count',
			'site_coordinators_count',
			'others_count',
			'household_survey_count',
			'facility_assessment_count',
			'oca_count',
			'mapping_count',
			'profiling_count',
			'quant_others_count',
			'kii_idi_count',
			'fgd_count',
			'workshops_count',
			'observation_count',
			'qual_others_count',
			'reviews_count',
			'hh_women_count',
			'hh_men_count',
			'hh_youth_count',
			'hh_others_count',
			'fac_hospital_count',
			'fac_hc_count',
			'fac_hp_count',
			'oca_target_count',
			'mapping_orgs_count',
			'mapping_structures_count',
			'mapping_others_count',
			'profiling_target_count',
			'quant_other_target_count',
			'kii_target_count',
			'fgd_session_count',
			'fgd_participant_count',
			'workshop_session_count',
			'workshop_participant_count',
			'observation_session_count',
			'qual_other_target_count',
			'technical_assistance_targets',
			'technical_assistance_rounds',
			'training_sessions',
			'training_participants',
			'datasets_count',
			'datasets_with_description',
			'languages_count',
			'audio_records_count',
			'summary_notes_count',
			'code_reports_count',
			'created_at',
			'updated_at',
			'ownership',
			'data_access',
			'method',
			'doc_review' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'collection_id',
			'project_id',
			'project_name',
			'client',
			'start_date',
			'end_date',
			'number_of_days',
			'number_of_rounds',
			'number_separate_activities',
			'data_collection_activity',
			'data_collectors_count',
			'supervisors_count',
			'field_guides_count',
			'site_coordinators_count',
			'others_count',
			'household_survey_count',
			'facility_assessment_count',
			'oca_count',
			'mapping_count',
			'profiling_count',
			'quant_others_count',
			'kii_idi_count',
			'fgd_count',
			'workshops_count',
			'observation_count',
			'qual_others_count',
			'reviews_count',
			'hh_women_count',
			'hh_men_count',
			'hh_youth_count',
			'hh_others_count',
			'fac_hospital_count',
			'fac_hc_count',
			'fac_hp_count',
			'oca_target_count',
			'mapping_orgs_count',
			'mapping_structures_count',
			'mapping_others_count',
			'profiling_target_count',
			'quant_other_target_count',
			'kii_target_count',
			'fgd_session_count',
			'fgd_participant_count',
			'workshop_session_count',
			'workshop_participant_count',
			'observation_session_count',
			'qual_other_target_count',
			'technical_assistance_targets',
			'technical_assistance_rounds',
			'training_sessions',
			'training_participants',
			'datasets_count',
			'datasets_with_description',
			'languages_count',
			'audio_records_count',
			'summary_notes_count',
			'code_reports_count',
			'created_at',
			'updated_at',
			'ownership',
			'data_access',
			'method',
			'doc_review' 
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
	$runnerTableLabels['mne_data_collection'] = array(
	'tableCaption' => 'Data Collection',
	'fieldLabels' => array(
		'collection_id' => 'Collection Id',
		'project_id' => 'Project Id',
		'project_name' => 'Project Name',
		'client' => 'Client',
		'start_date' => 'Start Date',
		'end_date' => 'End Date',
		'number_of_days' => 'Number Of Days',
		'number_of_rounds' => 'Number Of Rounds',
		'number_separate_activities' => 'Number Separate Activities',
		'data_collection_activity' => 'Data Collection Activity',
		'data_collectors_count' => 'Data Collectors Count',
		'supervisors_count' => 'Supervisors Count',
		'field_guides_count' => 'Field Guides Count',
		'site_coordinators_count' => 'Site Coordinators Count',
		'others_count' => 'Others Count',
		'household_survey_count' => 'Household Survey Count',
		'facility_assessment_count' => 'Facility Assessment Count',
		'oca_count' => 'OCA Count',
		'mapping_count' => 'Mapping Count',
		'profiling_count' => 'Profiling Count',
		'quant_others_count' => 'Quant Others Count',
		'kii_idi_count' => 'KII Idi Count',
		'fgd_count' => 'FGD Count',
		'workshops_count' => 'Workshops Count',
		'observation_count' => 'Observation Count',
		'qual_others_count' => 'Qual Others Count',
		'reviews_count' => 'Reviews Count',
		'hh_women_count' => 'HH Women Count',
		'hh_men_count' => 'HH Men Count',
		'hh_youth_count' => 'HH Youth Count',
		'hh_others_count' => 'HH Others Count',
		'fac_hospital_count' => 'Fac Hospital Count',
		'fac_hc_count' => 'Fac HC Count',
		'fac_hp_count' => 'Fac HP Count',
		'oca_target_count' => 'OCA Target Count',
		'mapping_orgs_count' => 'Mapping Orgs Count',
		'mapping_structures_count' => 'Mapping Structures Count',
		'mapping_others_count' => 'Mapping Others Count',
		'profiling_target_count' => 'Profiling Target Count',
		'quant_other_target_count' => 'Quant Other Target Count',
		'kii_target_count' => 'KII Target Count',
		'fgd_session_count' => 'FGD Session Count',
		'fgd_participant_count' => 'FGD Participant Count',
		'workshop_session_count' => 'Workshop Session Count',
		'workshop_participant_count' => 'Workshop Participant Count',
		'observation_session_count' => 'Observation Session Count',
		'qual_other_target_count' => 'Qual Other Target Count',
		'technical_assistance_targets' => 'Technical Assistance Targets',
		'technical_assistance_rounds' => 'Technical Assistance Rounds',
		'training_sessions' => 'Training Sessions',
		'training_participants' => 'Training Participants',
		'datasets_count' => 'Datasets Count',
		'datasets_with_description' => 'Datasets With Description',
		'languages_count' => 'Languages Count',
		'audio_records_count' => 'Audio Records Count',
		'summary_notes_count' => 'Summary Notes Count',
		'code_reports_count' => 'Code Reports Count',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At',
		'ownership' => 'Ownership',
		'data_access' => 'Data Access',
		'method' => 'Method',
		'doc_review' => 'Doc Review' 
	),
	'fieldTooltips' => array(
		'collection_id' => '',
		'project_id' => '',
		'project_name' => '',
		'client' => '',
		'start_date' => '',
		'end_date' => '',
		'number_of_days' => '',
		'number_of_rounds' => '',
		'number_separate_activities' => '',
		'data_collection_activity' => '',
		'data_collectors_count' => '',
		'supervisors_count' => '',
		'field_guides_count' => '',
		'site_coordinators_count' => '',
		'others_count' => '',
		'household_survey_count' => '',
		'facility_assessment_count' => '',
		'oca_count' => '',
		'mapping_count' => '',
		'profiling_count' => '',
		'quant_others_count' => '',
		'kii_idi_count' => '',
		'fgd_count' => '',
		'workshops_count' => '',
		'observation_count' => '',
		'qual_others_count' => '',
		'reviews_count' => '',
		'hh_women_count' => '',
		'hh_men_count' => '',
		'hh_youth_count' => '',
		'hh_others_count' => '',
		'fac_hospital_count' => '',
		'fac_hc_count' => '',
		'fac_hp_count' => '',
		'oca_target_count' => '',
		'mapping_orgs_count' => '',
		'mapping_structures_count' => '',
		'mapping_others_count' => '',
		'profiling_target_count' => '',
		'quant_other_target_count' => '',
		'kii_target_count' => '',
		'fgd_session_count' => '',
		'fgd_participant_count' => '',
		'workshop_session_count' => '',
		'workshop_participant_count' => '',
		'observation_session_count' => '',
		'qual_other_target_count' => '',
		'technical_assistance_targets' => '',
		'technical_assistance_rounds' => '',
		'training_sessions' => '',
		'training_participants' => '',
		'datasets_count' => '',
		'datasets_with_description' => '',
		'languages_count' => '',
		'audio_records_count' => '',
		'summary_notes_count' => '',
		'code_reports_count' => '',
		'created_at' => '',
		'updated_at' => '',
		'ownership' => '',
		'data_access' => '',
		'method' => '',
		'doc_review' => '' 
	),
	'fieldPlaceholders' => array(
		'collection_id' => '',
		'project_id' => '',
		'project_name' => '',
		'client' => '',
		'start_date' => '',
		'end_date' => '',
		'number_of_days' => '',
		'number_of_rounds' => '',
		'number_separate_activities' => '',
		'data_collection_activity' => '',
		'data_collectors_count' => '',
		'supervisors_count' => '',
		'field_guides_count' => '',
		'site_coordinators_count' => '',
		'others_count' => '',
		'household_survey_count' => '',
		'facility_assessment_count' => '',
		'oca_count' => '',
		'mapping_count' => '',
		'profiling_count' => '',
		'quant_others_count' => '',
		'kii_idi_count' => '',
		'fgd_count' => '',
		'workshops_count' => '',
		'observation_count' => '',
		'qual_others_count' => '',
		'reviews_count' => '',
		'hh_women_count' => '',
		'hh_men_count' => '',
		'hh_youth_count' => '',
		'hh_others_count' => '',
		'fac_hospital_count' => '',
		'fac_hc_count' => '',
		'fac_hp_count' => '',
		'oca_target_count' => '',
		'mapping_orgs_count' => '',
		'mapping_structures_count' => '',
		'mapping_others_count' => '',
		'profiling_target_count' => '',
		'quant_other_target_count' => '',
		'kii_target_count' => '',
		'fgd_session_count' => '',
		'fgd_participant_count' => '',
		'workshop_session_count' => '',
		'workshop_participant_count' => '',
		'observation_session_count' => '',
		'qual_other_target_count' => '',
		'technical_assistance_targets' => '',
		'technical_assistance_rounds' => '',
		'training_sessions' => '',
		'training_participants' => '',
		'datasets_count' => '',
		'datasets_with_description' => '',
		'languages_count' => '',
		'audio_records_count' => '',
		'summary_notes_count' => '',
		'code_reports_count' => '',
		'created_at' => '',
		'updated_at' => '',
		'ownership' => '',
		'data_access' => '',
		'method' => '',
		'doc_review' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>