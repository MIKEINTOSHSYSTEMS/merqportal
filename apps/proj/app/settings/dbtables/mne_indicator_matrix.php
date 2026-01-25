<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['mne_indicator_matrix'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		 
	),
	'fields' => array( 
		array(
			'name' => 'indicator_id',
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
			'name' => 'thematic_area',
			'type' => 200,
			'size' => 100,
			'scale' => 0,
			'typeName' => 'varchar(100)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'importance',
			'type' => 129,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'enum(\'Required\',\'Optional\')',
			'enumValues' => array( 
				'Required',
				'Optional' 
			),
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'indicator_name',
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
			'name' => 'indicator_description',
			'type' => 201,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'text',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'indicator_type',
			'type' => 129,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'enum(\'Output\',\'Outcome\',\'Process\')',
			'enumValues' => array( 
				'Output',
				'Outcome',
				'Process' 
			),
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'disaggregated_by',
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
			'name' => 'data_type',
			'type' => 129,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'enum(\'Percentage\',\'Number\',\'Currency\',\'Text\')',
			'enumValues' => array( 
				'Percentage',
				'Number',
				'Currency',
				'Text' 
			),
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'data_source',
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
			'name' => 'reporting_frequency',
			'type' => 129,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'enum(\'Monthly\',\'Quarterly\',\'Semi-annually\',\'Annual\',\'Ad hoc\')',
			'enumValues' => array( 
				'Monthly',
				'Quarterly',
				'Semi-annually',
				'Annual',
				'Ad hoc' 
			),
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'responsible_body',
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
			'name' => 'known_data_limitation',
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
			'name' => 'current_status',
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
			'name' => 'target_value',
			'type' => 14,
			'size' => 15,
			'scale' => 4,
			'typeName' => 'decimal(15,4)',
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
		'indicator_id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'mne_indicator_matrix' 
);
?>