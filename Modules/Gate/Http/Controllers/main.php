<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Africa/Nairobi',
    'bootstrap' => ['log'],
    'aliases' => [
        '@nineinchnick/nfy' => '@vendor/nineinchnick/yii2-nfy',
    ],
    'components' => [
       'msgHelper'=>[
          'class'=>'common\plugins\messaging\components\MsgHelper',
          'copy2Email'=>false,
       ],
       
       'subscribers'=>[
          'class'=>"common\components\SubscriptionHelper",

       ],
       'msgHelper'=>[
       'class'=>'common\plugins\messaging\components\MsgHelper',
       'copy2Email'=>false,
       ],
       'meta'=>[
           'class'=>'common\components\PostMeta',
       ],
       'httpclient' => [
        'class' =>'understeam\httpclient\Client',
       ],
       'shortcodes' => [
            'class' => 'common\components\Shortcode',
            'callbacks' => [
                //'shareButton' => ['\ijackua\sharelinks\ShareLinks', 'widget'],
                'shareButton'=>function($attrs, $content, $tag,$model){
                  return \common\widgets\ShareButtons::widget([
                    'viewName'=>'@common/views/socialButton.php',
                    'model'=>$model,
                    ]);
                },

            ]
        ],
     
        
       'sms' => [
 
            'class' => 'common\plugins\sms\components\SMS',
 
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            //'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
              'class' => 'Swift_SmtpTransport',
              'host' => 'smtp.gmail.com',
              'username' => 'systemtesting209@gmail.com',
              'password' => 'nzdufisviblmvkup',
              'port' => '587',
              'encryption' => 'tls',
              ],
          ],
        
        'urlManager' => [
          'class' => 'yii\web\UrlManager',
         //Disable index.php,
          'showScriptName' => false,
           //Disable r= routes,
          'enablePrettyUrl' => true,
          'rules' => [
                  '<controller:\w+>/<id:\d+>'       => '<controller>/view',                 
                  '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                  '<controller:\w+>/<action:\w+>' => '<controller>/<action>',                  
                  '<module:user>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
          ],
        ],
       'authManager' => [
            'class' => 'yii\rbac\DbManager',
	          'defaultRoles' => ['Admin','Admin'], // here define your roles
        
        ],

    ],
    'modules'=>[
       'utility' => [
            'class' => 'c006\utility\migration\Module',
            //'allowedIPs' => ['127.0.0.1', '::1']  //allowing ip's
        ],
       'gii' => [
          'class' => 'yii\gii\Module', //adding gii module
          'allowedIPs' => ['127.0.0.1', '::1']  //allowing ip's 
        ],
       'nfy' => [
            'class' => 'nineinchnick\nfy\Module',
            'userClass'=>'common\models\User',
        ],
        
       
       

    ],

];
