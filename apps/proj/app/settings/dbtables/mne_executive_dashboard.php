<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['mne_executive_dashboard'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		 
	),
	'fields' => array( 
		array(
			'name' => 'dashboard_id',
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
			'name' => 'report_date',
			'type' => 7,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'date',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'key_metric',
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
			'name' => 'actual_value',
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
			'name' => 'variance',
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
			'name' => 'status_indicator',
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
			'name' => 'trend',
			'type' => 129,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'enum(\'▲\',\'▼\',\'→\')',
			'enumValues' => array( 
				'▲',
				'▼',
				'→' 
			),
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '→',
			'defaultValue' => '' 
		),
		array(
			'name' => 'last_period_value',
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
		) 
	),
	'primaryKeys' => array( 
		'dashboard_id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'mne_executive_dashboard' 
);
?>