<?php 

function dump($var){
	
	echo '<pre><code>';
	var_dump($var);
	echo '</code></pre>';
}

// 設定を取得します。
function g_getConfig(){
	
	$config = [];
	
	// ローカル環境である場合の処理(サーバー名にlocalhostが含まれる場合)
	if(strpos($_SERVER['SERVER_NAME'], 'localhost') !== false){
		$config = parse_ini_file("config_l.ini");
	}else{
		$config = parse_ini_file("config_p.ini");
	}
	
	return $config;
	
}