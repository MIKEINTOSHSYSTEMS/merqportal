<?php
$runnerProjectSettings = array(
	'restAPIReturnEncodedBinary' => true,
	'restAPIAuthType' => 'basic',
	'menuIds' => array( 
		'main',
		'adminarea' 
	),
	'tablesAdvSecurity' => array(
		'mne_analysis_by_source' => array(
			'table' => 13186 
		),
		'mne_audit_log' => array(
			'table' => 13228 
		),
		'mne_budget_performance' => array(
			'table' => 13273 
		),
		'mne_business_opportunities' => array(
			'table' => 13309 
		),
		'mne_business_options' => array(
			'table' => 13444 
		),
		'mne_business_performance' => array(
			'table' => 13490 
		),
		'mne_client_options' => array(
			'table' => 13535 
		),
		'mne_client_satisfaction' => array(
			'table' => 13569 
		),
		'mne_currency_options' => array(
			'table' => 13623 
		),
		'mne_data_collection' => array(
			'table' => 13660 
		),
		'mne_data_methods' => array(
			'table' => 13852 
		),
		'mne_deliverable_status' => array(
			'table' => 13882 
		),
		'mne_delivery_metrics' => array(
			'table' => 13912 
		),
		'mne_executive_dashboard' => array(
			'table' => 13957 
		),
		'mne_extended_projects' => array(
			'table' => 14005 
		),
		'mne_financial_overview' => array(
			'table' => 14104 
		),
		'mne_indicator_matrix' => array(
			'table' => 14149 
		),
		'mne_knowledge_outputs' => array(
			'table' => 14215 
		),
		'mne_opportunity_metrics' => array(
			'table' => 14257 
		),
		'mne_partnership_options' => array(
			'table' => 14299 
		),
		'mne_partnerships' => array(
			'table' => 14329 
		),
		'mne_performance_alerts' => array(
			'table' => 14420 
		),
		'mne_performance_ratings' => array(
			'table' => 14468 
		),
		'mne_portfolio_snapshot' => array(
			'table' => 14498 
		),
		'mne_project_data_management' => array(
			'table' => 14534 
		),
		'mne_project_deliverables' => array(
			'table' => 14658 
		),
		'mne_project_details' => array(
			'table' => 14710 
		),
		'mne_project_financials' => array(
			'table' => 14773 
		),
		'mne_project_issues' => array(
			'table' => 14839 
		),
		'mne_project_leads' => array(
			'table' => 14881 
		),
		'mne_project_risks' => array(
			'table' => 14921 
		),
		'mne_project_timelines' => array(
			'table' => 14966 
		),
		'mne_project_type_options' => array(
			'table' => 15011 
		),
		'mne_project_updates' => array(
			'table' => 15041 
		),
		'mne_projects' => array(
			'table' => 15086 
		),
		'mne_publication_types' => array(
			'table' => 15238 
		),
		'mne_resource_options' => array(
			'table' => 15265 
		),
		'mne_risk_options' => array(
			'table' => 15295 
		),
		'mne_sector_options' => array(
			'table' => 15334 
		),
		'mne_status_options' => array(
			'table' => 15376 
		),
		'mne_system_config' => array(
			'table' => 15421 
		),
		'mne_win_loss_analysis' => array(
			'table' => 15460 
		),
		'mne_year_projects' => array(
			'table' => 15502 
		),
		'users' => array(
			'table' => 15553 
		),
		'mne_project_category' => array(
			'table' => 15751 
		),
		'mne_sector_category' => array(
			'table' => 15851 
		),
		'mne_deliverable_options' => array(
			'table' => 15996 
		),
		'mne_quality_status' => array(
			'table' => 16048 
		),
		'mne_generic_options' => array(
			'table' => 16073 
		),
		'mne_grantee_contracted_unit' => array(
			'table' => 16099 
		),
		'mne_imp_level_options' => array(
			'table' => 16146 
		),
		'mne_opportunity_sources' => array(
			'table' => 16178 
		),
		'mne_thematic_areas' => array(
			'table' => 16269 
		),
		'mne_data_sources' => array(
			'table' => 16306 
		),
		'mne_partner_types' => array(
			'table' => 16352 
		),
		'mne_engagement_level' => array(
			'table' => 16387 
		),
		'mne_status_indicators' => array(
			'table' => 16425 
		),
		'mne_budget_category' => array(
			'table' => 16501 
		),
		'mne_indicator_groups' => array(
			'table' => 16530 
		),
		'tblclients' => array(
			'table' => 16809 
		),
		'tblcountries' => array(
			'table' => 16917 
		),
		'tblcurrencies' => array(
			'table' => 16969 
		),
		'tblcurrency_rate_logs' => array(
			'table' => 17005 
		),
		'tblcurrency_rates' => array(
			'table' => 17044 
		),
		'admin_users' => array(
			'table' => 17563 
		),
		'merq__audit' => array(
			'table' => 17677 
		),
		'merq__locking' => array(
			'table' => 17714 
		),
		'positions' => array(
			'table' => 17765 
		),
		'departments' => array(
			'table' => 17807 
		),
		'tbldepartments' => array(
			'table' => 17855 
		),
		'tblstaff_departments' => array(
			'table' => 17912 
		),
		'tblhr_job_position' => array(
			'table' => 17936 
		) 
	),
	'userTableKeys' => array( 
		'user_id' 
	),
	'phpSpreadsheet' => false,
	'ext' => 'php',
	'security' => array(
		'projectName' => '',
		'loginDataSource' => 'users',
		'loginForm' => 0,
		'dynamicPermissions' => true,
		'dpTablePrefix' => 'merq_',
		'dpTableConnId' => 'conn',
		'providers' => array( 
			array(
				'type' => '%db',
				'name' => 'db',
				'active' => true,
				'label' => array(
					'text' => 'Database',
					'type' => 0 
				),
				'code' => '00',
				'table' => array(
					'connId' => 'conn',
					'table' => 'users' 
				),
				'usernameField' => 'username',
				'passwordField' => 'password_hash',
				'emailField' => 'email',
				'extUserIdField' => 'ext_security_id',
				'fullnameField' => 'full_name',
				'userpicField' => 'userpic',
				'activationField' => 'is_active',
				'resetTokenField' => 'reset_token',
				'resetDateField' => 'reset_date',
				'userGroupField' => 'username',
				'twoFactorField' => 'two_factor',
				'codeField' => 'totp',
				'phoneField' => 'phone' 
			),
			array(
				'scope' => 'openid profile email ',
				'nameClaim' => 'name',
				'emailClaim' => 'email',
				'logOut' => false,
				'type' => '%google',
				'name' => 'google',
				'active' => true,
				'label' => array(
					'text' => 'Google',
					'type' => 0 
				),
				'code' => 'go',
				'clientId' => '275218258195-ehd0ofm0b2kkvs1m1if95ag36i9q6hp2.apps.googleusercontent.com',
				'clientSecret' => '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',
				'domain' => 'merqconsultancy.org' 
			) 
		),
		'enabled' => true,
		'advancedSecurityAvailable' => true,
		'userGroupsAvailable' => true,
		'hardcodedLogin' => false,
		'defaultProviderCode' => '00',
		'adOnlyLogin' => false,
		'sessionControl' => array(
			'lifeTime' => 15,
			'sessionName' => '47ab6rh8hHMZCosQS0xv',
			'JWTSecret' => 'vjprsOqlAPsYvrdjHrIT',
			'forceExpire' => true,
			'keepAlive' => false,
			'warnExpire' => true 
		),
		'registration' => array(
			'remindMethod' => 1,
			'hashAlgorithm' => 0,
			'registerPage' => true,
			'remindPage' => true,
			'changePwdPage' => true,
			'notifyUser' => true,
			'sendActivationLink' => true,
			'notifyAdmin' => true,
			'adminEmail' => 'admin@merqconsultancy.org',
			'remindPasswordPage' => true,
			'changePasswordPage' => true,
			'hashPassword' => true,
			'passwordValidation' => array(
				'strong' => false,
				'minimumLength' => 8,
				'uniqueCharacters' => 4,
				'digitsAndSymbols' => 2,
				'upperAndLowerCase' => false 
			) 
		),
		'captchaSettings' => array(
			'captchaType' => 1,
			'siteKey' => '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
			'secretKey' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe',
			'passesCount' => 5 
		),
		'emailSettings' => array(
			'fromEmail' => 'internal@cloud.merqconsultancy.org',
			'usePHPDefinedSMTP' => false,
			'useBuiltInMailer' => false,
			'SMTPServer' => 'cloud.merqconsultancy.org',
			'SMTPPort' => 587,
			'SMTPUser' => 'internal@cloud.merqconsultancy.org',
			'SMTPPassword' => 'internal@merq',
			'securityProtocol' => 0 
		),
		'advancedSecurity' => array(
			'allowGuestLogin' => false 
		),
		'auditAndLocking' => array(
			'loggingMode' => 1,
			'loggingTable' => array(
				'connId' => 'conn',
				'table' => 'merq__audit' 
			),
			'loggingFile' => 'audit.log',
			'logSecurityActions' => true,
			'lockAfterUnsuccessfulLogin' => true,
			'enableLocking' => true,
			'lockingTable' => array(
				'connId' => 'conn',
				'table' => 'merq__locking' 
			),
			'tables' => array(
				'mne_analysis_by_source' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_audit_log' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_budget_performance' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_business_opportunities' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_business_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_business_performance' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_client_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_client_satisfaction' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_currency_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_data_collection' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_data_methods' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_deliverable_status' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_delivery_metrics' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_executive_dashboard' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_extended_projects' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_financial_overview' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_indicator_matrix' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_knowledge_outputs' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_opportunity_metrics' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_partnership_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_partnerships' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_performance_alerts' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_performance_ratings' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_portfolio_snapshot' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_project_data_management' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_project_deliverables' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_project_details' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_project_financials' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_project_issues' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_project_leads' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_project_risks' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_project_timelines' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_project_type_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_project_updates' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_projects' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_publication_types' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_resource_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_risk_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_sector_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_status_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_system_config' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_win_loss_analysis' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_year_projects' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'users' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_project_category' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_sector_category' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_deliverable_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_quality_status' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_generic_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_grantee_contracted_unit' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_imp_level_options' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_opportunity_sources' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_thematic_areas' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_data_sources' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_partner_types' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_engagement_level' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_status_indicators' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_budget_category' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'mne_indicator_groups' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'tblclients' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'tblcountries' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'tblcurrencies' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'tblcurrency_rate_logs' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'tblcurrency_rates' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				),
				'admin_users' => array(
					'logModifications' => true,
					'logFieldValues' => true 
				) 
			) 
		),
		'twoFactorSettings' => array(
			'available' => true,
			'required' => false,
			'enable' => true,
			'remember' => true,
			'types' => array(
				'totp' => true,
				'email' => true 
			),
			'twoFactorField' => 'two_factor',
			'emailField' => 'email',
			'phoneField' => 'phone',
			'codeField' => 'totp',
			'projectName' => 'MERQ Portal' 
		),
		'staticPermissions' => array(
			'groups' => array(
				'<Default>' => array(
					'permissions' => array(
						'mne_analysis_by_source' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_analysis_by_source',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_audit_log' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_audit_log',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_budget_performance' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_budget_performance',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_business_opportunities' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_business_opportunities',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_business_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_business_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_business_performance' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_business_performance',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_client_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_client_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_client_satisfaction' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_client_satisfaction',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_currency_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_currency_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_data_collection' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_data_collection',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_data_methods' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_data_methods',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_deliverable_status' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_deliverable_status',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_delivery_metrics' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_delivery_metrics',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_executive_dashboard' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_executive_dashboard',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_extended_projects' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_extended_projects',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_financial_overview' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_financial_overview',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_indicator_matrix' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_indicator_matrix',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_knowledge_outputs' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_knowledge_outputs',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_opportunity_metrics' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_opportunity_metrics',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_partnership_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_partnership_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_partnerships' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_partnerships',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_performance_alerts' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_performance_alerts',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_performance_ratings' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_performance_ratings',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_portfolio_snapshot' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_portfolio_snapshot',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_project_data_management' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_project_data_management',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_project_deliverables' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_project_deliverables',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_project_details' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_project_details',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_project_financials' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_project_financials',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_project_issues' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_project_issues',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_project_leads' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_project_leads',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_project_risks' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_project_risks',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_project_timelines' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_project_timelines',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_project_type_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_project_type_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_project_updates' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_project_updates',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_projects' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_projects',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_publication_types' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_publication_types',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_resource_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_resource_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_risk_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_risk_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_sector_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_sector_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_status_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_status_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_system_config' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_system_config',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_win_loss_analysis' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_win_loss_analysis',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_year_projects' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_year_projects',
							'restrictedPages' => array(
								 
							) 
						),
						'users' => array(
							'mask' => 'ADESPI',
							'table' => 'users',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_project_category' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_project_category',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_sector_category' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_sector_category',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_deliverable_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_deliverable_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_quality_status' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_quality_status',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_generic_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_generic_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_grantee_contracted_unit' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_grantee_contracted_unit',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_imp_level_options' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_imp_level_options',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_opportunity_sources' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_opportunity_sources',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_thematic_areas' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_thematic_areas',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_data_sources' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_data_sources',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_partner_types' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_partner_types',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_engagement_level' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_engagement_level',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_status_indicators' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_status_indicators',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_budget_category' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_budget_category',
							'restrictedPages' => array(
								 
							) 
						),
						'mne_indicator_groups' => array(
							'mask' => 'ADESPI',
							'table' => 'mne_indicator_groups',
							'restrictedPages' => array(
								 
							) 
						),
						'tblclients' => array(
							'mask' => 'ADESPI',
							'table' => 'tblclients',
							'restrictedPages' => array(
								 
							) 
						),
						'tblcountries' => array(
							'mask' => 'ADESPI',
							'table' => 'tblcountries',
							'restrictedPages' => array(
								 
							) 
						),
						'tblcurrencies' => array(
							'mask' => 'ADESPI',
							'table' => 'tblcurrencies',
							'restrictedPages' => array(
								 
							) 
						),
						'tblcurrency_rate_logs' => array(
							'mask' => 'ADESPI',
							'table' => 'tblcurrency_rate_logs',
							'restrictedPages' => array(
								 
							) 
						),
						'tblcurrency_rates' => array(
							'mask' => 'ADESPI',
							'table' => 'tblcurrency_rates',
							'restrictedPages' => array(
								 
							) 
						),
						'<global>' => array(
							'mask' => 'ADESPI',
							'table' => '<global>',
							'restrictedPages' => array(
								 
							) 
						) 
					),
					'admin' => false,
					'username' => '<Default>' 
				) 
			) 
		),
		'dbProvider' => array(
			'type' => '%db',
			'name' => 'db',
			'active' => true,
			'label' => array(
				'text' => 'Database',
				'type' => 0 
			),
			'code' => '00',
			'table' => array(
				'connId' => 'conn',
				'table' => 'users' 
			),
			'usernameField' => 'username',
			'passwordField' => 'password_hash',
			'emailField' => 'email',
			'extUserIdField' => 'ext_security_id',
			'fullnameField' => 'full_name',
			'userpicField' => 'userpic',
			'activationField' => 'is_active',
			'resetTokenField' => 'reset_token',
			'resetDateField' => 'reset_date',
			'userGroupField' => 'username',
			'twoFactorField' => 'two_factor',
			'codeField' => 'totp',
			'phoneField' => 'phone' 
		),
		'adAdminGroups' => array( 
			 
		),
		'showUserSource' => true,
		'dbProviderCodes' => array( 
			'00',
			'go' 
		) 
	),
	'notifications' => array(
		'enabled' => false,
		'table' => array(
			'connId' => '',
			'table' => '' 
		) 
	),
	'allTables' => array(
		'mne_analysis_by_source' => array(
			'gid' => 13186,
			'name' => 'mne_analysis_by_source',
			'shortName' => 'mne_analysis_by_source',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Analysis By Source' 
			),
			'connId' => 'conn',
			'color' => 'e67349',
			'originalTable' => 'mne_analysis_by_source' 
		),
		'mne_audit_log' => array(
			'gid' => 13228,
			'name' => 'mne_audit_log',
			'shortName' => 'mne_audit_log',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Audit Log' 
			),
			'connId' => 'conn',
			'color' => '7b68ee',
			'originalTable' => 'mne_audit_log' 
		),
		'mne_budget_performance' => array(
			'gid' => 13273,
			'name' => 'mne_budget_performance',
			'shortName' => 'mne_budget_performance',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Budget Performance' 
			),
			'connId' => 'conn',
			'color' => '8fbc8b',
			'originalTable' => 'mne_budget_performance' 
		),
		'mne_business_opportunities' => array(
			'gid' => 13309,
			'name' => 'mne_business_opportunities',
			'shortName' => 'mne_business_opportunities',
			'type' => 0,
			'caption' => array(
				'English' => 'Business Opportunities' 
			),
			'connId' => 'conn',
			'color' => 'dc143c',
			'originalTable' => 'mne_business_opportunities' 
		),
		'mne_business_options' => array(
			'gid' => 13444,
			'name' => 'mne_business_options',
			'shortName' => 'mne_business_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Business Options' 
			),
			'connId' => 'conn',
			'color' => 'cd853f',
			'originalTable' => 'mne_business_options' 
		),
		'mne_business_performance' => array(
			'gid' => 13490,
			'name' => 'mne_business_performance',
			'shortName' => 'mne_business_performance',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Business Performance' 
			),
			'connId' => 'conn',
			'color' => '778899',
			'originalTable' => 'mne_business_performance' 
		),
		'mne_client_options' => array(
			'gid' => 13535,
			'name' => 'mne_client_options',
			'shortName' => 'mne_client_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Client Options' 
			),
			'connId' => 'conn',
			'color' => 'b22222',
			'originalTable' => 'mne_client_options' 
		),
		'mne_client_satisfaction' => array(
			'gid' => 13569,
			'name' => 'mne_client_satisfaction',
			'shortName' => 'mne_client_satisfaction',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Client Satisfaction' 
			),
			'connId' => 'conn',
			'color' => '6b8e23',
			'originalTable' => 'mne_client_satisfaction' 
		),
		'mne_currency_options' => array(
			'gid' => 13623,
			'name' => 'mne_currency_options',
			'shortName' => 'mne_currency_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Currency Options' 
			),
			'connId' => 'conn',
			'color' => 'd2af80',
			'originalTable' => 'mne_currency_options' 
		),
		'mne_data_collection' => array(
			'gid' => 13660,
			'name' => 'mne_data_collection',
			'shortName' => 'mne_data_collection',
			'type' => 0,
			'caption' => array(
				'English' => 'Data Collection' 
			),
			'connId' => 'conn',
			'color' => 'bc8f8f',
			'originalTable' => 'mne_data_collection' 
		),
		'mne_data_methods' => array(
			'gid' => 13852,
			'name' => 'mne_data_methods',
			'shortName' => 'mne_data_methods',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Data Methods' 
			),
			'connId' => 'conn',
			'color' => 'cfae83',
			'originalTable' => 'mne_data_methods' 
		),
		'mne_deliverable_status' => array(
			'gid' => 13882,
			'name' => 'mne_deliverable_status',
			'shortName' => 'mne_deliverable_status',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Deliverable Status' 
			),
			'connId' => 'conn',
			'color' => '2f4f4f',
			'originalTable' => 'mne_deliverable_status' 
		),
		'mne_delivery_metrics' => array(
			'gid' => 13912,
			'name' => 'mne_delivery_metrics',
			'shortName' => 'mne_delivery_metrics',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Delivery Metrics' 
			),
			'connId' => 'conn',
			'color' => '00c2c5',
			'originalTable' => 'mne_delivery_metrics' 
		),
		'mne_executive_dashboard' => array(
			'gid' => 13957,
			'name' => 'mne_executive_dashboard',
			'shortName' => 'mne_executive_dashboard',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Executive Dashboard' 
			),
			'connId' => 'conn',
			'color' => '8fbc8b',
			'originalTable' => 'mne_executive_dashboard' 
		),
		'mne_extended_projects' => array(
			'gid' => 14005,
			'name' => 'mne_extended_projects',
			'shortName' => 'mne_extended_projects',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Extended Projects' 
			),
			'connId' => 'conn',
			'color' => '6b8e23',
			'originalTable' => 'mne_extended_projects' 
		),
		'mne_financial_overview' => array(
			'gid' => 14104,
			'name' => 'mne_financial_overview',
			'shortName' => 'mne_financial_overview',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Financial Overview' 
			),
			'connId' => 'conn',
			'color' => '00c2c5',
			'originalTable' => 'mne_financial_overview' 
		),
		'mne_indicator_matrix' => array(
			'gid' => 14149,
			'name' => 'mne_indicator_matrix',
			'shortName' => 'mne_indicator_matrix',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Indicator Matrix' 
			),
			'connId' => 'conn',
			'color' => '9e36ff',
			'originalTable' => 'mne_indicator_matrix' 
		),
		'mne_knowledge_outputs' => array(
			'gid' => 14215,
			'name' => 'mne_knowledge_outputs',
			'shortName' => 'mne_knowledge_outputs',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Knowledge Outputs' 
			),
			'connId' => 'conn',
			'color' => 'b22222',
			'originalTable' => 'mne_knowledge_outputs' 
		),
		'mne_opportunity_metrics' => array(
			'gid' => 14257,
			'name' => 'mne_opportunity_metrics',
			'shortName' => 'mne_opportunity_metrics',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Opportunity Metrics' 
			),
			'connId' => 'conn',
			'color' => 'e07878',
			'originalTable' => 'mne_opportunity_metrics' 
		),
		'mne_partnership_options' => array(
			'gid' => 14299,
			'name' => 'mne_partnership_options',
			'shortName' => 'mne_partnership_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Partnership Options' 
			),
			'connId' => 'conn',
			'color' => 'b22222',
			'originalTable' => 'mne_partnership_options' 
		),
		'mne_partnerships' => array(
			'gid' => 14329,
			'name' => 'mne_partnerships',
			'shortName' => 'mne_partnerships',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Partnerships' 
			),
			'connId' => 'conn',
			'color' => '8fbc8b',
			'originalTable' => 'mne_partnerships' 
		),
		'mne_performance_alerts' => array(
			'gid' => 14420,
			'name' => 'mne_performance_alerts',
			'shortName' => 'mne_performance_alerts',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Performance Alerts' 
			),
			'connId' => 'conn',
			'color' => '4682b4',
			'originalTable' => 'mne_performance_alerts' 
		),
		'mne_performance_ratings' => array(
			'gid' => 14468,
			'name' => 'mne_performance_ratings',
			'shortName' => 'mne_performance_ratings',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Performance Ratings' 
			),
			'connId' => 'conn',
			'color' => '8fbc8b',
			'originalTable' => 'mne_performance_ratings' 
		),
		'mne_portfolio_snapshot' => array(
			'gid' => 14498,
			'name' => 'mne_portfolio_snapshot',
			'shortName' => 'mne_portfolio_snapshot',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Portfolio Snapshot' 
			),
			'connId' => 'conn',
			'color' => 'daa520',
			'originalTable' => 'mne_portfolio_snapshot' 
		),
		'mne_project_data_management' => array(
			'gid' => 14534,
			'name' => 'mne_project_data_management',
			'shortName' => 'mne_project_data_management',
			'type' => 0,
			'caption' => array(
				'English' => 'Project Data Management' 
			),
			'connId' => 'conn',
			'color' => '00c2c5',
			'originalTable' => 'mne_project_data_management' 
		),
		'mne_project_deliverables' => array(
			'gid' => 14658,
			'name' => 'mne_project_deliverables',
			'shortName' => 'mne_project_deliverables',
			'type' => 0,
			'caption' => array(
				'English' => 'Project Deliverables' 
			),
			'connId' => 'conn',
			'color' => 'ff9c00',
			'originalTable' => 'mne_project_deliverables' 
		),
		'mne_project_details' => array(
			'gid' => 14710,
			'name' => 'mne_project_details',
			'shortName' => 'mne_project_details',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Project Details' 
			),
			'connId' => 'conn',
			'color' => 'bc8f8f',
			'originalTable' => 'mne_project_details' 
		),
		'mne_project_financials' => array(
			'gid' => 14773,
			'name' => 'mne_project_financials',
			'shortName' => 'mne_project_financials',
			'type' => 0,
			'caption' => array(
				'English' => 'Project Financials' 
			),
			'connId' => 'conn',
			'color' => 'd2691e',
			'originalTable' => 'mne_project_financials' 
		),
		'mne_project_issues' => array(
			'gid' => 14839,
			'name' => 'mne_project_issues',
			'shortName' => 'mne_project_issues',
			'type' => 0,
			'caption' => array(
				'English' => 'Project Issues' 
			),
			'connId' => 'conn',
			'color' => '5f9ea0',
			'originalTable' => 'mne_project_issues' 
		),
		'mne_project_leads' => array(
			'gid' => 14881,
			'name' => 'mne_project_leads',
			'shortName' => 'mne_project_leads',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Project Leads' 
			),
			'connId' => 'conn',
			'color' => '4169e1',
			'originalTable' => 'mne_project_leads' 
		),
		'mne_project_risks' => array(
			'gid' => 14921,
			'name' => 'mne_project_risks',
			'shortName' => 'mne_project_risks',
			'type' => 0,
			'caption' => array(
				'English' => 'Project Risks' 
			),
			'connId' => 'conn',
			'color' => 'd2af80',
			'originalTable' => 'mne_project_risks' 
		),
		'mne_project_timelines' => array(
			'gid' => 14966,
			'name' => 'mne_project_timelines',
			'shortName' => 'mne_project_timelines',
			'type' => 0,
			'caption' => array(
				'English' => 'Milestone / Timelines' 
			),
			'connId' => 'conn',
			'color' => '6b8e23',
			'originalTable' => 'mne_project_timelines' 
		),
		'mne_project_type_options' => array(
			'gid' => 15011,
			'name' => 'mne_project_type_options',
			'shortName' => 'mne_project_type_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Project Type Options' 
			),
			'connId' => 'conn',
			'color' => '000',
			'originalTable' => 'mne_project_type_options' 
		),
		'mne_project_updates' => array(
			'gid' => 15041,
			'name' => 'mne_project_updates',
			'shortName' => 'mne_project_updates',
			'type' => 0,
			'caption' => array(
				'English' => 'Project Updates' 
			),
			'connId' => 'conn',
			'color' => '778899',
			'originalTable' => 'mne_project_updates' 
		),
		'mne_projects' => array(
			'gid' => 15086,
			'name' => 'mne_projects',
			'shortName' => 'mne_projects',
			'type' => 0,
			'caption' => array(
				'English' => 'MERQ Projects' 
			),
			'connId' => 'conn',
			'color' => '000',
			'originalTable' => 'mne_projects' 
		),
		'mne_publication_types' => array(
			'gid' => 15238,
			'name' => 'mne_publication_types',
			'shortName' => 'mne_publication_types',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Publication Types' 
			),
			'connId' => 'conn',
			'color' => '3cb371',
			'originalTable' => 'mne_publication_types' 
		),
		'mne_resource_options' => array(
			'gid' => 15265,
			'name' => 'mne_resource_options',
			'shortName' => 'mne_resource_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Resource Options' 
			),
			'connId' => 'conn',
			'color' => 'b22222',
			'originalTable' => 'mne_resource_options' 
		),
		'mne_risk_options' => array(
			'gid' => 15295,
			'name' => 'mne_risk_options',
			'shortName' => 'mne_risk_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Risk Options' 
			),
			'connId' => 'conn',
			'color' => 'dc143c',
			'originalTable' => 'mne_risk_options' 
		),
		'mne_sector_options' => array(
			'gid' => 15334,
			'name' => 'mne_sector_options',
			'shortName' => 'mne_sector_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Sector Options' 
			),
			'connId' => 'conn',
			'color' => '757bff',
			'originalTable' => 'mne_sector_options' 
		),
		'mne_status_options' => array(
			'gid' => 15376,
			'name' => 'mne_status_options',
			'shortName' => 'mne_status_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Status Options' 
			),
			'connId' => 'conn',
			'color' => 'cd5c5c',
			'originalTable' => 'mne_status_options' 
		),
		'mne_system_config' => array(
			'gid' => 15421,
			'name' => 'mne_system_config',
			'shortName' => 'mne_system_config',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne System Config' 
			),
			'connId' => 'conn',
			'color' => 'cd5c5c',
			'originalTable' => 'mne_system_config' 
		),
		'mne_win_loss_analysis' => array(
			'gid' => 15460,
			'name' => 'mne_win_loss_analysis',
			'shortName' => 'mne_win_loss_analysis',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Win Loss Analysis' 
			),
			'connId' => 'conn',
			'color' => '6493ea',
			'originalTable' => 'mne_win_loss_analysis' 
		),
		'mne_year_projects' => array(
			'gid' => 15502,
			'name' => 'mne_year_projects',
			'shortName' => 'mne_year_projects',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Year Projects' 
			),
			'connId' => 'conn',
			'color' => 'edca00',
			'originalTable' => 'mne_year_projects' 
		),
		'users' => array(
			'gid' => 15553,
			'name' => 'users',
			'shortName' => 'users',
			'type' => 0,
			'caption' => array(
				'English' => 'Users' 
			),
			'connId' => 'conn',
			'color' => '5f9ea0',
			'originalTable' => 'users' 
		),
		'mne_project_category' => array(
			'gid' => 15751,
			'name' => 'mne_project_category',
			'shortName' => 'mne_project_category',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Project Category' 
			),
			'connId' => 'conn',
			'color' => '008b8b',
			'originalTable' => 'mne_project_category' 
		),
		'mne_sector_category' => array(
			'gid' => 15851,
			'name' => 'mne_sector_category',
			'shortName' => 'mne_sector_category',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Sector Category' 
			),
			'connId' => 'conn',
			'color' => '2f4f4f',
			'originalTable' => 'mne_sector_category' 
		),
		'mne_deliverable_options' => array(
			'gid' => 15996,
			'name' => 'mne_deliverable_options',
			'shortName' => 'mne_deliverable_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Deliverable Options' 
			),
			'connId' => 'conn',
			'color' => '6493ea',
			'originalTable' => 'mne_deliverable_options' 
		),
		'mne_quality_status' => array(
			'gid' => 16048,
			'name' => 'mne_quality_status',
			'shortName' => 'mne_quality_status',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Quality Status' 
			),
			'connId' => 'conn',
			'color' => '6493ea',
			'originalTable' => 'mne_quality_status' 
		),
		'mne_generic_options' => array(
			'gid' => 16073,
			'name' => 'mne_generic_options',
			'shortName' => 'mne_generic_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Generic Options' 
			),
			'connId' => 'conn',
			'color' => '4682b4',
			'originalTable' => 'mne_generic_options' 
		),
		'mne_grantee_contracted_unit' => array(
			'gid' => 16099,
			'name' => 'mne_grantee_contracted_unit',
			'shortName' => 'mne_grantee_contracted_unit',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Grantee Contracted Unit' 
			),
			'connId' => 'conn',
			'color' => 'daa520',
			'originalTable' => 'mne_grantee_contracted_unit' 
		),
		'mne_imp_level_options' => array(
			'gid' => 16146,
			'name' => 'mne_imp_level_options',
			'shortName' => 'mne_imp_level_options',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Imp Level Options' 
			),
			'connId' => 'conn',
			'color' => 'e67349',
			'originalTable' => 'mne_imp_level_options' 
		),
		'mne_opportunity_sources' => array(
			'gid' => 16178,
			'name' => 'mne_opportunity_sources',
			'shortName' => 'mne_opportunity_sources',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Opportunity Sources' 
			),
			'connId' => 'conn',
			'color' => 'd2691e',
			'originalTable' => 'mne_opportunity_sources' 
		),
		'mne_thematic_areas' => array(
			'gid' => 16269,
			'name' => 'mne_thematic_areas',
			'shortName' => 'mne_thematic_areas',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Thematic Areas' 
			),
			'connId' => 'conn',
			'color' => 'edca00',
			'originalTable' => 'mne_thematic_areas' 
		),
		'mne_data_sources' => array(
			'gid' => 16306,
			'name' => 'mne_data_sources',
			'shortName' => 'mne_data_sources',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Data Sources' 
			),
			'connId' => 'conn',
			'color' => 'edca00',
			'originalTable' => 'mne_data_sources' 
		),
		'mne_partner_types' => array(
			'gid' => 16352,
			'name' => 'mne_partner_types',
			'shortName' => 'mne_partner_types',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Partner Types' 
			),
			'connId' => 'conn',
			'color' => '6493ea',
			'originalTable' => 'mne_partner_types' 
		),
		'mne_engagement_level' => array(
			'gid' => 16387,
			'name' => 'mne_engagement_level',
			'shortName' => 'mne_engagement_level',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Engagement Level' 
			),
			'connId' => 'conn',
			'color' => '778899',
			'originalTable' => 'mne_engagement_level' 
		),
		'mne_status_indicators' => array(
			'gid' => 16425,
			'name' => 'mne_status_indicators',
			'shortName' => 'mne_status_indicators',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Status Indicators' 
			),
			'connId' => 'conn',
			'color' => '008b8b',
			'originalTable' => 'mne_status_indicators' 
		),
		'mne_budget_category' => array(
			'gid' => 16501,
			'name' => 'mne_budget_category',
			'shortName' => 'mne_budget_category',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Budget Category' 
			),
			'connId' => 'conn',
			'color' => 'daa520',
			'originalTable' => 'mne_budget_category' 
		),
		'mne_indicator_groups' => array(
			'gid' => 16530,
			'name' => 'mne_indicator_groups',
			'shortName' => 'mne_indicator_groups',
			'type' => 0,
			'caption' => array(
				'English' => 'Mne Indicator Groups' 
			),
			'connId' => 'conn',
			'color' => 'edca00',
			'originalTable' => 'mne_indicator_groups' 
		),
		'tblclients' => array(
			'gid' => 16809,
			'name' => 'tblclients',
			'shortName' => 'tblclients',
			'type' => 0,
			'caption' => array(
				'English' => 'MERQ Clients' 
			),
			'connId' => 'conn',
			'color' => '2f4f4f',
			'originalTable' => 'tblclients' 
		),
		'tblcountries' => array(
			'gid' => 16917,
			'name' => 'tblcountries',
			'shortName' => 'tblcountries',
			'type' => 0,
			'caption' => array(
				'English' => 'Tblcountries' 
			),
			'connId' => 'conn',
			'color' => '5f9ea0',
			'originalTable' => 'tblcountries' 
		),
		'tblcurrencies' => array(
			'gid' => 16969,
			'name' => 'tblcurrencies',
			'shortName' => 'tblcurrencies',
			'type' => 0,
			'caption' => array(
				'English' => 'Tblcurrencies' 
			),
			'connId' => 'conn',
			'color' => '1e90ff',
			'originalTable' => 'tblcurrencies' 
		),
		'tblcurrency_rate_logs' => array(
			'gid' => 17005,
			'name' => 'tblcurrency_rate_logs',
			'shortName' => 'tblcurrency_rate_logs',
			'type' => 0,
			'caption' => array(
				'English' => 'Tblcurrency Rate Logs' 
			),
			'connId' => 'conn',
			'color' => 'cfae83',
			'originalTable' => 'tblcurrency_rate_logs' 
		),
		'tblcurrency_rates' => array(
			'gid' => 17044,
			'name' => 'tblcurrency_rates',
			'shortName' => 'tblcurrency_rates',
			'type' => 0,
			'caption' => array(
				'English' => 'Tblcurrency Rates' 
			),
			'connId' => 'conn',
			'color' => '1e90ff',
			'originalTable' => 'tblcurrency_rates' 
		),
		'admin_users' => array(
			'gid' => 17563,
			'name' => 'admin_users',
			'shortName' => 'admin_users',
			'type' => 1,
			'caption' => array(
				'English' => 'Admin Users' 
			),
			'connId' => 'conn',
			'color' => '3cb371',
			'originalTable' => 'users' 
		),
		'merq__audit' => array(
			'gid' => 17677,
			'name' => 'merq__audit',
			'shortName' => 'merq__audit',
			'type' => 0,
			'caption' => array(
				'English' => 'Merq Audit' 
			),
			'connId' => 'conn',
			'color' => 'bc8f8f',
			'originalTable' => 'merq__audit' 
		),
		'merq__locking' => array(
			'gid' => 17714,
			'name' => 'merq__locking',
			'shortName' => 'merq__locking',
			'type' => 0,
			'caption' => array(
				'English' => 'Merq Locking' 
			),
			'connId' => 'conn',
			'color' => 'dc143c',
			'originalTable' => 'merq__locking' 
		),
		'positions' => array(
			'gid' => 17765,
			'name' => 'positions',
			'shortName' => 'positions',
			'type' => 0,
			'caption' => array(
				'English' => 'Positions' 
			),
			'connId' => 'conn',
			'color' => 'cd853f',
			'originalTable' => 'positions' 
		),
		'departments' => array(
			'gid' => 17807,
			'name' => 'departments',
			'shortName' => 'departments',
			'type' => 0,
			'caption' => array(
				'English' => 'Departments' 
			),
			'connId' => 'conn',
			'color' => '9acd32',
			'originalTable' => 'departments' 
		),
		'tbldepartments' => array(
			'gid' => 17855,
			'name' => 'tbldepartments',
			'shortName' => 'tbldepartments',
			'type' => 0,
			'caption' => array(
				'English' => 'Tbldepartments' 
			),
			'connId' => 'conn',
			'color' => 'e67349',
			'originalTable' => 'tbldepartments' 
		),
		'tblstaff_departments' => array(
			'gid' => 17912,
			'name' => 'tblstaff_departments',
			'shortName' => 'tblstaff_departments',
			'type' => 0,
			'caption' => array(
				'English' => 'Tblstaff Departments' 
			),
			'connId' => 'conn',
			'color' => 'cd853f',
			'originalTable' => 'tblstaff_departments' 
		),
		'tblhr_job_position' => array(
			'gid' => 17936,
			'name' => 'tblhr_job_position',
			'shortName' => 'tblhr_job_position',
			'type' => 0,
			'caption' => array(
				'English' => 'Tblhr Job Position' 
			),
			'connId' => 'conn',
			'color' => 'dc143c',
			'originalTable' => 'tblhr_job_position' 
		) 
	),
	'tablesByShort' => array(
		'mne_analysis_by_source' => 'mne_analysis_by_source',
		'mne_audit_log' => 'mne_audit_log',
		'mne_budget_performance' => 'mne_budget_performance',
		'mne_business_opportunities' => 'mne_business_opportunities',
		'mne_business_options' => 'mne_business_options',
		'mne_business_performance' => 'mne_business_performance',
		'mne_client_options' => 'mne_client_options',
		'mne_client_satisfaction' => 'mne_client_satisfaction',
		'mne_currency_options' => 'mne_currency_options',
		'mne_data_collection' => 'mne_data_collection',
		'mne_data_methods' => 'mne_data_methods',
		'mne_deliverable_status' => 'mne_deliverable_status',
		'mne_delivery_metrics' => 'mne_delivery_metrics',
		'mne_executive_dashboard' => 'mne_executive_dashboard',
		'mne_extended_projects' => 'mne_extended_projects',
		'mne_financial_overview' => 'mne_financial_overview',
		'mne_indicator_matrix' => 'mne_indicator_matrix',
		'mne_knowledge_outputs' => 'mne_knowledge_outputs',
		'mne_opportunity_metrics' => 'mne_opportunity_metrics',
		'mne_partnership_options' => 'mne_partnership_options',
		'mne_partnerships' => 'mne_partnerships',
		'mne_performance_alerts' => 'mne_performance_alerts',
		'mne_performance_ratings' => 'mne_performance_ratings',
		'mne_portfolio_snapshot' => 'mne_portfolio_snapshot',
		'mne_project_data_management' => 'mne_project_data_management',
		'mne_project_deliverables' => 'mne_project_deliverables',
		'mne_project_details' => 'mne_project_details',
		'mne_project_financials' => 'mne_project_financials',
		'mne_project_issues' => 'mne_project_issues',
		'mne_project_leads' => 'mne_project_leads',
		'mne_project_risks' => 'mne_project_risks',
		'mne_project_timelines' => 'mne_project_timelines',
		'mne_project_type_options' => 'mne_project_type_options',
		'mne_project_updates' => 'mne_project_updates',
		'mne_projects' => 'mne_projects',
		'mne_publication_types' => 'mne_publication_types',
		'mne_resource_options' => 'mne_resource_options',
		'mne_risk_options' => 'mne_risk_options',
		'mne_sector_options' => 'mne_sector_options',
		'mne_status_options' => 'mne_status_options',
		'mne_system_config' => 'mne_system_config',
		'mne_win_loss_analysis' => 'mne_win_loss_analysis',
		'mne_year_projects' => 'mne_year_projects',
		'users' => 'users',
		'mne_project_category' => 'mne_project_category',
		'mne_sector_category' => 'mne_sector_category',
		'mne_deliverable_options' => 'mne_deliverable_options',
		'mne_quality_status' => 'mne_quality_status',
		'mne_generic_options' => 'mne_generic_options',
		'mne_grantee_contracted_unit' => 'mne_grantee_contracted_unit',
		'mne_imp_level_options' => 'mne_imp_level_options',
		'mne_opportunity_sources' => 'mne_opportunity_sources',
		'mne_thematic_areas' => 'mne_thematic_areas',
		'mne_data_sources' => 'mne_data_sources',
		'mne_partner_types' => 'mne_partner_types',
		'mne_engagement_level' => 'mne_engagement_level',
		'mne_status_indicators' => 'mne_status_indicators',
		'mne_budget_category' => 'mne_budget_category',
		'mne_indicator_groups' => 'mne_indicator_groups',
		'tblclients' => 'tblclients',
		'tblcountries' => 'tblcountries',
		'tblcurrencies' => 'tblcurrencies',
		'tblcurrency_rate_logs' => 'tblcurrency_rate_logs',
		'tblcurrency_rates' => 'tblcurrency_rates',
		'admin_users' => 'admin_users',
		'merq__audit' => 'merq__audit',
		'merq__locking' => 'merq__locking',
		'positions' => 'positions',
		'departments' => 'departments',
		'tbldepartments' => 'tbldepartments',
		'tblstaff_departments' => 'tblstaff_departments',
		'tblhr_job_position' => 'tblhr_job_position' 
	),
	'tablesByGood' => array(
		'mne_analysis_by_source' => 'mne_analysis_by_source',
		'mne_audit_log' => 'mne_audit_log',
		'mne_budget_performance' => 'mne_budget_performance',
		'mne_business_opportunities' => 'mne_business_opportunities',
		'mne_business_options' => 'mne_business_options',
		'mne_business_performance' => 'mne_business_performance',
		'mne_client_options' => 'mne_client_options',
		'mne_client_satisfaction' => 'mne_client_satisfaction',
		'mne_currency_options' => 'mne_currency_options',
		'mne_data_collection' => 'mne_data_collection',
		'mne_data_methods' => 'mne_data_methods',
		'mne_deliverable_status' => 'mne_deliverable_status',
		'mne_delivery_metrics' => 'mne_delivery_metrics',
		'mne_executive_dashboard' => 'mne_executive_dashboard',
		'mne_extended_projects' => 'mne_extended_projects',
		'mne_financial_overview' => 'mne_financial_overview',
		'mne_indicator_matrix' => 'mne_indicator_matrix',
		'mne_knowledge_outputs' => 'mne_knowledge_outputs',
		'mne_opportunity_metrics' => 'mne_opportunity_metrics',
		'mne_partnership_options' => 'mne_partnership_options',
		'mne_partnerships' => 'mne_partnerships',
		'mne_performance_alerts' => 'mne_performance_alerts',
		'mne_performance_ratings' => 'mne_performance_ratings',
		'mne_portfolio_snapshot' => 'mne_portfolio_snapshot',
		'mne_project_data_management' => 'mne_project_data_management',
		'mne_project_deliverables' => 'mne_project_deliverables',
		'mne_project_details' => 'mne_project_details',
		'mne_project_financials' => 'mne_project_financials',
		'mne_project_issues' => 'mne_project_issues',
		'mne_project_leads' => 'mne_project_leads',
		'mne_project_risks' => 'mne_project_risks',
		'mne_project_timelines' => 'mne_project_timelines',
		'mne_project_type_options' => 'mne_project_type_options',
		'mne_project_updates' => 'mne_project_updates',
		'mne_projects' => 'mne_projects',
		'mne_publication_types' => 'mne_publication_types',
		'mne_resource_options' => 'mne_resource_options',
		'mne_risk_options' => 'mne_risk_options',
		'mne_sector_options' => 'mne_sector_options',
		'mne_status_options' => 'mne_status_options',
		'mne_system_config' => 'mne_system_config',
		'mne_win_loss_analysis' => 'mne_win_loss_analysis',
		'mne_year_projects' => 'mne_year_projects',
		'users' => 'users',
		'mne_project_category' => 'mne_project_category',
		'mne_sector_category' => 'mne_sector_category',
		'mne_deliverable_options' => 'mne_deliverable_options',
		'mne_quality_status' => 'mne_quality_status',
		'mne_generic_options' => 'mne_generic_options',
		'mne_grantee_contracted_unit' => 'mne_grantee_contracted_unit',
		'mne_imp_level_options' => 'mne_imp_level_options',
		'mne_opportunity_sources' => 'mne_opportunity_sources',
		'mne_thematic_areas' => 'mne_thematic_areas',
		'mne_data_sources' => 'mne_data_sources',
		'mne_partner_types' => 'mne_partner_types',
		'mne_engagement_level' => 'mne_engagement_level',
		'mne_status_indicators' => 'mne_status_indicators',
		'mne_budget_category' => 'mne_budget_category',
		'mne_indicator_groups' => 'mne_indicator_groups',
		'tblclients' => 'tblclients',
		'tblcountries' => 'tblcountries',
		'tblcurrencies' => 'tblcurrencies',
		'tblcurrency_rate_logs' => 'tblcurrency_rate_logs',
		'tblcurrency_rates' => 'tblcurrency_rates',
		'admin_users' => 'admin_users',
		'merq__audit' => 'merq__audit',
		'merq__locking' => 'merq__locking',
		'positions' => 'positions',
		'departments' => 'departments',
		'tbldepartments' => 'tbldepartments',
		'tblstaff_departments' => 'tblstaff_departments',
		'tblhr_job_position' => 'tblhr_job_position' 
	),
	'events' => array( 
		 
	),
	'languages' => array( 
		array(
			'name' => 'English',
			'nativeName' => 'English',
			'rtl' => false,
			'filename' => 'English.lng' 
		) 
	),
	'languageNames' => array( 
		'English' 
	),
	'defaultLanguage' => 'English',
	'detectDefaultLanguage' => true,
	'charset' => 'utf-8',
	'codepage' => 65001,
	'defaultConnID' => 'conn',
	'wrConnectionID' => '',
	'settingsTable' => array(
		'connId' => '',
		'table' => '' 
	),
	'wizardBuild' => '43785',
	'projectBuild' => 'wpqf2b2X4qCZ',
	'projectTheme' => 'flatly',
	'projectSize' => 'normal',
	'customErrorMsg' => array(
		'text' => 'Error occured.',
		'type' => 0 
	),
	'cloudSettings' => array(
		'cloudAmazonRegion' => '',
		'cloudAmazonBucket' => '',
		'cloudAmazonAccessKey' => '',
		'cloudAmazonSecretKey' => '',
		'cloudWasabiRegion' => '',
		'cloudWasabiBucket' => '',
		'cloudWasabiAccessKey' => '',
		'cloudWasabiSecretKey' => '',
		'cloudGDriveClientId' => '',
		'cloudGDriveClientSecret' => '',
		'cloudOneDriveClientId' => '',
		'cloudOneDriveClientSecret' => '',
		'cloudOneDriveDrive' => '',
		'cloudOneDriveAccountType' => 0,
		'cloudOneDriveDirectoryId' => '',
		'cloudDropboxClientId' => '',
		'cloudDropboxClientSecret' => '' 
	),
	'mapSettings' => array(
		'embed' => true,
		'provider' => 0,
		'apikey' => '' 
	),
	'viewPluginsWithJS' => array( 
		 
	),
	'rtlLanguages' => array(
		'English' => false 
	),
	'smsSettings' => array(
		'smsProvider' => 4,
		'iBusername' => '',
		'iBpassword' => '',
		'iBsender' => '',
		'essUsername' => '',
		'essPassword' => '',
		'essSender' => '',
		'gwApiToken' => '',
		'gwSender' => '',
		'mbAuth' => '',
		'mbSender' => '',
		'twilioSID' => '',
		'twilioAuth' => '',
		'twilioNumber' => '',
		'phoneField' => '',
		'counryCode' => '+1',
		'wauUsername' => '',
		'wauPassword' => '',
		'wauSender' => '' 
	) 
);

?>