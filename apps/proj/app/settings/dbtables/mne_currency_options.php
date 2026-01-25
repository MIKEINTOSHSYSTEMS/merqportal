<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['mne_currency_options'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		 
	),
	'fields' => array( 
		array(
			'name' => 'currency_id',
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
			'name' => 'currency_code',
			'type' => 200,
			'size' => 3,
			'scale' => 0,
			'typeName' => 'varchar(3)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'currency_name',
			'type' => 200,
			'size' => 50,
			'scale' => 0,
			'typeName' => 'varchar(50)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'symbol',
			'type' => 200,
			'size' => 10,
			'scale' => 0,
			'typeName' => 'varchar(10)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'exchange_rate',
			'type' => 14,
			'size' => 10,
			'scale' => 4,
			'typeName' => 'decimal(10,4)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '1.0000',
			'defaultValue' => '1.0000' 
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
		'currency_id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'mne_currency_options' 
);
?>