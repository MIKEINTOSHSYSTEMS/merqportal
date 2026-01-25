<?php
global $runnerDbTableInfo;
$runnerDbTableInfo['mne_performance_alerts'] = array(
	'type' => 0,
	'foreignKeys' => array( 
		array(
			'name' => 'fk_alert_assigned_to',
			'refTable' => 'users',
			'refSchema' => '',
			'del_rule' => 2,
			'columns' => array( 
				array(
					'column' => 'assigned_to',
					'ref_column' => 'user_id' 
				) 
			) 
		),
		array(
			'name' => 'fk_alert_project',
			'refTable' => 'mne_projects',
			'refSchema' => '',
			'del_rule' => 2,
			'columns' => array( 
				array(
					'column' => 'project_id',
					'ref_column' => 'project_id' 
				) 
			) 
		) 
	),
	'fields' => array( 
		array(
			'name' => 'alert_id',
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
			'name' => 'project_id',
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
			'name' => 'issue_type',
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
			'name' => 'issue_description',
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
			'name' => 'severity',
			'type' => 129,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'enum(\'High\',\'Medium\',\'Low\')',
			'enumValues' => array( 
				'High',
				'Medium',
				'Low' 
			),
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => 'Medium',
			'defaultValue' => '' 
		),
		array(
			'name' => 'status',
			'type' => 129,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'enum(\'Open\',\'In Progress\',\'Resolved\',\'Closed\')',
			'enumValues' => array( 
				'Open',
				'In Progress',
				'Resolved',
				'Closed' 
			),
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => 'Open',
			'defaultValue' => '' 
		),
		array(
			'name' => 'assigned_to',
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
			'name' => 'due_date',
			'type' => 7,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'date',
			'nullable' => true,
			'autoinc' => false,
			'defaultValueSQL' => null,
			'defaultValue' => '' 
		),
		array(
			'name' => 'resolved_date',
			'type' => 7,
			'size' => 0,
			'scale' => 0,
			'typeName' => 'date',
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
		'alert_id' 
	),
	'uniqueFields' => array( 
		 
	),
	'name' => 'mne_performance_alerts' 
);
?>