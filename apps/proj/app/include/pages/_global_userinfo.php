<?php
			$optionsArray = array(
	'fields' => array(
		'gridFields' => array( 
			'username',
			'email',
			'full_name',
			'phone',
			'alternate_phone',
			'first_name',
			'middle_name',
			'last_name',
			'userpic' 
		),
		'searchRequiredFields' => array( 
			 
		),
		'searchPanelFields' => array( 
			 
		),
		'fieldItems' => array(
			'username' => array( 
				'integrated_edit_field' 
			),
			'email' => array( 
				'integrated_edit_field1' 
			),
			'full_name' => array( 
				'integrated_edit_field2' 
			),
			'phone' => array( 
				'integrated_edit_field3' 
			),
			'alternate_phone' => array( 
				'integrated_edit_field4' 
			),
			'first_name' => array( 
				'integrated_edit_field5' 
			),
			'middle_name' => array( 
				'integrated_edit_field6' 
			),
			'last_name' => array( 
				'integrated_edit_field7' 
			),
			'userpic' => array( 
				'user_picture' 
			) 
		) 
	),
	'layoutHelper' => array(
		'formItems' => array(
			'formItems' => array(
				'above-grid' => array( 
					 
				),
				'below-grid' => array( 
					 
				),
				'supertop' => array( 
					'expand_menu_button',
					'collapse_button',
					'breadcrumb',
					'loginform_login',
					'username_button' 
				),
				'left' => array( 
					'logo',
					'expand_button',
					'menu' 
				),
				'top' => array( 
					 
				),
				'grid' => array( 
					'user_fields_title',
					'integrated_edit_field2',
					'fields_message',
					'user_fields_reset',
					'user_fields_save',
					'changepassword_link',
					'user_picture',
					'integrated_edit_field',
					'integrated_edit_field1',
					'integrated_edit_field7',
					'integrated_edit_field3',
					'integrated_edit_field4',
					'integrated_edit_field5',
					'integrated_edit_field6',
					'twofactor_settings',
					'twofactor_label',
					'twofactor_comment',
					'twofactor_setup_comment',
					'twofactor_continue',
					'twofactor_skip' 
				) 
			),
			'formXtTags' => array(
				'above-grid' => array( 
					 
				),
				'below-grid' => array( 
					 
				),
				'top' => array( 
					 
				) 
			),
			'itemForms' => array(
				'expand_menu_button' => 'supertop',
				'collapse_button' => 'supertop',
				'breadcrumb' => 'supertop',
				'loginform_login' => 'supertop',
				'username_button' => 'supertop',
				'logo' => 'left',
				'expand_button' => 'left',
				'menu' => 'left',
				'user_fields_title' => 'grid',
				'integrated_edit_field2' => 'grid',
				'fields_message' => 'grid',
				'user_fields_reset' => 'grid',
				'user_fields_save' => 'grid',
				'changepassword_link' => 'grid',
				'user_picture' => 'grid',
				'integrated_edit_field' => 'grid',
				'integrated_edit_field1' => 'grid',
				'integrated_edit_field7' => 'grid',
				'integrated_edit_field3' => 'grid',
				'integrated_edit_field4' => 'grid',
				'integrated_edit_field5' => 'grid',
				'integrated_edit_field6' => 'grid',
				'twofactor_settings' => 'grid',
				'twofactor_label' => 'grid',
				'twofactor_comment' => 'grid',
				'twofactor_setup_comment' => 'grid',
				'twofactor_continue' => 'grid',
				'twofactor_skip' => 'grid' 
			),
			'itemLocations' => array(
				'user_fields_title' => array(
					'location' => 'grid',
					'cellId' => 'fields_message' 
				),
				'integrated_edit_field2' => array(
					'location' => 'grid',
					'cellId' => 'fields_message' 
				),
				'fields_message' => array(
					'location' => 'grid',
					'cellId' => 'fields_message' 
				),
				'user_fields_reset' => array(
					'location' => 'grid',
					'cellId' => 'buttons' 
				),
				'user_fields_save' => array(
					'location' => 'grid',
					'cellId' => 'buttons' 
				),
				'changepassword_link' => array(
					'location' => 'grid',
					'cellId' => 'fields' 
				),
				'user_picture' => array(
					'location' => 'grid',
					'cellId' => 'fields' 
				),
				'integrated_edit_field' => array(
					'location' => 'grid',
					'cellId' => 'fields1' 
				),
				'integrated_edit_field1' => array(
					'location' => 'grid',
					'cellId' => 'fields1' 
				),
				'integrated_edit_field7' => array(
					'location' => 'grid',
					'cellId' => 'fields5' 
				),
				'integrated_edit_field3' => array(
					'location' => 'grid',
					'cellId' => 'fields6' 
				),
				'integrated_edit_field4' => array(
					'location' => 'grid',
					'cellId' => 'fields7' 
				),
				'integrated_edit_field5' => array(
					'location' => 'grid',
					'cellId' => 'fields8' 
				),
				'integrated_edit_field6' => array(
					'location' => 'grid',
					'cellId' => 'fields9' 
				),
				'twofactor_settings' => array(
					'location' => 'grid',
					'cellId' => '2factor' 
				),
				'twofactor_label' => array(
					'location' => 'grid',
					'cellId' => '2factor_label' 
				),
				'twofactor_comment' => array(
					'location' => 'grid',
					'cellId' => '2factor_label' 
				),
				'twofactor_setup_comment' => array(
					'location' => 'grid',
					'cellId' => '2factor_label' 
				),
				'twofactor_continue' => array(
					'location' => 'grid',
					'cellId' => '2factor_buttons' 
				),
				'twofactor_skip' => array(
					'location' => 'grid',
					'cellId' => '2factor_buttons' 
				) 
			),
			'itemVisiblity' => array(
				'breadcrumb' => 5,
				'expand_menu_button' => 2,
				'expand_button' => 5 
			) 
		),
		'itemsByType' => array(
			'fields_message' => array( 
				'fields_message' 
			),
			'user_fields_reset' => array( 
				'user_fields_reset' 
			),
			'user_fields_save' => array( 
				'user_fields_save' 
			),
			'user_fields_title' => array( 
				'user_fields_title' 
			),
			'breadcrumb' => array( 
				'breadcrumb' 
			),
			'logo' => array( 
				'logo' 
			),
			'menu' => array( 
				'menu' 
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
			'expand_menu_button' => array( 
				'expand_menu_button' 
			),
			'collapse_button' => array( 
				'collapse_button' 
			),
			'integrated_edit_field' => array( 
				'integrated_edit_field',
				'integrated_edit_field1',
				'integrated_edit_field2',
				'integrated_edit_field3',
				'integrated_edit_field4',
				'integrated_edit_field5',
				'integrated_edit_field6',
				'integrated_edit_field7' 
			),
			'changepassword_link' => array( 
				'changepassword_link' 
			),
			'adminarea_link' => array( 
				'adminarea_link' 
			),
			'user_picture' => array( 
				'user_picture' 
			),
			'twofactor_settings' => array( 
				'twofactor_settings' 
			),
			'twofactor_comment' => array( 
				'twofactor_comment' 
			),
			'twofactor_setup_comment' => array( 
				'twofactor_setup_comment' 
			),
			'twofactor_label' => array( 
				'twofactor_label' 
			),
			'twofactor_continue' => array( 
				'twofactor_continue' 
			),
			'twofactor_skip' => array( 
				'twofactor_skip' 
			),
			'expand_button' => array( 
				'expand_button' 
			) 
		),
		'cellMaps' => array(
			'grid' => array(
				'cells' => array(
					'2factor_label' => array(
						'cols' => array( 
							0,
							1 
						),
						'rows' => array( 
							0 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'twofactor_label',
							'twofactor_comment',
							'twofactor_setup_comment' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'2factor' => array(
						'cols' => array( 
							0,
							1 
						),
						'rows' => array( 
							1 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'twofactor_settings' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'2factor_buttons' => array(
						'cols' => array( 
							0,
							1 
						),
						'rows' => array( 
							2 
						),
						'tags' => array( 
							'twofactor_continue',
							'twofactor_skip' 
						),
						'items' => array( 
							'twofactor_continue',
							'twofactor_skip' 
						),
						'fixedAtServer' => false,
						'fixedAtClient' => false 
					),
					'fields_message' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'user_fields_title',
							'integrated_edit_field2',
							'fields_message' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'fields1' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							3 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field',
							'integrated_edit_field1' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'fields8' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field5' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'fields9' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							4 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field6' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'fields4' => array(
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
					'fields5' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							5 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field7' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'fields6' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							6 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field3' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'fields7' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							6 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'integrated_edit_field4' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'fields' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							7 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'changepassword_link',
							'user_picture' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'fields2' => array(
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
					),
					'buttons' => array(
						'cols' => array( 
							0 
						),
						'rows' => array( 
							8 
						),
						'tags' => array( 
							 
						),
						'items' => array( 
							'user_fields_reset',
							'user_fields_save' 
						),
						'fixedAtServer' => true,
						'fixedAtClient' => false 
					),
					'fields3' => array(
						'cols' => array( 
							1 
						),
						'rows' => array( 
							8 
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
				'height' => 9 
			) 
		) 
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
	'id' => 'userinfo',
	'type' => 'userinfo',
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
		'below-grid' => array(
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
			'modelId' => 'leftbar-top-edit',
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
						'collapse_button',
						'breadcrumb' 
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
		'top' => array(
			'modelId' => 'empty-above-grid',
			'grid' => array( 
				 
			),
			'cells' => array(
				 
			),
			'deferredItems' => array( 
				 
			),
			'recsPerRow' => 1 
		),
		'grid' => array(
			'modelId' => 'userinfo-grid',
			'grid' => array( 
				array(
					'cells' => array( 
						array(
							'cell' => '2factor_label',
							'colspan' => 2 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
						array(
							'cell' => '2factor',
							'colspan' => 2 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
						array(
							'cell' => '2factor_buttons',
							'colspan' => 2 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'fields_message' 
						),
						array(
							'cell' => 'fields1' 
						) 
					),
					'section' => '' 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'fields8' 
						),
						array(
							'cell' => 'fields9' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'fields4' 
						),
						array(
							'cell' => 'fields5' 
						) 
					) 
				),
				array(
					'section' => '',
					'cells' => array( 
						array(
							'cell' => 'fields6' 
						),
						array(
							'cell' => 'fields7' 
						) 
					) 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'fields' 
						),
						array(
							'cell' => 'fields2' 
						) 
					),
					'section' => '' 
				),
				array(
					'cells' => array( 
						array(
							'cell' => 'buttons' 
						),
						array(
							'cell' => 'fields3' 
						) 
					),
					'section' => '' 
				) 
			),
			'cells' => array(
				'fields_message' => array(
					'model' => 'fields_message',
					'items' => array( 
						'user_fields_title',
						'integrated_edit_field2',
						'fields_message' 
					) 
				),
				'buttons' => array(
					'model' => 'buttons',
					'items' => array( 
						'user_fields_reset',
						'user_fields_save' 
					) 
				),
				'fields' => array(
					'model' => 'fields',
					'items' => array( 
						'changepassword_link',
						'user_picture' 
					) 
				),
				'fields1' => array(
					'model' => 'fields_message',
					'items' => array( 
						'integrated_edit_field',
						'integrated_edit_field1' 
					) 
				),
				'fields2' => array(
					'model' => 'fields',
					'items' => array( 
						 
					) 
				),
				'fields3' => array(
					'model' => 'buttons',
					'items' => array( 
						 
					) 
				),
				'fields4' => array(
					'model' => 'fields',
					'items' => array( 
						 
					) 
				),
				'fields5' => array(
					'model' => 'fields',
					'items' => array( 
						'integrated_edit_field7' 
					) 
				),
				'fields6' => array(
					'model' => 'fields',
					'items' => array( 
						'integrated_edit_field3' 
					) 
				),
				'fields7' => array(
					'model' => 'fields',
					'items' => array( 
						'integrated_edit_field4' 
					) 
				),
				'fields8' => array(
					'model' => 'fields',
					'items' => array( 
						'integrated_edit_field5' 
					) 
				),
				'fields9' => array(
					'model' => 'fields',
					'items' => array( 
						'integrated_edit_field6' 
					) 
				),
				'2factor' => array(
					'model' => '2factor',
					'items' => array( 
						'twofactor_settings' 
					) 
				),
				'2factor_label' => array(
					'model' => '2factor_label',
					'items' => array( 
						'twofactor_label',
						'twofactor_comment',
						'twofactor_setup_comment' 
					) 
				),
				'2factor_buttons' => array(
					'model' => '2factor_buttons',
					'items' => array( 
						'twofactor_continue',
						'twofactor_skip' 
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
		'fields_message' => array(
			'type' => 'fields_message' 
		),
		'user_fields_reset' => array(
			'type' => 'user_fields_reset' 
		),
		'user_fields_save' => array(
			'type' => 'user_fields_save' 
		),
		'user_fields_title' => array(
			'type' => 'user_fields_title',
			'font-size' => '24px' 
		),
		'breadcrumb' => array(
			'type' => 'breadcrumb' 
		),
		'logo' => array(
			'type' => 'logo' 
		),
		'menu' => array(
			'type' => 'menu' 
		),
		'username_button' => array(
			'type' => 'username_button',
			'items' => array( 
				'userinfo_link',
				'logout_link',
				'adminarea_link' 
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
		'expand_menu_button' => array(
			'type' => 'expand_menu_button' 
		),
		'collapse_button' => array(
			'type' => 'collapse_button' 
		),
		'integrated_edit_field' => array(
			'field' => 'username',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field1' => array(
			'field' => 'email',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field2' => array(
			'field' => 'full_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'changepassword_link' => array(
			'type' => 'changepassword_link' 
		),
		'adminarea_link' => array(
			'type' => 'adminarea_link' 
		),
		'integrated_edit_field3' => array(
			'field' => 'phone',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field4' => array(
			'field' => 'alternate_phone',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field5' => array(
			'field' => 'first_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field6' => array(
			'field' => 'middle_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'integrated_edit_field7' => array(
			'field' => 'last_name',
			'type' => 'integrated_edit_field',
			'orientation' => 0 
		),
		'user_picture' => array(
			'type' => 'user_picture',
			'field' => 'userpic',
			'orientation' => 0 
		),
		'twofactor_settings' => array(
			'type' => 'twofactor_settings' 
		),
		'twofactor_comment' => array(
			'type' => 'twofactor_comment' 
		),
		'twofactor_setup_comment' => array(
			'type' => 'twofactor_setup_comment' 
		),
		'twofactor_label' => array(
			'type' => 'twofactor_label',
			'font-size' => '24px' 
		),
		'twofactor_continue' => array(
			'type' => 'twofactor_continue' 
		),
		'twofactor_skip' => array(
			'type' => 'twofactor_skip' 
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