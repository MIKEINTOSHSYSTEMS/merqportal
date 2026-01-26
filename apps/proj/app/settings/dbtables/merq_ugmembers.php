<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['merq_ugmembers'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		 
	),
	'fields' => array( 
		array(
			'name' => 'UserName',
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
			'name' => 'GroupID',
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
			'name' => 'Provider',
			'type' => 200,
			'size' => 10,
			'scale' => 0,
			'typeName' => 'varchar(10)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => '',
			'defaultValue' => '' 
		) 
	),
	'primaryKeys' => array( 
		'UserName',
		'GroupID',
		'Provider' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'merq_ugmembers' 
);
?>