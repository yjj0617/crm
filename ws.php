<?php
    use \Slim\Views\PhpRenderer;
	use Ratchet\Server\IoServer;
	use Ratchet\Http\HttpServer;
	use Ratchet\WebSocket\WsServer;
	use MyApp\Chat;

    date_default_timezone_set('Asia/Chongqing');
     require __DIR__ .'/vendor/autoload.php';
    $settings = require __DIR__ .'/inc/settings.php';//应用配置
    
    $db = new medoo([
        'database_type' => $settings['settings']['db']['database_type'],
        'database_name' => $settings['settings']['db']['database_name'],
        'server' => $settings['settings']['db']['server'],
        'username' => $settings['settings']['db']['username'],
        'password' => $settings['settings']['db']['password'],
        'charset' => $settings['settings']['db']['charset'],
        'prefix' => 'zscrm_'
    ]);

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Chat()
            )
        ),
        8021
    );
    $server->run();
