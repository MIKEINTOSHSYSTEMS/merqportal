<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['mne_deliverable_options'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		 
	),
	'fields' => array( 
		array(
			'name' => 'deliverable_id',
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
			'name' => 'deliverable_name',
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
			'name' => 'deliverable_description',
			'type' => 201,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'longtext',
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
		'deliverable_id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'mne_deliverable_options' 
);
?>