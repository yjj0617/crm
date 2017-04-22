<?php
session_start();
require 'vendor/autoload.php';
date_default_timezone_set('Asia/Chongqing');
$domain = explode('.', $_SERVER['HTTP_HOST']);
$settings = require 'inc/settings.php';//应用配置
$flag = 404;
$data = [];
$msg = '';
$assets_path = $settings['settings']['renderer']['assets_path'];
//Edit by chang @04.05
$db = new medoo([
	    'database_type' => $settings['settings']['db']['database_type'],
	    'database_name' => $settings['settings']['db']['database_name'],
	    'server' => $settings['settings']['db']['server'],
	    'username' => $settings['settings']['db']['username'],
	    'password' => $settings['settings']['db']['password'],
	    'charset' => $settings['settings']['db']['charset'],
	    'port'=>$settings['settings']['db']['port'],
	    'prefix' => 'zscrm_'
 
	]);

$settings['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        global $domain;
        	return $c['response']
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html;charset=utf-8')
            ->write('<div style="text-align:center;padding-top:23%;">也？页面哪儿去了？迷路了，还是走丢了？</div>');
    };
};
// $settings['errorHandler'] = function ($c) {
//     return function ($request, $response) use ($c) {
//         	return $c['response']
//             ->withStatus(500)
//             ->withHeader('Content-Type', 'text/html;charset=utf-8')
//             ->write('<div style="text-align:center;padding-top:23%;">也？有错误发生？请联系攻城狮：service@missui.com</div>');
//     };
// };


$app = new \Slim\App($settings);
$container = $app->getContainer();

require 'inc/dependencies.php';//附加属性
require 'Middleware/middleware.php';
require 'Middleware/CrmMiddleware.php';
require 'inc/routes.php';//页面路由
require 'inc/routes_b.php';//页面路由-姚
require 'inc/routes_c.php';//页面路由-常
require 'inc/function.php';//公共函数
$app->run();