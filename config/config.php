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
        'language' => [
            'common',
            'login',
            'forget_password',
            'reset_password',
            'user_info',
            'account',
            'bank_account',
            'gender',
            'title_signboard',
            'guide_signboard',
            'owner',
            'partner',
            'message',
            'modal_confirm',
        ],
        'validation' => ['validation']
    ],
    'path_url_file' => null // if it is not empty, it will be specified as the import file
];
