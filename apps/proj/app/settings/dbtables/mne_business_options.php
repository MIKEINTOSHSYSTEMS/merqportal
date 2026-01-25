<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['mne_business_options'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		 
	),
	'fields' => array( 
		array(
			'name' => 'option_id',
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
			'name' => 'option_type',
			'type' => 129,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'enum(\'source\',\'type\',\'decision\',\'reason\',\'win_loss_reason\')',
			'enumValues' => array( 
				'source',
				'type',
				'decision',
				'reason',
				'win_loss_reason' 
			),
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'option_value',
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
			'name' => 'option_label',
			'type' => 200,
			'size' => 200,
			'scale' => 0,
			'typeName' => 'varchar(200)',
			'nullable' => false,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'parent_id',
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
			'name' => 'is_active',
			'type' => 16,
			'size' => 1,
			'scale' => 0,
			'typeName' => 'tinyint(1)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '1',
			'defaultValue' => '1' 
		),
		array(
			'name' => 'sort_order',
			'type' => 3,
			'size' => 11,
			'scale' => 0,
			'typeName' => 'int(11)',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => '0',
			'defaultValue' => '0' 
		) 
	),
	'primaryKeys' => array( 
		'option_id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'mne_business_options' 
);
?>