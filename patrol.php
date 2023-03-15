<?php 
require_once 'common.php';
require_once 'Model/PatrolAction.php';

$model = new PatrolAction(); // 保存アクションモデル

$config = g_getConfig(); // 設定を取得します。
if($config['live_flg'] == 0) die(); // 作動フラグがOFFなら何もしない。

// ▼ 正パスデータを取得する
$file = 'data/data.json';
$jsonData = file_get_contents($file);
$correctData = json_decode($jsonData, true); // 正パスデータ

// 正パスマップを作成する
$correctMap = $model->createCorrectMap($correctData);

// // jsonファイルから危険データを取得する■■■□□□■■■□□□
// $dangerData = $model->getDangerDataFromJson();


// ▼　最新パスデータを取得する
$target_dir = $config['target_dir'];
$latestData = $model->getPathData($target_dir); // 最新パスデータ

$danger_flg = 0; // 危険検知フラグ 0:検出なし, 1:危険検出

foreach($latestData as $latestEnt){
	$path_name = $latestEnt['path_name']; // パス名
	
	// 正パスデータに存在しないパスである場合（危険ファイルを検知）
	if(empty($correctMap[$path_name])){
		
		$res = $model->deleteDanger($target_dir . $path_name); // 危険削除
		
		$danger_flg = 1;
	}
	
	// 正パスデータの更新日付と一致しない場合
	else{
		
	}
	
}
