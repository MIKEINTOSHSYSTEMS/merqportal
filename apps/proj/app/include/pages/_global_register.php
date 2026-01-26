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
			'full_name' 
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
			) 
		) 
	),
	'layoutHelper' => array(
		'formItems' => array(
			'formItems' => array(
				'above-grid' => array( 
					'register_message' 
				),
				'top' => array( 
					'register_header' 
				),
				'footer' => array( 
					'register_save',
					'back_to_login',
					'register_reset' 
				),
				'grid' => array( 
					'integrated_edit_field3',
					'integrated_edit_field',
					'integrated_edit_field4',
					'integrated_edit_field2',
					'integrated_edit_field6',
					'integrated_edit_field7',
					'integrated_edit_field1',
					'integrated_confirm_password',
					'captcha',
					'integrated_edit_field5',
					'integrated_edit_field8' 
				) 
			),
			'formXtTags' => array(
				 
			),
			'itemForms' => array(
				'register_message' => 'above-grid',
				'register_header' => 'top',
				'register_save' => 'footer',
				'back_to_login' => 'footer',
				'register_reset' => 'footer',
				'integrated_edit_field3' => 'grid',
				'integrated_edit_field' => 'grid',
				'integrated_edit_field4' => 'grid',
				'integrated_edit_field2' => 'grid',
				'integrated_edit_field6' => 'grid',
				'integrated_edit_field7' => 'grid',
				'integrated_edit_field1' => 'grid',
				'integrated_confirm_password' => 'grid',
				'captcha' => 'grid',
				'integrated_edit_field5' => 'grid',
				'integrated_edit_field8' => 'grid' 
			),
			'itemLocations' => array(
				'integrated_edit_field3' => array(
					'location' => 'grid',
					'cellId' => 'c' 
				),
				'integrated_edit_field' => array(
					'location' => 'grid',
					'cellId' => 'c4' 
				),
				'integrated_edit_field4' => array(
					'location' => 'grid',
					'cellId' => 'c1' 
				),
				'integrated_edit_field2' => array(
					'location' => 'grid',
					'cellId' => 'c2' 
				),
				'integrated_edit_field6' => array(
					'location' => 'grid',
					'cellId' => 'c6' 
				),
				'integrated_edit_field7' => array(
					'location' => 'grid',
					'cellId' => 'c7' 
				),
				'integrated_edit_field1' => array(
					'location' => 'grid',
					'cellId' => 'c8' 
				),
				'integrated_confirm_password' => array(
					'location' => 'grid',
					'cellId' => 'c9' 
				),
				'captcha' => array(
					'location' => 'grid',
					'cellId' => 'c12' 
				),
				'integrated_edit_field5' => array(
					'location' => 'grid',
					'cellId' => 'c14' 
				),
				'integrated_edit_field8' => array(
					'location' => 'grid',
					'cellId' => 'c15' 
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
				'integrated_edit_field8' 
			),
			'integrated_confirm_password' => array( 
				'integrated_confirm_password' 
			),
			'captcha' => array( 
				'captcha' 
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
							'integrated_edit_field3' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c1' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field4' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c14' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field5' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c15' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field8' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c4' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c2' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field2' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c6' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field6' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c7' => array(
						'cols' => array( 
							1 
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
					),
					'c8' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field1' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c9' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_confirm_password' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c10' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							5 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c11' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							5 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c12' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							6 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'captcha' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'c13' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							6 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c3' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							7 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'c5' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							7 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					) 
				),
				'width' => 2,
				'height' => 8 
			) 
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
			'full_name' 
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
				) 
			),
			'cells' => array(
				'c1' => array(
					'model' => 'c1',
					'items' => array( 
						'register_message' 
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
					) 
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
						),
						array(
							'cell' => 'c1' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c14' 
						),
						array(
							'cell' => 'c15' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c4' 
						),
						array(
							'cell' => 'c2' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c6' 
						),
						array(
							'cell' => 'c7' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c8' 
						),
						array(
							'cell' => 'c9' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c10' 
						),
						array(
							'cell' => 'c11' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'c12' 
						),
						array(
							'cell' => 'c13' 
						) 
					) 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'c3' 
						),
						array(
							'cell' => 'c5' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'c3' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field3' 
					) 
				),
				'c4' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field' 
					) 
				),
				'c1' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field4' 
					) 
				),
				'c2' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field2' 
					) 
				),
				'c5' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c6' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field6' 
					) 
				),
				'c7' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field7' 
					) 
				),
				'c8' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field1' 
					) 
				),
				'c9' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_confirm_password' 
					) 
				),
				'c10' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c11' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c12' => array(
					'model' => 'c3',
					'items' => array( 
						'captcha' 
					) 
				),
				'c13' => array(
					'model' => 'c3',
					'items' => array( 
						 
					) 
				),
				'c14' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field5' 
					) 
				),
				'c15' => array(
					'model' => 'c3',
					'items' => array( 
						'integrated_edit_field8' 
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
			'orientation' => 0 
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
			'source' => 3,
			'image' => 'pexels-pixabay-326337.jpg' 
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