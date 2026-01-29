<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['mne_projects'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		array(
			'name' => 'fk_project_contract_type',
			'refTable' => 'mne_business_options',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'contract_type_id',
					'ref_column' => 'option_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_coordinator',
			'refTable' => 'mne_project_leads',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'project_coordinator_id',
					'ref_column' => 'lead_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_currency',
			'refTable' => 'mne_currency_options',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'currency_id',
					'ref_column' => 'currency_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_major_type',
			'refTable' => 'mne_project_type_options',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'major_project_type_id',
					'ref_column' => 'type_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_manager',
			'refTable' => 'mne_project_leads',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'project_manager_id',
					'ref_column' => 'lead_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_mel_lead',
			'refTable' => 'mne_project_leads',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'mel_lead_id',
					'ref_column' => 'lead_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_sector',
			'refTable' => 'mne_sector_options',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'sector_id',
					'ref_column' => 'sector_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_specific_primary',
			'refTable' => 'mne_project_type_options',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'specific_type_primary_id',
					'ref_column' => 'type_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_specific_secondary',
			'refTable' => 'mne_project_type_options',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'specific_type_secondary_id',
					'ref_column' => 'type_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_status',
			'refTable' => 'mne_status_options',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'current_status_id',
					'ref_column' => 'status_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_tech_lead',
			'refTable' => 'mne_project_leads',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'technical_lead_id',
					'ref_column' => 'lead_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_tech_primary',
			'refTable' => 'mne_sector_options',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'technical_area_primary_id',
					'ref_column' => 'sector_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_project_tech_secondary',
			'refTable' => 'mne_sector_options',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'technical_area_secondary_id',
					'ref_column' => 'sector_id' 
				) 
			) 
		) 
	),
	'fields' => array( 
		array(
			'name' => 'project_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => false,
			'autoinc' => true,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'project_code',
			'type' => 200,
			'size' => 50,
			'scale' => 0,
			'typeName' => 'varchar(50)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'agreement_reference_no',
			'type' => 200,
			'size' => 100,
			'scale' => 0,
			'typeName' => 'varchar(100)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'opportunity_id',
			'type' => 200,
			'size' => 255,
			'scale' => 0,
			'typeName' => 'varchar(255)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'project_name',
			'type' => 200,
			'size' => 255,
			'scale' => 0,
			'typeName' => 'varchar(255)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'project_shortname',
			'type' => 200,
			'size' => 255,
			'scale' => 0,
			'typeName' => 'varchar(255)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'client_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'client_name',
			'type' => 200,
			'size' => 255,
			'scale' => 0,
			'typeName' => 'varchar(255)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'start_date',
			'type' => 7,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'date',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'end_date_original',
			'type' => 7,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'date',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'date_extended',
			'type' => 7,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'date',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'reason_for_extension',
			'type' => 201,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'text',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'total_value',
			'type' => 14,
			'size' => 15,
			'scale' => 2,
			'typeName' => 'decimal(15,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'currency_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'profit_margins',
			'type' => 200,
			'size' => 255,
			'scale' => 0,
			'typeName' => 'varchar(255)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'contract_type_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'grantee_contracted_unit',
			'type' => 200,
			'size' => 100,
			'scale' => 0,
			'typeName' => 'varchar(100)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'major_project_type_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'specific_type_primary_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'specific_type_secondary_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'sector_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'technical_area_primary_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'technical_area_secondary_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'technical_area_others',
			'type' => 201,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'text',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'current_status_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'project_description',
			'type' => 201,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'text',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'project_manager_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'technical_lead_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'mel_lead_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'project_coordinator_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'project_members',
			'type' => 200,
			'size' => 255,
			'scale' => 0,
			'typeName' => 'varchar(255)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'created_by',
			'type' => 200,
			'size' => 255,
			'scale' => 0,
			'typeName' => 'varchar(255)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'updated_by',
			'type' => 200,
			'size' => 255,
			'scale' => 0,
			'typeName' => 'varchar(255)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'created_at',
			'type' => 135,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'timestamp',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => 'current_timestamp()',
			'defaultValue' => 'CURRENT_TIMESTAMP' 
		),
		array(
			'name' => 'updated_at',
			'type' => 135,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'timestamp',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => 'current_timestamp()',
			'defaultValue' => 'CURRENT_TIMESTAMP' 
		),
		array(
			'name' => 'is_active',
			'type' => 16,
			'size' => 1,
			'scale' => 0,
			'typeName' => 'tinyint(1)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '1',
			'defaultValue' => '1' 
		) 
	),
	'primaryKeys' => array( 
		'project_id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'mne_projects' 
);
?>