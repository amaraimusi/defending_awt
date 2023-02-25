<?php
require_once 'common.php';
require_once 'Model/BaseX.php';


$config = g_getConfig(); // 設定を取得します。
$target_dir = $config['target_dir'];


if($_POST){
	$config['live_flg'] = $_POST['live_flg'];
	g_saveConfig($config); // 設定をiniファイルに保存する
}


dump('対象パス→' . $target_dir);


echo 'OK';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="google" content="notranslate" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEBかいざん防衛 | ワクガンス</title>

</head>
<body>
<h1>WEBかいざん防衛 | ワクガンス</h1>
<div class="container">

<form action="#" method="post">

	<table border="1">
		<thead><tr><th>設定名称</th><th>コード</th><th>値</th><th>変更</th></tr></thead>
		<tbody>
			<tr>
				<td>対象パス</td>
				<td>target_dir</td>
				<td><?php echo $config['target_dir']; ?></td>
				<td></td>
			</tr>
			<tr>
				<td>作動フラグ</td>
				<td>live_flg</td>
				<td><?php echo $config['live_flg']; ?></td>
				<td><input type="number" name="live_flg" value="<?php echo $config['live_flg']; ?>" required style="width:4em" />0:パトロール停止, 1:パトロール実行</td>
			</tr>
		</tbody>
	</table>
	<button>設定変更</button>
</form>

</div><!-- content -->
<div id="footer">(C) amaraimusi 2023-2-15</div>
</body>
</html>




