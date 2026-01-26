<?php
global $runnerTableSettings;
$runnerTableSettings['mne_partnerships'] = array(
	'name' => 'mne_partnerships',
	'shortName' => 'mne_partnerships',
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
	'afterEditDetails' => 'mne_partnerships',
	'afterAddDetail' => 'mne_partnerships',
	'detailsBadgeColor' => '8fbc8b',
	'sql' => 'SELECT
	partnership_id,
	partner_code,
	partner_name,
	date_identified,
	partner_type_id,
	has_mou_agreement,
	agreement_date,
	agreement_expiry,
	strategic_engagement,
	last_meeting_date,
	next_meeting_date,
	opportunities_shared,
	joint_proposals,
	converted_to_wins,
	status_id,
	contact_person,
	contact_email,
	contact_phone,
	website,
	country,
	notes,
	created_by,
	created_at,
	updated_at,
	is_active
FROM
	mne_partnerships',
	'keyFields' => array( 
		'partnership_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'partnership_id' => array(
			'name' => 'partnership_id',
			'goodName' => 'partnership_id',
			'strField' => 'partnership_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'partnership_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'partner_code' => array(
			'name' => 'partner_code',
			'goodName' => 'partner_code',
			'strField' => 'partner_code',
			'index' => 2,
			'sqlExpression' => 'partner_code',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'partner_name' => array(
			'name' => 'partner_name',
			'goodName' => 'partner_name',
			'strField' => 'partner_name',
			'index' => 3,
			'sqlExpression' => 'partner_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'date_identified' => array(
			'name' => 'date_identified',
			'goodName' => 'date_identified',
			'strField' => 'date_identified',
			'index' => 4,
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
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'partner_type_id' => array(
			'name' => 'partner_type_id',
			'goodName' => 'partner_type_id',
			'strField' => 'partner_type_id',
			'index' => 5,
			'type' => 3,
			'sqlExpression' => 'partner_type_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_partner_types',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'type_id',
					'lookupDisplayField' => 'type_name' 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'has_mou_agreement' => array(
			'name' => 'has_mou_agreement',
			'goodName' => 'has_mou_agreement',
			'strField' => 'has_mou_agreement',
			'index' => 6,
			'type' => 129,
			'sqlExpression' => 'has_mou_agreement',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Yes',
						'No' 
					) 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'agreement_date' => array(
			'name' => 'agreement_date',
			'goodName' => 'agreement_date',
			'strField' => 'agreement_date',
			'index' => 7,
			'type' => 7,
			'sqlExpression' => 'agreement_date',
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
			'tableName' => 'mne_partnerships' 
		),
		'agreement_expiry' => array(
			'name' => 'agreement_expiry',
			'goodName' => 'agreement_expiry',
			'strField' => 'agreement_expiry',
			'index' => 8,
			'type' => 7,
			'sqlExpression' => 'agreement_expiry',
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
			'tableName' => 'mne_partnerships' 
		),
		'strategic_engagement' => array(
			'name' => 'strategic_engagement',
			'goodName' => 'strategic_engagement',
			'strField' => 'strategic_engagement',
			'index' => 9,
			'type' => 129,
			'sqlExpression' => 'strategic_engagement',
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
						'Med',
						'Low' 
					) 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'last_meeting_date' => array(
			'name' => 'last_meeting_date',
			'goodName' => 'last_meeting_date',
			'strField' => 'last_meeting_date',
			'index' => 10,
			'type' => 7,
			'sqlExpression' => 'last_meeting_date',
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
			'tableName' => 'mne_partnerships' 
		),
		'next_meeting_date' => array(
			'name' => 'next_meeting_date',
			'goodName' => 'next_meeting_date',
			'strField' => 'next_meeting_date',
			'index' => 11,
			'type' => 7,
			'sqlExpression' => 'next_meeting_date',
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
			'tableName' => 'mne_partnerships' 
		),
		'opportunities_shared' => array(
			'name' => 'opportunities_shared',
			'goodName' => 'opportunities_shared',
			'strField' => 'opportunities_shared',
			'index' => 12,
			'type' => 3,
			'sqlExpression' => 'opportunities_shared',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'joint_proposals' => array(
			'name' => 'joint_proposals',
			'goodName' => 'joint_proposals',
			'strField' => 'joint_proposals',
			'index' => 13,
			'type' => 3,
			'sqlExpression' => 'joint_proposals',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'converted_to_wins' => array(
			'name' => 'converted_to_wins',
			'goodName' => 'converted_to_wins',
			'strField' => 'converted_to_wins',
			'index' => 14,
			'type' => 3,
			'sqlExpression' => 'converted_to_wins',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'status_id' => array(
			'name' => 'status_id',
			'goodName' => 'status_id',
			'strField' => 'status_id',
			'index' => 15,
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
			'tableName' => 'mne_partnerships' 
		),
		'contact_person' => array(
			'name' => 'contact_person',
			'goodName' => 'contact_person',
			'strField' => 'contact_person',
			'index' => 16,
			'sqlExpression' => 'contact_person',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'contact_email' => array(
			'name' => 'contact_email',
			'goodName' => 'contact_email',
			'strField' => 'contact_email',
			'index' => 17,
			'sqlExpression' => 'contact_email',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'contact_phone' => array(
			'name' => 'contact_phone',
			'goodName' => 'contact_phone',
			'strField' => 'contact_phone',
			'index' => 18,
			'sqlExpression' => 'contact_phone',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'website' => array(
			'name' => 'website',
			'goodName' => 'website',
			'strField' => 'website',
			'index' => 19,
			'sqlExpression' => 'website',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'country' => array(
			'name' => 'country',
			'goodName' => 'country',
			'strField' => 'country',
			'index' => 20,
			'sqlExpression' => 'country',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'notes' => array(
			'name' => 'notes',
			'goodName' => 'notes',
			'strField' => 'notes',
			'index' => 21,
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
			'tableName' => 'mne_partnerships' 
		),
		'created_by' => array(
			'name' => 'created_by',
			'goodName' => 'created_by',
			'strField' => 'created_by',
			'index' => 22,
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
					'lookupDisplayField' => 'username' 
				) 
			),
			'tableName' => 'mne_partnerships' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 23,
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
			'tableName' => 'mne_partnerships' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 24,
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
			'tableName' => 'mne_partnerships' 
		),
		'is_active' => array(
			'name' => 'is_active',
			'goodName' => 'is_active',
			'strField' => 'is_active',
			'index' => 25,
			'type' => 16,
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
			'tableName' => 'mne_partnerships' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'mne_partnership_options',
			'detailsKeys' => array( 
				'partner_type_id' 
			),
			'masterKeys' => array( 
				'partnership_id' 
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
				'created_by' 
			),
			'masterKeys' => array( 
				'user_id' 
			) 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	partnership_id,
	partner_code,
	partner_name,
	date_identified,
	partner_type_id,
	has_mou_agreement,
	agreement_date,
	agreement_expiry,
	strategic_engagement,
	last_meeting_date,
	next_meeting_date,
	opportunities_shared,
	joint_proposals,
	converted_to_wins,
	status_id,
	contact_person,
	contact_email,
	contact_phone,
	website,
	country,
	notes,
	created_by,
	created_at,
	updated_at,
	is_active
FROM
	mne_partnerships',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'partnership_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'partnership_id' 
				),
				'encrypted' => false,
				'columnName' => 'partnership_id' 
			),
			array(
				'sql' => 'partner_code',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'partner_code' 
				),
				'encrypted' => false,
				'columnName' => 'partner_code' 
			),
			array(
				'sql' => 'partner_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'partner_name' 
				),
				'encrypted' => false,
				'columnName' => 'partner_name' 
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
					'table' => 'mne_partnerships',
					'name' => 'date_identified' 
				),
				'encrypted' => false,
				'columnName' => 'date_identified' 
			),
			array(
				'sql' => 'partner_type_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'partner_type_id' 
				),
				'encrypted' => false,
				'columnName' => 'partner_type_id' 
			),
			array(
				'sql' => 'has_mou_agreement',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'has_mou_agreement' 
				),
				'encrypted' => false,
				'columnName' => 'has_mou_agreement' 
			),
			array(
				'sql' => 'agreement_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'agreement_date' 
				),
				'encrypted' => false,
				'columnName' => 'agreement_date' 
			),
			array(
				'sql' => 'agreement_expiry',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'agreement_expiry' 
				),
				'encrypted' => false,
				'columnName' => 'agreement_expiry' 
			),
			array(
				'sql' => 'strategic_engagement',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'strategic_engagement' 
				),
				'encrypted' => false,
				'columnName' => 'strategic_engagement' 
			),
			array(
				'sql' => 'last_meeting_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'last_meeting_date' 
				),
				'encrypted' => false,
				'columnName' => 'last_meeting_date' 
			),
			array(
				'sql' => 'next_meeting_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'next_meeting_date' 
				),
				'encrypted' => false,
				'columnName' => 'next_meeting_date' 
			),
			array(
				'sql' => 'opportunities_shared',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'opportunities_shared' 
				),
				'encrypted' => false,
				'columnName' => 'opportunities_shared' 
			),
			array(
				'sql' => 'joint_proposals',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'joint_proposals' 
				),
				'encrypted' => false,
				'columnName' => 'joint_proposals' 
			),
			array(
				'sql' => 'converted_to_wins',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'converted_to_wins' 
				),
				'encrypted' => false,
				'columnName' => 'converted_to_wins' 
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
					'table' => 'mne_partnerships',
					'name' => 'status_id' 
				),
				'encrypted' => false,
				'columnName' => 'status_id' 
			),
			array(
				'sql' => 'contact_person',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'contact_person' 
				),
				'encrypted' => false,
				'columnName' => 'contact_person' 
			),
			array(
				'sql' => 'contact_email',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'contact_email' 
				),
				'encrypted' => false,
				'columnName' => 'contact_email' 
			),
			array(
				'sql' => 'contact_phone',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'contact_phone' 
				),
				'encrypted' => false,
				'columnName' => 'contact_phone' 
			),
			array(
				'sql' => 'website',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'website' 
				),
				'encrypted' => false,
				'columnName' => 'website' 
			),
			array(
				'sql' => 'country',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_partnerships',
					'name' => 'country' 
				),
				'encrypted' => false,
				'columnName' => 'country' 
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
					'table' => 'mne_partnerships',
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
					'table' => 'mne_partnerships',
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
					'table' => 'mne_partnerships',
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
					'table' => 'mne_partnerships',
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
					'table' => 'mne_partnerships',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_partnerships',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_partnerships',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'partnership_id',
						'partner_code',
						'partner_name',
						'date_identified',
						'partner_type_id',
						'has_mou_agreement',
						'agreement_date',
						'agreement_expiry',
						'strategic_engagement',
						'last_meeting_date',
						'next_meeting_date',
						'opportunities_shared',
						'joint_proposals',
						'converted_to_wins',
						'status_id',
						'contact_person',
						'contact_email',
						'contact_phone',
						'website',
						'country',
						'notes',
						'created_by',
						'created_at',
						'updated_at',
						'is_active' 
					),
					'name' => 'mne_partnerships' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'partnership_id,
	partner_code,
	partner_name,
	date_identified,
	partner_type_id,
	has_mou_agreement,
	agreement_date,
	agreement_expiry,
	strategic_engagement,
	last_meeting_date,
	next_meeting_date,
	opportunities_shared,
	joint_proposals,
	converted_to_wins,
	status_id,
	contact_person,
	contact_email,
	contact_phone,
	website,
	country,
	notes,
	created_by,
	created_at,
	updated_at,
	is_active',
		'fromListSql' => 'FROM
	mne_partnerships',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_partnerships',
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
			'partnership_id',
			'partner_code',
			'partner_name',
			'date_identified',
			'partner_type_id',
			'has_mou_agreement',
			'agreement_date',
			'agreement_expiry',
			'strategic_engagement',
			'last_meeting_date',
			'next_meeting_date',
			'opportunities_shared',
			'joint_proposals',
			'converted_to_wins',
			'status_id',
			'contact_person',
			'contact_email',
			'contact_phone',
			'website',
			'country',
			'notes',
			'created_by',
			'created_at',
			'updated_at',
			'is_active' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'partnership_id',
			'partner_code',
			'partner_name',
			'date_identified',
			'partner_type_id',
			'has_mou_agreement',
			'agreement_date',
			'agreement_expiry',
			'strategic_engagement',
			'last_meeting_date',
			'next_meeting_date',
			'opportunities_shared',
			'joint_proposals',
			'converted_to_wins',
			'status_id',
			'contact_person',
			'contact_email',
			'contact_phone',
			'website',
			'country',
			'notes',
			'created_by',
			'created_at',
			'updated_at',
			'is_active' 
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
	$runnerTableLabels['mne_partnerships'] = array(
	'tableCaption' => 'Mne Partnerships',
	'fieldLabels' => array(
		'partnership_id' => 'Partnership Id',
		'partner_code' => 'Partner Code',
		'partner_name' => 'Partner Name',
		'date_identified' => 'Date Identified',
		'partner_type_id' => 'Partner Type Id',
		'has_mou_agreement' => 'Has Mou Agreement',
		'agreement_date' => 'Agreement Date',
		'agreement_expiry' => 'Agreement Expiry',
		'strategic_engagement' => 'Strategic Engagement',
		'last_meeting_date' => 'Last Meeting Date',
		'next_meeting_date' => 'Next Meeting Date',
		'opportunities_shared' => 'Opportunities Shared',
		'joint_proposals' => 'Joint Proposals',
		'converted_to_wins' => 'Converted To Wins',
		'status_id' => 'Status Id',
		'contact_person' => 'Contact Person',
		'contact_email' => 'Contact Email',
		'contact_phone' => 'Contact Phone',
		'website' => 'Website',
		'country' => 'Country',
		'notes' => 'Notes',
		'created_by' => 'Created By',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At',
		'is_active' => 'Is Active' 
	),
	'fieldTooltips' => array(
		'partnership_id' => '',
		'partner_code' => '',
		'partner_name' => '',
		'date_identified' => '',
		'partner_type_id' => '',
		'has_mou_agreement' => '',
		'agreement_date' => '',
		'agreement_expiry' => '',
		'strategic_engagement' => '',
		'last_meeting_date' => '',
		'next_meeting_date' => '',
		'opportunities_shared' => '',
		'joint_proposals' => '',
		'converted_to_wins' => '',
		'status_id' => '',
		'contact_person' => '',
		'contact_email' => '',
		'contact_phone' => '',
		'website' => '',
		'country' => '',
		'notes' => '',
		'created_by' => '',
		'created_at' => '',
		'updated_at' => '',
		'is_active' => '' 
	),
	'fieldPlaceholders' => array(
		'partnership_id' => '',
		'partner_code' => '',
		'partner_name' => '',
		'date_identified' => '',
		'partner_type_id' => '',
		'has_mou_agreement' => '',
		'agreement_date' => '',
		'agreement_expiry' => '',
		'strategic_engagement' => '',
		'last_meeting_date' => '',
		'next_meeting_date' => '',
		'opportunities_shared' => '',
		'joint_proposals' => '',
		'converted_to_wins' => '',
		'status_id' => '',
		'contact_person' => '',
		'contact_email' => '',
		'contact_phone' => '',
		'website' => '',
		'country' => '',
		'notes' => '',
		'created_by' => '',
		'created_at' => '',
		'updated_at' => '',
		'is_active' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>