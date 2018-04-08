<?php

return [
    'accountKitAppId'          => env('ACCOUNTKIT_APP_ID'),
    'accountKitAppSecret'      => env('ACCOUNTKIT_APP_SECRET'),
    'accountKitRedirectUrl'    => env('ACCOUNTKIT_REDIRECT_URL'),
    'accountKitLoginTypeSms'   => env('ACCOUNTKIT_LOGIN_TYPE_SMS', 'https://www.accountkit.com/v1.0/basic/dialog/sms_login/'),
    'accountKitLoginTypeEmail' => env('ACCOUNTKIT_LOGIN_TYPE_EMAIL', 'https://www.accountkit.com/v1.0/basic/dialog/email_login/'),
];
