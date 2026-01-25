<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['mne_extended_projects'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		array(
			'name' => 'fk_extended_project',
			'refTable' => 'mne_projects',
			'refSchema' => '',
			'del_rule' => 1,
			'columns' => array( 
				array(
					'column' => 'project_id',
					'ref_column' => 'project_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_extended_sector',
			'refTable' => 'mne_sector_options',
			'refSchema' => '',
			'columns' => array( 
				array(
					'column' => 'sector_id',
					'ref_column' => 'sector_id' 
				) 
			) 
		) 
	),
	'fields' => array( 
		array(
			'name' => 'extended_id',
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
			'name' => 'project_id',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'client',
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
			'name' => 'budget_spent',
			'type' => 14,
			'size' => 15,
			'scale' => 2,
			'typeName' => 'decimal(15,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0.00',
			'defaultValue' => '0.00' 
		),
		array(
			'name' => 'remaining_budget',
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
			'name' => 'burn_rate_percentage',
			'type' => 14,
			'size' => 5,
			'scale' => 2,
			'typeName' => 'decimal(5,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'profit_margin_percentage',
			'type' => 14,
			'size' => 5,
			'scale' => 2,
			'typeName' => 'decimal(5,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'vat_collected',
			'type' => 14,
			'size' => 15,
			'scale' => 2,
			'typeName' => 'decimal(15,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0.00',
			'defaultValue' => '0.00' 
		),
		array(
			'name' => 'client_satisfaction_rating',
			'type' => 14,
			'size' => 3,
			'scale' => 2,
			'typeName' => 'decimal(3,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'next_milestone_date',
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
			'name' => 'percent_complete',
			'type' => 14,
			'size' => 5,
			'scale' => 2,
			'typeName' => 'decimal(5,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0.00',
			'defaultValue' => '0.00' 
		),
		array(
			'name' => 'on_time_status',
			'type' => 129,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'enum(\'Yes\',\'No\')',
			'enumValues' => array( 
				'Yes',
				'No' 
			),
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'on_budget_status',
			'type' => 129,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'enum(\'Yes\',\'No\')',
			'enumValues' => array( 
				'Yes',
				'No' 
			),
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'deliverables_met',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0',
			'defaultValue' => '0' 
		),
		array(
			'name' => 'total_deliverables',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0',
			'defaultValue' => '0' 
		),
		array(
			'name' => 'publications_count',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0',
			'defaultValue' => '0' 
		),
		array(
			'name' => 'datasets_count',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0',
			'defaultValue' => '0' 
		),
		array(
			'name' => 'certificates_received',
			'type' => 129,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'enum(\'Yes\',\'No\')',
			'enumValues' => array( 
				'Yes',
				'No' 
			),
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => 'No',
			'defaultValue' => '' 
		),
		array(
			'name' => 'q1_hours',
			'type' => 14,
			'size' => 10,
			'scale' => 2,
			'typeName' => 'decimal(10,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0.00',
			'defaultValue' => '0.00' 
		),
		array(
			'name' => 'q2_hours',
			'type' => 14,
			'size' => 10,
			'scale' => 2,
			'typeName' => 'decimal(10,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0.00',
			'defaultValue' => '0.00' 
		),
		array(
			'name' => 'q3_hours',
			'type' => 14,
			'size' => 10,
			'scale' => 2,
			'typeName' => 'decimal(10,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0.00',
			'defaultValue' => '0.00' 
		),
		array(
			'name' => 'q4_hours',
			'type' => 14,
			'size' => 10,
			'scale' => 2,
			'typeName' => 'decimal(10,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0.00',
			'defaultValue' => '0.00' 
		),
		array(
			'name' => 'total_hours',
			'type' => 14,
			'size' => 10,
			'scale' => 2,
			'typeName' => 'decimal(10,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0.00',
			'defaultValue' => '0.00' 
		),
		array(
			'name' => 'percent_allocation',
			'type' => 14,
			'size' => 5,
			'scale' => 2,
			'typeName' => 'decimal(5,2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0.00',
			'defaultValue' => '0.00' 
		),
		array(
			'name' => 'last_updated',
			'type' => 135,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'timestamp',
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
		) 
	),
	'primaryKeys' => array( 
		'extended_id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'mne_extended_projects' 
);
?>