<?php 
require_once 'common.php';
require_once 'Model/BaseX.php';

$model = new BaseX();

$config = g_getConfig(); // 設定を取得します。


// ▼　最新パスデータを取得する
$target_dir = $config['target_dir'];
$latestData = $model->getPathData($target_dir); // 最新パスデータ


foreach($latestData as $latestEnt){
	$path_name = $latestEnt['path_name']; // パス名
	
	echo "<div>{$path_name}</div>";
	
}
