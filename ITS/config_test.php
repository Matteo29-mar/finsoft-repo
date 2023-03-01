<?php

DEFINE('APP_VERSION', '0.0.1');


DEFINE('DEBUG',    true);
DEFINE('LOCALENV', true);

DEFINE('SALT', 'qdm6hcawn0iktrzl9soy27pg1exj843bvf5u');

DEFINE('MAILER_DEFAULT_FROM_EMAIL', 'postmaster@molto.cloud');
DEFINE('MAILER_DEFAULT_FROM_USER',  '');
define('MAILER_DSN',                'smtp://postmaster@molto.cloud:PieroDellaFrancesca1983!@smtps.aruba.it:465/?encryption=ssl&auth_mode=login');

if (LOCALENV) {
    DEFINE('HTTP_BASEURL', 'http://localhost/');
    DEFINE('SUBDIR',       '/');

    $sql_details = [
        'type' =>       'Mysql',
        'servername' => '127.0.0.1',
        'username' =>   '<USER>',
        'password' =>   '<PASS>',
        'port' =>       '3306',
        'db' =>         '<DB>',
        'dsn' =>        'charset=utf8'
    ];
} else {
    DEFINE('HTTP_BASEURL', 'https://www.example.com/');
    DEFINE('SUBDIR',       '/');

    $sql_details = [
        'type' =>       'Mysql',
        'servername' => '<SERVERNAME>',
        'username' =>   '<USERNAME>',
        'password' =>   '<PASSWORD>',
        'port' =>       '<PORT>',
        'db' =>         '<DB>',
        'dsn' =>        '<DSN>'
    ];
}
