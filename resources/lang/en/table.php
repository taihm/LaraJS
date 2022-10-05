<?php

return [
    'actions' => 'Actions',
    'user' => [
        'id' => 'No.',
        'name' => 'Name',
        'email' => 'Email',
        'avatar' => 'Avatar',
        'role' => 'Role',
        'password' => 'Password',
        'password_confirmation' => 'Confirmation password',
    ],
    'rolePermission' => [
        'id' => 'No.',
        'name' => 'Name',
        'description' => 'Description',
    ],
    'data_excel' => [
		'id' => 'ID',
        'name' => 'Name',
        'content' => 'Content',
	],
    'building' => [
		'id' => 'ID',
        'name' => 'Name',
        'address' => 'Address',
        'status' => 'Status',
	],
    'staff' => [
		'id' => 'ID',
        'building_id' => 'Building',
        'user_id' => 'User',
        'staff_position_id' => 'Staff position',
        'status' => 'Status',
	],
    'staff_position' => [
		'id' => 'ID',
        'name' => 'Name',
        'description' => 'Description',
	],
    'support_service' => [
		'id' => 'ID',
        'name' => 'Name',
        'description' => 'Description',
        'fee' => 'Fee',
	],
    //{{LANG_TABLE_NOT_DELETE_THIS_LINE}}
    'texts' => [
        'count' => 'Showing {from} to {to} of {count} records|{count} records|One record',
        'first' => 'First',
        'last' => 'Last',
        'filter' => 'Filter:',
        'filterPlaceholder' => 'Search...',
        'limit' => 'Records:',
        'page' => 'Page:',
        'noResults' => 'No matching records',
        'filterBy' => 'Filter by {column}',
        'loading' => 'Loading...',
        'defaultOption' => 'Select {column}',
        'columns' => 'Columns',
    ],
];
