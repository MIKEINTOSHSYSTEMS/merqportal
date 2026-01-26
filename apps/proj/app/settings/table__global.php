<?php
global $runnerTableSettings;
$runnerTableSettings[ GLOBAL_PAGES ] = array(
	'name' => '<global>',
	'type' => 5,
	'shortName' => '_global',
	'advancedSecurityType' => 0,
	'pagesByType' => array(
		'menu' => array( 
			'menu' 
		),
		'login' => array( 
			'login' 
		),
		'userinfo' => array( 
			'userinfo' 
		),
		'register' => array( 
			'register' 
		),
		'register_success' => array( 
			'register_success' 
		),
		'remind' => array( 
			'remind' 
		),
		'remind_success' => array( 
			'remind_success' 
		),
		'changepwd' => array( 
			'changepwd' 
		),
		'changepwd_success' => array( 
			'changepwd_success' 
		),
		'session_expired' => array( 
			'session_expired' 
		) 
	),
	'pageTypes' => array(
		'menu' => 'menu',
		'login' => 'login',
		'userinfo' => 'userinfo',
		'register' => 'register',
		'register_success' => 'register_success',
		'remind' => 'remind',
		'remind_success' => 'remind_success',
		'changepwd' => 'changepwd',
		'changepwd_success' => 'changepwd_success',
		'session_expired' => 'session_expired' 
	),
	'defaultPages' => array(
		'menu' => 'menu',
		'login' => 'login',
		'userinfo' => 'userinfo',
		'register' => 'register',
		'register_success' => 'register_success',
		'remind' => 'remind',
		'remind_success' => 'remind_success',
		'changepwd' => 'changepwd',
		'changepwd_success' => 'changepwd_success',
		'session_expired' => 'session_expired' 
	),
	'originalPagesByType' => array(
		'menu' => array( 
			'menu' 
		),
		'login' => array( 
			'login' 
		),
		'userinfo' => array( 
			'userinfo' 
		),
		'register' => array( 
			'register' 
		),
		'register_success' => array( 
			'register_success' 
		),
		'remind' => array( 
			'remind' 
		),
		'remind_success' => array( 
			'remind_success' 
		),
		'changepwd' => array( 
			'changepwd' 
		),
		'changepwd_success' => array( 
			'changepwd_success' 
		),
		'session_expired' => array( 
			'session_expired' 
		) 
	),
	'originalPageTypes' => array(
		'menu' => 'menu',
		'login' => 'login',
		'userinfo' => 'userinfo',
		'register' => 'register',
		'register_success' => 'register_success',
		'remind' => 'remind',
		'remind_success' => 'remind_success',
		'changepwd' => 'changepwd',
		'changepwd_success' => 'changepwd_success',
		'session_expired' => 'session_expired' 
	),
	'originalDefaultPages' => array(
		'menu' => 'menu',
		'login' => 'login',
		'userinfo' => 'userinfo',
		'register' => 'register',
		'register_success' => 'register_success',
		'remind' => 'remind',
		'remind_success' => 'remind_success',
		'changepwd' => 'changepwd',
		'changepwd_success' => 'changepwd_success',
		'session_expired' => 'session_expired' 
	),
	'hasJsEvents' => false 
);

global $runnerTableLabels;
if( mlang_getcurrentlang() === 'English' ) {
	$runnerTableLabels[ GLOBAL_PAGES ] = array(
	'pageTitles' => array(
		 
	) 
);
}
?>