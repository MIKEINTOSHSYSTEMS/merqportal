<?php
			$optionsArray = array(
	'welcome' => array(
		'welcomePageSkip' => true,
		'welcomeItems' => array(
			'expand_menu_button' => array(
				'menutItem' => false 
			),
			'collapse_button' => array(
				'menutItem' => false 
			),
			'loginform_login' => array(
				'menutItem' => false 
			),
			'username_button' => array(
				'menutItem' => false 
			),
			'logo' => array(
				'menutItem' => false 
			),
			'expand_button' => array(
				'menutItem' => false 
			),
			'menu' => array(
				'menutItem' => false 
			),
			'welcome_item' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_analysis_by_source',
				'page' => 'list' 
			),
			'welcome_item1' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_audit_log',
				'page' => 'list' 
			),
			'welcome_item2' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_budget_performance',
				'page' => 'list' 
			),
			'welcome_item3' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_business_opportunities',
				'page' => 'list' 
			),
			'welcome_item4' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_business_options',
				'page' => 'list' 
			),
			'welcome_item5' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_business_performance',
				'page' => 'list' 
			),
			'welcome_item6' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_client_options',
				'page' => 'list' 
			),
			'welcome_item7' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_client_satisfaction',
				'page' => 'list' 
			),
			'welcome_item8' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_currency_options',
				'page' => 'list' 
			),
			'welcome_item9' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_data_collection',
				'page' => 'list' 
			),
			'welcome_item10' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_data_methods',
				'page' => 'list' 
			),
			'welcome_item11' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_deliverable_status',
				'page' => 'list' 
			),
			'welcome_item12' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_delivery_metrics',
				'page' => 'list' 
			),
			'welcome_item13' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_executive_dashboard',
				'page' => 'list' 
			),
			'welcome_item14' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_extended_projects',
				'page' => 'list' 
			),
			'welcome_item15' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_financial_overview',
				'page' => 'list' 
			),
			'welcome_item16' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_indicator_matrix',
				'page' => 'list' 
			),
			'welcome_item17' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_knowledge_outputs',
				'page' => 'list' 
			),
			'welcome_item18' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_opportunity_metrics',
				'page' => 'list' 
			),
			'welcome_item19' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_partnership_options',
				'page' => 'list' 
			),
			'welcome_item20' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_partnerships',
				'page' => 'list' 
			),
			'welcome_item21' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_performance_alerts',
				'page' => 'list' 
			),
			'welcome_item22' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_performance_ratings',
				'page' => 'list' 
			),
			'welcome_item23' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_portfolio_snapshot',
				'page' => 'list' 
			),
			'welcome_item24' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_project_data_management',
				'page' => 'list' 
			),
			'welcome_item25' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_project_deliverables',
				'page' => 'list' 
			),
			'welcome_item26' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_project_details',
				'page' => 'list' 
			),
			'welcome_item27' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_project_financials',
				'page' => 'list' 
			),
			'welcome_item28' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_project_issues',
				'page' => 'list' 
			),
			'welcome_item29' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_project_leads',
				'page' => 'list' 
			),
			'welcome_item30' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_project_risks',
				'page' => 'list' 
			),
			'welcome_item31' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_project_timelines',
				'page' => 'list' 
			),
			'welcome_item32' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_project_type_options',
				'page' => 'list' 
			),
			'welcome_item33' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_project_updates',
				'page' => 'list' 
			),
			'welcome_item34' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_projects',
				'page' => 'list' 
			),
			'welcome_item35' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_publication_types',
				'page' => 'list' 
			),
			'welcome_item36' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_resource_options',
				'page' => 'list' 
			),
			'welcome_item37' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_risk_options',
				'page' => 'list' 
			),
			'welcome_item38' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_sector_options',
				'page' => 'list' 
			),
			'welcome_item39' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_status_options',
				'page' => 'list' 
			),
			'welcome_item40' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_system_config',
				'page' => 'list' 
			),
			'welcome_item41' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_win_loss_analysis',
				'page' => 'list' 
			),
			'welcome_item42' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_year_projects',
				'page' => 'list' 
			),
			'welcome_item43' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'users',
				'page' => 'list' 
			),
			'welcome_item44' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_project_category',
				'page' => 'list' 
			),
			'welcome_item45' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_sector_category',
				'page' => 'list' 
			),
			'welcome_item46' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_deliverable_options',
				'page' => 'list' 
			),
			'welcome_item47' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_quality_status',
				'page' => 'list' 
			),
			'welcome_item48' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_generic_options',
				'page' => 'list' 
			),
			'welcome_item49' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_grantee_contracted_unit',
				'page' => 'list' 
			),
			'welcome_item50' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_imp_level_options',
				'page' => 'list' 
			),
			'welcome_item51' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_opportunity_sources',
				'page' => 'list' 
			),
			'welcome_item52' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_thematic_areas',
				'page' => 'list' 
			),
			'welcome_item53' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_data_sources',
				'page' => 'list' 
			),
			'welcome_item54' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_partner_types',
				'page' => 'list' 
			),
			'welcome_item55' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_engagement_level',
				'page' => 'list' 
			),
			'welcome_item56' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_status_indicators',
				'page' => 'list' 
			),
			'welcome_item57' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_budget_category',
				'page' => 'list' 
			),
			'welcome_item58' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'mne_indicator_groups',
				'page' => 'list' 
			),
			'welcome_item59' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'tblclients',
				'page' => 'list' 
			),
			'welcome_item60' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'tblcountries',
				'page' => 'list' 
			),
			'welcome_item61' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'tblcurrencies',
				'page' => 'list' 
			),
			'welcome_item62' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'tblcurrency_rate_logs',
				'page' => 'list' 
			),
			'welcome_item63' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'tblcurrency_rates',
				'page' => 'list' 
			),
			'welcome_item64' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'merq__audit',
				'page' => 'list' 
			),
			'welcome_item65' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'merq__locking',
				'page' => 'list' 
			),
			'welcome_item66' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'positions',
				'page' => 'list' 
			),
			'welcome_item67' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'departments',
				'page' => 'list' 
			),
			'welcome_item68' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'tbldepartments',
				'page' => 'list' 
			),
			'welcome_item69' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'tblstaff_departments',
				'page' => 'list' 
			),
			'welcome_item70' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'tblhr_job_position',
				'page' => 'list' 
			),
			'welcome_item71' => array(
				'menutItem' => true,
				'group' => false,
				'linkType' => 0,
				'items' => null,
				'table' => 'Dashboard',
				'page' => 'dashboard' 
			) 
		) 
	),
	'fields' => array(
		'gridFields' => array( 
			 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			 
		) 
	),
	'layoutHelper' => array(
		'formItems' => array(
			'formItems' => array(
				'above-grid' => array( 
					 
				),
				'supertop' => array( 
					'expand_menu_button',
					'collapse_button',
					'loginform_login',
					'username_button' 
				),
				'left' => array( 
					'logo',
					'expand_button',
					'menu' 
				),
				'grid' => array( 
					'welcome_item',
					'welcome_item1',
					'welcome_item2',
					'welcome_item3',
					'welcome_item4',
					'welcome_item5',
					'welcome_item6',
					'welcome_item7',
					'welcome_item8',
					'welcome_item9',
					'welcome_item10',
					'welcome_item11',
					'welcome_item12',
					'welcome_item13',
					'welcome_item14',
					'welcome_item15',
					'welcome_item16',
					'welcome_item17',
					'welcome_item18',
					'welcome_item19',
					'welcome_item20',
					'welcome_item21',
					'welcome_item22',
					'welcome_item23',
					'welcome_item24',
					'welcome_item25',
					'welcome_item26',
					'welcome_item27',
					'welcome_item28',
					'welcome_item29',
					'welcome_item30',
					'welcome_item31',
					'welcome_item32',
					'welcome_item33',
					'welcome_item34',
					'welcome_item35',
					'welcome_item36',
					'welcome_item37',
					'welcome_item38',
					'welcome_item39',
					'welcome_item40',
					'welcome_item41',
					'welcome_item42',
					'welcome_item43',
					'welcome_item44',
					'welcome_item45',
					'welcome_item46',
					'welcome_item47',
					'welcome_item48',
					'welcome_item49',
					'welcome_item50',
					'welcome_item51',
					'welcome_item52',
					'welcome_item53',
					'welcome_item54',
					'welcome_item55',
					'welcome_item56',
					'welcome_item57',
					'welcome_item58',
					'welcome_item59',
					'welcome_item60',
					'welcome_item61',
					'welcome_item62',
					'welcome_item63',
					'welcome_item64',
					'welcome_item65',
					'welcome_item66',
					'welcome_item67',
					'welcome_item68',
					'welcome_item69',
					'welcome_item70',
					'welcome_item71' 
				) 
			),
			'formXtTags' => array(
				'above-grid' => array( 
					 
				) 
			),
			'itemForms' => array(
				'expand_menu_button' => 'supertop',
				'collapse_button' => 'supertop',
				'loginform_login' => 'supertop',
				'username_button' => 'supertop',
				'logo' => 'left',
				'expand_button' => 'left',
				'menu' => 'left',
				'welcome_item' => 'grid',
				'welcome_item1' => 'grid',
				'welcome_item2' => 'grid',
				'welcome_item3' => 'grid',
				'welcome_item4' => 'grid',
				'welcome_item5' => 'grid',
				'welcome_item6' => 'grid',
				'welcome_item7' => 'grid',
				'welcome_item8' => 'grid',
				'welcome_item9' => 'grid',
				'welcome_item10' => 'grid',
				'welcome_item11' => 'grid',
				'welcome_item12' => 'grid',
				'welcome_item13' => 'grid',
				'welcome_item14' => 'grid',
				'welcome_item15' => 'grid',
				'welcome_item16' => 'grid',
				'welcome_item17' => 'grid',
				'welcome_item18' => 'grid',
				'welcome_item19' => 'grid',
				'welcome_item20' => 'grid',
				'welcome_item21' => 'grid',
				'welcome_item22' => 'grid',
				'welcome_item23' => 'grid',
				'welcome_item24' => 'grid',
				'welcome_item25' => 'grid',
				'welcome_item26' => 'grid',
				'welcome_item27' => 'grid',
				'welcome_item28' => 'grid',
				'welcome_item29' => 'grid',
				'welcome_item30' => 'grid',
				'welcome_item31' => 'grid',
				'welcome_item32' => 'grid',
				'welcome_item33' => 'grid',
				'welcome_item34' => 'grid',
				'welcome_item35' => 'grid',
				'welcome_item36' => 'grid',
				'welcome_item37' => 'grid',
				'welcome_item38' => 'grid',
				'welcome_item39' => 'grid',
				'welcome_item40' => 'grid',
				'welcome_item41' => 'grid',
				'welcome_item42' => 'grid',
				'welcome_item43' => 'grid',
				'welcome_item44' => 'grid',
				'welcome_item45' => 'grid',
				'welcome_item46' => 'grid',
				'welcome_item47' => 'grid',
				'welcome_item48' => 'grid',
				'welcome_item49' => 'grid',
				'welcome_item50' => 'grid',
				'welcome_item51' => 'grid',
				'welcome_item52' => 'grid',
				'welcome_item53' => 'grid',
				'welcome_item54' => 'grid',
				'welcome_item55' => 'grid',
				'welcome_item56' => 'grid',
				'welcome_item57' => 'grid',
				'welcome_item58' => 'grid',
				'welcome_item59' => 'grid',
				'welcome_item60' => 'grid',
				'welcome_item61' => 'grid',
				'welcome_item62' => 'grid',
				'welcome_item63' => 'grid',
				'welcome_item64' => 'grid',
				'welcome_item65' => 'grid',
				'welcome_item66' => 'grid',
				'welcome_item67' => 'grid',
				'welcome_item68' => 'grid',
				'welcome_item69' => 'grid',
				'welcome_item70' => 'grid',
				'welcome_item71' => 'grid' 
			),
			'itemLocations' => array(
				 
			),
			'itemVisiblity' => array(
				'expand_menu_button' => 2,
				'expand_button' => 5 
			) 
		),
		'itemsByType' => array(
			'welcome_item' => array( 
				'welcome_item',
				'welcome_item1',
				'welcome_item2',
				'welcome_item3',
				'welcome_item4',
				'welcome_item5',
				'welcome_item6',
				'welcome_item7',
				'welcome_item8',
				'welcome_item9',
				'welcome_item10',
				'welcome_item11',
				'welcome_item12',
				'welcome_item13',
				'welcome_item14',
				'welcome_item15',
				'welcome_item16',
				'welcome_item17',
				'welcome_item18',
				'welcome_item19',
				'welcome_item20',
				'welcome_item21',
				'welcome_item22',
				'welcome_item23',
				'welcome_item24',
				'welcome_item25',
				'welcome_item26',
				'welcome_item27',
				'welcome_item28',
				'welcome_item29',
				'welcome_item30',
				'welcome_item31',
				'welcome_item32',
				'welcome_item33',
				'welcome_item34',
				'welcome_item35',
				'welcome_item36',
				'welcome_item37',
				'welcome_item38',
				'welcome_item39',
				'welcome_item40',
				'welcome_item41',
				'welcome_item42',
				'welcome_item43',
				'welcome_item44',
				'welcome_item45',
				'welcome_item46',
				'welcome_item47',
				'welcome_item48',
				'welcome_item49',
				'welcome_item50',
				'welcome_item51',
				'welcome_item52',
				'welcome_item53',
				'welcome_item54',
				'welcome_item55',
				'welcome_item56',
				'welcome_item57',
				'welcome_item58',
				'welcome_item59',
				'welcome_item60',
				'welcome_item61',
				'welcome_item62',
				'welcome_item63',
				'welcome_item64',
				'welcome_item65',
				'welcome_item66',
				'welcome_item67',
				'welcome_item68',
				'welcome_item69',
				'welcome_item70',
				'welcome_item71' 
			),
			'logo' => array( 
				'logo' 
			),
			'menu' => array( 
				'menu' 
			),
			'expand_menu_button' => array( 
				'expand_menu_button' 
			),
			'collapse_button' => array( 
				'collapse_button' 
			),
			'username_button' => array( 
				'username_button' 
			),
			'loginform_login' => array( 
				'loginform_login' 
			),
			'userinfo_link' => array( 
				'userinfo_link' 
			),
			'logout_link' => array( 
				'logout_link' 
			),
			'changepassword_link' => array( 
				'changepassword_link' 
			),
			'adminarea_link' => array( 
				'adminarea_link' 
			),
			'expand_button' => array( 
				'expand_button' 
			) 
		),
		'cellMaps' => array(
			 
		) 
	),
	'loginForm' => array(
		'loginForm' => 0 
	),
	'page' => array(
		'verticalBar' => true,
		'labeledButtons' => array(
			'update_records' => array(
				 
			),
			'print_pages' => array(
				 
			),
			'register_activate_message' => array(
				 
			),
			'details_found' => array(
				 
			) 
		),
		'hasCustomButtons' => false,
		'customButtons' => array( 
			 
		),
		'codeSnippets' => array( 
			 
		),
		'clickHandlerSnippets' => array( 
			 
		),
		'hasNotifications' => false,
		'menus' => array( 
			array(
				'id' => 'main',
				'horizontal' => false 
			) 
		),
		'calcTotalsFor' => 1,
		'hasCharts' => false 
	),
	'events' => array(
		'maps' => array( 
			 
		),
		'mapsData' => array(
			 
		),
		'buttons' => array( 
			 
		) 
	) 
);
			$pageArray = array(
	'id' => 'menu',
	'type' => 'menu',
	'layoutId' => 'leftbar',
	'disabled' => false,
	'default' => 0,
	'forms' => array(
		'above-grid' => array(
			'modelId' => 'empty-above-grid',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'supertop' => array(
			'modelId' => 'menu-topbar',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1' 
						),
						array(
							'cell' => 'c2' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'expand_menu_button',
						'collapse_button' 
					) 
				),
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						'loginform_login',
						'username_button' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'left' => array(
			'modelId' => 'leftbar-menu',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c0' 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c1' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c0' => array(
					'model' => 'c0',
					'items' => array( 
						'logo',
						'expand_button' 
					) 
				),
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'menu' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'grid' => array(
			'modelId' => 'welcome',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'welcome_item',
						'welcome_item1',
						'welcome_item2',
						'welcome_item3',
						'welcome_item4',
						'welcome_item5',
						'welcome_item6',
						'welcome_item7',
						'welcome_item8',
						'welcome_item9',
						'welcome_item10',
						'welcome_item11',
						'welcome_item12',
						'welcome_item13',
						'welcome_item14',
						'welcome_item15',
						'welcome_item16',
						'welcome_item17',
						'welcome_item18',
						'welcome_item19',
						'welcome_item20',
						'welcome_item21',
						'welcome_item22',
						'welcome_item23',
						'welcome_item24',
						'welcome_item25',
						'welcome_item26',
						'welcome_item27',
						'welcome_item28',
						'welcome_item29',
						'welcome_item30',
						'welcome_item31',
						'welcome_item32',
						'welcome_item33',
						'welcome_item34',
						'welcome_item35',
						'welcome_item36',
						'welcome_item37',
						'welcome_item38',
						'welcome_item39',
						'welcome_item40',
						'welcome_item41',
						'welcome_item42',
						'welcome_item43',
						'welcome_item44',
						'welcome_item45',
						'welcome_item46',
						'welcome_item47',
						'welcome_item48',
						'welcome_item49',
						'welcome_item50',
						'welcome_item51',
						'welcome_item52',
						'welcome_item53',
						'welcome_item54',
						'welcome_item55',
						'welcome_item56',
						'welcome_item57',
						'welcome_item58',
						'welcome_item59',
						'welcome_item60',
						'welcome_item61',
						'welcome_item62',
						'welcome_item63',
						'welcome_item64',
						'welcome_item65',
						'welcome_item66',
						'welcome_item67',
						'welcome_item68',
						'welcome_item69',
						'welcome_item70',
						'welcome_item71' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		) 
	),
	'items' => array(
		'welcome_item' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_analysis_by_source',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_analysis_by_source',
				'type' => 6 
			),
			'linkIcon' => array(
				'glyph' => 'hand-right' 
			),
			'linkComments' => array(
				'text' => 'Mne Analysis By Source description',
				'type' => 0 
			),
			'background' => '#e67349',
			'linkType' => 0 
		),
		'welcome_item1' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_audit_log',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_audit_log',
				'type' => 6 
			),
			'linkIcon' => array(
				'glyph' => 'fire' 
			),
			'linkComments' => array(
				'text' => 'Mne Audit Log description',
				'type' => 0 
			),
			'background' => '#7b68ee',
			'linkType' => 0 
		),
		'welcome_item2' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_budget_performance',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_budget_performance',
				'type' => 6 
			),
			'linkIcon' => array(
				'glyph' => 'flash' 
			),
			'linkComments' => array(
				'text' => 'Mne Budget Performance description',
				'type' => 0 
			),
			'background' => '#8fbc8b',
			'linkType' => 0 
		),
		'welcome_item3' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_business_opportunities',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_business_opportunities',
				'type' => 6 
			),
			'linkIcon' => array(
				'glyph' => 'briefcase' 
			),
			'linkComments' => array(
				'text' => 'Mne Business Opportunities description',
				'type' => 0 
			),
			'background' => '#dc143c',
			'linkType' => 0 
		),
		'welcome_item4' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_business_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_business_options',
				'type' => 6 
			),
			'linkIcon' => array(
				'glyph' => 'earphone' 
			),
			'linkComments' => array(
				'text' => 'Mne Business Options description',
				'type' => 0 
			),
			'background' => '#cd853f',
			'linkType' => 0 
		),
		'welcome_item5' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_business_performance',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_business_performance',
				'type' => 6 
			),
			'linkIcon' => array(
				'glyph' => 'earphone' 
			),
			'background' => '#778899',
			'linkType' => 0 
		),
		'welcome_item6' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_client_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_client_options',
				'type' => 6 
			),
			'linkIcon' => array(
				'glyph' => 'briefcase' 
			),
			'background' => '#b22222',
			'linkType' => 0 
		),
		'welcome_item7' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_client_satisfaction',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_client_satisfaction',
				'type' => 6 
			),
			'linkIcon' => array(
				'glyph' => 'star' 
			),
			'background' => '#6b8e23',
			'linkType' => 0 
		),
		'welcome_item8' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_currency_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_currency_options',
				'type' => 6 
			),
			'linkIcon' => array(
				'glyph' => 'heart-empty' 
			),
			'background' => '#d2af80',
			'linkType' => 0 
		),
		'welcome_item9' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_data_collection',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_data_collection',
				'type' => 6 
			),
			'background' => '#bc8f8f',
			'linkType' => 0 
		),
		'welcome_item10' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_data_methods',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_data_methods',
				'type' => 6 
			),
			'background' => '#cfae83',
			'linkType' => 0 
		),
		'welcome_item11' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_deliverable_status',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_deliverable_status',
				'type' => 6 
			),
			'background' => '#2f4f4f',
			'linkType' => 0 
		),
		'welcome_item12' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_delivery_metrics',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_delivery_metrics',
				'type' => 6 
			),
			'background' => '#00c2c5',
			'linkType' => 0 
		),
		'welcome_item13' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_executive_dashboard',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_executive_dashboard',
				'type' => 6 
			),
			'background' => '#8fbc8b',
			'linkType' => 0 
		),
		'welcome_item14' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_extended_projects',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_extended_projects',
				'type' => 6 
			),
			'background' => '#6b8e23',
			'linkType' => 0 
		),
		'welcome_item15' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_financial_overview',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_financial_overview',
				'type' => 6 
			),
			'background' => '#00c2c5',
			'linkType' => 0 
		),
		'welcome_item16' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_indicator_matrix',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_indicator_matrix',
				'type' => 6 
			),
			'background' => '#e8926f',
			'linkType' => 0 
		),
		'welcome_item17' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_knowledge_outputs',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_knowledge_outputs',
				'type' => 6 
			),
			'background' => '#b22222',
			'linkType' => 0 
		),
		'welcome_item18' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_opportunity_metrics',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_opportunity_metrics',
				'type' => 6 
			),
			'background' => '#e07878',
			'linkType' => 0 
		),
		'welcome_item19' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_partnership_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_partnership_options',
				'type' => 6 
			),
			'background' => '#b22222',
			'linkType' => 0 
		),
		'welcome_item20' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_partnerships',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_partnerships',
				'type' => 6 
			),
			'background' => '#8fbc8b',
			'linkType' => 0 
		),
		'welcome_item21' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_performance_alerts',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_performance_alerts',
				'type' => 6 
			),
			'background' => '#4682b4',
			'linkType' => 0 
		),
		'welcome_item22' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_performance_ratings',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_performance_ratings',
				'type' => 6 
			),
			'background' => '#8fbc8b',
			'linkType' => 0 
		),
		'welcome_item23' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_portfolio_snapshot',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_portfolio_snapshot',
				'type' => 6 
			),
			'background' => '#daa520',
			'linkType' => 0 
		),
		'welcome_item24' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_project_data_management',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_project_data_management',
				'type' => 6 
			),
			'background' => '#00c2c5',
			'linkType' => 0 
		),
		'welcome_item25' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_project_deliverables',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_project_deliverables',
				'type' => 6 
			),
			'background' => '#d2af80',
			'linkType' => 0 
		),
		'welcome_item26' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_project_details',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_project_details',
				'type' => 6 
			),
			'background' => '#bc8f8f',
			'linkType' => 0 
		),
		'welcome_item27' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_project_financials',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_project_financials',
				'type' => 6 
			),
			'background' => '#d2691e',
			'linkType' => 0 
		),
		'welcome_item28' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_project_issues',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_project_issues',
				'type' => 6 
			),
			'background' => '#5f9ea0',
			'linkType' => 0 
		),
		'welcome_item29' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_project_leads',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_project_leads',
				'type' => 6 
			),
			'background' => '#4169e1',
			'linkType' => 0 
		),
		'welcome_item30' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_project_risks',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_project_risks',
				'type' => 6 
			),
			'background' => '#d2af80',
			'linkType' => 0 
		),
		'welcome_item31' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_project_timelines',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_project_timelines',
				'type' => 6 
			),
			'background' => '#6b8e23',
			'linkType' => 0 
		),
		'welcome_item32' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_project_type_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_project_type_options',
				'type' => 6 
			),
			'background' => '#daa520',
			'linkType' => 0 
		),
		'welcome_item33' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_project_updates',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_project_updates',
				'type' => 6 
			),
			'background' => '#778899',
			'linkType' => 0 
		),
		'welcome_item34' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_projects',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_projects',
				'type' => 6 
			),
			'background' => '#d2af80',
			'linkType' => 0 
		),
		'welcome_item35' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_publication_types',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_publication_types',
				'type' => 6 
			),
			'background' => '#3cb371',
			'linkType' => 0 
		),
		'welcome_item36' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_resource_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_resource_options',
				'type' => 6 
			),
			'background' => '#b22222',
			'linkType' => 0 
		),
		'welcome_item37' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_risk_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_risk_options',
				'type' => 6 
			),
			'background' => '#dc143c',
			'linkType' => 0 
		),
		'welcome_item38' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_sector_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_sector_options',
				'type' => 6 
			),
			'background' => '#e07878',
			'linkType' => 0 
		),
		'welcome_item39' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_status_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_status_options',
				'type' => 6 
			),
			'background' => '#cd5c5c',
			'linkType' => 0 
		),
		'welcome_item40' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_system_config',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_system_config',
				'type' => 6 
			),
			'background' => '#cd5c5c',
			'linkType' => 0 
		),
		'welcome_item41' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_win_loss_analysis',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_win_loss_analysis',
				'type' => 6 
			),
			'background' => '#6493ea',
			'linkType' => 0 
		),
		'welcome_item42' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_year_projects',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_year_projects',
				'type' => 6 
			),
			'background' => '#edca00',
			'linkType' => 0 
		),
		'welcome_item43' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'users',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'users',
				'type' => 6 
			),
			'background' => '#5f9ea0',
			'linkType' => 0 
		),
		'logo' => array(
			'type' => 'logo' 
		),
		'menu' => array(
			'type' => 'menu' 
		),
		'expand_menu_button' => array(
			'type' => 'expand_menu_button' 
		),
		'collapse_button' => array(
			'type' => 'collapse_button' 
		),
		'welcome_item44' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_project_category',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_project_category',
				'type' => 6 
			),
			'background' => '#008b8b',
			'linkType' => 0 
		),
		'welcome_item45' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_sector_category',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_sector_category',
				'type' => 6 
			),
			'background' => '#2f4f4f',
			'linkType' => 0 
		),
		'welcome_item46' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_deliverable_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_deliverable_options',
				'type' => 6 
			),
			'background' => '#6493ea',
			'linkType' => 0 
		),
		'welcome_item47' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_quality_status',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_quality_status',
				'type' => 6 
			),
			'background' => '#6493ea',
			'linkType' => 0 
		),
		'welcome_item48' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_generic_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_generic_options',
				'type' => 6 
			),
			'background' => '#4682b4',
			'linkType' => 0 
		),
		'welcome_item49' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_grantee_contracted_unit',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_grantee_contracted_unit',
				'type' => 6 
			),
			'background' => '#daa520',
			'linkType' => 0 
		),
		'welcome_item50' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_imp_level_options',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_imp_level_options',
				'type' => 6 
			),
			'background' => '#e67349',
			'linkType' => 0 
		),
		'welcome_item51' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_opportunity_sources',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_opportunity_sources',
				'type' => 6 
			),
			'background' => '#d2691e',
			'linkType' => 0 
		),
		'welcome_item52' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_thematic_areas',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_thematic_areas',
				'type' => 6 
			),
			'background' => '#edca00',
			'linkType' => 0 
		),
		'welcome_item53' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_data_sources',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_data_sources',
				'type' => 6 
			),
			'background' => '#edca00',
			'linkType' => 0 
		),
		'welcome_item54' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_partner_types',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_partner_types',
				'type' => 6 
			),
			'background' => '#6493ea',
			'linkType' => 0 
		),
		'welcome_item55' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_engagement_level',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_engagement_level',
				'type' => 6 
			),
			'background' => '#778899',
			'linkType' => 0 
		),
		'welcome_item56' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_status_indicators',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_status_indicators',
				'type' => 6 
			),
			'background' => '#008b8b',
			'linkType' => 0 
		),
		'welcome_item57' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_budget_category',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_budget_category',
				'type' => 6 
			),
			'background' => '#daa520',
			'linkType' => 0 
		),
		'welcome_item58' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'mne_indicator_groups',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'mne_indicator_groups',
				'type' => 6 
			),
			'background' => '#edca00',
			'linkType' => 0 
		),
		'welcome_item59' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'tblclients',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'tblclients',
				'type' => 6 
			),
			'background' => '#2f4f4f',
			'linkType' => 0 
		),
		'welcome_item60' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'tblcountries',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'tblcountries',
				'type' => 6 
			),
			'background' => '#5f9ea0',
			'linkType' => 0 
		),
		'welcome_item61' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'tblcurrencies',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'tblcurrencies',
				'type' => 6 
			),
			'background' => '#1e90ff',
			'linkType' => 0 
		),
		'welcome_item62' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'tblcurrency_rate_logs',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'tblcurrency_rate_logs',
				'type' => 6 
			),
			'background' => '#cfae83',
			'linkType' => 0 
		),
		'welcome_item63' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'tblcurrency_rates',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'tblcurrency_rates',
				'type' => 6 
			),
			'background' => '#1e90ff',
			'linkType' => 0 
		),
		'username_button' => array(
			'type' => 'username_button',
			'items' => array( 
				'userinfo_link',
				'logout_link',
				'adminarea_link',
				'changepassword_link' 
			) 
		),
		'loginform_login' => array(
			'type' => 'loginform_login',
			'popup' => false 
		),
		'userinfo_link' => array(
			'type' => 'userinfo_link' 
		),
		'logout_link' => array(
			'type' => 'logout_link' 
		),
		'changepassword_link' => array(
			'type' => 'changepassword_link' 
		),
		'adminarea_link' => array(
			'type' => 'adminarea_link' 
		),
		'welcome_item64' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'merq__audit',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'merq__audit',
				'type' => 6 
			),
			'background' => '#bc8f8f',
			'linkType' => 0 
		),
		'welcome_item65' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'merq__locking',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'merq__locking',
				'type' => 6 
			),
			'background' => '#dc143c',
			'linkType' => 0 
		),
		'welcome_item66' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'positions',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'positions',
				'type' => 6 
			),
			'background' => '#cd853f',
			'linkType' => 0 
		),
		'welcome_item67' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'departments',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'departments',
				'type' => 6 
			),
			'background' => '#9acd32',
			'linkType' => 0 
		),
		'welcome_item68' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'tbldepartments',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'tbldepartments',
				'type' => 6 
			),
			'background' => '#e67349',
			'linkType' => 0 
		),
		'welcome_item69' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'tblstaff_departments',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'tblstaff_departments',
				'type' => 6 
			),
			'background' => '#cd853f',
			'linkType' => 0 
		),
		'welcome_item70' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'tblhr_job_position',
			'linkPage' => 'list',
			'linkText' => array(
				'table' => 'tblhr_job_position',
				'type' => 6 
			),
			'background' => '#dc143c',
			'linkType' => 0 
		),
		'welcome_item71' => array(
			'type' => 'welcome_item',
			'linkUrl' => '',
			'linkTable' => 'Dashboard',
			'linkPage' => 'dashboard',
			'linkText' => array(
				'table' => 'Dashboard',
				'type' => 6 
			),
			'background' => '#d2691e',
			'linkType' => 0 
		),
		'expand_button' => array(
			'type' => 'expand_button' 
		) 
	),
	'dbProps' => array(
		 
	),
	'version' => 13,
	'imageItem' => array(
		'type' => 'page_image' 
	),
	'imageBgColor' => '#f2f2f2',
	'controlsBgColor' => 'white',
	'imagePosition' => 'right',
	'listTotals' => 1,
	'title' => array(
		 
	) 
);
		?>