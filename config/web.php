<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'YATAGUI',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => $_SESSION['lang'],
    //'layout' => 'admin_layout',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [

        'mainClass' => [
            'class' => 'app\components\mainClass', //class pour les configurations
        ],

        'productClass' => [
            'class' => 'app\components\productClass', //class pour les produits
        ],

        
        'membreClass' => [
            'class' => 'app\components\membreClass', //class pour les produits
        ],

        'nonSqlClass' => [
            'class' => 'app\components\nonSqlClass', // CLass pour les fichiers
        ],

        'menuactionClass' => [
            'class' => 'app\components\menuactionClass',
        ],

        'personnelCLass' => [
            'class' => 'app\components\personnelCLass', //class pour les configurations
        ],
        'notificationCLass' => [
            'class' => 'app\components\notificationCLass', //class pour les configurations
        ],

        'fileuploadClass' => [
            'class' => 'app\components\fileuploadClass', //class pour les fichier
        ],


        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],




        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '&*()@A^)!(%^&*)@#$%^&*(*^%$_SDF$%^&%^',
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        // 'mailer' => [
        //     'class' => \yii\symfonymailer\Mailer::class,
        //     'viewPath' => '@app/mail',
        //     // send all mails to a file by default.
        //     'useFileTransport' => true,
        // ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [


                // siteController
                md5('site_index') => 'site/index',

                //productController
              
                md5('membre_liste') => 'membre/membre',


                md5('produit_groupe') => 'produit/groupe',
                md5('produit_reference') => 'produit/reference',
                md5('produit_banner') => 'produit/banner',
                md5('produit_product') => 'produit/product',
                md5('produit_productadd') => 'produit/productadd',
                md5('produit_productupdate') . '/<code:\w+>' => 'produit/productupdate',

                //clientcontroller
                md5('client_client') => 'client/client',
                md5('client_add') => 'client/add',

                md5('client_profil') => 'client/profil',



                //visiteurController
                md5('visiteur_unicitelibelle') => 'visiteur/unicitelibelle',

             
                /** DEFAULT RULES **/
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}
// die('ok');

return $config;
