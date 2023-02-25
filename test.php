<?php
require_once 'common.php';
require_once 'Model/SaveAction.php';


$config = g_getConfig(); // 設定を取得します。

$config['neko'] = 'neko2';

dump($config);//■■■□□□■■■□□□)
g_saveConfig($config);
// $config_str = '';

// foreach ($config as $key => $value) {
// 	$config_str .= "{$key} = {$value}\n";
// }

// file_put_contents('config_l.ini', $config_str);

echo 'OK';


