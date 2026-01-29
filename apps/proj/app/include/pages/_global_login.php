<?php
			$optionsArray = array(
	'captcha' => array(
		'captcha' => true 
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
					'twofactor_message',
					'login_message' 
				),
				'top' => array( 
					'login-logo',
					'login_welcome' 
				),
				'grid' => array( 
					'remember_password',
					'remember_machine',
					'guest_login',
					'username_label',
					'username',
					'password_label',
					'password',
					'captcha',
					'auth_code_message',
					'auth_code',
					'auth_altemail',
					'auth_altphone',
					'auth_altapp' 
				),
				'footer' => array( 
					'login_button',
					'continue_login_button',
					'verify_button',
					'resend_button',
					'login_remind',
					'login_external',
					'login_google',
					'text' 
				),
				'superbottom' => array( 
					'loginform_register_link' 
				) 
			),
			'formXtTags' => array(
				 
			),
			'itemForms' => array(
				'twofactor_message' => 'above-grid',
				'login_message' => 'above-grid',
				'login-logo' => 'top',
				'login_welcome' => 'top',
				'remember_password' => 'grid',
				'remember_machine' => 'grid',
				'guest_login' => 'grid',
				'username_label' => 'grid',
				'username' => 'grid',
				'password_label' => 'grid',
				'password' => 'grid',
				'captcha' => 'grid',
				'auth_code_message' => 'grid',
				'auth_code' => 'grid',
				'auth_altemail' => 'grid',
				'auth_altphone' => 'grid',
				'auth_altapp' => 'grid',
				'login_button' => 'footer',
				'continue_login_button' => 'footer',
				'verify_button' => 'footer',
				'resend_button' => 'footer',
				'login_remind' => 'footer',
				'login_external' => 'footer',
				'login_google' => 'footer',
				'text' => 'footer',
				'loginform_register_link' => 'superbottom' 
			),
			'itemLocations' => array(
				 
			),
			'itemVisiblity' => array(
				'login_google' => 2 
			) 
		),
		'itemsByType' => array(
			'login_message' => array( 
				'login_message' 
			),
			'guest_login' => array( 
				'guest_login' 
			),
			'login-logo' => array( 
				'login-logo' 
			),
			'login_welcome' => array( 
				'login_welcome' 
			),
			'username_label' => array( 
				'username_label' 
			),
			'username' => array( 
				'username' 
			),
			'password_label' => array( 
				'password_label' 
			),
			'password' => array( 
				'password' 
			),
			'remember_password' => array( 
				'remember_password' 
			),
			'login_button' => array( 
				'login_button' 
			),
			'loginform_register_link' => array( 
				'loginform_register_link' 
			),
			'login_remind' => array( 
				'login_remind' 
			),
			'captcha' => array( 
				'captcha' 
			),
			'login_google' => array( 
				'login_google' 
			),
			'login_external' => array( 
				'login_external' 
			),
			'text' => array( 
				'text' 
			),
			'twofactor_message' => array( 
				'twofactor_message' 
			),
			'auth_code' => array( 
				'auth_code' 
			),
			'continue_login_button' => array( 
				'continue_login_button' 
			),
			'verify_button' => array( 
				'verify_button' 
			),
			'resend_button' => array( 
				'resend_button' 
			),
			'auth_code_message' => array( 
				'auth_code_message' 
			),
			'remember_machine' => array( 
				'remember_machine' 
			),
			'auth_altemail' => array( 
				'auth_altemail' 
			),
			'auth_altphone' => array( 
				'auth_altphone' 
			),
			'auth_altapp' => array( 
				'auth_altapp' 
			) 
		),
		'cellMaps' => array(
			 
		) 
	),
	'page' => array(
		'verticalBar' => false,
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
	'id' => 'login',
	'type' => 'login',
	'layoutId' => 'pretty1',
	'disabled' => false,
	'default' => 0,
	'forms' => array(
		'above-grid' => array(
			'modelId' => 'login-above-grid',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c2' 
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
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						'twofactor_message' 
					) 
				),
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'login_message' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'top' => array(
			'modelId' => 'plogin-header',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1',
							'colspan' => 1 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c3',
							'colspan' => 1 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'login-logo' 
					),
					'background' => '#001f3f',
					'align' => 'center' 
				),
				'c3' => array(
					'model' => 'c3',
					'items' => array( 
						'login_welcome' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'grid' => array(
			'modelId' => 'plogin-grid',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1',
							'colspan' => 2 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c2',
							'colspan' => 2 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c3',
							'colspan' => 2 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c11',
							'colspan' => 2 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c4' 
						),
						array(
							'cell' => 'c6' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c4' => array(
					'model' => 'c4',
					'items' => array( 
						'remember_password',
						'remember_machine' 
					) 
				),
				'c6' => array(
					'model' => 'c6',
					'items' => array( 
						'guest_login' 
					) 
				),
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'username_label',
						'username' 
					) 
				),
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						'password_label',
						'password' 
					) 
				),
				'c3' => array(
					'model' => 'c3',
					'items' => array( 
						'captcha',
						'auth_code_message',
						'auth_code' 
					) 
				),
				'c11' => array(
					'model' => 'c11',
					'items' => array( 
						'auth_altemail',
						'auth_altphone',
						'auth_altapp' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'footer' => array(
			'modelId' => 'plogin-footer',
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
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c4',
							'colspan' => 2 
						) 
					) 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c3',
							'colspan' => 2 
						) 
					),
					'section' => '' 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c',
							'colspan' => 2 
						) 
					) 
				) 
			),
			'cells' => array(
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'login_button',
						'continue_login_button',
						'verify_button',
						'resend_button' 
					) 
				),
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						'login_remind' 
					) 
				),
				'c3' => array(
					'model' => 'c3',
					'items' => array( 
						'login_external' 
					) 
				),
				'c' => array(
					'model' => 'c3',
					'items' => array( 
						'login_google' 
					) 
				),
				'c4' => array(
					'model' => 'c3',
					'items' => array( 
						'text' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'superbottom' => array(
			'modelId' => 'plogin-superbottom',
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
						'loginform_register_link' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		) 
	),
	'items' => array(
		'login_message' => array(
			'type' => 'login_message' 
		),
		'guest_login' => array(
			'type' => 'guest_login' 
		),
		'login-logo' => array(
			'type' => 'login-logo',
			'font-size' => '24px',
			'bold' => true 
		),
		'login_welcome' => array(
			'type' => 'login_welcome',
			'italic' => true 
		),
		'username_label' => array(
			'type' => 'username_label' 
		),
		'username' => array(
			'type' => 'username' 
		),
		'password_label' => array(
			'type' => 'password_label' 
		),
		'password' => array(
			'type' => 'password' 
		),
		'remember_password' => array(
			'type' => 'remember_password' 
		),
		'login_button' => array(
			'type' => 'login_button',
			'icon' => array(
				 
			) 
		),
		'loginform_register_link' => array(
			'type' => 'loginform_register_link' 
		),
		'login_remind' => array(
			'type' => 'login_remind' 
		),
		'captcha' => array(
			'type' => 'captcha' 
		),
		'login_google' => array(
			'type' => 'login_google',
			'mobileDisplay' => 'mobile' 
		),
		'login_external' => array(
			'type' => 'login_external',
			'providerName' => 'google',
			'icon' => array(
				'file' => 'google-icon-logo-32.svg',
				'style' => 0 
			),
			'label' => array(
				'type' => 0,
				'text' => ' Login with MERQ\'s %provider% Workspace (New Users Only!)' 
			),
			'buttonStyle' => 'primary',
			'buttonSize' => 'normal',
			'bold' => true,
			'mobileDisplay' => 'both',
			'font-size' => '17px',
			'tooltip' => array(
				'type' => 0,
				'text' => 'You will be able to login automatically using your existing MERQ Consultancy\'s email address!' 
			) 
		),
		'text' => array(
			'type' => 'text',
			'label' => array(
				'text' => '<br>',
				'type' => 0 
			),
			'editedByRte' => false 
		),
		'twofactor_message' => array(
			'type' => 'twofactor_message' 
		),
		'auth_code' => array(
			'type' => 'auth_code' 
		),
		'continue_login_button' => array(
			'type' => 'continue_login_button' 
		),
		'verify_button' => array(
			'type' => 'verify_button' 
		),
		'resend_button' => array(
			'type' => 'resend_button' 
		),
		'auth_code_message' => array(
			'type' => 'auth_code_message' 
		),
		'remember_machine' => array(
			'type' => 'remember_machine' 
		),
		'auth_altemail' => array(
			'type' => 'auth_altemail' 
		),
		'auth_altphone' => array(
			'type' => 'auth_altphone' 
		),
		'auth_altapp' => array(
			'type' => 'auth_altapp' 
		) 
	),
	'dbProps' => array(
		 
	),
	'version' => 13,
	'imageItem' => array(
		'type' => 'page_image',
		'shadow' => false,
		'fullSize' => true,
		'image' => array(
			'source' => 1,
			'image' => 'windows-SwHvzwEzCfA-unsplash.jpg' 
		) 
	),
	'imageBgColor' => '#f2f2f2',
	'controlsBgColor' => 'white',
	'imagePosition' => 'right',
	'listTotals' => 1,
	'title' => array(
		 
	) 
);
		?>