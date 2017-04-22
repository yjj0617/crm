<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbb2acc3984e9a4560fa868e1cfc03beb
{
    public static $files = array (
        'ad155f8f1cf0d418fe49e248db8c661b' => __DIR__ . '/..' . '/react/promise/src/functions_include.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
        'c7359326b6707d98bdc176bf9ddeaebf' => __DIR__ . '/..' . '/catfan/medoo/medoo.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\Routing\\' => 26,
            'Symfony\\Component\\HttpFoundation\\' => 33,
            'Symfony\\Component\\EventDispatcher\\' => 34,
            'Slim\\Views\\' => 11,
            'Slim\\' => 5,
        ),
        'R' => 
        array (
            'React\\Stream\\' => 13,
            'React\\Socket\\' => 13,
            'React\\Promise\\' => 14,
            'React\\EventLoop\\' => 16,
            'Ratchet\\' => 8,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'I' => 
        array (
            'Interop\\Container\\' => 18,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\Routing\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/routing',
        ),
        'Symfony\\Component\\HttpFoundation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/http-foundation',
        ),
        'Symfony\\Component\\EventDispatcher\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/event-dispatcher',
        ),
        'Slim\\Views\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/php-view/src',
        ),
        'Slim\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/slim/Slim',
        ),
        'React\\Stream\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/stream/src',
        ),
        'React\\Socket\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/socket/src',
        ),
        'React\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/promise/src',
        ),
        'React\\EventLoop\\' => 
        array (
            0 => __DIR__ . '/..' . '/react/event-loop/src',
        ),
        'Ratchet\\' => 
        array (
            0 => __DIR__ . '/..' . '/cboden/ratchet/src/Ratchet',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'Interop\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/container-interop/container-interop/src/Interop/Container',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
        ),
        'G' => 
        array (
            'Guzzle\\Stream' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/stream',
            ),
            'Guzzle\\Parser' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/parser',
            ),
            'Guzzle\\Http' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/http',
            ),
            'Guzzle\\Common' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/common',
            ),
        ),
        'E' => 
        array (
            'Evenement' => 
            array (
                0 => __DIR__ . '/..' . '/evenement/evenement/src',
            ),
        ),
    );

    public static $classMap = array (
        'ArticleController' => __DIR__ . '/../..' . '/Controller/ArticleController.class.php',
        'CmsController' => __DIR__ . '/../..' . '/Controller/CmsController.class.php',
        'Common\\Library\\WebSocketClient' => __DIR__ . '/../..' . '/Controller/wscController.class.php',
        'CompanyController' => __DIR__ . '/../..' . '/Controller/CompanyController.class.php',
        'ComplainController' => __DIR__ . '/../..' . '/Controller/ComplainController.class.php',
        'ContractController' => __DIR__ . '/../..' . '/Controller/ContractController.class.php',
        'CostController' => __DIR__ . '/../..' . '/Controller/CostController.class.php',
        'CrmMiddleware' => __DIR__ . '/../..' . '/Middleware/CrmMiddleware.php',
        'DesktopController' => __DIR__ . '/../..' . '/Controller/DesktopController.class.php',
        'ExecutiveController' => __DIR__ . '/../..' . '/Controller/ExecutiveController.class.php',
        'FeedbackController' => __DIR__ . '/../..' . '/Controller/FeedbackController.class.php',
        'HrController' => __DIR__ . '/../..' . '/Controller/HrController.class.php',
        'LogController' => __DIR__ . '/../..' . '/Controller/LogController.class.php',
        'MediaController' => __DIR__ . '/../..' . '/Controller/MediaController.class.php',
        'MemberController' => __DIR__ . '/../..' . '/Controller/MemberController.class.php',
        'Middleware' => __DIR__ . '/../..' . '/Middleware/middleware.php',
        'MoneyController' => __DIR__ . '/../..' . '/Controller/MoneyController.class.php',
        'MyApp\\Chat' => __DIR__ . '/../..' . '/Controller/ChatController.class.php',
        'OperateController' => __DIR__ . '/../..' . '/Controller/OperateController.class.php',
        'OpportunityController' => __DIR__ . '/../..' . '/Controller/OpportunityController.class.php',
        'PerformanceController' => __DIR__ . '/../..' . '/Controller/PerformanceController.class.php',
        'QaController' => __DIR__ . '/../..' . '/Controller/QaController.class.php',
        'ReportController' => __DIR__ . '/../..' . '/Controller/ReportController.class.php',
        'ServiceController' => __DIR__ . '/../..' . '/Controller/ServiceController.class.php',
        'SettingController' => __DIR__ . '/../..' . '/Controller/SettingController.class.php',
        'SmsController' => __DIR__ . '/../..' . '/Controller/SmsController.class.php',
        'StaffController' => __DIR__ . '/../..' . '/Controller/StaffController.class.php',
        'ToolController' => __DIR__ . '/../..' . '/Controller/ToolController.class.php',
        'UploadController' => __DIR__ . '/../..' . '/Controller/UploadController.class.php',
        'WechatController' => __DIR__ . '/../..' . '/Controller/WechatController.class.php',
        'ZsfundController' => __DIR__ . '/../..' . '/Controller/ZsfundController.class.php',
        'upload' => __DIR__ . '/../..' . '/Controller/upload/class.upload.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbb2acc3984e9a4560fa868e1cfc03beb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbb2acc3984e9a4560fa868e1cfc03beb::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitbb2acc3984e9a4560fa868e1cfc03beb::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitbb2acc3984e9a4560fa868e1cfc03beb::$classMap;

        }, null, ClassLoader::class);
    }
}