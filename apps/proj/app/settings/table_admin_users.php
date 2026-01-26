<?php
global $runnerTableSettings;
$runnerTableSettings['admin_users'] = array(
	'name' => 'admin_users',
	'type' => 1,
	'shortName' => 'admin_users',
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
	'audit' => true,
	'afterEditDetails' => 'admin_users',
	'afterAddDetail' => 'admin_users',
	'detailsBadgeColor' => '3cb371',
	'sql' => 'SELECT
	user_id,
	username,
	email,
	password_hash,
	full_name,
	google_id,
	first_name,
	last_name,
	middle_name,
	phone,
	alternate_phone,
	`role`,
	job_position,
	join_date,
	leave_balance,
	last_leave_increment,
	role_id,
	is_active,
	created_at,
	updated_at,
	last_login,
	employee_id,
	position_id,
	department_id,
	hire_date,
	is_admin,
	reset_token,
	reset_date,
	is_doctor,
	supervisor_id
FROM
	users',
	'keyFields' => array( 
		'user_id' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'user_id' => array(
			'name' => 'user_id',
			'goodName' => 'user_id',
			'strField' => 'user_id',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'user_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'username' => array(
			'name' => 'username',
			'goodName' => 'username',
			'strField' => 'username',
			'index' => 2,
			'sqlExpression' => 'username',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'email' => array(
			'name' => 'email',
			'goodName' => 'email',
			'strField' => 'email',
			'index' => 3,
			'sqlExpression' => 'email',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Email Hyperlink' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'validateAs' => 'Email',
					'textHTML5Input' => 'Email' 
				) 
			),
			'tableName' => 'users' 
		),
		'password_hash' => array(
			'name' => 'password_hash',
			'goodName' => 'password_hash',
			'strField' => 'password_hash',
			'index' => 4,
			'sqlExpression' => 'password_hash',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'full_name' => array(
			'name' => 'full_name',
			'goodName' => 'full_name',
			'strField' => 'full_name',
			'index' => 5,
			'sqlExpression' => 'full_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'google_id' => array(
			'name' => 'google_id',
			'goodName' => 'google_id',
			'strField' => 'google_id',
			'index' => 6,
			'sqlExpression' => 'google_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'first_name' => array(
			'name' => 'first_name',
			'goodName' => 'first_name',
			'strField' => 'first_name',
			'index' => 7,
			'sqlExpression' => 'first_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'last_name' => array(
			'name' => 'last_name',
			'goodName' => 'last_name',
			'strField' => 'last_name',
			'index' => 8,
			'sqlExpression' => 'last_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'middle_name' => array(
			'name' => 'middle_name',
			'goodName' => 'middle_name',
			'strField' => 'middle_name',
			'index' => 9,
			'sqlExpression' => 'middle_name',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'phone' => array(
			'name' => 'phone',
			'goodName' => 'phone',
			'strField' => 'phone',
			'index' => 10,
			'sqlExpression' => 'phone',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Phone Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Telephone',
					'pluginInitString' => '$this->settings["required"] = false;                    // Wether is mandatory
$this->settings["tooltip"] = "Click here to enter telephone"; // Information tooltip
$this->settings["initialCountry"] = "et";               // Country default
$this->settings["preferredCountries"] = "et";           // Preferred Country
' 
				) 
			),
			'tableName' => 'users' 
		),
		'alternate_phone' => array(
			'name' => 'alternate_phone',
			'goodName' => 'alternate_phone',
			'strField' => 'alternate_phone',
			'index' => 11,
			'sqlExpression' => 'alternate_phone',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Phone Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Telephone',
					'pluginInitString' => '$this->settings["required"] = false;                    // Wether is mandatory
$this->settings["tooltip"] = "Click here to enter telephone"; // Information tooltip
$this->settings["initialCountry"] = "et";               // Country default
$this->settings["preferredCountries"] = "et";           // Preferred Country
' 
				) 
			),
			'tableName' => 'users' 
		),
		'role' => array(
			'name' => 'role',
			'goodName' => 'role',
			'strField' => 'role',
			'index' => 12,
			'type' => 129,
			'sqlExpression' => '`role`',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 0,
					'lookupValues' => array( 
						'admin',
						'manager',
						'employee',
						'consultant' 
					) 
				) 
			),
			'tableName' => 'users' 
		),
		'job_position' => array(
			'name' => 'job_position',
			'goodName' => 'job_position',
			'strField' => 'job_position',
			'index' => 13,
			'sqlExpression' => 'job_position',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'join_date' => array(
			'name' => 'join_date',
			'goodName' => 'join_date',
			'strField' => 'join_date',
			'index' => 14,
			'type' => 7,
			'sqlExpression' => 'join_date',
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
			'tableName' => 'users' 
		),
		'leave_balance' => array(
			'name' => 'leave_balance',
			'goodName' => 'leave_balance',
			'strField' => 'leave_balance',
			'index' => 15,
			'type' => 14,
			'sqlExpression' => 'leave_balance',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Number' 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'last_leave_increment' => array(
			'name' => 'last_leave_increment',
			'goodName' => 'last_leave_increment',
			'strField' => 'last_leave_increment',
			'index' => 16,
			'type' => 7,
			'sqlExpression' => 'last_leave_increment',
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
			'tableName' => 'users' 
		),
		'role_id' => array(
			'name' => 'role_id',
			'goodName' => 'role_id',
			'strField' => 'role_id',
			'index' => 17,
			'type' => 3,
			'sqlExpression' => 'role_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupTable' => 'roles',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'role_id',
					'lookupDisplayField' => 'role_name' 
				) 
			),
			'tableName' => 'users' 
		),
		'is_active' => array(
			'name' => 'is_active',
			'goodName' => 'is_active',
			'strField' => 'is_active',
			'index' => 18,
			'type' => 16,
			'sqlExpression' => 'is_active',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'created_at' => array(
			'name' => 'created_at',
			'goodName' => 'created_at',
			'strField' => 'created_at',
			'index' => 19,
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
			'tableName' => 'users' 
		),
		'updated_at' => array(
			'name' => 'updated_at',
			'goodName' => 'updated_at',
			'strField' => 'updated_at',
			'index' => 20,
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
			'tableName' => 'users' 
		),
		'last_login' => array(
			'name' => 'last_login',
			'goodName' => 'last_login',
			'strField' => 'last_login',
			'index' => 21,
			'type' => 135,
			'sqlExpression' => 'last_login',
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
			'tableName' => 'users' 
		),
		'employee_id' => array(
			'name' => 'employee_id',
			'goodName' => 'employee_id',
			'strField' => 'employee_id',
			'index' => 22,
			'sqlExpression' => 'employee_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'users' 
		),
		'position_id' => array(
			'name' => 'position_id',
			'goodName' => 'position_id',
			'strField' => 'position_id',
			'index' => 23,
			'type' => 3,
			'sqlExpression' => 'position_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'positions',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'position_id',
					'lookupDisplayField' => 'position_title' 
				) 
			),
			'tableName' => 'users' 
		),
		'department_id' => array(
			'name' => 'department_id',
			'goodName' => 'department_id',
			'strField' => 'department_id',
			'index' => 24,
			'type' => 3,
			'sqlExpression' => 'department_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'departments',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'department_id',
					'lookupDisplayField' => 'department_name' 
				) 
			),
			'tableName' => 'users' 
		),
		'hire_date' => array(
			'name' => 'hire_date',
			'goodName' => 'hire_date',
			'strField' => 'hire_date',
			'index' => 25,
			'type' => 7,
			'sqlExpression' => 'hire_date',
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
			'tableName' => 'users' 
		),
		'is_admin' => array(
			'name' => 'is_admin',
			'goodName' => 'is_admin',
			'strField' => 'is_admin',
			'index' => 26,
			'type' => 16,
			'sqlExpression' => 'is_admin',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Checkbox' 
				) 
			),
			'tableName' => 'users' 
		),
		'reset_token' => array(
			'name' => 'reset_token',
			'goodName' => 'reset_token',
			'strField' => 'reset_token',
			'index' => 27,
			'type' => 201,
			'sqlExpression' => 'reset_token',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Text area' 
				) 
			),
			'tableName' => 'users' 
		),
		'reset_date' => array(
			'name' => 'reset_date',
			'goodName' => 'reset_date',
			'strField' => 'reset_date',
			'index' => 28,
			'type' => 135,
			'sqlExpression' => 'reset_date',
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
			'tableName' => 'users' 
		),
		'is_doctor' => array(
			'name' => 'is_doctor',
			'goodName' => 'is_doctor',
			'strField' => 'is_doctor',
			'index' => 29,
			'type' => 16,
			'sqlExpression' => 'is_doctor',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Checkbox' 
				) 
			),
			'tableName' => 'users' 
		),
		'supervisor_id' => array(
			'name' => 'supervisor_id',
			'goodName' => 'supervisor_id',
			'strField' => 'supervisor_id',
			'index' => 30,
			'type' => 3,
			'sqlExpression' => 'supervisor_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'users',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'user_id',
					'lookupDisplayField' => 'username' 
				) 
			),
			'tableName' => 'users' 
		) 
	),
	'masterTables' => array( 
		array(
			'table' => 'positions',
			'detailsKeys' => array( 
				'position_id' 
			),
			'masterKeys' => array( 
				'position_id' 
			) 
		),
		array(
			'table' => 'departments',
			'detailsKeys' => array( 
				'department_id' 
			),
			'masterKeys' => array( 
				'department_id' 
			) 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	user_id,
	username,
	email,
	password_hash,
	full_name,
	google_id,
	first_name,
	last_name,
	middle_name,
	phone,
	alternate_phone,
	`role`,
	job_position,
	join_date,
	leave_balance,
	last_leave_increment,
	role_id,
	is_active,
	created_at,
	updated_at,
	last_login,
	employee_id,
	position_id,
	department_id,
	hire_date,
	is_admin,
	reset_token,
	reset_date,
	is_doctor,
	supervisor_id
FROM
	users',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'user_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'user_id' 
				),
				'encrypted' => false,
				'columnName' => 'user_id' 
			),
			array(
				'sql' => 'username',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'username' 
				),
				'encrypted' => false,
				'columnName' => 'username' 
			),
			array(
				'sql' => 'email',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'email' 
				),
				'encrypted' => false,
				'columnName' => 'email' 
			),
			array(
				'sql' => 'password_hash',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'password_hash' 
				),
				'encrypted' => false,
				'columnName' => 'password_hash' 
			),
			array(
				'sql' => 'full_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'full_name' 
				),
				'encrypted' => false,
				'columnName' => 'full_name' 
			),
			array(
				'sql' => 'google_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'google_id' 
				),
				'encrypted' => false,
				'columnName' => 'google_id' 
			),
			array(
				'sql' => 'first_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'first_name' 
				),
				'encrypted' => false,
				'columnName' => 'first_name' 
			),
			array(
				'sql' => 'last_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'last_name' 
				),
				'encrypted' => false,
				'columnName' => 'last_name' 
			),
			array(
				'sql' => 'middle_name',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'middle_name' 
				),
				'encrypted' => false,
				'columnName' => 'middle_name' 
			),
			array(
				'sql' => 'phone',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'phone' 
				),
				'encrypted' => false,
				'columnName' => 'phone' 
			),
			array(
				'sql' => 'alternate_phone',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'alternate_phone' 
				),
				'encrypted' => false,
				'columnName' => 'alternate_phone' 
			),
			array(
				'sql' => '`role`',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'role' 
				),
				'encrypted' => false,
				'columnName' => 'role' 
			),
			array(
				'sql' => 'job_position',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'job_position' 
				),
				'encrypted' => false,
				'columnName' => 'job_position' 
			),
			array(
				'sql' => 'join_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'join_date' 
				),
				'encrypted' => false,
				'columnName' => 'join_date' 
			),
			array(
				'sql' => 'leave_balance',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'leave_balance' 
				),
				'encrypted' => false,
				'columnName' => 'leave_balance' 
			),
			array(
				'sql' => 'last_leave_increment',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'last_leave_increment' 
				),
				'encrypted' => false,
				'columnName' => 'last_leave_increment' 
			),
			array(
				'sql' => 'role_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'role_id' 
				),
				'encrypted' => false,
				'columnName' => 'role_id' 
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
					'table' => 'users',
					'name' => 'is_active' 
				),
				'encrypted' => false,
				'columnName' => 'is_active' 
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
					'table' => 'users',
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
					'table' => 'users',
					'name' => 'updated_at' 
				),
				'encrypted' => false,
				'columnName' => 'updated_at' 
			),
			array(
				'sql' => 'last_login',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'last_login' 
				),
				'encrypted' => false,
				'columnName' => 'last_login' 
			),
			array(
				'sql' => 'employee_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'employee_id' 
				),
				'encrypted' => false,
				'columnName' => 'employee_id' 
			),
			array(
				'sql' => 'position_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'position_id' 
				),
				'encrypted' => false,
				'columnName' => 'position_id' 
			),
			array(
				'sql' => 'department_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'department_id' 
				),
				'encrypted' => false,
				'columnName' => 'department_id' 
			),
			array(
				'sql' => 'hire_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'hire_date' 
				),
				'encrypted' => false,
				'columnName' => 'hire_date' 
			),
			array(
				'sql' => 'is_admin',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'is_admin' 
				),
				'encrypted' => false,
				'columnName' => 'is_admin' 
			),
			array(
				'sql' => 'reset_token',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'reset_token' 
				),
				'encrypted' => false,
				'columnName' => 'reset_token' 
			),
			array(
				'sql' => 'reset_date',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'reset_date' 
				),
				'encrypted' => false,
				'columnName' => 'reset_date' 
			),
			array(
				'sql' => 'is_doctor',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'is_doctor' 
				),
				'encrypted' => false,
				'columnName' => 'is_doctor' 
			),
			array(
				'sql' => 'supervisor_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'users',
					'name' => 'supervisor_id' 
				),
				'encrypted' => false,
				'columnName' => 'supervisor_id' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'users',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'users',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'user_id',
						'username',
						'email',
						'password_hash',
						'full_name',
						'google_id',
						'first_name',
						'last_name',
						'middle_name',
						'phone',
						'alternate_phone',
						'role',
						'job_position',
						'join_date',
						'leave_balance',
						'last_leave_increment',
						'role_id',
						'is_active',
						'created_at',
						'updated_at',
						'last_login',
						'employee_id',
						'position_id',
						'department_id',
						'hire_date',
						'is_admin',
						'reset_token',
						'reset_date',
						'is_doctor',
						'supervisor_id' 
					),
					'name' => 'users' 
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
			),
			array(
				'fieldIndex' => 17,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 18,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 19,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 20,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 21,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 22,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 23,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 24,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 25,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 26,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 27,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 28,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			),
			array(
				'fieldIndex' => 29,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'user_id,
	username,
	email,
	password_hash,
	full_name,
	google_id,
	first_name,
	last_name,
	middle_name,
	phone,
	alternate_phone,
	`role`,
	job_position,
	join_date,
	leave_balance,
	last_leave_increment,
	role_id,
	is_active,
	created_at,
	updated_at,
	last_login,
	employee_id,
	position_id,
	department_id,
	hire_date,
	is_admin,
	reset_token,
	reset_date,
	is_doctor,
	supervisor_id',
		'fromListSql' => 'FROM
	users',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'users',
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
			'user_id',
			'username',
			'email',
			'password_hash',
			'full_name',
			'google_id',
			'first_name',
			'last_name',
			'middle_name',
			'phone',
			'alternate_phone',
			'role',
			'job_position',
			'join_date',
			'leave_balance',
			'last_leave_increment',
			'role_id',
			'is_active',
			'created_at',
			'updated_at',
			'last_login',
			'employee_id',
			'position_id',
			'department_id',
			'hire_date',
			'is_admin',
			'reset_token',
			'reset_date',
			'is_doctor',
			'supervisor_id' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'user_id',
			'username',
			'email',
			'password_hash',
			'full_name',
			'google_id',
			'first_name',
			'last_name',
			'middle_name',
			'phone',
			'alternate_phone',
			'role',
			'job_position',
			'join_date',
			'leave_balance',
			'last_leave_increment',
			'role_id',
			'is_active',
			'created_at',
			'updated_at',
			'last_login',
			'employee_id',
			'position_id',
			'department_id',
			'hire_date',
			'is_admin',
			'reset_token',
			'reset_date',
			'is_doctor',
			'supervisor_id' 
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
	$runnerTableLabels['admin_users'] = array(
	'tableCaption' => 'Admin Users',
	'fieldLabels' => array(
		'user_id' => 'User Id',
		'username' => 'Username',
		'email' => 'Email',
		'password_hash' => 'Password Hash',
		'full_name' => 'Full Name',
		'google_id' => 'Google Id',
		'first_name' => 'First Name',
		'last_name' => 'Last Name',
		'middle_name' => 'Middle Name',
		'phone' => 'Phone',
		'alternate_phone' => 'Alternate Phone',
		'role' => 'Role',
		'job_position' => 'Job Position',
		'join_date' => 'Join Date',
		'leave_balance' => 'Leave Balance',
		'last_leave_increment' => 'Last Leave Increment',
		'role_id' => 'Role Id',
		'is_active' => 'Is Active',
		'created_at' => 'Created At',
		'updated_at' => 'Updated At',
		'last_login' => 'Last Login',
		'employee_id' => 'Employee Id',
		'position_id' => 'Position Id',
		'department_id' => 'Department Id',
		'hire_date' => 'Hire Date',
		'is_admin' => 'Is Admin',
		'reset_token' => 'Reset Token',
		'reset_date' => 'Reset Date',
		'is_doctor' => 'Is Doctor',
		'supervisor_id' => 'Supervisor Id' 
	),
	'fieldTooltips' => array(
		'user_id' => '',
		'username' => '',
		'email' => '',
		'password_hash' => '',
		'full_name' => '',
		'google_id' => '',
		'first_name' => '',
		'last_name' => '',
		'middle_name' => '',
		'phone' => '',
		'alternate_phone' => '',
		'role' => '',
		'job_position' => '',
		'join_date' => '',
		'leave_balance' => '',
		'last_leave_increment' => '',
		'role_id' => '',
		'is_active' => '',
		'created_at' => '',
		'updated_at' => '',
		'last_login' => '',
		'employee_id' => '',
		'position_id' => '',
		'department_id' => '',
		'hire_date' => '',
		'is_admin' => '',
		'reset_token' => '',
		'reset_date' => '',
		'is_doctor' => '',
		'supervisor_id' => '' 
	),
	'fieldPlaceholders' => array(
		'user_id' => '',
		'username' => '',
		'email' => '',
		'password_hash' => '',
		'full_name' => '',
		'google_id' => '',
		'first_name' => '',
		'last_name' => '',
		'middle_name' => '',
		'phone' => '',
		'alternate_phone' => '',
		'role' => '',
		'job_position' => '',
		'join_date' => '',
		'leave_balance' => '',
		'last_leave_increment' => '',
		'role_id' => '',
		'is_active' => '',
		'created_at' => '',
		'updated_at' => '',
		'last_login' => '',
		'employee_id' => '',
		'position_id' => '',
		'department_id' => '',
		'hire_date' => '',
		'is_admin' => '',
		'reset_token' => '',
		'reset_date' => '',
		'is_doctor' => '',
		'supervisor_id' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>