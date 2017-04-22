<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => 'templates/',
            'home_path' => 'http://t.cw2009.com/',
            'app_name' => 'CRM管理系统',
            'assets_path' => 'http://assets.cw2009.com:8020/',
            'version' => '2.0.1'
        ],

        //Monolog settings
        'logger' => [
            'name' => 'mcms',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        //Database
        'db' => [
            'database_type' => 'mysql',
            'database_name' => 'zs',
            'server' => '127.0.0.1',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'port' => '3306'
        ]
    ],
];
