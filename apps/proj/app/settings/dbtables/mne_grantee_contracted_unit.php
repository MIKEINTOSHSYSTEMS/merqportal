<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['mne_grantee_contracted_unit'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		 
	),
	'fields' => array( 
		array(
			'name' => 'grantee_id',
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
			'name' => 'grantee_name',
			'type' => 200,
			'size' => 250,
			'scale' => 0,
			'typeName' => 'varchar(250)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'grantee_details',
			'type' => 200,
			'size' => 250,
			'scale' => 0,
			'typeName' => 'varchar(250)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'grantee_address',
			'type' => 200,
			'size' => 250,
			'scale' => 0,
			'typeName' => 'varchar(250)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'grantee_contact_person',
			'type' => 200,
			'size' => 250,
			'scale' => 0,
			'typeName' => 'varchar(250)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'is_active',
			'type' => 16,
			'size' => 4,
			'scale' => 0,
			'typeName' => 'tinyint(4)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '1',
			'defaultValue' => '1' 
		) 
	),
	'primaryKeys' => array( 
		'grantee_id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'mne_grantee_contracted_unit' 
);
?>