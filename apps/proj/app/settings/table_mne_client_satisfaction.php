<?php
global $runnerTableSettings;
$runnerTableSettings['mne_client_satisfaction'] = array(
	'name' => 'mne_client_satisfaction',
	'shortName' => 'mne_client_satisfaction',
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
	'afterEditDetails' => 'mne_client_satisfaction',
	'afterAddDetail' => 'mne_client_satisfaction',
	'detailsBadgeColor' => '6b8e23',
	'sql' => 'SELECT
	satisfaction_id,
	project_id,
	metric,
	rating_value,
	score_percentage,
	comments,
	feedback_date,
	certificate_type,
	certificate_received,
	certificate_date,
	certificate_reference,
	created_at,
	updated_at
FROM
	mne_client_satisfaction',
	'keyFields' => array( 
		'satisfaction_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'satisfaction_id' => array(
			'name' => 'satisfaction_id',
			'goodName' => 'satisfaction_id',
			'strField' => 'satisfaction_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'satisfaction_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_client_satisfaction' 
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
					'lookupDisplayField' => 'project_code' 
				) 
			),
			'tableName' => 'mne_client_satisfaction' 
		),
		'metric' => array(
			'name' => 'metric',
			'goodName' => 'metric',
			'strField' => 'metric',
			'index' => 3,
			'sqlExpression' => 'metric',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_client_satisfaction' 
		),
		'rating_value' => array(
			'name' => 'rating_value',
			'goodName' => 'rating_value',
			'strField' => 'rating_value',
			'index' => 4,
			'type' => 3,
			'sqlExpression' => 'rating_value',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_client_satisfaction' 
		),
		'score_percentage' => array(
			'name' => 'score_percentage',
			'goodName' => 'score_percentage',
			'strField' => 'score_percentage',
			'index' => 5,
			'type' => 14,
			'sqlExpression' => 'score_percentage',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_client_satisfaction' 
		),
		'comments' => array(
			'name' => 'comments',
			'goodName' => 'comments',
			'strField' => 'comments',
			'index' => 6,
			'type' => 201,
			'sqlExpression' => 'comments',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_client_satisfaction' 
		),
		'feedback_date' => array(
			'name' => 'feedback_date',
			'goodName' => 'feedback_date',
			'strField' => 'feedback_date',
			'index' => 7,
			'type' => 7,
			'sqlExpression' => 'feedback_date',
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
			'tableName' => 'mne_client_satisfaction' 
		),
		'certificate_type' => array(
			'name' => 'certificate_type',
			'goodName' => 'certificate_type',
			'strField' => 'certificate_type',
			'index' => 8,
			'sqlExpression' => 'certificate_type',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'mne_client_satisfaction' 
		),
		'certificate_received' => array(
			'name' => 'certificate_received',
			'goodName' => 'certificate_received',
			'strField' => 'certificate_received',
			'index' => 9,
			'type' => 129,
			'sqlExpression' => 'certificate_received',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'Yes',
						'No' 
					) 
				) 
			),
			'tableName' => 'mne_client_satisfaction' 
		),
		'certificate_date' => array(
			'name' => 'certificate_date',
			'goodName' => 'certificate_date',
			'strField' => 'certificate_date',
			'index' => 10,
			'type' => 7,
			'sqlExpression' => 'certificate_date',
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
			'tableName' => 'mne_client_satisfaction' 
		),
		'certificate_reference' => array(
			'name' => 'certificate_reference',
			'goodName' => 'certificate_reference',
			'strField' => 'certificate_reference',
			'index' => 11,
			'type' => 201,
			'sqlExpression' => 'certificate_reference',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'mne_client_satisfaction' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 12,
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
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_client_satisfaction' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 13,
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
					'dateEditType' => 11 
				) 
			),
			'tableName' => 'mne_client_satisfaction' 
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
	satisfaction_id,
	project_id,
	metric,
	rating_value,
	score_percentage,
	comments,
	feedback_date,
	certificate_type,
	certificate_received,
	certificate_date,
	certificate_reference,
	created_at,
	updated_at
