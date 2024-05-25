<?php

namespace app\assets;
use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css',

        'web/assets/plugins/custom/datatables/datatables.bundle.css',
        'web/assets/plugins/global/plugins.bundle.css',
        'web/assets/css/style.bundle.css',
        'web/assets/plugins/custom/datatables/datatables.bundle.css',
        'web/assets/plugins//custom/fullcalendar/fullcalendar.bundle.css        '
    ];
    public $js = [
        'web/assets/plugins/global/plugins.bundle.js',
        'web/assets/js/scripts.bundle.js',
        'web/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js',
        'web/assets/js/custom/apps/calendar/calendar.js',
                'web/assets/js/custom/authentication/sign-in/general.js',
        'web/assets/js/custom/utilities/modals/create-account.js',
        'web/assets/plugins/custom/datatables/datatables.bundle.js',
        'web/assets/plugins/custom/formrepeater/formrepeater.bundle.js'

    ];

    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}