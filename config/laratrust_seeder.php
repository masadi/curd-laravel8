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
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'siswa' => 'c,r,u,d',
            'guru' => 'c,r,u,d',
            'mata_pelajaran' => 'c,r,u,d',
            'kelas' => 'c,r,u,d',
            'absen' => 'c,r,u,d',
        ],
        'siswa' => [
            'profile' => 'r,u',
            'absen' => 'c,r',
        ],
        'guru' => [
            'profile' => 'r,u',
            'absen' => 'c,r',
            'mata_pelajaran' => 'r',
            'kelas' => 'r',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
