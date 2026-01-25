<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['tblcurrency_rates'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		 
	),
	'fields' => array( 
		array(
			'name' => 'id',
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
			'name' => 'from_currency_id',
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
			'name' => 'from_currency_name',
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
			'name' => 'from_currency_rate',
			'type' => 14,
			'size' => 15,
			'scale' => 6,
			'typeName' => 'decimal(15,6)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => '0.000000',
			'defaultValue' => '0.000000' 
		),
		array(
			'name' => 'to_currency_id',
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
			'name' => 'to_currency_name',
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
			'name' => 'to_currency_rate',
			'type' => 14,
			'size' => 15,
			'scale' => 6,
			'typeName' => 'decimal(15,6)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => '0.000000',
			'defaultValue' => '0.000000' 
		),
		array(
			'name' => 'date_updated',
			'type' => 135,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'datetime',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => 'current_timestamp()',
			'defaultValue' => 'CURRENT_TIMESTAMP' 
		) 
	),
	'primaryKeys' => array( 
		'id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'tblcurrency_rates' 
);
?>