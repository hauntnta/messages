<?php
/**
 * config message
 */
return [
    'languages' => [
        'en' => [
            'text_sheet_lang' => 'english',
            'text_sheet_validation' => 'message_en'
        ],
        'ja' => [
            'text_sheet_lang' => 'japanese',
            'text_sheet_validation' => 'message_jp'
        ]
    ],
    'sheet' => [
        'base_lang' => [
            'common' => [
                'length' => [1, 65]
            ],
            'login' => [
                'length' => [66, 71]
            ],
            'forget_password' => [
                'length' => [72, 76]
            ],
            'reset_password' => [
                'length' => [77, 81]
            ],
            'user_info' => [
                'length' => [82, 114]
            ],
            'account' => [
                'length' => [115, 128]
            ],
            'bank_account' => [
                'length' => [129, 134]
            ],
            'gender' => [
                'length' => [135, 139]
            ],
            'title_signboard' => [
                'length' => [140, 152]
            ],
            'guide_signboard' => [
                'length' => [153, 162]
            ],
            'owner' => [
                'length' => [163, 171]
            ],
            'partner' => [
                'length' => [172, 179]
            ],
            'message' => [
                'length' => [181, 189]
            ],
            'modal_confirm' => [
                'length' => [190, 198]
            ]
        ],
        'validation' => [

        ]
    ],
    'path_url_file' => null // if it is not empty, it will be specified as the import file
];
