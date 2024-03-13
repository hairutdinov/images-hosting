<?php

use yii\i18n\Formatter;
use yii\web\JsonParser;
use yii\web\JsonResponseFormatter;
use yii\web\Response;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'user' => [
            'enableSession' => false,
            'loginUrl' => null,
            'identityClass' => 'yii\web\User',
        ],
        'request' => [
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
            'enableCookieValidation' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/url-rules.php'),
        ],
        'response' => [
            'class' => Response::class,
            'format' =>  Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            'formatters' => [
                Response::FORMAT_JSON => array(
                    'class' => JsonResponseFormatter::class,
                    'prettyPrint' => YII_DEBUG,
                ),
            ],
        ],
    ],
    'params' => $params,
];
