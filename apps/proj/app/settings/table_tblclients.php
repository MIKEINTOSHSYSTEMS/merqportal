<?php
global $runnerTableSettings;
$runnerTableSettings['tblclients'] = array(
	'name' => 'tblclients',
	'shortName' => 'tblclients',
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
	'afterEditDetails' => 'tblclients',
	'afterAddDetail' => 'tblclients',
	'detailsBadgeColor' => '2f4f4f',
	'displayLoading' => true,
	'sql' => 'SELECT
	userid,
	company,
	vat,
	phonenumber,
	country,
	city,
	zip,
	`state`,
	address,
	website,
	datecreated,
	active,
	leadid,
	billing_street,
	billing_city,
	billing_state,
	billing_zip,
	billing_country,
	shipping_street,
	shipping_city,
	shipping_state,
	shipping_zip,
	shipping_country,
	longitude,
	latitude,
	default_language,
	default_currency,
	show_primary_contact,
	stripe_id,
	registration_confirmed,
	addedfrom
FROM
	tblclients',
	'keyFields' => array( 
		'userid' 
	),
	'deviceHideFields' => array(
		'1' => array( 
			 
		),
		'5' => array( 
			 
		) 
	),
	'fields' => array(
		'userid' => array(
			'name' => 'userid',
			'goodName' => 'userid',
			'strField' => 'userid',
			'index' => 1,
			'type' => 3,
			'autoinc' => true,
			'sqlExpression' => 'userid',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'company' => array(
			'name' => 'company',
			'goodName' => 'company',
			'strField' => 'company',
			'index' => 2,
			'sqlExpression' => 'company',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'vat' => array(
			'name' => 'vat',
			'goodName' => 'vat',
			'strField' => 'vat',
			'index' => 3,
			'sqlExpression' => 'vat',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'phonenumber' => array(
			'name' => 'phonenumber',
			'goodName' => 'phonenumber',
			'strField' => 'phonenumber',
			'index' => 4,
			'sqlExpression' => 'phonenumber',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Telephone',
					'pluginInitString' => '$this->settings["required"] = false;                    // Wether is mandatory
$this->settings["tooltip"] = "Click here to enter telephone"; // Information tooltip
$this->settings["initialCountry"] = "et";               // Country default
$this->settings["preferredCountries"] = "us";           // Preferred Country
' 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'country' => array(
			'name' => 'country',
			'goodName' => 'country',
			'strField' => 'country',
			'index' => 5,
			'type' => 3,
			'sqlExpression' => 'country',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'tblcountries',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'country_id',
					'lookupDisplayField' => 'short_name',
					'lookupOrderBy' => 'country_id' 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'city' => array(
			'name' => 'city',
			'goodName' => 'city',
			'strField' => 'city',
			'index' => 6,
			'sqlExpression' => 'city',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'zip' => array(
			'name' => 'zip',
			'goodName' => 'zip',
			'strField' => 'zip',
			'index' => 7,
			'sqlExpression' => 'zip',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'state' => array(
			'name' => 'state',
			'goodName' => 'state',
			'strField' => 'state',
			'index' => 8,
			'sqlExpression' => '`state`',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'address' => array(
			'name' => 'address',
			'goodName' => 'address',
			'strField' => 'address',
			'index' => 9,
			'sqlExpression' => 'address',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'website' => array(
			'name' => 'website',
			'goodName' => 'website',
			'strField' => 'website',
			'index' => 10,
			'sqlExpression' => 'website',
			'viewFormats' => array(
				'view' => array(
					'format' => 'Hyperlink',
					'linkNewWindow' => true 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'textHTML5Input' => 'URL' 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'datecreated' => array(
			'name' => 'datecreated',
			'goodName' => 'datecreated',
			'strField' => 'datecreated',
			'index' => 11,
			'type' => 135,
			'sqlExpression' => 'datecreated',
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
			'tableName' => 'tblclients' 
		),
		'active' => array(
			'name' => 'active',
			'goodName' => 'active',
			'strField' => 'active',
			'index' => 12,
			'type' => 3,
			'sqlExpression' => 'active',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Checkbox',
					'defaultValue' => '1' 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'leadid' => array(
			'name' => 'leadid',
			'goodName' => 'leadid',
			'strField' => 'leadid',
			'index' => 13,
			'type' => 3,
			'sqlExpression' => 'leadid',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'billing_street' => array(
			'name' => 'billing_street',
			'goodName' => 'billing_street',
			'strField' => 'billing_street',
			'index' => 14,
			'sqlExpression' => 'billing_street',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'billing_city' => array(
			'name' => 'billing_city',
			'goodName' => 'billing_city',
			'strField' => 'billing_city',
			'index' => 15,
			'sqlExpression' => 'billing_city',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'billing_state' => array(
			'name' => 'billing_state',
			'goodName' => 'billing_state',
			'strField' => 'billing_state',
			'index' => 16,
			'sqlExpression' => 'billing_state',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'billing_zip' => array(
			'name' => 'billing_zip',
			'goodName' => 'billing_zip',
			'strField' => 'billing_zip',
			'index' => 17,
			'sqlExpression' => 'billing_zip',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'billing_country' => array(
			'name' => 'billing_country',
			'goodName' => 'billing_country',
			'strField' => 'billing_country',
			'index' => 18,
			'type' => 3,
			'sqlExpression' => 'billing_country',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'defaultValue' => '0',
					'lookupType' => 2,
					'lookupTable' => 'tblcountries',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'country_id',
					'lookupDisplayField' => 'short_name',
					'lookupOrderBy' => 'country_id' 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'shipping_street' => array(
			'name' => 'shipping_street',
			'goodName' => 'shipping_street',
			'strField' => 'shipping_street',
			'index' => 19,
			'sqlExpression' => 'shipping_street',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'shipping_city' => array(
			'name' => 'shipping_city',
			'goodName' => 'shipping_city',
			'strField' => 'shipping_city',
			'index' => 20,
			'sqlExpression' => 'shipping_city',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'defaultValue' => '0',
					'lookupType' => 2,
					'lookupTable' => 'tblcountries',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'country_id',
					'lookupDisplayField' => 'short_name' 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'shipping_state' => array(
			'name' => 'shipping_state',
			'goodName' => 'shipping_state',
			'strField' => 'shipping_state',
			'index' => 21,
			'sqlExpression' => 'shipping_state',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'shipping_zip' => array(
			'name' => 'shipping_zip',
			'goodName' => 'shipping_zip',
			'strField' => 'shipping_zip',
			'index' => 22,
			'sqlExpression' => 'shipping_zip',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'shipping_country' => array(
			'name' => 'shipping_country',
			'goodName' => 'shipping_country',
			'strField' => 'shipping_country',
			'index' => 23,
			'type' => 3,
			'sqlExpression' => 'shipping_country',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'lookupType' => 2,
					'lookupTable' => 'tblcountries',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'country_id',
					'lookupDisplayField' => 'short_name',
					'lookupOrderBy' => 'country_id' 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'longitude' => array(
			'name' => 'longitude',
			'goodName' => 'longitude',
			'strField' => 'longitude',
			'index' => 24,
			'sqlExpression' => 'longitude',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'latitude' => array(
			'name' => 'latitude',
			'goodName' => 'latitude',
			'strField' => 'latitude',
			'index' => 25,
			'sqlExpression' => 'latitude',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'default_language' => array(
			'name' => 'default_language',
			'goodName' => 'default_language',
			'strField' => 'default_language',
			'index' => 26,
			'sqlExpression' => 'default_language',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'default_currency' => array(
			'name' => 'default_currency',
			'goodName' => 'default_currency',
			'strField' => 'default_currency',
			'index' => 27,
			'type' => 3,
			'sqlExpression' => 'default_currency',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Lookup wizard',
					'defaultValue' => '0',
					'lookupType' => 2,
					'lookupTable' => 'tblcurrencies',
					'lookupTableConnection' => 'conn',
					'lookupLinkField' => 'id',
					'lookupDisplayField' => 'name' 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'show_primary_contact' => array(
			'name' => 'show_primary_contact',
			'goodName' => 'show_primary_contact',
			'strField' => 'show_primary_contact',
			'index' => 28,
			'type' => 3,
			'sqlExpression' => 'show_primary_contact',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Checkbox',
					'defaultValue' => '0' 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'stripe_id' => array(
			'name' => 'stripe_id',
			'goodName' => 'stripe_id',
			'strField' => 'stripe_id',
			'index' => 29,
			'sqlExpression' => 'stripe_id',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'registration_confirmed' => array(
			'name' => 'registration_confirmed',
			'goodName' => 'registration_confirmed',
			'strField' => 'registration_confirmed',
			'index' => 30,
			'type' => 3,
			'sqlExpression' => 'registration_confirmed',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					'format' => 'Checkbox',
					'defaultValue' => '1' 
				) 
			),
			'tableName' => 'tblclients' 
		),
		'addedfrom' => array(
			'name' => 'addedfrom',
			'goodName' => 'addedfrom',
			'strField' => 'addedfrom',
			'index' => 31,
			'type' => 3,
			'sqlExpression' => 'addedfrom',
			'viewFormats' => array(
				'view' => array(
					 
				) 
			),
			'editFormats' => array(
				'edit' => array(
					 
				) 
			),
			'tableName' => 'tblclients' 
		) 
	),
	'query' => array(
		'sql' => 'SELECT
	userid,
	company,
	vat,
	phonenumber,
	country,
	city,
	zip,
	`state`,
	address,
	website,
	datecreated,
	active,
	leadid,
	billing_street,
	billing_city,
	billing_state,
	billing_zip,
	billing_country,
	shipping_street,
	shipping_city,
	shipping_state,
	shipping_zip,
	shipping_country,
	longitude,
	latitude,
	default_language,
	default_currency,
	show_primary_contact,
	stripe_id,
	registration_confirmed,
	addedfrom
FROM
	tblclients',
		'parsed' => true,
		'type' => 'SQLQuery',
		'fieldList' => array( 
			array(
				'sql' => 'userid',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'userid' 
				),
				'encrypted' => false,
				'columnName' => 'userid' 
			),
			array(
				'sql' => 'company',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'company' 
				),
				'encrypted' => false,
				'columnName' => 'company' 
			),
			array(
				'sql' => 'vat',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'vat' 
				),
				'encrypted' => false,
				'columnName' => 'vat' 
			),
			array(
				'sql' => 'phonenumber',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'phonenumber' 
				),
				'encrypted' => false,
				'columnName' => 'phonenumber' 
			),
			array(
				'sql' => 'country',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'country' 
				),
				'encrypted' => false,
				'columnName' => 'country' 
			),
			array(
				'sql' => 'city',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'city' 
				),
				'encrypted' => false,
				'columnName' => 'city' 
			),
			array(
				'sql' => 'zip',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'zip' 
				),
				'encrypted' => false,
				'columnName' => 'zip' 
			),
			array(
				'sql' => '`state`',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'state' 
				),
				'encrypted' => false,
				'columnName' => 'state' 
			),
			array(
				'sql' => 'address',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'address' 
				),
				'encrypted' => false,
				'columnName' => 'address' 
			),
			array(
				'sql' => 'website',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'website' 
				),
				'encrypted' => false,
				'columnName' => 'website' 
			),
			array(
				'sql' => 'datecreated',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'datecreated' 
				),
				'encrypted' => false,
				'columnName' => 'datecreated' 
			),
			array(
				'sql' => 'active',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'active' 
				),
				'encrypted' => false,
				'columnName' => 'active' 
			),
			array(
				'sql' => 'leadid',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'leadid' 
				),
				'encrypted' => false,
				'columnName' => 'leadid' 
			),
			array(
				'sql' => 'billing_street',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'billing_street' 
				),
				'encrypted' => false,
				'columnName' => 'billing_street' 
			),
			array(
				'sql' => 'billing_city',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'billing_city' 
				),
				'encrypted' => false,
				'columnName' => 'billing_city' 
			),
			array(
				'sql' => 'billing_state',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'billing_state' 
				),
				'encrypted' => false,
				'columnName' => 'billing_state' 
			),
			array(
				'sql' => 'billing_zip',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'billing_zip' 
				),
				'encrypted' => false,
				'columnName' => 'billing_zip' 
			),
			array(
				'sql' => 'billing_country',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'billing_country' 
				),
				'encrypted' => false,
				'columnName' => 'billing_country' 
			),
			array(
				'sql' => 'shipping_street',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'shipping_street' 
				),
				'encrypted' => false,
				'columnName' => 'shipping_street' 
			),
			array(
				'sql' => 'shipping_city',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'shipping_city' 
				),
				'encrypted' => false,
				'columnName' => 'shipping_city' 
			),
			array(
				'sql' => 'shipping_state',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'shipping_state' 
				),
				'encrypted' => false,
				'columnName' => 'shipping_state' 
			),
			array(
				'sql' => 'shipping_zip',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'shipping_zip' 
				),
				'encrypted' => false,
				'columnName' => 'shipping_zip' 
			),
			array(
				'sql' => 'shipping_country',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'shipping_country' 
				),
				'encrypted' => false,
				'columnName' => 'shipping_country' 
			),
			array(
				'sql' => 'longitude',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'longitude' 
				),
				'encrypted' => false,
				'columnName' => 'longitude' 
			),
			array(
				'sql' => 'latitude',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'latitude' 
				),
				'encrypted' => false,
				'columnName' => 'latitude' 
			),
			array(
				'sql' => 'default_language',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'default_language' 
				),
				'encrypted' => false,
				'columnName' => 'default_language' 
			),
			array(
				'sql' => 'default_currency',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'default_currency' 
				),
				'encrypted' => false,
				'columnName' => 'default_currency' 
			),
			array(
				'sql' => 'show_primary_contact',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'show_primary_contact' 
				),
				'encrypted' => false,
				'columnName' => 'show_primary_contact' 
			),
			array(
				'sql' => 'stripe_id',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'stripe_id' 
				),
				'encrypted' => false,
				'columnName' => 'stripe_id' 
			),
			array(
				'sql' => 'registration_confirmed',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'registration_confirmed' 
				),
				'encrypted' => false,
				'columnName' => 'registration_confirmed' 
			),
			array(
				'sql' => 'addedfrom',
				'parsed' => true,
				'type' => 'FieldListItem',
				'alias' => '',
				'expression' => array(
					'sql' => '',
					'parsed' => true,
					'type' => 'SQLField',
					'table' => 'tblclients',
					'name' => 'addedfrom' 
				),
				'encrypted' => false,
				'columnName' => 'addedfrom' 
			) 
		),
		'fromList' => array( 
			array(
				'sql' => 'tblclients',
				'parsed' => true,
				'type' => 'FromListItem',
				'table' => array(
					'sql' => 'tblclients',
					'parsed' => true,
					'type' => 'SQLTable',
					'columns' => array( 
						'userid',
						'company',
						'vat',
						'phonenumber',
						'country',
						'city',
						'zip',
						'state',
						'address',
						'website',
						'datecreated',
						'active',
						'leadid',
						'billing_street',
						'billing_city',
						'billing_state',
						'billing_zip',
						'billing_country',
						'shipping_street',
						'shipping_city',
						'shipping_state',
						'shipping_zip',
						'shipping_country',
						'longitude',
						'latitude',
						'default_language',
						'default_currency',
						'show_primary_contact',
						'stripe_id',
						'registration_confirmed',
						'addedfrom' 
					),
					'name' => 'tblclients' 
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
			),
			array(
				'fieldIndex' => 30,
				'orderByIndex' => -1,
				'groupByIndex' => -1,
				'whereIndex' => -1,
				'havingIndex' => -1 
			) 
		),
		'headSql' => 'SELECT',
		'fieldListSql' => 'userid,
	company,
	vat,
	phonenumber,
	country,
	city,
	zip,
	`state`,
	address,
	website,
	datecreated,
	active,
	leadid,
	billing_street,
	billing_city,
	billing_state,
	billing_zip,
	billing_country,
	shipping_street,
	shipping_city,
	shipping_state,
	shipping_zip,
	shipping_country,
	longitude,
	latitude,
	default_language,
	default_currency,
	show_primary_contact,
	stripe_id,
	registration_confirmed,
	addedfrom',
		'fromListSql' => 'FROM
	tblclients',
		'orderBySql' => '',
		'tailSql' => '' 
	),
	'originalTable' => 'tblclients',
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
			'userid',
			'company',
			'vat',
			'phonenumber',
			'country',
			'city',
			'zip',
			'state',
			'address',
			'website',
			'datecreated',
			'active',
			'leadid',
			'billing_street',
			'billing_city',
			'billing_state',
			'billing_zip',
			'billing_country',
			'shipping_street',
			'shipping_city',
			'shipping_state',
			'shipping_zip',
			'shipping_country',
			'longitude',
			'latitude',
			'default_language',
			'default_currency',
			'show_primary_contact',
			'stripe_id',
			'registration_confirmed',
			'addedfrom' 
		),
		'searchSuggest' => true,
		'highlightSearchResults' => true,
		'hideDataUntilSearch' => false,
		'hideFilterUntilSearch' => false,
		'googleLikeSearchFields' => array( 
			'userid',
			'company',
			'vat',
			'phonenumber',
			'country',
			'city',
			'zip',
			'state',
			'address',
			'website',
			'datecreated',
			'active',
			'leadid',
			'billing_street',
			'billing_city',
			'billing_state',
			'billing_zip',
			'billing_country',
			'shipping_street',
			'shipping_city',
			'shipping_state',
			'shipping_zip',
			'shipping_country',
			'longitude',
			'latitude',
			'default_language',
			'default_currency',
			'show_primary_contact',
			'stripe_id',
			'registration_confirmed',
			'addedfrom' 
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
	$runnerTableLabels['tblclients'] = array(
	'tableCaption' => 'MERQ Clients',
	'fieldLabels' => array(
		'userid' => 'Userid',
		'company' => 'Company',
		'vat' => 'VAT',
		'phonenumber' => 'Phone number',
		'country' => 'Country',
		'city' => 'City',
		'zip' => 'Zip',
		'state' => 'State',
		'address' => 'Address',
		'website' => 'Website',
		'datecreated' => 'Date Created',
		'active' => 'Active',
		'leadid' => 'Leadid',
		'billing_street' => 'Billing Street',
		'billing_city' => 'Billing City',
		'billing_state' => 'Billing State',
		'billing_zip' => 'Billing Zip',
		'billing_country' => 'Billing Country',
		'shipping_street' => 'Shipping Street',
		'shipping_city' => 'Shipping City',
		'shipping_state' => 'Shipping State',
		'shipping_zip' => 'Shipping Zip',
		'shipping_country' => 'Shipping Country',
		'longitude' => 'Longitude',
		'latitude' => 'Latitude',
		'default_language' => 'Default Language',
		'default_currency' => 'Default Currency',
		'show_primary_contact' => 'Show Primary Contact',
		'stripe_id' => 'Stripe Id',
		'registration_confirmed' => 'Registration Confirmed',
		'addedfrom' => 'Addedfrom' 
	),
	'fieldTooltips' => array(
		'userid' => '',
		'company' => '',
		'vat' => '',
		'phonenumber' => '',
		'country' => '',
		'city' => '',
		'zip' => '',
		'state' => '',
		'address' => '',
		'website' => '',
		'datecreated' => '',
		'active' => '',
		'leadid' => '',
		'billing_street' => '',
		'billing_city' => '',
		'billing_state' => '',
		'billing_zip' => '',
		'billing_country' => '',
		'shipping_street' => '',
		'shipping_city' => '',
		'shipping_state' => '',
		'shipping_zip' => '',
		'shipping_country' => '',
		'longitude' => '',
		'latitude' => '',
		'default_language' => '',
		'default_currency' => '',
		'show_primary_contact' => '',
		'stripe_id' => '',
		'registration_confirmed' => '',
		'addedfrom' => '' 
	),
	'fieldPlaceholders' => array(
		'userid' => '',
		'company' => '',
		'vat' => '',
		'phonenumber' => '',
		'country' => '',
		'city' => '',
		'zip' => '',
		'state' => '',
		'address' => '',
		'website' => '',
		'datecreated' => '',
		'active' => '',
		'leadid' => '',
		'billing_street' => '',
		'billing_city' => '',
		'billing_state' => '',
		'billing_zip' => '',
		'billing_country' => '',
		'shipping_street' => '',
		'shipping_city' => '',
		'shipping_state' => '',
		'shipping_zip' => '',
		'shipping_country' => '',
		'longitude' => '',
		'latitude' => '',
		'default_language' => '',
		'default_currency' => '',
		'show_primary_contact' => '',
		'stripe_id' => '',
		'registration_confirmed' => '',
		'addedfrom' => '' 
	),
	'pageTitles' => array(
		 
	) 
);
}
?>