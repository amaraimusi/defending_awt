<?php
require_once 'common.php';
require_once 'Model/SaveAction.php';


$model = new SaveAction(); // 保存アクションモデル
$pathData = $model->getPathData('../');

dump($pathData);

// JSONに変換してテキストファイルに出力
//$jsonData = json_encode($data, JSON_PRETTY_PRINT); // JSON_PRETTY_PRINTを指定すると、出力されるJSONが整形されます。
$jsonData = json_encode($pathData, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);

$file = 'data/data.json'; // 出力するファイル名
file_put_contents($file, $jsonData);

echo 'OK';


