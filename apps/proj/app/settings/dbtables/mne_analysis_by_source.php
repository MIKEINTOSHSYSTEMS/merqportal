<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['mne_analysis_by_source'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		 
	),
	'fields' => array( 
		array(
			'name' => 'analysis_id',
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
			'name' => 'source_type',
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
			'name' => 'count',
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
			'name' => 'won_count',
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
			'name' => 'win_rate',
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
			'name' => 'total_value',
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
			'name' => 'report_period',
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
		'analysis_id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'mne_analysis_by_source' 
);
?>