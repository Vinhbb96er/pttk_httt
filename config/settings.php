<?php

return [
    'pre_id' => [
        'faculty' => 'K',
        'patient' => 'BN',
        'medical_record' => 'BA',
        'position' => 'CV',
        'staff' => 'NV',
        'registration' => 'P',
    ],
    'paginate_default_val' => 10,
    'staff_role' => [
        'super_admin' => 0,
        'admin' => 1,
        'front_desk_staff' => 2,
        'faculty_staff' => 3,
    ],
    'staff_status' => [
        'active' => 1,
        'lock' => 0,
    ],
    'upload_path' => [
        'staffs' => '/uploads/staffs/',
    ],
    'image_default' => [
        'no_image' => '/templates/img/no-image.jpeg',
    ],
    'condition_search' => [
        'staffs' => [
            'all' => 0,
            'name' => 1,
            'id' => 2,
            'faculty' => 3,
        ]
    ]
];
