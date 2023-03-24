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
	$file_or_dir = $ent['file_or_dir']; 
	$size = $ent['size']; 
	
	$data_html .= "<tr><td>{$path_name}</td><td>{$update_date}</td><td>{$file_or_dir}</td><td>{$size}</td></tr>";
	
}


echo "
	<table border='2'>
		<thead>
			<tr><th>path_name</th><th>update_date</th><th>file_or_dir</th><th>size</th></tr>
		</thead>
		<tbody>
			{$data_html}
		</tbody>
	</table>
";



