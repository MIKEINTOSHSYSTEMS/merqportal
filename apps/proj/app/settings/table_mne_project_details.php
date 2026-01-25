<?php
global $runnerTableSettings;
$runnerTableSettings['mne_project_details'] = array(
	'name' => 'mne_project_details',
	'shortName' => 'mne_project_details',
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
	'afterEditDetails' => 'mne_project_details',
	'afterAddDetail' => 'mne_project_details',
	'detailsBadgeColor' => 'bc8f8f',
	'displayLoading' => true,
	'warnLeavingEdit' => true,
	'sql' => 'SELECT
	detail_id,
	project_id,
	client,
	contract_value,
	project_manager,
	start_date,
	technical_lead,
	end_date,
	mel_lead,
	percent_complete,
	project_coordinator,
	reporting_period,
	project_status,
	last_updated,
	created_at,
	updated_at
FROM
	mne_project_details',
	'keyFields' => array( 
		'detail_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'detail_id' => array(
			'name' => 'detail_id',
			'goodName' => 'detail_id',
			'strField' => 'detail_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'detail_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'project_id' => array(
			'name' => 'project_id',
			'goodName' => 'project_id',
			'strField' => 'project_id',
			'index' => 2,
			'type' => 3,
			'sqlExpression' => 'project_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_projects',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'project_id',
					'lookupDisplayField' => 'project_code',
					'lookupAutofillEdit' => true,
					'lookupAutofillFields' => array( 
						array(
							'masterField' => 'client',
							'lookupField' => 'client_id' 
						),
						array(
							'masterField' => 'contract_value',
							'lookupField' => 'total_value' 
						),
						array(
							'masterField' => 'project_manager',
							'lookupField' => 'project_manager_id' 
						),
						array(
							'masterField' => 'start_date',
							'lookupField' => 'start_date' 
						),
						array(
							'masterField' => 'technical_lead',
							'lookupField' => 'technical_lead_id' 
						),
						array(
							'masterField' => 'end_date',
							'lookupField' => 'end_date_original' 
						),
						array(
							'masterField' => 'mel_lead',
							'lookupField' => 'mel_lead_id' 
						),
						array(
							'masterField' => 'project_coordinator',
							'lookupField' => 'project_coordinator_id' 
						),
						array(
							'masterField' => 'project_status',
							'lookupField' => 'current_status_id' 
						),
						array(
							'masterField' => 'last_updated',
							'lookupField' => 'updated_at' 
						),
						array(
							'masterField' => 'created_at',
							'lookupField' => 'created_at' 
						) 
					) 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'client' => array(
			'name' => 'client',
			'goodName' => 'client',
			'strField' => 'client',
			'index' => 3,
			'sqlExpression' => 'client',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'contract_value' => array(
			'name' => 'contract_value',
			'goodName' => 'contract_value',
			'strField' => 'contract_value',
			'index' => 4,
			'type' => 14,
			'sqlExpression' => 'contract_value',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'project_manager' => array(
			'name' => 'project_manager',
			'goodName' => 'project_manager',
			'strField' => 'project_manager',
			'index' => 5,
			'sqlExpression' => 'project_manager',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'start_date' => array(
			'name' => 'start_date',
			'goodName' => 'start_date',
			'strField' => 'start_date',
			'index' => 6,
			'type' => 7,
			'sqlExpression' => 'start_date',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'technical_lead' => array(
			'name' => 'technical_lead',
			'goodName' => 'technical_lead',
			'strField' => 'technical_lead',
			'index' => 7,
			'sqlExpression' => 'technical_lead',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'end_date' => array(
			'name' => 'end_date',
			'goodName' => 'end_date',
			'strField' => 'end_date',
			'index' => 8,
			'type' => 7,
			'sqlExpression' => 'end_date',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'mel_lead' => array(
			'name' => 'mel_lead',
			'goodName' => 'mel_lead',
			'strField' => 'mel_lead',
			'index' => 9,
			'sqlExpression' => 'mel_lead',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'percent_complete' => array(
			'name' => 'percent_complete',
			'goodName' => 'percent_complete',
			'strField' => 'percent_complete',
			'index' => 10,
			'type' => 14,
			'sqlExpression' => 'percent_complete',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Number',
					'textHTML5Input' => 'Number' 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'project_coordinator' => array(
			'name' => 'project_coordinator',
			'goodName' => 'project_coordinator',
			'strField' => 'project_coordinator',
			'index' => 11,
			'sqlExpression' => 'project_coordinator',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'reporting_period' => array(
			'name' => 'reporting_period',
			'goodName' => 'reporting_period',
			'strField' => 'reporting_period',
			'index' => 12,
			'sqlExpression' => 'reporting_period',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'project_status' => array(
			'name' => 'project_status',
			'goodName' => 'project_status',
			'strField' => 'project_status',
			'index' => 13,
			'sqlExpression' => 'project_status',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'mne_status_options',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'status_id',
					'lookupDisplayField' => 'status_name',
					'lookupWhere' => 'status_category = "General"' 
				) 
			),
			'tableName' => 'mne_project_details' 
		),
		'last_updated' => array(
			'name' => 'last_updated',
			'goodName' => 'last_updated',
			'strField' => 'last_updated',
			'index' => 14,
			'type' => 135,
			'sqlExpression' => 'last_updated',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Short Date' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Date',
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_project_details' 
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
			'tableName' => 'mne_project_details' 
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
			'tableName' => 'mne_project_details' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'mne_projects',
			'detailsKeys' => array( 
				'project_id' 
			),
			'masterKeys' => array( 
				'project_id' 
			) 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	detail_id,
	project_id,
	client,
	contract_value,
	project_manager,
	start_date,
	technical_lead,
	end_date,
	mel_lead,
	percent_complete,
	project_coordinator,
	reporting_period,
	project_status,
	last_updated,
	created_at,
	updated_at
FROM
	mne_project_details',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'detail_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'detail_id' 
				),
				'encrypted' => false,
				'columnName' => 'detail_id' 
			),
			array(
				'sql' => 'project_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'project_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_id' 
			),
			array(
				'sql' => 'client',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'client' 
				),
				'encrypted' => false,
				'columnName' => 'client' 
			),
			array(
				'sql' => 'contract_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'contract_value' 
				),
				'encrypted' => false,
				'columnName' => 'contract_value' 
			),
			array(
				'sql' => 'project_manager',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'project_manager' 
				),
				'encrypted' => false,
				'columnName' => 'project_manager' 
			),
			array(
				'sql' => 'start_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'start_date' 
				),
				'encrypted' => false,
				'columnName' => 'start_date' 
			),
			array(
				'sql' => 'technical_lead',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'technical_lead' 
				),
				'encrypted' => false,
				'columnName' => 'technical_lead' 
			),
			array(
				'sql' => 'end_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'end_date' 
				),
				'encrypted' => false,
				'columnName' => 'end_date' 
			),
			array(
				'sql' => 'mel_lead',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'mel_lead' 
				),
				'encrypted' => false,
				'columnName' => 'mel_lead' 
			),
			array(
				'sql' => 'percent_complete',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'percent_complete' 
				),
				'encrypted' => false,
				'columnName' => 'percent_complete' 
			),
			array(
				'sql' => 'project_coordinator',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'project_coordinator' 
				),
				'encrypted' => false,
				'columnName' => 'project_coordinator' 
			),
			array(
				'sql' => 'reporting_period',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'reporting_period' 
				),
				'encrypted' => false,
				'columnName' => 'reporting_period' 
			),
			array(
				'sql' => 'project_status',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'project_status' 
				),
				'encrypted' => false,
				'columnName' => 'project_status' 
			),
			array(
				'sql' => 'last_updated',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_project_details',
					'name' => 'last_updated' 
				),
				'encrypted' => false,
				'columnName' => 'last_updated' 
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
					'table' => 'mne_project_details',
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
					'table' => 'mne_project_details',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_project_details',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_project_details',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'detail_id',
						'project_id',
						'client',
						'contract_value',
						'project_manager',
						'start_date',
						'technical_lead',
						'end_date',
						'mel_lead',
						'percent_complete',
						'project_coordinator',
						'reporting_period',
						'project_status',
						'last_updated',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_project_details' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'detail_id,
	project_id,
	client,
	contract_value,
	project_manager,
	start_date,
	technical_lead,
	end_date,
	mel_lead,
	percent_complete,
	project_coordinator,
	reporting_period,
	project_status,
	last_updated,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_project_details',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_project_details',
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
			'detail_id',
			'project_id',
			'client',
			'contract_value',
			'project_manager',
			'start_date',
			'technical_lead',
			'end_date',
			'mel_lead',
			'percent_complete',
			'project_coordinator',
			'reporting_period',
			'project_status',
			'last_updated',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'detail_id',
			'project_id',
			'client',
			'contract_value',
			'project_manager',
			'start_date',
			'technical_lead',
			'end_date',
			'mel_lead',
			'percent_complete',
			'project_coordinator',
			'reporting_period',
			'project_status',
			'last_updated',
			'created_at',
			'updated_at' 
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
	$runnerTableLabels['mne_project_details'] = array(
	'tableCaption' => 'Mne Project Details',
	'fieldLabels' => array(
		'detail_id' => 'Detail Id',
		'project_id' => 'Project Id',
		'client' => 'Client',
		'contract_value' => 'Contract Value',
		'project_manager' => 'Project Manager',
		'start_date' => 'Start Date',
		'technical_lead' => 'Technical Lead',
		'end_date' => 'End Date',
		'mel_lead' => 'Mel Lead',
		'percent_complete' => 'Percent Complete',
		'project_coordinator' => 'Project Coordinator',
		'reporting_period' => 'Reporting Period',
		'project_status' => 'Project Status',
		'last_updated' => 'Last Updated',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'detail_id' => '',
		'project_id' => '',
		'client' => '',
		'contract_value' => '',
		'project_manager' => '',
		'start_date' => '',
		'technical_lead' => '',
		'end_date' => '',
		'mel_lead' => '',
		'percent_complete' => '',
		'project_coordinator' => '',
		'reporting_period' => '',
		'project_status' => '',
		'last_updated' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'detail_id' => '',
		'project_id' => '',
		'client' => '',
		'contract_value' => '',
		'project_manager' => '',
		'start_date' => '',
		'technical_lead' => '',
		'end_date' => '',
		'mel_lead' => '',
		'percent_complete' => '',
		'project_coordinator' => '',
		'reporting_period' => '',
		'project_status' => '',
		'last_updated' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>