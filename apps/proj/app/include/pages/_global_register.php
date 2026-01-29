<?php
			$optionsArray = array(
	'captcha' => array(
		'captcha' => true 
	),
	'fields' => array(
		'gridFields' => array( 
			'username',
			'password_hash',
			'email',
			'first_name',
			'middle_name',
			'last_name',
			'phone',
			'alternate_phone',
			'full_name',
			'is_doctor' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'username' => array( 
				'integrated_edit_field' 
			),
			'password_hash' => array( 
				'integrated_edit_field1' 
			),
			'confirm_aoel3cx' => array( 
				'integrated_confirm_password' 
			),
			'email' => array( 
				'integrated_edit_field2' 
			),
			'first_name' => array( 
				'integrated_edit_field3' 
			),
			'middle_name' => array( 
				'integrated_edit_field4' 
			),
			'last_name' => array( 
				'integrated_edit_field5' 
			),
			'phone' => array( 
				'integrated_edit_field6' 
			),
			'alternate_phone' => array( 
				'integrated_edit_field7' 
			),
			'full_name' => array( 
				'integrated_edit_field8' 
			),
			'is_doctor' => array( 
				'integrated_edit_field9' 
			) 
		) 
	),
	'layoutHelper' => array(
		'formItems' => array(
			'formItems' => array(
				'above-grid' => array( 
					'register_message',
					'step_nav' 
				),
				'top' => array( 
					'register_header',
					'image' 
				),
				'footer' => array( 
					'next_step',
					'register_save',
					'back_to_login',
					'register_reset' 
				),
				'grid' => array( 
					'integrated_edit_field3',
					'integrated_edit_field5',
					'integrated_edit_field4',
					'integrated_edit_field8',
					'integrated_edit_field9' 
				),
				'step2' => array( 
					'integrated_edit_field',
					'integrated_edit_field2',
					'integrated_edit_field7',
					'integrated_edit_field6' 
				),
				'step3' => array( 
					'integrated_edit_field1',
					'captcha',
					'integrated_confirm_password' 
				) 
			),
			'formXtTags' => array(
				 
			),
			'itemForms' => array(
				'register_message' => 'above-grid',
				'step_nav' => 'above-grid',
				'register_header' => 'top',
				'image' => 'top',
				'next_step' => 'footer',
				'register_save' => 'footer',
				'back_to_login' => 'footer',
				'register_reset' => 'footer',
				'integrated_edit_field3' => 'grid',
				'integrated_edit_field5' => 'grid',
				'integrated_edit_field4' => 'grid',
				'integrated_edit_field8' => 'grid',
				'integrated_edit_field9' => 'grid',
				'integrated_edit_field' => 'step2',
				'integrated_edit_field2' => 'step2',
				'integrated_edit_field7' => 'step2',
				'integrated_edit_field6' => 'step2',
				'integrated_edit_field1' => 'step3',
				'captcha' => 'step3',
				'integrated_confirm_password' => 'step3' 
			),
			'itemLocations' => array(
				'integrated_edit_field3' => array(
					'location' => 'grid',
					'cellId' => 'c18' 
				),
				'integrated_edit_field5' => array(
					'location' => 'grid',
					'cellId' => 'c22' 
				),
				'integrated_edit_field4' => array(
					'location' => 'grid',
					'cellId' => 'c24' 
				),
				'integrated_edit_field8' => array(
					'location' => 'grid',
					'cellId' => 'c25' 
				),
				'integrated_edit_field9' => array(
					'location' => 'grid',
					'cellId' => 'c' 
				),
				'integrated_edit_field' => array(
					'location' => 'step2',
					'cellId' => 'c1' 
				),
				'integrated_edit_field2' => array(
					'location' => 'step2',
					'cellId' => 'c3' 
				),
				'integrated_edit_field7' => array(
					'location' => 'step2',
					'cellId' => 'c4' 
				),
				'integrated_edit_field6' => array(
					'location' => 'step2',
					'cellId' => 'c5' 
				),
				'integrated_edit_field1' => array(
					'location' => 'step3',
					'cellId' => 'c1' 
				),
				'captcha' => array(
					'location' => 'step3',
					'cellId' => 'c' 
				),
				'integrated_confirm_password' => array(
					'location' => 'step3',
					'cellId' => 'c2' 
				) 
			),
			'itemVisiblity' => array(
				 
			) 
		),
		'itemsByType' => array(
			'register_header' => array( 
				'register_header' 
			),
			'register_reset' => array( 
				'register_reset' 
			),
			'register_message' => array( 
				'register_message' 
			),
			'register_save' => array( 
				'register_save' 
			),
			'back_to_login' => array( 
				'back_to_login' 
			),
			'integrated_edit_field' => array( 
				'integrated_edit_field',
				'integrated_edit_field1',
				'integrated_edit_field2',
				'integrated_edit_field3',
				'integrated_edit_field4',
				'integrated_edit_field5',
				'integrated_edit_field6',
				'integrated_edit_field7',
				'integrated_edit_field8',
				'integrated_edit_field9' 
			),
			'integrated_confirm_password' => array( 
				'integrated_confirm_password' 
			),
			'captcha' => array( 
				'captcha' 
			),
			'next_step' => array( 
				'next_step' 
			),
			'step_nav' => array( 
				'step_nav' 
			),
			'image' => array( 
				'image' 
			) 
		),
		'cellMaps' => array(
			'grid' => array(
				'cells' => array(
					'c' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field9' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c18' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field3' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c24' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field4' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c22' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field5' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c25' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field8' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					) 
				),
				'width' => 1,
				'height' => 5 
			),
			'step2' => array(
				'cells' => array(
					'c1' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c3' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field2' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c5' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field6' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c4' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field7' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					) 
				),
				'width' => 1,
				'height' => 4 
			),
			'step3' => array(
				'cells' => array(
					'c1' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field1' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c2' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_confirm_password' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'captcha' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					) 
				),
				'width' => 1,
				'height' => 3 
			) 
		) 
	),
	'page' => array(
		'verticalBar' => false,
		'multiStep' => true,
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
	'register' => array(
		'gridFields' => array( 
			'username',
			'password_hash',
			'email',
			'first_name',
			'middle_name',
			'last_name',
			'phone',
			'alternate_phone',
			'full_name',
			'is_doctor' 
		) 
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
	'id' => 'register',
	'type' => 'register',
	'layoutId' => 'pretty1',
	'disabled' => false,
	'default' => 0,
	'forms' => array(
		'above-grid' => array(
			'modelId' => 'register-above-grid',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1' 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
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
						'register_message' 
					) 
				),
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						'step_nav' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'top' => array(
			'modelId' => 'register-header',
			'grid' => array( 
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c' 
						) 
					) 
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
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'register_header' 
					),
					'align' => 'center' 
				),
				'c' => array(
					'model' => 'c1',
					'items' => array( 
						'image' 
					),
					'align' => 'center' 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'footer' => array(
			'modelId' => 'register-below-grid',
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
						'next_step',
						'register_save',
						'back_to_login' 
					) 
				),
				'c2' => array(
					'model' => 'c2',
					'items' => array( 
						'register_reset' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'grid' => array(
			'modelId' => 'simple-edit',
			'grid' => array( 
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c18',
							'colspan' => 1 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c24',
							'colspan' => 1 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c22',
							'colspan' => 1 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c25',
							'colspan' => 1 
						) 
					) 
				) 
			),
			'cells' => array(
				'c18' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field3' 
					) 
				),
				'c22' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field5' 
					) 
				),
				'c24' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field4' 
					) 
				),
				'c25' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field8' 
					) 
				),
				'c' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field9' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'columnCount' => 1,
			'inlineLabels' => false,
			'separateLabels' => false 
		),
		'step2' => array(
			'modelId' => 'simple-edit',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1' 
						) 
					),
					'section' => '' 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c3' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c5' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c4' 
						) 
					) 
				) 
			),
			'cells' => array(
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'integrated_edit_field' 
					) 
				),
				'c3' => array(
					'model' => 'c1',
					'items' => array( 
						'integrated_edit_field2' 
					) 
				),
				'c4' => array(
					'model' => 'c1',
					'items' => array( 
						'integrated_edit_field7' 
					) 
				),
				'c5' => array(
					'model' => 'c1',
					'items' => array( 
						'integrated_edit_field6' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'columnCount' => 1,
			'inlineLabels' => false,
			'separateLabels' => false 
		),
		'step3' => array(
			'modelId' => 'simple-edit',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => 'c1' 
						) 
					),
					'section' => '' 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c2' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c' 
						) 
					) 
				) 
			),
			'cells' => array(
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'integrated_edit_field1' 
					) 
				),
				'c' => array(
					'model' => 'c1',
					'items' => array( 
						'captcha' 
					) 
				),
				'c2' => array(
					'model' => 'c1',
					'items' => array( 
						'integrated_confirm_password' 
					) 
				) 
			),
			'deferredItems' => array( 
				 
			),
			'columnCount' => 1,
			'inlineLabels' => false,
			'separateLabels' => false 
		) 
	),
	'items' => array(
		'register_header' => array(
			'type' => 'register_header' 
		),
		'register_reset' => array(
			'type' => 'register_reset' 
		),
		'register_message' => array(
			'type' => 'register_message' 
		),
		'register_save' => array(
			'type' => 'register_save' 
		),
		'back_to_login' => array(
			'type' => 'back_to_login' 
		),
		'integrated_edit_field' => array(
			'field' => 'username',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field1' => array(
			'field' => 'password_hash',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'label' => array(
				'field' => 'password_hash',
				'table' => 'users',
				'type' => 3 
			) 
		),
		'integrated_confirm_password' => array(
			'type' => 'integrated_confirm_password',
			'field' => 'confirm_aoel3cx',
			'orientation' => 0 
		),
		'integrated_edit_field2' => array(
			'field' => 'email',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field3' => array(
			'field' => 'first_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field4' => array(
			'field' => 'middle_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field5' => array(
			'field' => 'last_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field6' => array(
			'field' => 'phone',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field7' => array(
			'field' => 'alternate_phone',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field8' => array(
			'field' => 'full_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'captcha' => array(
			'type' => 'captcha' 
		),
		'next_step' => array(
			'type' => 'next_step' 
		),
		'step_nav' => array(
			'type' => 'step_nav' 
		),
		'integrated_edit_field9' => array(
			'field' => 'is_doctor',
			'type' => 'integrated_edit_field',
			'orientation' => 0,
			'label' => array(
				'field' => 'is_doctor',
				'table' => 'users',
				'type' => 3 
			) 
		),
		'image' => array(
			'type' => 'image',
			'image' => array(
				'image' => 'merq.png',
				'source' => 2 
			),
			'width' => '400px',
			'mobileDisplay' => 'both' 
		) 
	),
	'dbProps' => array(
		 
	),
	'steps' => array( 
		array(
			'location' => 'grid',
			'label' => array(
				'text' => 'Initials',
				'type' => 0 
			) 
		),
		array(
			'location' => 'step2',
			'label' => array(
				'text' => 'Account',
				'type' => 0 
			) 
		),
		array(
			'location' => 'step3',
			'label' => array(
				'text' => 'Security',
				'type' => 0 
			) 
		) 
	),
	'version' => 13,
	'imageItem' => array(
		'type' => 'page_image',
		'shadow' => false,
		'fullSize' => true,
		'image' => array(
			'source' => 1,
			'image' => 'matheus-negrao-2oQAi9M6cVY-unsplash.jpg' 
		) 
	),
	'imageBgColor' => '#f2f2f2',
	'controlsBgColor' => 'white',
	'imagePosition' => 'left',
	'listTotals' => 1,
	'title' => array(
		 
	) 
);
		?>