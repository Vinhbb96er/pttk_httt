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
        'patients' => '/uploads/patients/',
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
        ],
        'patients' => [
            'all' => 0,
            'name' => 1,
            'id' => 2,
            'insurance_number' => 3,
        ],

        'medical_records' => [
            'all' => 0,
            'name' => 1,
            'id' => 2,
            'insurance_number' => 3,
            'faculty' => 4,
        ],
    ],
    'medical_record' => [
        'status' => [
            'leave' => 1,
            'stay' => 2,
            'move' => 3,
            'other' => 4,
        ]
    ]
];
