<?php 
require_once 'common.php';

// ▼ 正パスデータを取得する
$file = 'data/data.json';
$jsonData = file_get_contents($file);
$correctData = json_decode($jsonData, true); // 正パスデータ

$data_html = "";

foreach($correctData as $ent){
	$path_name = $ent['path_name']; // パス名
	$update_date = $ent['update_date']; // 更新日
	
	$data_html .= "<tr><td>{$path_name}</td><td>{$update_date}</td></tr>";
	
}


echo "
	<table border='2'>
		<thead>
			<tr><th>path_name</th><th>update_date</th></tr>
		</thead>
		<tbody>
			{$data_html}
		</tbody>
	</table>
";



