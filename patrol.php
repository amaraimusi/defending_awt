<?php 
require_once 'common.php';
require_once 'Model/PatrolAction.php';

$model = new PatrolAction(); // 保存アクションモデル

$config = g_getConfig(); // 設定を取得します。

// ▼ 正パスデータを取得する
$file = 'data/data.json';
$jsonData = file_get_contents($file);
$correctData = json_decode($jsonData, true); // 正パスデータ

// ▼　最新パスデータを取得する
$target_dir = $config['target_dir'];
$latestData = $model->getPathData($target_dir); // 最新パスデータ

dump($latestData);//■■■□□□■■■□□□)