FROM
	mne_client_satisfaction',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'satisfaction_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_client_satisfaction',
					'name' => 'satisfaction_id' 
				),
				'encrypted' => false,
				'columnName' => 'satisfaction_id' 
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
					'table' => 'mne_client_satisfaction',
					'name' => 'project_id' 
				),
				'encrypted' => false,
				'columnName' => 'project_id' 
			),
			array(
				'sql' => 'metric',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_client_satisfaction',
					'name' => 'metric' 
				),
				'encrypted' => false,
				'columnName' => 'metric' 
			),
			array(
				'sql' => 'rating_value',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_client_satisfaction',
					'name' => 'rating_value' 
				),
				'encrypted' => false,
				'columnName' => 'rating_value' 
			),
			array(
				'sql' => 'score_percentage',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_client_satisfaction',
					'name' => 'score_percentage' 
				),
				'encrypted' => false,
				'columnName' => 'score_percentage' 
			),
			array(
				'sql' => 'comments',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_client_satisfaction',
					'name' => 'comments' 
				),
				'encrypted' => false,
				'columnName' => 'comments' 
			),
			array(
				'sql' => 'feedback_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_client_satisfaction',
					'name' => 'feedback_date' 
				),
				'encrypted' => false,
				'columnName' => 'feedback_date' 
			),
			array(
				'sql' => 'certificate_type',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_client_satisfaction',
					'name' => 'certificate_type' 
				),
				'encrypted' => false,
				'columnName' => 'certificate_type' 
			),
			array(
				'sql' => 'certificate_received',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_client_satisfaction',
					'name' => 'certificate_received' 
				),
				'encrypted' => false,
				'columnName' => 'certificate_received' 
			),
			array(
				'sql' => 'certificate_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_client_satisfaction',
					'name' => 'certificate_date' 
				),
				'encrypted' => false,
				'columnName' => 'certificate_date' 
			),
			array(
				'sql' => 'certificate_reference',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'mne_client_satisfaction',
					'name' => 'certificate_reference' 
				),
				'encrypted' => false,
				'columnName' => 'certificate_reference' 
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
					'table' => 'mne_client_satisfaction',
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
					'table' => 'mne_client_satisfaction',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'mne_client_satisfaction',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'mne_client_satisfaction',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'satisfaction_id',
						'project_id',
						'metric',
						'rating_value',
						'score_percentage',
						'comments',
						'feedback_date',
						'certificate_type',
						'certificate_received',
						'certificate_date',
						'certificate_reference',
						'created_at',
						'updated_at' 
					),
					'name' => 'mne_client_satisfaction' 
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
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'satisfaction_id,
	project_id,
	metric,
	rating_value,
	score_percentage,
	comments,
	feedback_date,
	certificate_type,
	certificate_received,
	certificate_date,
	certificate_reference,
	created_at,
	updated_at',
		'fromListSql' => 'FROM
	mne_client_satisfaction',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'mne_client_satisfaction',
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
			'satisfaction_id',
			'project_id',
			'metric',
			'rating_value',
			'score_percentage',
			'comments',
			'feedback_date',
			'certificate_type',
			'certificate_received',
			'certificate_date',
			'certificate_reference',
			'created_at',
			'updated_at' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'satisfaction_id',
			'project_id',
			'metric',
			'rating_value',
			'score_percentage',
			'comments',
			'feedback_date',
			'certificate_type',
			'certificate_received',
			'certificate_date',
			'certificate_reference',
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
	$runnerTableLabels['mne_client_satisfaction'] = array(
	'tableCaption' => 'Mne Client Satisfaction',
	'fieldLabels' => array(
		'satisfaction_id' => 'Satisfaction Id',
		'project_id' => 'Project Id',
		'metric' => 'Metric',
		'rating_value' => 'Rating Value',
		'score_percentage' => 'Score Percentage',
		'comments' => 'Comments',
		'feedback_date' => 'Feedback Date',
		'certificate_type' => 'Certificate Type',
		'certificate_received' => 'Certificate Received',
		'certificate_date' => 'Certificate Date',
		'certificate_reference' => 'Certificate Reference',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At' 
	),
	'fieldTooltips' => array(
		'satisfaction_id' => '',
		'project_id' => '',
		'metric' => '',
		'rating_value' => '',
		'score_percentage' => '',
		'comments' => '',
		'feedback_date' => '',
		'certificate_type' => '',
		'certificate_received' => '',
		'certificate_date' => '',
		'certificate_reference' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'fieldPlaceholders' => array(
		'satisfaction_id' => '',
		'project_id' => '',
		'metric' => '',
		'rating_value' => '',
		'score_percentage' => '',
		'comments' => '',
		'feedback_date' => '',
		'certificate_type' => '',
		'certificate_received' => '',
		'certificate_date' => '',
		'certificate_reference' => '',
		'created_at' => '',
		'updated_at' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>