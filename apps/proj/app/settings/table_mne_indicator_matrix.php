<?php
global $runnerTableSettings;
$runnerTableSettings['mne_indicator_matrix'] = array(
	'name' => 'mne_indicator_matrix',
	'shortName' => 'mne_indicator_matrix',
	'pagesByType' => array(
		'add' => array( 
			'add' 
		),
		'export' => array( 
			'export' 
		),
		'import' => array( 
			'import' 
		),
		'edit' => array( 
			'edit' 
		),
		'view' => array( 
			'view' 
		),
		'list' => array( 
			'list' 
		),
		'print' => array( 
			'print' 
		),
		'search' => array( 
			'search' 
		) 
	),
	'pageTypes' => array(
		'add' => 'add',
		'export' => 'export',
		'import' => 'import',
		'edit' => 'edit',
		'view' => 'view',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'defaultPages' => array(
		'add' => 'add',
		'export' => 'export',
		'import' => 'import',
		'edit' => 'edit',
		'view' => 'view',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'afterEditDetails' => 'mne_indicator_matrix',
	'afterAddDetail' => 'mne_indicator_matrix',
	'detailsBadgeColor' => '9e36ff',
	'sql' => 'SELECT
	indicator_id,
	thematic_area,
	importance,
	indicator_name,
	indicator_description,
	indicator_type,
	disaggregated_by,
	data_type,
	data_source,
	reporting_frequency,
	responsible_body,
	known_data_limitation,
	current_status,
	target_value,
	created_at,
	updated_at,
	is_active
FROM
	mne_indicator_matrix',
	'keyFields' => array( 
		'indicator_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'indicator_id' => array(
			'name' => 'indicator_id',
			'goodName' => 'indicator_id',
			'strField' => 'indicator_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'indicator_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'thematic_area' => array(
			'name' => 'thematic_area',
			'goodName' => 'thematic_area',
			'strField' => 'thematic_area',
			'index' => 2,
			'sqlExpression' => 'thematic_area',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_indicator_groups',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'group_id',
					'lookupDisplayField' => 'group_name' 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'importance' => array(
			'name' => 'importance',
			'goodName' => 'importance',
			'strField' => 'importance',
			'index' => 3,
			'type' => 129,
			'sqlExpression' => 'importance',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Required',
						'Optional' 
					) 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'indicator_name' => array(
			'name' => 'indicator_name',
			'goodName' => 'indicator_name',
			'strField' => 'indicator_name',
			'index' => 4,
			'sqlExpression' => 'indicator_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'indicator_description' => array(
			'name' => 'indicator_description',
			'goodName' => 'indicator_description',
			'strField' => 'indicator_description',
			'index' => 5,
			'type' => 201,
			'sqlExpression' => 'indicator_description',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'indicator_type' => array(
			'name' => 'indicator_type',
			'goodName' => 'indicator_type',
			'strField' => 'indicator_type',
			'index' => 6,
			'type' => 129,
			'sqlExpression' => 'indicator_type',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Output',
						'Outcome',
						'Process' 
					) 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'disaggregated_by' => array(
			'name' => 'disaggregated_by',
			'goodName' => 'disaggregated_by',
			'strField' => 'disaggregated_by',
			'index' => 7,
			'type' => 201,
			'sqlExpression' => 'disaggregated_by',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'data_type' => array(
			'name' => 'data_type',
			'goodName' => 'data_type',
			'strField' => 'data_type',
			'index' => 8,
			'type' => 129,
			'sqlExpression' => 'data_type',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Percentage',
						'Number',
						'Currency',
						'Text' 
					) 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'data_source' => array(
			'name' => 'data_source',
			'goodName' => 'data_source',
			'strField' => 'data_source',
			'index' => 9,
			'sqlExpression' => 'data_source',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_data_sources',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'source_id',
					'lookupDisplayField' => 'source_name' 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'reporting_frequency' => array(
			'name' => 'reporting_frequency',
			'goodName' => 'reporting_frequency',
			'strField' => 'reporting_frequency',
			'index' => 10,
			'type' => 129,
			'sqlExpression' => 'reporting_frequency',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Monthly',
						'Quarterly',
						'Semi-annually',
						'Annual',
						'Ad hoc' 
					) 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'responsible_body' => array(
			'name' => 'responsible_body',
			'goodName' => 'responsible_body',
			'strField' => 'responsible_body',
			'index' => 11,
			'sqlExpression' => 'responsible_body',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'known_data_limitation' => array(
			'name' => 'known_data_limitation',
			'goodName' => 'known_data_limitation',
			'strField' => 'known_data_limitation',
			'index' => 12,
			'type' => 201,
			'sqlExpression' => 'known_data_limitation',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'current_status' => array(
			'name' => 'current_status',
			'goodName' => 'current_status',
			'strField' => 'current_status',
			'index' => 13,
			'sqlExpression' => 'current_status',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'target_value' => array(
			'name' => 'target_value',
			'goodName' => 'target_value',
			'strField' => 'target_value',
			'index' => 14,
			'type' => 14,
			'sqlExpression' => 'target_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Number' 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 15,
			'type' => 135,
			'sqlExpression' => 'created_at',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'defaultValue' => 'date("Y-m-d H:i:s")',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 16,
			'type' => 135,
			'sqlExpression' => 'updated_at',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'autoUpdateValue' => 'date("Y-m-d H:i:s")',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		),
		'is_active' => array(
			'name' => 'is_active',
			'goodName' => 'is_active',
			'strField' => 'is_active',
			'index' => 17,
			'type' => 2,
			'sqlExpression' => 'is_active',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Checkbox' 
				) 
			),
			'tableName' => 'mne_indicator_matrix' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'mne_data_sources',
			'detailsKeys' => array( 
				'data_source' 
			),
			'masterKeys' => array( 
				'source_id' 
			) 
		),
		array(
			'table' => 'mne_indicator_groups',
			'detailsKeys' => array( 
				'thematic_area' 
			),
			'masterKeys' => array( 
				'group_id' 
			) 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	indicator_id,
	thematic_area,
	importance,
	indicator_name,
	indicator_description,
	indicator_type,
	disaggregated_by,
	data_type,
	data_source,
	reporting_frequency,
	responsible_body,
	known_data_limitation,
	current_status,
	target_value,
	created_at,
	updated_at,
	is_active
FROM
	mne_indicator_matrix',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'indicator_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'indicator_id' 
				),
				'encrypted' => false,
				'columnName' => 'indicator_id' 
			),
			array(
				'sql' => 'thematic_area',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'thematic_area' 
				),
				'encrypted' => false,
				'columnName' => 'thematic_area' 
			),
			array(
				'sql' => 'importance',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'importance' 
				),
				'encrypted' => false,
				'columnName' => 'importance' 
			),
			array(
				'sql' => 'indicator_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'indicator_name' 
				),
				'encrypted' => false,
				'columnName' => 'indicator_name' 
			),
			array(
				'sql' => 'indicator_description',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'indicator_description' 
				),
				'encrypted' => false,
				'columnName' => 'indicator_description' 
			),
			array(
				'sql' => 'indicator_type',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'indicator_type' 
				),
				'encrypted' => false,
				'columnName' => 'indicator_type' 
			),
			array(
				'sql' => 'disaggregated_by',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'disaggregated_by' 
				),
				'encrypted' => false,
				'columnName' => 'disaggregated_by' 
			),
			array(
				'sql' => 'data_type',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'data_type' 
				),
				'encrypted' => false,
				'columnName' => 'data_type' 
			),
			array(
				'sql' => 'data_source',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'data_source' 
				),
				'encrypted' => false,
				'columnName' => 'data_source' 
			),
			array(
				'sql' => 'reporting_frequency',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'reporting_frequency' 
				),
				'encrypted' => false,
				'columnName' => 'reporting_frequency' 
			),
			array(
				'sql' => 'responsible_body',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'responsible_body' 
				),
				'encrypted' => false,
				'columnName' => 'responsible_body' 
			),
			array(
				'sql' => 'known_data_limitation',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'known_data_limitation' 
				),
				'encrypted' => false,
				'columnName' => 'known_data_limitation' 
			),
			array(
				'sql' => 'current_status',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'current_status' 
				),
				'encrypted' => false,
				'columnName' => 'current_status' 
			),
			array(
				'sql' => 'target_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'target_value' 
				),
				'encrypted' => false,
				'columnName' => 'target_value' 
			),
			array(
				'sql' => 'created_at',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'created_at' 
				),
				'encrypted' => false,
				'columnName' => 'created_at' 
			),
			array(
				'sql' => 'updated_at',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			),
			array(
				'sql' => 'is_active',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_indicator_matrix',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_indicator_matrix',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_indicator_matrix',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'indicator_id',
						'thematic_area',
						'importance',
						'indicator_name',
						'indicator_description',
						'indicator_type',
						'disaggregated_by',
						'data_type',
						'data_source',
						'reporting_frequency',
						'responsible_body',
						'known_data_limitation',
						'current_status',
						'target_value',
						'created_at',
						'updated_at',
						'is_active' 
					),
					'name' => 'mne_indicator_matrix' 
				),
				'joinOn' => array(
					'sql' => '',
					'parsed' => false,
					'type' => 'LogicalExpression',
					'contained' => array( 
						 
					),
					'unionType' => 0,
					'column' => null 
				),
				'joinList' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'JoinOn',
					'field1' => array( 
						 
					),
					'field2' => array( 
						 
					) 
				),
				'link' => 0 
			) 
		),
		'where' => array(
			'sql' => '',
			'parsed' => false,
			'type' => 'LogicalExpression',
			'contained' => array( 
				 
			),
			'unionType' => 0,
			'column' => null 
		),
		'groupBy' => array( 
			 
		),
		'having' => array(
			'sql' => '',
			'parsed' => false,
			'type' => 'LogicalExpression',
			'contained' => array( 
				 
			),
			'unionType' => 0,
			'column' => null 
		),
		'orderBy' => array( 
			 
		),
		'colsIndex' => array( 
			array(
				'fieldIndex' => 0,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 1,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 2,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 3,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 4,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 5,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 6,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 7,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 8,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 9,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 10,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 11,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 12,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 13,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 14,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 15,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 16,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'indicator_id,
	thematic_area,
	importance,
	indicator_name,
	indicator_description,
	indicator_type,
	disaggregated_by,
	data_type,
	data_source,
	reporting_frequency,
	responsible_body,
	known_data_limitation,
	current_status,
	target_value,
	created_at,
	updated_at,
	is_active',
		'fromListSql' => 'FROM
	mne_indicator_matrix',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_indicator_matrix',
	'originalPagesByType' => array(
		'add' => array( 
			'add' 
		),
		'export' => array( 
			'export' 
		),
		'import' => array( 
			'import' 
		),
		'edit' => array( 
			'edit' 
		),
		'view' => array( 
			'view' 
		),
		'list' => array( 
			'list' 
		),
		'print' => array( 
			'print' 
		),
		'search' => array( 
			'search' 
		) 
	),
	'originalPageTypes' => array(
		'add' => 'add',
		'export' => 'export',
		'import' => 'import',
		'edit' => 'edit',
		'view' => 'view',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'originalDefaultPages' => array(
		'add' => 'add',
		'export' => 'export',
		'import' => 'import',
		'edit' => 'edit',
		'view' => 'view',
		'list' => 'list',
		'print' => 'print',
		'search' => 'search' 
	),
	'searchSettings' => array(
		'caseSensitiveSearch' => false,
		'searchableFields' => array( 
			'indicator_id',
			'thematic_area',
			'importance',
			'indicator_name',
			'indicator_description',
			'indicator_type',
			'disaggregated_by',
			'data_type',
			'data_source',
			'reporting_frequency',
			'responsible_body',
			'known_data_limitation',
			'current_status',
			'target_value',
			'created_at',
			'updated_at',
			'is_active' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'indicator_id',
			'thematic_area',
			'importance',
			'indicator_name',
			'indicator_description',
			'indicator_type',
			'disaggregated_by',
			'data_type',
			'data_source',
			'reporting_frequency',
			'responsible_body',
			'known_data_limitation',
			'current_status',
			'target_value',
			'created_at',
			'updated_at',
			'is_active' 
		) 
	),
	'connId' => 'conn',
	'clickActions' => array(
		'row' => array(
			'action' => 'noaction' 
		),
		'fields' => array(
			 
		) 
	),
	'geoCoding' => array(
		'enabled' => false,
		'latField' => '',
		'lonField' => '',
		'addressFields' => array( 
			 
		) 
	),
	'whereTabs' => array( 
		 
	),
	'labels' => array(
		 
	),
	'chartSettings' => array(
		 
	),
	'dataSourceOperations' => array(
		 
	),
	'calendarSettings' => array(
		'categoryColors' => array( 
			 
		) 
	),
	'ganttSettings' => array(
		'categoryColors' => array( 
			 
		) 
	) 
);

global $runnerTableLabels;
if( mlang_getcurrentlang() === 'English' ) {
	$runnerTableLabels['mne_indicator_matrix'] = array(
	'tableCaption' => 'Mne Indicator Matrix',
	'fieldLabels' => array(
		'indicator_id' => 'Indicator Id',
		'thematic_area' => 'Thematic Area(Indicator Group)',
		'importance' => 'Importance',
		'indicator_name' => 'Indicator Name',
		'indicator_description' => 'Indicator Description',
		'indicator_type' => 'Indicator Type',
		'disaggregated_by' => 'Disaggregated By',
		'data_type' => 'Data Type',
		'data_source' => 'Data Source',
		'reporting_frequency' => 'Reporting Frequency',
		'responsible_body' => 'Responsible Body',
		'known_data_limitation' => 'Known Data Limitation',
		'current_status' => 'Current Status',
		'target_value' => 'Target Value',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At',
		'is_active' => 'Is Active' 
	),
	'fieldTooltips' => array(
		'indicator_id' => '',
		'thematic_area' => '',
		'importance' => '',
		'indicator_name' => '',
		'indicator_description' => '',
		'indicator_type' => '',
		'disaggregated_by' => '',
		'data_type' => '',
		'data_source' => '',
		'reporting_frequency' => '',
		'responsible_body' => '',
		'known_data_limitation' => '',
		'current_status' => '',
		'target_value' => '',
		'created_at' => '',
		'updated_at' => '',
		'is_active' => '' 
	),
	'fieldPlaceholders' => array(
		'indicator_id' => '',
		'thematic_area' => '',
		'importance' => '',
		'indicator_name' => '',
		'indicator_description' => '',
		'indicator_type' => '',
		'disaggregated_by' => '',
		'data_type' => '',
		'data_source' => '',
		'reporting_frequency' => '',
		'responsible_body' => '',
		'known_data_limitation' => '',
		'current_status' => '',
		'target_value' => '',
		'created_at' => '',
		'updated_at' => '',
		'is_active' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>