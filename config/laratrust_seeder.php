<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'sales' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'operation' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'field_team' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'accounts' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'supplier' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'data_center' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        // 'user' => [
        //     'profile' => 'r,u',
        // ],
        // 'role_name' => [
        //     'module_1_name' => 'c,r,u,d',
        // ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
