<?php 
require_once 'common.php';
require_once 'Model/BaseX.php';

$model = new BaseX();

$config = g_getConfig(); // 設定を取得します。

// // ▼ 正パスデータを取得する
// $file = 'data/data.json';
// $jsonData = file_get_contents($file);
// $correctData = json_decode($jsonData, true); // 正パスデータ

// // 正パスマップを作成する
// $correctMap = $model->createCorrectMap($correctData);

// // jsonファイルから危険データを取得する■■■□□□■■■□□□
// $dangerData = $model->getDangerDataFromJson();


// ▼　最新パスデータを取得する
$target_dir = $config['target_dir'];
$latestData = $model->getPathData($target_dir); // 最新パスデータ


foreach($latestData as $latestEnt){
	$path_name = $latestEnt['path_name']; // パス名
	
	echo "<div>{$path_name}</div>";
	
}
