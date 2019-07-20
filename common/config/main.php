<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@frontend/runtime/cache',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => '431988086385-nqiu0tc3j3euakc492m6biu5m1l10lhp.apps.googleusercontent.com',
                    'clientSecret' => 'Wcajsy_SYoiiguI67wAZs-ZL',
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '2251285511628766',
                    'clientSecret' => 'b1542163de41a407e18560af537a32ae',
                ],
                // etc.
            ],
        ]

    ],
];
