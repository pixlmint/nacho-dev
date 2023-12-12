<?php

use App\Controller\Debug;
use App\Controller\ParsedownTest;

return [
    'routes' => [
        [
            'route' => '/api/info',
            'controller' => Debug::class,
            'function' => 'info',
        ],
        [
            'route' => '/api/parsedown/test',
            'controller' => ParsedownTest::class,
            'function' => 'md',
        ],
    ],
    'plugins' => [
        [
            'name' => 'my-first-test-plugin',
            'enabled' => false,
            'install_method' => 'source_code',
            'config' => require_once('plugins/my-first-test-plugin/config/config.php'),
        ],
        [
            'name' => 'pixlcms-journal-plugin',
            'enabled' => false,
            'install_method' => 'source_code',
            'config' => require_once('plugins/pixlcms-journal-plugin/config/config.php'),
        ],
        [
            'name' => 'pixlcms-wiki-plugin',
            'enabled' => true,
            'install_method' => 'source_code',
            'config' => require_once('plugins/pixlcms-wiki-plugin/config/config.php'),
        ],
        [
            'name' => 'pixlcms-media-plugin',
            'enabled' => true,
            'install_method' => 'source_code',
            'config' => require_once('plugins/pixlcms-media-plugin/config/config.php'),
        ],
    ],
    'base' => [
        'debugEnabled' => true,
        'frontendController' => PixlMint\CMS\Controllers\FrontendController::class,
    ],
];