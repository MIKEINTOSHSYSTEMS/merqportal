<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['tblcountries'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		 
	),
	'fields' => array( 
		array(
			'name' => 'country_id',
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
			'name' => 'iso2',
			'type' => 200,
			'size' => 2,
			'scale' => 0,
			'typeName' => 'char(2)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'short_name',
			'type' => 200,
			'size' => 80,
			'scale' => 0,
			'typeName' => 'varchar(80)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => '',
			'defaultValue' => '' 
		),
		array(
			'name' => 'long_name',
			'type' => 200,
			'size' => 80,
			'scale' => 0,
			'typeName' => 'varchar(80)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => '',
			'defaultValue' => '' 
		),
		array(
			'name' => 'iso3',
			'type' => 200,
			'size' => 3,
			'scale' => 0,
			'typeName' => 'char(3)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'numcode',
			'type' => 200,
			'size' => 6,
			'scale' => 0,
			'typeName' => 'varchar(6)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'un_member',
			'type' => 200,
			'size' => 12,
			'scale' => 0,
			'typeName' => 'varchar(12)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'calling_code',
			'type' => 200,
			'size' => 8,
			'scale' => 0,
			'typeName' => 'varchar(8)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'cctld',
			'type' => 200,
			'size' => 5,
			'scale' => 0,
			'typeName' => 'varchar(5)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		) 
	),
	'primaryKeys' => array( 
		'country_id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'tblcountries' 
);
?>